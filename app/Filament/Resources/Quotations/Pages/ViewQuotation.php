<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\QuotationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewQuotation extends ViewRecord
{
    protected static string $resource = QuotationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('regenerate_pdf')
                ->label('Regenerate PDF')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->action(function () {
                    try {
                        // Delete old PDF if exists
                        if ($this->record->pdf_path && Storage::disk('local')->exists($this->record->pdf_path)) {
                            Storage::disk('local')->delete($this->record->pdf_path);
                        }
                        
                        // Generate new PDF
                        \App\Services\QuotationPdfService::generate($this->record);
                        $this->record->refresh();
                        
                        \Filament\Notifications\Notification::make()
                            ->title('PDF Regenerated')
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        \Filament\Notifications\Notification::make()
                            ->title('Error')
                            ->body('Gagal membuat PDF: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Actions\Action::make('download_pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    try {
                        // Check if file exists, if not regenerate
                        if (!$this->record->pdf_path || !Storage::disk('local')->exists($this->record->pdf_path)) {
                            \App\Services\QuotationPdfService::generate($this->record);
                            $this->record->refresh();
                        }
                        return response()->download(
                            Storage::disk('local')->path($this->record->pdf_path),
                            'Quotation-'.$this->record->quotation_number.'-'.now()->format('Y-m-d').'.pdf'
                        );
                    } catch (\Throwable $e) {
                        \Filament\Notifications\Notification::make()
                            ->title('Error')
                            ->body('Gagal mengunduh PDF: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
