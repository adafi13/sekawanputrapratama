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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Calculate grand_total from items
        $items = $data['items'] ?? [];
        $subtotal = 0;
        
        \Log::info('EditQuotation - Items count: ' . count($items));
        
        foreach ($items as $item) {
            $price = floatval($item['unit_price'] ?? 0);
            $disc = floatval($item['discount_percent'] ?? 0);
            $itemTotal = $price - ($price * ($disc / 100));
            $subtotal += $itemTotal;
        }
        
        $discountPercent = floatval($data['discount_percentage'] ?? 0);
        $afterDiscount = $subtotal - ($subtotal * ($discountPercent / 100));
        $grandTotal = $afterDiscount;
        
        if (!empty($data['include_tax'])) {
            $taxPercent = floatval($data['tax_percentage'] ?? 12);
            $tax = $afterDiscount * ($taxPercent / 100);
            $grandTotal += $tax;
            $data['tax_amount'] = $tax;
        } else {
            $data['tax_amount'] = 0;
        }
        
        $data['subtotal'] = $subtotal;
        $data['discount_amount'] = $subtotal * ($discountPercent / 100);
        $data['total_amount'] = $afterDiscount;
        $data['grand_total'] = $grandTotal;
        
        \Log::info('EditQuotation - Calculated grand_total: ' . $grandTotal);
        
        return $data;
    }

    protected function afterSave(): void
    {
        // Ensure grand_total is saved - backup method
        $items = $this->record->items;
        if ($items->count() > 0 && $this->record->grand_total == 0) {
            $subtotal = 0;
            foreach ($items as $item) {
                $price = floatval($item->unit_price ?? 0);
                $disc = floatval($item->discount_percent ?? 0);
                $itemTotal = $price - ($price * ($disc / 100));
                $subtotal += $itemTotal;
            }
            
            $discountPercent = floatval($this->record->discount_percentage ?? 0);
            $afterDiscount = $subtotal - ($subtotal * ($discountPercent / 100));
            $grandTotal = $afterDiscount;
            
            if ($this->record->include_tax) {
                $taxPercent = floatval($this->record->tax_percentage ?? 12);
                $tax = $afterDiscount * ($taxPercent / 100);
                $grandTotal += $tax;
                $this->record->tax_amount = $tax;
            }
            
            $this->record->subtotal = $subtotal;
            $this->record->discount_amount = $subtotal * ($discountPercent / 100);
            $this->record->total_amount = $afterDiscount;
            $this->record->grand_total = $grandTotal;
            $this->record->saveQuietly();
            
            \Log::info('EditQuotation afterSave - Updated grand_total: ' . $grandTotal);
        }
    }

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
