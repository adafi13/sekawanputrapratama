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

        // Get the file path
        $filePath = Storage::disk('local')->path($quotation->pdf_path);

        // Generate filename for download
        $filename = sprintf(
            'Quotation-%s-%s.pdf',
            $quotation->quotation_number,
            now()->format('Y-m-d')
        );

        // Stream the file
        return response()->download($filePath, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
