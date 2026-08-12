<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoicePdfService
{
    /**
     * Generate PDF for invoice
     */
    public static function generate(Invoice $invoice): string
    {
        // Load invoice with relationships
        $invoice->load(['project.customer']);

        // Prepare data for PDF
        $data = [
            'invoice' => $invoice,
            'project' => $invoice->project,
            'customer' => $invoice->project->customer,
            'company' => self::getCompanyInfo(),
        ];

        // Generate PDF
        $pdf = Pdf::loadView('pdf.invoice', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif',
            ]);

        // Save PDF
        $filename = self::generatePdfFilename($invoice);
        $path = 'invoices/' . $filename;
        
        Storage::disk('local')->put($path, $pdf->output());

        // Update invoice with PDF path WITHOUT triggering observers
        $invoice->timestamps = false; // Disable timestamp updates
        $invoice->updateQuietly([
            'pdf_path' => $path,
            'pdf_generated_at' => now(),
        ]);
        $invoice->timestamps = true; // Re-enable timestamps

        return $path;
    }

    /**
     * Delete existing PDF if exists
     */
    public static function delete(Invoice $invoice): bool
    {
        if ($invoice->pdf_path && Storage::disk('local')->exists($invoice->pdf_path)) {
            return Storage::disk('local')->delete($invoice->pdf_path);
        }
        return false;
    }

    /**
     * Generate PDF filename
     */
    protected static function generatePdfFilename(Invoice $invoice): string
    {
        $invoiceNumber = str_replace(['/', '#'], '-', $invoice->invoice_number);
        $timestamp = now()->format('YmdHis');
        return "invoice_{$invoiceNumber}_{$timestamp}.pdf";
    }

    /**
     * Get company information
     */
    protected static function getCompanyInfo(): array
    {
        $setting = \App\Models\Setting::first();
        $logoPath = public_path('assets/media/logo.png');
        if ($setting && $setting->company_logo && Storage::disk('public')->exists($setting->company_logo)) {
            $logoPath = public_path('storage/' . $setting->company_logo);
        }

        return [
            'name' => Setting::get('site.company_name', 'PT SEKAWAN PUTRA PRATAMA'),
            'address' => Setting::get('contact.address', 'Perumahan Mega Regency, Blk. L5 No. 23, Sukaragam, Bekasi, Jawa Barat 17330'),
            'phone' => Setting::get('contact.phone', '+62 851-5641-2702'),
            'email' => Setting::get('contact.email', 'admin@sekawanputrapratama.com'),
            'website' => 'sekawanputrapratama.com',
            'logo' => $logoPath,
        ];
    }

    /**
     * Get bank account info for invoice
     */
    public static function getBankAccounts(): array
    {
        return [
            'bca' => [
                'bank_name' => 'Bank Central Asia (BCA)',
                'account_number' => '1234567890',
                'account_name' => 'PT. PT Sekawan Putra Pratama',
            ],
            'mandiri' => [
                'bank_name' => 'Bank Mandiri',
                'account_number' => '0987654321',
                'account_name' => 'PT. PT Sekawan Putra Pratama',
            ],
        ];
    }

    /**
     * Download PDF (generate if not exists)
     */
    public static function download(Invoice $invoice): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        // Generate PDF if not exists
        if (!$invoice->pdf_path || !Storage::disk('local')->exists($invoice->pdf_path)) {
            self::generate($invoice);
            $invoice->refresh();
        }

        $filePath = Storage::disk('local')->path($invoice->pdf_path);
        $downloadName = "Invoice_{$invoice->invoice_number}.pdf";

        return response()->download($filePath, $downloadName);
    }
}
