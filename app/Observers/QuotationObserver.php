<?php

namespace App\Observers;

use App\Models\Quotation;
use App\Services\QuotationPdfService;
use Illuminate\Support\Facades\Log;

class QuotationObserver
{
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
