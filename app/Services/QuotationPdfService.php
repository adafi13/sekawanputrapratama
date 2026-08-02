<?php

namespace App\Services;

use App\Models\Quotation;
use App\Models\Setting;
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

        // Calculate payment terms amounts dynamically
        $paymentTerms = [];
        if (is_array($quotation->payment_terms)) {
            foreach ($quotation->payment_terms as $term) {
                $percentage = (float) ($term['percentage'] ?? 0);
                $paymentTerms[] = [
                    'percentage' => $percentage,
                    'amount' => $grandTotal * ($percentage / 100),
                    'description' => $term['description'] ?? '',
                ];
            }
        }

        return [
            'subtotal' => $subtotal,
            'discount_percentage' => $quotation->discount_percentage ?? 0,
            'discount_amount' => $discountAmount,
            'after_discount' => $afterDiscount,
            'tax_percentage' => $quotation->tax_percentage ?? 11,
            'tax_amount' => $taxAmount,
            'grand_total' => $grandTotal,
            'payment_terms' => $paymentTerms,
        ];
    }

    /**
     * Get company information from settings
     */
    protected static function getCompanyInfo(): array
    {
        $setting = \App\Models\Setting::first();
        
        // Use logo from public/assets/media/logo.png as default
        $logoPath = public_path('assets/media/logo.png');
        
        // If settings has a custom logo in storage, use that
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
     * Get clean download filename for quotation
     */
    public static function getDownloadFilename(Quotation $quotation): string
    {
        $clientName = $quotation->customer->company_name ?? $quotation->lead->company_name ?? '';
        $cleanClient = $clientName ? \Illuminate\Support\Str::slug($clientName, '_') : '';

        if ($cleanClient) {
            return sprintf('Penawaran_%s_%s.pdf', $quotation->quotation_number, strtoupper($cleanClient));
        }

        return sprintf('Penawaran_%s.pdf', $quotation->quotation_number);
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
            self::getDownloadFilename($quotation)
        );
    }

    /**
     * Generate a crisp PNG company stamp as base64 Data URI using GD
     */
    public static function generateStampPng(string $companyName = 'PT SEKAWAN PUTRA PRATAMA'): string
    {
        if (!extension_loaded('gd')) {
            return '';
        }

        $w = 200;
        $h = 200;
        $img = imagecreatetruecolor($w, $h);

        imagealphablending($img, false);
        imagesavealpha($img, true);
        $transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
        imagefill($img, 0, 0, $transparent);
        imagealphablending($img, true);

        // Dark royal blue stamp ink color with slight opacity
        $blue = imagecolorallocatealpha($img, 30, 64, 175, 20);

        // Outer circle (thick)
        imagesetthickness($img, 4);
        imageellipse($img, 100, 100, 186, 186, $blue);

        // Inner circle (thin)
        imagesetthickness($img, 2);
        imageellipse($img, 100, 100, 156, 156, $blue);

        // Parallel middle lines
        imageline($img, 24, 82, 176, 82, $blue);
        imageline($img, 24, 118, 176, 118, $blue);

        // Center text
        $midText = "SEKAWAN";
        $xMid = (int)((200 - (strlen($midText) * imagefontwidth(5))) / 2);
        imagestring($img, 5, $xMid, 92, $midText, $blue);

        // Top text
        $cleanComp = strtoupper(trim($companyName));
        $xTop = (int)((200 - (strlen($cleanComp) * imagefontwidth(2))) / 2);
        if ($xTop < 10) $xTop = 10;
        imagestring($img, 2, $xTop, 40, $cleanComp, $blue);

        // Bottom text
        $botText = "BEKASI - INDONESIA";
        $xBot = (int)((200 - (strlen($botText) * imagefontwidth(2))) / 2);
        imagestring($img, 2, $xBot, 142, $botText, $blue);

        // Side stars
        imagestring($img, 3, 34, 92, "*", $blue);
        imagestring($img, 3, 158, 92, "*", $blue);

        ob_start();
        imagepng($img);
        $pngData = ob_get_clean();

        return 'data:image/png;base64,' . base64_encode($pngData);
    }
}
