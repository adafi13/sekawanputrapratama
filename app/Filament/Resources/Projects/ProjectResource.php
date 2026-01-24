<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\ProjectResource\Pages;
use App\Models\Project;
use App\Models\Lead;
use App\Models\User;
use App\Models\Invoice;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components;
use Filament\Forms\Components as FormComponents;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'CRM';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Information')
                    ->schema([
                        Components\Select::make('lead_id')
                            ->label('Related Lead')
                            ->options(Lead::pluck('company_name', 'id'))
                            ->searchable()
                            ->nullable(),
                        Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Components\Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Schedule & Budget')
                    ->schema([
                        Components\DatePicker::make('start_date'),
                        Components\DatePicker::make('end_date'),
                        Components\TextInput::make('budget')
                            ->numeric()
                            ->prefix('Rp')
                            ->maxValue(999999999999.99),
                        Components\Select::make('status')
                            ->options(Project::getStatuses())
                            ->default(Project::STATUS_PLANNING)
                            ->required(),
                    ])->columns(2),

                Section::make('Assignment & Progress')
                    ->schema([
                        Components\Select::make('assigned_to')
                            ->label('Project Manager')
                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->nullable(),
                        Components\TextInput::make('completion_percentage')
                            ->numeric()
                            ->suffix('%')
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Project Name'),
                TextEntry::make('lead.company_name')
                    ->label('Client'),
                TextEntry::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Project::getStatuses()[$state] ?? $state)
                    ->color(fn ($state) => match($state) {
                        Project::STATUS_AWAITING_CONTRACT => 'warning',
                        Project::STATUS_PLANNING => 'gray',
                        Project::STATUS_IN_PROGRESS => 'info',
                        Project::STATUS_ON_HOLD => 'warning',
                        Project::STATUS_COMPLETED => 'success',
                        Project::STATUS_CANCELLED => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('assignedTo.name')
                    ->label('Project Manager'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('budget')
                    ->money('IDR'),
                TextEntry::make('completion_percentage')
                    ->suffix('%'),
                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('end_date')
                    ->date(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('lead.company_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                BadgeColumn::make('status')
                    ->formatStateUsing(fn ($state) => Project::getStatuses()[$state] ?? $state)
                    ->colors([
                        'warning' => [Project::STATUS_AWAITING_CONTRACT, Project::STATUS_AWAITING_DP],
                        'primary' => Project::STATUS_PLANNING,
                        'info' => [Project::STATUS_DEVELOPMENT_PHASE_1, Project::STATUS_DEVELOPMENT_PHASE_2],
                        'purple' => Project::STATUS_UAT,
                        'indigo' => Project::STATUS_DEPLOYMENT,
                        'success' => Project::STATUS_COMPLETED,
                        'gray' => Project::STATUS_ON_HOLD,
                        'danger' => Project::STATUS_CANCELLED,
                    ]),
                TextColumn::make('assignedTo.name')
                    ->label('PM')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('budget')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('lead_id')
                    ->label('Lead')
                    ->relationship('lead', 'company_name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('status')
                    ->options(Project::getStatuses()),
                SelectFilter::make('assigned_to')
                    ->label('Project Manager')
                    ->options(User::pluck('name', 'id')),
            ])
            ->recordActions([
                \Filament\Actions\ActionGroup::make([
                    // Sign Contract - Only for Manager when contract is DRAFT
                    Action::make('sign_contract')
                        ->label('Sign Contract')
                        ->icon(Heroicon::OutlinedDocumentCheck)
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalHeading('Sign Contract')
                        ->modalDescription('By signing this contract, DP invoice will be generated and you can proceed with project planning after payment.')
                        ->modalIcon(Heroicon::OutlinedPencilSquare)
                        ->visible(fn (Project $record) => 
                            $record->status === Project::STATUS_AWAITING_DP &&
                            $record->contract &&
                            $record->contract->status === 'draft'
                        )
                        ->form([
                            FormComponents\Textarea::make('notes')
                                ->label('Signature Notes')
                                ->placeholder('Add any notes about this contract signing...')
                                ->rows(2),
                        ])
                        ->action(function (Project $record, array $data) {
                            $contract = $record->contract;
                            
                            // Update contract to ACTIVE
                            $contract->update([
                                'status' => \App\Models\Contract::STATUS_ACTIVE,
                                'signed_at' => now(),
                            ]);
                            
                            // Generate DP Invoice automatically
                            $paymentTerms = $contract->payment_terms ?? [];
                            $dpPercentage = 30; // default
                            $dpDescription = 'Down Payment (DP)';
                            
                            if (isset($paymentTerms[0])) {
                                $dpPercentage = $paymentTerms[0]['percentage'] ?? 30;
                                $dpDescription = $paymentTerms[0]['description'] ?? 'Down Payment (DP)';
                            }
                            
                            $dpAmount = ($contract->contract_value * $dpPercentage) / 100;
                            
                            // Generate DP Invoice
                            $invoiceNumber = self::generateInvoiceNumber();
                            $invoice = \App\Models\Invoice::create([
                                'project_id' => $record->id,
                                'invoice_number' => $invoiceNumber,
                                'payment_stage' => 'dp',
                                'amount' => $dpAmount,
                                'status' => \App\Models\Invoice::STATUS_PENDING,
                                'issue_date' => now(),
                                'due_date' => now()->addDays(14),
                                'notes' => "Pembayaran {$dpDescription} - Contract signed",
                            ]);
                            
                            Notification::make()
                                ->title('Contract Signed Successfully')
                                ->success()
                                ->body("Contract signed and DP invoice {$invoiceNumber} generated (Rp " . number_format($dpAmount, 0, ',', '.') . "). Please proceed with payment to start planning.")
                                ->send();
                        }),
                    
                    // Next Stage - Progress project status
                    Action::make('next_stage')
                        ->label(function (Project $record) {
                            // Jika tidak bisa maju karena pembayaran, beri label peringatan
                            if (!$record->canAdvanceToNextStage()) {
                                return 'Pending Payment';
                            }

                            return match($record->status) {
                                Project::STATUS_AWAITING_DP => 'Start Planning',
                                Project::STATUS_PLANNING => 'Start Development Phase 1',
                                Project::STATUS_DEVELOPMENT_PHASE_1 => 'Advance to Phase 2',
                                Project::STATUS_DEVELOPMENT_PHASE_2 => 'Open UAT Access',
                                Project::STATUS_UAT => 'Release to Production',
                                Project::STATUS_DEPLOYMENT => 'Complete Project',
                                default => 'Next Stage',
                            };
                        })
                        ->icon(fn (Project $record) => $record->canAdvanceToNextStage() 
                            ? 'heroicon-o-arrow-right' 
                            : 'heroicon-o-credit-card'
                        )
                        ->color(fn (Project $record) => $record->canAdvanceToNextStage() ? 'success' : 'warning')
                        ->requiresConfirmation()
                        ->modalHeading(function (Project $record) {
                            $nextStatus = $record->getNextStatus();
                            return $record->canAdvanceToNextStage() 
                                ? 'Advance to: ' . (Project::getStatuses()[$nextStatus] ?? 'Next Stage')
                                : 'Payment Required';
                        })
                        ->modalDescription(function (Project $record) {
                            if (!$record->canAdvanceToNextStage()) {
                                return match($record->status) {
                                    Project::STATUS_AWAITING_DP => '❌ Termin 1 (DP 30%) belum lunas. Anda tidak bisa memulai fase Planning.',
                                    Project::STATUS_DEVELOPMENT_PHASE_2 => '❌ Termin 2 (Progress 40%) belum lunas. Akses UAT tidak dapat dibuka.',
                                    Project::STATUS_UAT => '❌ Termin 3 (Final 30%) belum lunas. Deploy ke server produksi dilarang.',
                                    default => 'Silakan selesaikan pembayaran invoice yang menggantung sebelum lanjut.',
                                };
                            }

                            return 'Pastikan semua checklist di tahap ini sudah selesai sebelum berpindah ke stage berikutnya.';
                        })
                        ->modalIcon(fn (Project $record) => $record->canAdvanceToNextStage() 
                            ? 'heroicon-o-arrow-trending-up' 
                            : 'heroicon-o-exclamation-triangle'
                        )
                        // Sembunyikan form input NOTES jika pembayaran belum lunas agar admin tidak capek mengetik
                        ->form(fn (Project $record) => $record->canAdvanceToNextStage() ? [
                            FormComponents\Textarea::make('notes')
                                ->label('Stage Progression Notes')
                                ->placeholder('Contoh: Semua fitur phase 1 sudah diapprove klien...')
                                ->required()
                                ->rows(3),
                        ] : [])
                        ->visible(fn (Project $record) => 
                            $record->status !== Project::STATUS_AWAITING_CONTRACT && 
                            $record->getNextStatus() !== null
                        )
                        ->action(function (Project $record, array $data, $action) {
                            // Double check di sisi server
                            if (!$record->canAdvanceToNextStage()) {
                                Notification::make()
                                    ->title('Proses Dibatalkan')
                                    ->danger()
                                    ->body('Status tidak dapat diubah karena syarat pembayaran belum terpenuhi.')
                                    ->send();
                                
                                $action->halt(); // Menghentikan eksekusi action
                                return;
                            }

                            $oldStatus = $record->status;
                            $nextStatus = $record->getNextStatus();
                            
                            $record->update([
                                'status' => $nextStatus,
                                // Opsional: simpan notes ke tabel history/log jika ada
                            ]);

                            Notification::make()
                                ->title('Project Advanced Successfully')
                                ->success()
                                ->body("Project moved to " . Project::getStatuses()[$nextStatus])
                                ->send();
                        }),
                    
                    // Previous Stage - Rollback with reason
                    Action::make('previous_stage')
                        ->label('Previous Stage')
                        ->icon(Heroicon::OutlinedArrowLeft)
                        ->color('gray')
                        ->requiresConfirmation()
                        ->modalHeading(fn (Project $record) => 'Rollback to: ' . (Project::getStatuses()[$record->getPreviousStatus()] ?? 'Previous Stage'))
                        ->modalDescription('Move this project back to the previous stage.')
                        ->modalIcon(Heroicon::OutlinedArrowUturnLeft)
                        ->visible(fn (Project $record) => $record->getPreviousStatus() !== null)
                        ->form([
                            FormComponents\Textarea::make('reason')
                                ->label('Rollback Reason')
                                ->placeholder('Why are you moving back to the previous stage?')
                                ->required()
                                ->rows(3),
                        ])
                        ->action(function (Project $record, array $data) {
                            $oldStatus = $record->status;
                            $previousStatus = $record->getPreviousStatus();
                            
                            $record->update(['status' => $previousStatus]);
                            
                            Notification::make()
                                ->title('Stage Rolled Back')
                                ->warning()
                                ->body("Project moved back from " . Project::getStatuses()[$oldStatus] . " to " . Project::getStatuses()[$previousStatus])
                                ->send();
                        }),
                ])
                ->label('Actions')
                ->icon(Heroicon::OutlinedEllipsisVertical)
                ->size('sm')
                ->color('primary')
                ->button(),
                
                \Filament\Actions\ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * Generate unique invoice number.
     */
    protected static function generateInvoiceNumber(): string
    {
        $year = date('Y');
        $month = date('m');
        
        // Count invoices this month
        $count = \App\Models\Invoice::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count() + 1;
            
        return sprintf('INV-%s%s-%04d', $year, $month, $count);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
