<?php

namespace App\Filament\Resources\Contracts\Tables;

use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components as FormComponents;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContractsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contract_number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('customer.company_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('contract_value')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'draft',
                        'warning' => 'sent',
                        'info' => 'signed',
                        'success' => 'active',
                        'success' => 'completed',
                        'danger' => 'terminated',
                    ]),
                TextColumn::make('signed_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // Download PDF Contract/SPK
                Action::make('download_pdf')
                    ->label('Download')
                    ->icon(Heroicon::OutlinedDocumentArrowDown)
                    ->color('success')
                    ->action(function (Contract $record) {
                        // 1. Setup company data
                        $company = [
                            'name' => 'PT. SEKAWAN PUTRA PRATAMA',
                            'address' => 'Grand Galaxy City, Jl. Boulevard Raya, Bekasi',
                            'phone' => '+62 21 8888 9999',
                            'email' => 'info@sekawanputrapratama.com',
                        ];

                        // 2. Get payment terms from contract (from quotation or custom)
                        $paymentTerms = $record->payment_terms ?? [
                            [
                                'description' => 'Termin 1 (DP - Down Payment)',
                                'percentage' => 30,
                                'amount' => $record->contract_value * 0.30
                            ],
                            [
                                'description' => 'Termin 2 (Progress Development)',
                                'percentage' => 40,
                                'amount' => $record->contract_value * 0.40
                            ],
                            [
                                'description' => 'Termin 3 (Serah Terima / UAT)',
                                'percentage' => 30,
                                'amount' => $record->contract_value * 0.30
                            ],
                        ];

                        $calculations = [
                            'grand_total' => $record->contract_value,
                            'payment_terms' => $paymentTerms,
                        ];

                        // 3. Smart template selection based on project_type and contract value
                        if ($record->project_type === Contract::TYPE_MANAGED_SERVICE) {
                            // Managed Service Template (License + Maintenance)
                            $viewFile = 'pdf.contract_managed_service';
                            $fileName = 'Contract-ManagedService-' . $record->contract_number;
                        } else {
                            // Buy-Out Templates
                            $threshold = 15000000; // 15 Million IDR
                            
                            if ($record->contract_value >= $threshold) {
                                // Enterprise Buy-Out Contract (>= 15 Million)
                                $viewFile = 'pdf.contract_enterprise';
                                $fileName = 'Contract-Enterprise-' . $record->contract_number;
                            } else {
                                // Simple Buy-Out SPK (< 15 Million)
                                $viewFile = 'pdf.contract_simple';
                                $fileName = 'SPK-' . $record->contract_number;
                            }
                        }

                        // 4. Generate PDF
                        $pdf = Pdf::loadView($viewFile, [
                            'contract' => $record,
                            'quotation' => $record->quotation,
                            'company' => $company,
                            'calculations' => $calculations,
                        ]);

                        $pdf->setPaper('a4', 'portrait');

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, $fileName . '.pdf');
                    }),
                
                // Sign Contract - Only when status is DRAFT
                Action::make('sign_contract')
                    ->label('Sign')
                    ->icon(Heroicon::OutlinedDocumentCheck)
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Sign Contract')
                    ->modalDescription('By signing this contract, it will become active.')
                    ->modalIcon(Heroicon::OutlinedPencilSquare)
                    ->visible(fn (Contract $record) => $record->status === Contract::STATUS_DRAFT)
                    ->form([
                        FormComponents\Textarea::make('notes')
                            ->label('Signature Notes')
                            ->placeholder('Add any notes about this contract signing...')
                            ->rows(2),
                    ])
                    ->action(function (Contract $record, array $data) {
                        // Update contract to ACTIVE
                        $record->update([
                            'status' => Contract::STATUS_ACTIVE,
                            'signed_at' => now(),
                        ]);
                        
                        // Generate DP Invoice automatically
                        $paymentTerms = $record->payment_terms ?? [];
                        $dpPercentage = 30; // default
                        $dpDescription = 'Down Payment (DP)';
                        
                        if (isset($paymentTerms[0])) {
                            $dpPercentage = $paymentTerms[0]['percentage'] ?? 30;
                            $dpDescription = $paymentTerms[0]['description'] ?? 'Down Payment (DP)';
                        }
                        
                        $dpAmount = ($record->contract_value * $dpPercentage) / 100;
                        
                        // Generate DP Invoice
                        $year = date('Y');
                        $month = date('m');
                        $invoiceCount = \App\Models\Invoice::whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->count() + 1;
                        $invoiceNumber = sprintf('INV-%s%s-%04d', $year, $month, $invoiceCount);
                        
                        $invoice = \App\Models\Invoice::create([
                            'project_id' => $record->project_id,
                            'invoice_number' => $invoiceNumber,
                            'payment_stage' => 'dp',
                            'amount' => $dpAmount,
                            'status' => \App\Models\Invoice::STATUS_PENDING,
                            'issue_date' => now(),
                            'due_date' => now()->addDays(14),
                            'notes' => "Pembayaran {$dpDescription} - Contract signed",
                        ]);
                        
                        // Auto-advance project to PLANNING if exists (legacy)
                        if ($record->project && $record->project->status === 'awaiting_contract') {
                            $record->project->update([
                                'status' => 'planning',
                            ]);
                        }
                        
                        Notification::make()
                            ->title('Contract Signed Successfully')
                            ->success()
                            ->body("Contract signed and DP invoice {$invoiceNumber} generated (Rp " . number_format($dpAmount, 0, ',', '.') . "). Please proceed with payment to start planning.")
                            ->send();
                    }),
                
                \Filament\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
