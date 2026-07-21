<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Testimonial;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $testimonials = [
            [
                'testimonial' => 'Pemasangan sistem keamanan CCTV & pengawasan area pabrik kosmetik kami diselesaikan dengan sangat rapi dan sesuai standar ISO. Sistem monitoring dapat dipantau realtime 24/7 dari smartphone tanpa kendala. Sangat memuaskan!',
                'client_name' => 'Hani Fitriani',
                'client_company' => 'PT Banyu Ayu Kosmetika',
                'company_industry' => 'Kosmetik & Manufaktur',
                'client_position' => 'Operational Director',
                'rating' => 5,
                'is_verified' => true,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'testimonial' => 'Integrasi infrastruktur jaringan dan sistem keamanan CCTV untuk fasilitas teknik kami berjalan presisi. Tim PT Sekawan Putra Pratama sangat profesional, responsif, dan memberikan edukasi pemeliharaan secara detail.',
                'client_name' => 'Hendra Gunawan',
                'client_company' => 'PT Gema Solution Teknik',
                'company_industry' => 'Engineering & Teknik',
                'client_position' => 'Head of IT & Security',
                'rating' => 5,
                'is_verified' => true,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'testimonial' => 'Implementasi infrastruktur server & jaringan antar-cabang kami ditangani secara efisien tanpa downtime operasional. Performa jaringan meningkat pesat dan manajemen server menjadi sangat terstruktur. Sangat direkomendasikan!',
                'client_name' => 'Raymond Wijaya',
                'client_company' => 'PT Sarana Mitra Luas, Tbk.',
                'company_industry' => 'Logistik & Rental Handling',
                'client_position' => 'GM Infrastructure',
                'rating' => 5,
                'is_verified' => true,
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'testimonial' => 'Pengembangan landing page dan portal informasi layanan ISP kami dikerjakan sangat cepat, modern, dan sangat responsif di semua perangkat. Tingkat konversi calon pelanggan baru meningkat tajam setelah launching!',
                'client_name' => 'Aris Setiawan',
                'client_company' => 'Hyperlink ISP',
                'company_industry' => 'Provider Internet & Telco',
                'client_position' => 'Chief Technology Officer (CTO)',
                'rating' => 5,
                'is_verified' => true,
                'is_featured' => true,
                'order' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['client_company' => $testimonial['client_company']],
                $testimonial
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Testimonial::whereIn('client_company', [
            'PT Banyu Ayu Kosmetika',
            'PT Gema Solution Teknik',
            'PT Sarana Mitra Luas, Tbk.',
            'Hyperlink ISP',
        ])->delete();
    }
};
