<?php

namespace App\Filament\Resources\Invoices\InvoiceResource\Pages;

use App\Filament\Resources\Invoices\InvoiceResource;
use App\Services\InvoicePdfService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Download PDF Action
            Actions\Action::make('download_pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    return InvoicePdfService::download($this->record);
                }),

            // Regenerate PDF Action
            Actions\Action::make('regenerate_pdf')
                ->label('Regenerate PDF')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Regenerate Invoice PDF')
                ->modalDescription('This will delete the existing PDF and generate a new one with current data.')
                ->action(function () {
                    // Delete old PDF
                    if ($this->record->pdf_path && Storage::disk('local')->exists($this->record->pdf_path)) {
                        Storage::disk('local')->delete($this->record->pdf_path);
                    }
                    
                    // Generate new PDF
                    InvoicePdfService::generate($this->record);
                    $this->record->refresh();
                    
                    Notification::make()
                        ->title('PDF Regenerated Successfully')
                        ->success()
                        ->send();
                }),

            Actions\DeleteAction::make(),
        ];
    }
}
