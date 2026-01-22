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
                }),
            Actions\Action::make('download_pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    // Check if file exists, if not regenerate
                    if (!$this->record->pdf_path || !Storage::disk('local')->exists($this->record->pdf_path)) {
                        \App\Services\QuotationPdfService::generate($this->record);
                        $this->record->refresh();
                    }
                    
                    return redirect()->route('quotations.download', $this->record);
                }),
        ];
    }
}
