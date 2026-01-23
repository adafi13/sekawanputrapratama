<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\QuotationResource;
use App\Models\Lead;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateQuotation extends CreateRecord
{
    protected static string $resource = QuotationResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Pre-fill customer_id and lead_id from URL when form loads
        $leadId = request()->query('lead_id');
        
        if ($leadId) {
            $lead = Lead::find($leadId);
            
            if ($lead) {
                $data['lead_id'] = $lead->id;
                if ($lead->customer_id) {
                    $data['customer_id'] = $lead->customer_id;
                }
            }
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Check if lead_id is passed in URL query parameter
        $leadId = request()->query('lead_id');
        
        if ($leadId) {
            $lead = Lead::find($leadId);
            
            if ($lead) {
                // Pre-fill data from lead if not already set
                $data['lead_id'] = $data['lead_id'] ?? $lead->id;
                $data['customer_id'] = $data['customer_id'] ?? $lead->customer_id;
                
                // Pre-fill opening content with lead info
                if (empty($data['opening_content'])) {
                    $data['opening_content'] = "<p>Kepada Yth. <strong>{$lead->company_name}</strong>,</p>" .
                        "<p>Dengan hormat,</p>" .
                        "<p>Kami dari <strong>PT. Sekawan Putra Pratama</strong> mengajukan penawaran harga " .
                        "untuk project yang Bapak/Ibu rencanakan dengan detail sebagai berikut:</p>";
                }
            }
        }
        
        // Auto-set status to Draft on creation
        $data['status'] = \App\Models\Quotation::STATUS_DRAFT;
        
        // Ensure numeric fields are set (even if 0)
        $data['subtotal'] = $data['subtotal'] ?? 0;
        $data['tax_amount'] = $data['tax_amount'] ?? 0;
        $data['discount_amount'] = $data['discount_amount'] ?? 0;
        $data['total_amount'] = $data['total_amount'] ?? 0;
        
        // Calculate grand_total from items
        $items = $data['items'] ?? [];
        $subtotal = 0;
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
        }
        
        $data['subtotal'] = $subtotal;
        $data['discount_amount'] = $subtotal * ($discountPercent / 100);
        $data['total_amount'] = $afterDiscount;
        $data['grand_total'] = $grandTotal;
        
        return $data;
    }

    protected function afterCreate(): void
    {
        // Auto-generate PDF after creating quotation
        \App\Services\QuotationPdfService::generate($this->record);
        
        // Update lead status if quotation created from lead
        if ($this->record->lead_id) {
            $lead = $this->record->lead;
            
            if ($lead && in_array($lead->status, [Lead::STATUS_QUALIFIED, Lead::STATUS_CONTACTED])) {
                $lead->update([
                    'status' => Lead::STATUS_QUOTATION_SENT,
                    'quotation_sent_at' => now(),
                    'notes' => ($lead->notes ? $lead->notes . "\n\n" : '') . 
                        '[' . now()->format('Y-m-d H:i') . '] Quotation created: #' . $this->record->quotation_number,
                ]);
            }
        }
    }
}
