<?php

namespace App\Console\Commands;

use App\Models\Quotation;
use Illuminate\Console\Command;

class RecalculateQuotationTotals extends Command
{
    protected $signature = 'quotations:recalculate';
    protected $description = 'Recalculate grand_total for all quotations based on items';

    public function handle()
    {
        $this->info('Recalculating quotation totals...');
        
        $quotations = Quotation::with('items')->get();
        $updated = 0;
        
        foreach ($quotations as $q) {
            $items = $q->items;
            $subtotal = 0;
            
            foreach ($items as $item) {
                $price = floatval($item->unit_price ?? 0);
                $disc = floatval($item->discount_percent ?? 0);
                $itemTotal = $price - ($price * ($disc / 100));
                $subtotal += $itemTotal;
            }
            
            $discountPercent = floatval($q->discount_percentage ?? 0);
            $afterDiscount = $subtotal - ($subtotal * ($discountPercent / 100));
            $grandTotal = $afterDiscount;
            
            if ($q->include_tax) {
                $taxPercent = floatval($q->tax_percentage ?? 12);
                $tax = $afterDiscount * ($taxPercent / 100);
                $grandTotal += $tax;
                $q->tax_amount = $tax;
            } else {
                $q->tax_amount = 0;
            }
            
            $q->subtotal = $subtotal;
            $q->discount_amount = $subtotal * ($discountPercent / 100);
            $q->total_amount = $afterDiscount;
            $q->grand_total = $grandTotal;
            $q->save();
            
            $this->line("✓ {$q->quotation_number}: Rp " . number_format($grandTotal, 0, ',', '.'));
            $updated++;
        }
        
        $this->info("\nDone! Updated {$updated} quotation(s).");
        
        return Command::SUCCESS;
    }
}
