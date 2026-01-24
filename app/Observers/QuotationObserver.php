<?php

namespace App\Observers;

use App\Models\Quotation;
use App\Services\QuotationPdfService;
use Illuminate\Support\Facades\Log;

class QuotationObserver
{
    /**
     * Handle the Quotation "saving" event.
     * This runs BEFORE save, allowing us to modify the model.
     */
    public function saving(Quotation $quotation): void
    {
        $this->calculateTotals($quotation);
    }

    /**
     * Calculate and update quotation totals
     */
    protected function calculateTotals(Quotation $quotation): void
    {
        // Calculate subtotal from items if available
        if ($quotation->exists && $quotation->relationLoaded('items')) {
            $subtotal = $quotation->items->sum(function ($item) {
                $price = floatval($item->unit_price ?? 0);
                $discountPercent = floatval($item->discount_percent ?? 0);
                return $price - ($price * ($discountPercent / 100));
            });
            
            $quotation->subtotal = $subtotal;
        } else {
            // Use existing subtotal if items not loaded
            $subtotal = floatval($quotation->subtotal ?? 0);
        }

        // Calculate discount amount
        $discountPercent = floatval($quotation->discount_percentage ?? 0);
        $discountAmount = $subtotal * ($discountPercent / 100);
        $quotation->discount_amount = $discountAmount;

        // Calculate amount after discount
        $afterDiscount = $subtotal - $discountAmount;

        // Calculate tax if applicable
        $taxAmount = 0;
        if ($quotation->include_tax) {
            $taxPercent = floatval($quotation->tax_percentage ?? 11);
            $taxAmount = $afterDiscount * ($taxPercent / 100);
        }
        $quotation->tax_amount = $taxAmount;

        // Calculate grand total
        $quotation->grand_total = $afterDiscount + $taxAmount;
    }
    
    /**
     * Handle the Quotation "created" event.
     */
    public function created(Quotation $quotation): void
    {
        //
    }

    /**
     * Handle the Quotation "updated" event.
     */
    public function updated(Quotation $quotation): void
    {
        //
    }

    /**
     * Handle the Quotation "saved" event (after created or updated).
     */
    public function saved(Quotation $quotation): void
    {
        // Auto-generate PDF after save
        // Skip if already generating to prevent infinite loop
        if (app()->has('quotation.generating_pdf') || $quotation->isDirty('pdf_path')) {
            return;
        }

        try {
            app()->instance('quotation.generating_pdf', true);
            
            // Generate PDF in background (after response)
            dispatch(function () use ($quotation) {
                try {
                    // Refresh quotation from database to get latest data
                    $quotation = $quotation->fresh(['lead', 'customer', 'items']);
                    if (!$quotation) {
                        return;
                    }
                    
                    QuotationPdfService::generate($quotation);
                    Log::info("PDF generated for quotation: {$quotation->quotation_number}");
                } catch (\Exception $e) {
                    Log::error("Failed to generate PDF for quotation {$quotation->quotation_number}: " . $e->getMessage());
                }
            })->afterResponse();
            
        } finally {
            app()->forgetInstance('quotation.generating_pdf');
        }
    }

    /**
     * Handle the Quotation "deleted" event.
     */
    public function deleted(Quotation $quotation): void
    {
        // Delete PDF file if exists
        if ($quotation->pdf_path) {
            \Storage::disk('local')->delete($quotation->pdf_path);
        }
    }

    /**
     * Handle the Quotation "restored" event.
     */
    public function restored(Quotation $quotation): void
    {
        //
    }

    /**
     * Handle the Quotation "force deleted" event.
     */
    public function forceDeleted(Quotation $quotation): void
    {
        // Delete PDF file if exists
        if ($quotation->pdf_path) {
            \Storage::disk('local')->delete($quotation->pdf_path);
        }
    }
}
