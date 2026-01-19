<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $websiteCategory = PortfolioCategory::where('slug', 'website')->first();
        $appsCategory = PortfolioCategory::where('slug', 'apps')->first();
        $serverCategory = PortfolioCategory::where('slug', 'server')->first();

        $portfolios = [
            [
                'title' => 'Website Company Profile Modern',
                'description' => 'Website company profile modern dengan CMS terintegrasi untuk kemudahan update konten',
                'content' => '<p>Website company profile yang dibuat dengan teknologi Laravel dan Vue.js, dilengkapi dengan CMS yang user-friendly. Website ini responsif di semua perangkat, SEO-optimized, dan memiliki loading time yang sangat cepat.</p>',
                'challenge' => 'Klien membutuhkan website yang mudah dikelola sendiri tanpa perlu pengetahuan teknis, namun tetap profesional dan modern.',
                'solution' => 'Kami membuat website dengan CMS custom yang sangat intuitif, dilengkapi dengan editor WYSIWYG, manajemen media, dan fitur SEO built-in.',
                'results' => 'Website berhasil meningkatkan traffic organik sebesar 300% dalam 3 bulan pertama. Klien dapat mengupdate konten sendiri dengan mudah.',
                'metrics' => [
                    'Traffic Increase' => '300%',
                    'Loading Speed' => '< 2 detik',
                    'SEO Score' => '95/100'
                ],
                'category_id' => $websiteCategory?->id,
                'client_name' => 'PT. Maju Bersama',
                'client_industry' => 'Manufaktur',
                'project_date' => now()->subMonths(3),
                'project_duration' => '4 minggu',
                'project_url' => 'https://example.com',
                'technologies' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL'],
                'is_featured' => true,
                'order' => 1,
                'meta_title' => 'Portfolio Website Company Profile Modern - Sekawan Putra Pratama',
                'meta_description' => 'Website company profile modern dengan CMS terintegrasi, responsif, dan SEO-friendly.',
            ],
            [
                'title' => 'Aplikasi Mobile E-Commerce',
                'description' => 'Aplikasi mobile e-commerce cross-platform dengan fitur lengkap untuk Android dan iOS',
                'content' => '<p>Aplikasi mobile e-commerce yang dikembangkan menggunakan Flutter untuk cross-platform development. Aplikasi ini memiliki fitur lengkap mulai dari browsing produk, keranjang belanja, checkout, pembayaran, hingga tracking order.</p>',
                'challenge' => 'Klien membutuhkan aplikasi yang berjalan di Android dan iOS dengan budget terbatas dan waktu development yang efisien.',
                'solution' => 'Kami menggunakan Flutter untuk membuat satu codebase yang berjalan di kedua platform, menghemat waktu dan biaya development hingga 40%.',
                'results' => 'Aplikasi berhasil diluncurkan di Play Store dan App Store dengan rating 4.8/5.0. User engagement meningkat 250% dibandingkan website sebelumnya.',
                'metrics' => [
                    'App Rating' => '4.8/5.0',
                    'User Engagement' => '+250%',
                    'Development Time' => '12 minggu'
                ],
                'category_id' => $appsCategory?->id,
                'client_name' => 'Toko Online Sejahtera',
                'client_industry' => 'E-Commerce',
                'project_date' => now()->subMonths(2),
                'project_duration' => '12 minggu',
                'project_url' => 'https://example.com',
                'technologies' => ['Flutter', 'Firebase', 'Laravel API', 'Stripe Payment'],
                'is_featured' => true,
                'order' => 2,
                'meta_title' => 'Portfolio Aplikasi Mobile E-Commerce - Sekawan Putra Pratama',
                'meta_description' => 'Aplikasi mobile e-commerce cross-platform dengan fitur lengkap untuk Android dan iOS.',
            ],
            [
                'title' => 'Setup Server & IT Infrastructure Perusahaan',
                'description' => 'Instalasi dan konfigurasi server kantor dengan sistem backup otomatis dan monitoring 24/7',
                'content' => '<p>Setup infrastruktur IT lengkap untuk perusahaan dengan server Linux, sistem backup otomatis, firewall, dan monitoring. Dilengkapi dengan dokumentasi lengkap dan training untuk tim IT internal.</p>',
                'challenge' => 'Perusahaan membutuhkan infrastruktur server yang aman, stabil, dan mudah dikelola dengan budget yang efisien.',
                'solution' => 'Kami setup server menggunakan Linux dengan Docker untuk containerization, implementasi backup otomatis harian, dan setup monitoring system untuk alerting real-time.',
                'results' => 'Server berjalan stabil dengan uptime 99.9%. Sistem backup berhasil menyelamatkan data saat terjadi insiden. Tim IT internal sudah terlatih untuk maintenance harian.',
                'metrics' => [
                    'Server Uptime' => '99.9%',
                    'Backup Success Rate' => '100%',
                    'Response Time' => '< 1 detik'
                ],
                'category_id' => $serverCategory?->id,
                'client_name' => 'PT. Teknologi Nusantara',
                'client_industry' => 'Teknologi',
                'project_date' => now()->subMonths(1),
                'project_duration' => '3 minggu',
                'project_url' => null,
                'technologies' => ['Ubuntu Server', 'Docker', 'Nginx', 'MySQL', 'Redis'],
                'is_featured' => true,
                'order' => 3,
                'meta_title' => 'Portfolio Setup Server & IT Infrastructure - Sekawan Putra Pratama',
                'meta_description' => 'Instalasi dan konfigurasi server kantor profesional dengan sistem backup otomatis dan monitoring 24/7.',
            ],
            [
                'title' => 'Sistem ERP Custom',
                'description' => 'Sistem ERP (Enterprise Resource Planning) custom untuk manajemen operasional perusahaan',
                'content' => '<p>Sistem ERP yang dikembangkan khusus untuk kebutuhan perusahaan dengan modul lengkap: Inventory Management, Sales, Purchasing, Accounting, HR, dan Reporting. Sistem ini terintegrasi dengan sistem existing perusahaan.</p>',
                'challenge' => 'Perusahaan membutuhkan sistem ERP yang sesuai dengan workflow bisnis mereka, bukan sistem generic yang harus disesuaikan.',
                'solution' => 'Kami melakukan analisis mendalam terhadap workflow bisnis, kemudian mengembangkan sistem ERP custom yang sesuai dengan kebutuhan spesifik perusahaan.',
                'results' => 'Efisiensi operasional meningkat 40%, waktu proses berkurang 60%, dan akurasi data meningkat hingga 95%.',
                'metrics' => [
                    'Efficiency Increase' => '40%',
                    'Process Time Reduction' => '60%',
                    'Data Accuracy' => '95%'
                ],
                'category_id' => $websiteCategory?->id,
                'client_name' => 'PT. Industri Maju',
                'client_industry' => 'Manufaktur',
                'project_date' => now()->subMonths(6),
                'project_duration' => '16 minggu',
                'project_url' => null,
                'technologies' => ['Laravel', 'Vue.js', 'PostgreSQL', 'Redis', 'Docker'],
                'is_featured' => false,
                'order' => 4,
                'meta_title' => 'Portfolio Sistem ERP Custom - Sekawan Putra Pratama',
                'meta_description' => 'Sistem ERP custom untuk manajemen operasional perusahaan dengan modul lengkap.',
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::updateOrCreate(
                ['title' => $portfolio['title']],
                $portfolio
            );
        }
    }
}


