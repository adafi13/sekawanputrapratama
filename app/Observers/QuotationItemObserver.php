<?php

namespace App\Observers;

use App\Models\QuotationItem;

class QuotationItemObserver
{
    /**
     * Handle the QuotationItem "saving" event.
     * Calculate item total before saving.
     */
    public function saving(QuotationItem $item): void
    {
        // Calculate item total: unit_price - discount
        $price = floatval($item->unit_price ?? 0);
        $discountPercent = floatval($item->discount_percent ?? 0);
        $item->total = $price - ($price * ($discountPercent / 100));
    }

    /**
     * Handle the QuotationItem "saved" event.
     * Trigger quotation recalculation.
     */
    public function saved(QuotationItem $item): void
    {
        $this->recalculateQuotation($item);
    }

    /**
     * Handle the QuotationItem "deleted" event.
     * Trigger quotation recalculation.
     */
    public function deleted(QuotationItem $item): void
    {
        $this->recalculateQuotation($item);
    }

    /**
     * Recalculate parent quotation totals
     */
    protected function recalculateQuotation(QuotationItem $item): void
    {
        if (!$item->quotation) {
            return;
        }

        // Reload items to get fresh data
        $item->quotation->load('items');
        
        // Save quotation (this will trigger QuotationObserver::saving)
        $item->quotation->save();
    }
}
