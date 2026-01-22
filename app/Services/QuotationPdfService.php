<?php

namespace App\Services;

use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class QuotationPdfService
{
    /**
     * Generate PDF for quotation
     */
    public static function generate(Quotation $quotation): string
    {
        // Load quotation with relationships
        $quotation->load(['lead', 'customer', 'items']);

        // Calculate totals
        $calculations = self::calculateTotals($quotation);

        // Prepare data for PDF
        $data = [
            'quotation' => $quotation,
            'calculations' => $calculations,
            'company' => self::getCompanyInfo(),
        ];

        // Generate PDF
        $pdf = Pdf::loadView('pdf.quotation', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif',
            ]);

        // Save PDF
        $filename = self::generatePdfFilename($quotation);
        $path = 'quotations/' . $filename;
        
        Storage::disk('local')->put($path, $pdf->output());

        // Update quotation with PDF path WITHOUT triggering observers
        $quotation->timestamps = false; // Disable timestamp updates
        $quotation->updateQuietly([
            'pdf_path' => $path,
            'pdf_generated_at' => now(),
        ]);
        $quotation->timestamps = true; // Re-enable timestamps

        return $path;
    }

    /**
     * Calculate all totals and payment terms
     */
    protected static function calculateTotals(Quotation $quotation): array
    {
        $subtotal = 0;
        
        // Calculate subtotal from items (without quantity)
        foreach ($quotation->items as $item) {
            $price = $item->unit_price;
            $discount = $price * ($item->discount_percent / 100);
            $subtotal += ($price - $discount);
        }

        // Apply quotation-level discount percentage
        $discountAmount = $subtotal * (($quotation->discount_percentage ?? 0) / 100);
        $afterDiscount = $subtotal - $discountAmount;

        // Calculate tax if included
        $taxAmount = 0;
        if ($quotation->include_tax) {
            $taxPercentage = $quotation->tax_percentage ?? 11;
            $taxAmount = $afterDiscount * ($taxPercentage / 100);
        }

        // Grand total
        $grandTotal = $afterDiscount + $taxAmount;

        // Calculate payment terms amounts
        $term1Amount = $grandTotal * (($quotation->payment_term_1_percentage ?? 30) / 100);
        $term2Amount = $grandTotal * (($quotation->payment_term_2_percentage ?? 40) / 100);
        $term3Amount = $grandTotal * (($quotation->payment_term_3_percentage ?? 30) / 100);

        return [
            'subtotal' => $subtotal,
            'discount_percentage' => $quotation->discount_percentage ?? 0,
            'discount_amount' => $discountAmount,
            'after_discount' => $afterDiscount,
            'tax_percentage' => $quotation->tax_percentage ?? 11,
            'tax_amount' => $taxAmount,
            'grand_total' => $grandTotal,
            'payment_terms' => [
                [
                    'percentage' => $quotation->payment_term_1_percentage ?? 30,
                    'amount' => $term1Amount,
                    'description' => $quotation->payment_term_1_description ?? 'Down Payment',
                ],
                [
                    'percentage' => $quotation->payment_term_2_percentage ?? 40,
                    'amount' => $term2Amount,
                    'description' => $quotation->payment_term_2_description ?? 'Progress Payment',
                ],
                [
                    'percentage' => $quotation->payment_term_3_percentage ?? 30,
                    'amount' => $term3Amount,
                    'description' => $quotation->payment_term_3_description ?? 'Final Payment',
                ],
            ],
        ];
    }

    /**
     * Get company information from settings
     */
    protected static function getCompanyInfo(): array
    {
        $setting = \App\Models\Setting::first();
        
        return [
            'name' => $setting->company_name ?? 'SPP Company',
            'address' => $setting->company_address ?? '',
            'phone' => $setting->company_phone ?? '',
            'email' => $setting->company_email ?? '',
            'website' => $setting->company_website ?? '',
            'logo' => $setting->company_logo ?? null,
        ];
    }

    /**
     * Generate unique PDF filename
     */
    protected static function generatePdfFilename(Quotation $quotation): string
    {
        return sprintf(
            '%s_%s.pdf',
            $quotation->quotation_number,
            now()->format('YmdHis')
        );
    }

    /**
     * Get default terms and conditions
     */
    public static function getDefaultTerms(): array
    {
        return [
            [
                'id' => 'payment_terms',
                'label' => 'Pembayaran dilakukan dalam 3 termin sesuai dengan ketentuan yang tercantum',
                'checked' => true,
            ],
            [
                'id' => 'revision_policy',
                'label' => 'Revisi desain/konten dilakukan sesuai rounds yang disepakati',
                'checked' => true,
            ],
            [
                'id' => 'timeline',
                'label' => 'Timeline pengerjaan akan disesuaikan berdasarkan kesepakatan kedua belah pihak',
                'checked' => true,
            ],
            [
                'id' => 'warranty',
                'label' => 'Garansi bug fixing selama 30 hari setelah go-live',
                'checked' => true,
            ],
            [
                'id' => 'source_code',
                'label' => 'Source code akan diserahkan setelah pelunasan pembayaran termin terakhir',
                'checked' => true,
            ],
            [
                'id' => 'hosting_domain',
                'label' => 'Harga tidak termasuk biaya hosting dan domain (jika diperlukan)',
                'checked' => true,
            ],
            [
                'id' => 'training',
                'label' => 'Training pengelolaan sistem dilakukan 1x setelah serah terima',
                'checked' => true,
            ],
            [
                'id' => 'scope_change',
                'label' => 'Perubahan scope di luar kesepakatan awal akan dikenakan biaya tambahan',
                'checked' => true,
            ],
            [
                'id' => 'confidentiality',
                'label' => 'Kedua belah pihak setuju menjaga kerahasiaan informasi proyek',
                'checked' => true,
            ],
            [
                'id' => 'termination',
                'label' => 'Pembatalan proyek setelah DP tidak dapat mengembalikan biaya yang telah dibayarkan',
                'checked' => true,
            ],
        ];
    }

    /**
     * Download PDF
     */
    public static function download(Quotation $quotation): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        if (!$quotation->pdf_path || !Storage::disk('local')->exists($quotation->pdf_path)) {
            // Generate if not exists
            self::generate($quotation);
        }

        return Storage::disk('local')->download(
            $quotation->pdf_path,
            $quotation->quotation_number . '.pdf'
        );
    }
}
