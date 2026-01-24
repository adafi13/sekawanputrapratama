<?php

namespace App\Filament\Resources\Quotations\Tables;

use App\Models\Quotation;
use App\Services\QuotationPdfService;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class QuotationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quotation_number')
                    ->label('Quotation #')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Quotation number copied'),
                
                TextColumn::make('lead.company_name')
                    ->label('Lead / Client')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('customer.company_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Quotation::STATUS_DRAFT => 'gray',
                        Quotation::STATUS_SENT => 'info',
                        Quotation::STATUS_REVISED => 'warning',
                        Quotation::STATUS_ACCEPTED => 'success',
                        Quotation::STATUS_REJECTED => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => Quotation::getStatuses()[$state] ?? $state),
                
                TextColumn::make('grand_total')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable()
                    ->getStateUsing(function (Quotation $record) {
                        // Use grand_total if available, otherwise fall back to total_amount
                        return $record->grand_total ?? $record->total_amount ?? 0;
                    }),
                
                TextColumn::make('valid_until')
                    ->label('Valid Until')
                    ->date()
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(Quotation::getStatuses()),
                
                SelectFilter::make('customer_id')
                    ->relationship('customer', 'company_name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                
                Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->color('primary')
                    ->action(function (Quotation $record) {
                        try {
                            return QuotationPdfService::download($record);
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('Error')
                                ->body('Failed to generate PDF: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
                
                Action::make('regenerate_pdf')
                    ->label('Regenerate PDF')
                    ->icon(Heroicon::OutlinedArrowPath)
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Regenerate PDF')
                    ->modalDescription('This will regenerate the PDF file for this quotation.')
                    ->action(function (Quotation $record) {
                        try {
                            QuotationPdfService::generate($record);
                            
                            \Filament\Notifications\Notification::make()
                                ->title('PDF Regenerated')
                                ->body("PDF for quotation {$record->quotation_number} has been regenerated.")
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('Error')
                                ->body('Failed to regenerate PDF: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
                
                // Note: "Send to Client" removed - auto-triggered when Lead advances to Negotiation
                
                Action::make('mark_accepted')
                    ->label('Mark as Accepted')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Quotation $record): bool => in_array($record->status, [Quotation::STATUS_SENT, Quotation::STATUS_REVISED]))
                    ->action(function (Quotation $record) {
                        // Auto-sync: Update Lead to Deal FIRST (single update to avoid double observer call)
                        if ($record->lead_id) {
                            $lead = $record->lead;
                            if ($lead && $lead->status !== \App\Models\Lead::STATUS_DEAL) {
                                $lead->update([
                                    'status' => \App\Models\Lead::STATUS_DEAL,
                                    'deal_closed_at' => now(),
                                    'notes' => ($lead->notes ? $lead->notes . "\n\n" : '') . 
                                        '[' . now()->format('Y-m-d H:i') . '] Quotation accepted: #' . 
                                        $record->quotation_number . ' - Deal closed!',
                                ]);
                            }
                        }
                        
                        // Update quotation status (without triggering observer for lead)
                        $record->updateQuietly(['status' => Quotation::STATUS_ACCEPTED]);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Quotation Accepted')
                            ->body("Quotation {$record->quotation_number} accepted. Lead status updated to Deal!")
                            ->success()
                            ->send();
                    }),
                
                Action::make('mark_rejected')
                    ->label('Mark as Rejected')
                    ->icon(Heroicon::OutlinedXCircle)
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Quotation $record): bool => in_array($record->status, [Quotation::STATUS_SENT, Quotation::STATUS_REVISED]))
                    ->modalHeading('Mark Quotation as Rejected')
                    ->modalDescription('This will update the lead status to Lost.')
                    ->form([
                        \Filament\Forms\Components\Textarea::make('rejection_reason')
                            ->label('Rejection Reason')
                            ->required()
                            ->rows(3)
                            ->placeholder('Why was this quotation rejected?'),
                    ])
                    ->action(function (Quotation $record, array $data) {
                        $record->update([
                            'status' => Quotation::STATUS_REJECTED,
                            'notes' => ($record->notes ? $record->notes . "\n\n" : '') . 
                                '[' . now()->format('Y-m-d H:i') . '] Rejected: ' . $data['rejection_reason'],
                        ]);
                        
                        // Auto-sync: Update Lead to Lost
                        if ($record->lead_id) {
                            $lead = $record->lead;
                            if ($lead && $lead->status !== \App\Models\Lead::STATUS_LOST) {
                                $lead->update([
                                    'status' => \App\Models\Lead::STATUS_LOST,
                                    'notes' => ($lead->notes ? $lead->notes . "\n\n" : '') . 
                                        '[' . now()->format('Y-m-d H:i') . '] Quotation rejected: #' . 
                                        $record->quotation_number . ' - Reason: ' . $data['rejection_reason'],
                                ]);
                            }
                        }
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Quotation Rejected')
                            ->body("Quotation {$record->quotation_number} rejected. Lead status updated to Lost.")
                            ->danger()
                            ->send();
                    }),
                
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
