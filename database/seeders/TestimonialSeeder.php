<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'testimonial' => 'Pelayanan sangat profesional dan responsif. Website yang dibuat sangat cepat loading-nya dan SEO-friendly. Tim sangat komunikatif selama proses development. Hasilnya melebihi ekspektasi!',
                'client_name' => 'Budi Santoso',
                'client_company' => 'PT. Maju Bersama',
                'company_industry' => 'Manufaktur',
                'client_position' => 'Direktur',
                'rating' => 5,
                'is_verified' => true,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'testimonial' => 'Instalasi server berjalan sangat lancar dan profesional. Tim onsite support sangat membantu dalam setup dan training. Server kami sekarang lebih stabil dan aman. Recommended!',
                'client_name' => 'Siti Rahmawati',
                'client_company' => 'CV. Teknologi Nusantara',
                'company_industry' => 'Teknologi',
                'client_position' => 'Manager IT',
                'rating' => 5,
                'is_verified' => true,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'testimonial' => 'Aplikasi mobile yang dibuat sangat user-friendly dan performanya bagus. Proses development transparan dengan update progress berkala. Sangat puas dengan hasilnya!',
                'client_name' => 'Ahmad Fauzi',
                'client_company' => 'PT. Digital Solutions',
                'company_industry' => 'E-Commerce',
                'client_position' => 'CEO',
                'rating' => 5,
                'is_verified' => true,
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'testimonial' => 'Website e-commerce yang dibuat sangat lengkap dengan fitur pembayaran dan manajemen produk. Support pasca launch juga sangat baik. Terima kasih Sekawan Putra Pratama!',
                'client_name' => 'Dewi Lestari',
                'client_company' => 'Toko Online Sejahtera',
                'company_industry' => 'Retail',
                'client_position' => 'Owner',
                'rating' => 5,
                'is_verified' => true,
                'is_featured' => true,
                'order' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['client_name' => $testimonial['client_name'], 'client_company' => $testimonial['client_company']],
                $testimonial
            );
        }
    }
}


