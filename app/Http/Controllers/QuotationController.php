<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class QuotationController extends Controller
{
    /**
     * Download the PDF file for a quotation
     */
    public function download(Quotation $quotation)
    {
        // Check if PDF exists
        if (!$quotation->pdf_path || !Storage::disk('local')->exists($quotation->pdf_path)) {
            abort(404, 'PDF file not found. Please regenerate the PDF.');
        }

        return \App\Services\QuotationPdfService::download($quotation);
    }
}
