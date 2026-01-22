<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\QuotationResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditQuotation extends EditRecord
{
    protected static string $resource = QuotationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('regenerate_pdf')
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
            Action::make('download_pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->visible(fn () => $this->record->pdf_path !== null)
                ->action(function () {
                    // Check if file exists, if not regenerate
                    if (!$this->record->pdf_path || !Storage::disk('local')->exists($this->record->pdf_path)) {
                        \App\Services\QuotationPdfService::generate($this->record);
                        $this->record->refresh();
                    }
                    
                    return redirect()->route('quotations.download', $this->record);
                }),
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
