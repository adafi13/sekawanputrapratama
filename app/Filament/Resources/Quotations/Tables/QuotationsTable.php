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
                
                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),
                
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
                
                Action::make('send_to_client')
                    ->label('Send to Client')
                    ->icon(Heroicon::OutlinedPaperAirplane)
                    ->color('info')
                    ->requiresConfirmation()
                    ->visible(fn (Quotation $record): bool => $record->status === Quotation::STATUS_DRAFT)
                    ->action(function (Quotation $record) {
                        $record->update(['status' => Quotation::STATUS_SENT]);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Quotation Sent')
                            ->body("Quotation {$record->quotation_number} has been marked as sent.")
                            ->success()
                            ->send();
                    }),
                
                Action::make('mark_accepted')
                    ->label('Mark as Accepted')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Quotation $record): bool => in_array($record->status, [Quotation::STATUS_SENT, Quotation::STATUS_REVISED]))
                    ->action(function (Quotation $record) {
                        $record->update(['status' => Quotation::STATUS_ACCEPTED]);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Quotation Accepted')
                            ->body("Quotation {$record->quotation_number} has been accepted.")
                            ->success()
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
