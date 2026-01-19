<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Web Development',
                'description' => 'Pembuatan website profesional, responsif, dan SEO-friendly untuk meningkatkan digital presence bisnis Anda.',
                'content' => '<p>Di era digital saat ini, website adalah wajah bisnis Anda di dunia online. Kami menawarkan jasa pembuatan website yang tidak hanya estetik, tetapi juga fungsional, cepat, aman, dan SEO-friendly.</p>
                <h4>Layanan Web Development Kami:</h4>
                <ul>
                    <li><strong>Company Profile Website:</strong> Website perusahaan profesional dengan CMS untuk kemudahan update konten</li>
                    <li><strong>E-Commerce / Online Store:</strong> Platform toko online lengkap dengan sistem pembayaran, manajemen produk, dan laporan penjualan</li>
                    <li><strong>Web Application:</strong> Sistem aplikasi web custom sesuai kebutuhan bisnis (ERP, CRM, Sistem Manajemen, dll)</li>
                    <li><strong>Landing Page:</strong> Halaman penjualan yang menarik dan konversi tinggi</li>
                </ul>
                <h4>Keunggulan Website Kami:</h4>
                <ul>
                    <li>Responsive Design (Mobile, Tablet, Desktop)</li>
                    <li>SEO Optimized untuk ranking Google</li>
                    <li>Fast Loading & High Performance</li>
                    <li>Secure & Protected dari serangan</li>
                    <li>User-Friendly CMS untuk update konten</li>
                    <li>Modern Tech Stack (Laravel, Vue.js, Tailwind CSS)</li>
                </ul>',
                'features' => [
                    'Responsive Design',
                    'SEO Optimized',
                    'Fast Loading',
                    'Secure & Protected',
                    'User-Friendly CMS',
                    'Modern Tech Stack'
                ],
                'technologies' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Vite'],
                'pricing_starting_from' => 5000000,
                'delivery_time' => '2-8 minggu',
                'order' => 1,
                'is_active' => true,
                'meta_title' => 'Jasa Web Development Profesional - Sekawan Putra Pratama',
                'meta_description' => 'Jasa pembuatan website profesional, responsif, dan SEO-friendly. Company Profile, E-Commerce, Web Application dengan teknologi terbaru.',
            ],
            [
                'title' => 'App Development',
                'description' => 'Pengembangan aplikasi mobile dan desktop yang stabil, user-friendly, dan berperforma tinggi untuk bisnis Anda.',
                'content' => '<p>Kami mengembangkan aplikasi mobile (Android/iOS) dan desktop yang responsif, stabil, dan mudah digunakan. Dengan teknologi terbaru, kami memastikan aplikasi Anda berjalan lancar di berbagai platform dan memberikan pengalaman pengguna yang optimal.</p>
                <h4>Layanan App Development Kami:</h4>
                <ul>
                    <li><strong>Mobile App (Android/iOS):</strong> Aplikasi mobile native atau cross-platform dengan Flutter/React Native</li>
                    <li><strong>Desktop Application:</strong> Aplikasi desktop untuk Windows, macOS, atau Linux</li>
                    <li><strong>Hybrid App:</strong> Aplikasi yang berjalan di multiple platform dengan satu codebase</li>
                    <li><strong>API Integration:</strong> Integrasi dengan sistem existing atau third-party services</li>
                </ul>
                <h4>Keunggulan Aplikasi Kami:</h4>
                <ul>
                    <li>Cross-Platform Development (satu code untuk Android & iOS)</li>
                    <li>Modern UI/UX Design</li>
                    <li>Offline Capability</li>
                    <li>Real-time Updates</li>
                    <li>Secure Data Handling</li>
                    <li>Scalable Architecture</li>
                </ul>',
                'features' => [
                    'Cross-Platform',
                    'Modern UI/UX',
                    'Offline Capability',
                    'Real-time Updates',
                    'Secure Data',
                    'Scalable Architecture'
                ],
                'technologies' => ['Flutter', 'React Native', 'Laravel API', 'Firebase', 'Dart'],
                'pricing_starting_from' => 15000000,
                'delivery_time' => '8-16 minggu',
                'order' => 2,
                'is_active' => true,
                'meta_title' => 'Jasa App Development Mobile & Desktop - Sekawan Putra Pratama',
                'meta_description' => 'Jasa pengembangan aplikasi mobile (Android/iOS) dan desktop profesional dengan teknologi Flutter dan React Native.',
            ],
            [
                'title' => 'Office Server & IT Infrastructure',
                'description' => 'Instalasi, konfigurasi, dan maintenance server kantor untuk keamanan data dan efisiensi operasional perusahaan.',
                'content' => '<p>Server aman dan terpusat untuk alur kerja perusahaan. Kami membantu Anda mengatur infrastruktur server kantor yang handal, aman, dan mudah dikelola. Dari setup awal hingga maintenance berkala, kami siap mendukung kebutuhan IT infrastructure bisnis Anda.</p>
                <h4>Layanan Server & IT Infrastructure Kami:</h4>
                <ul>
                    <li><strong>Server Installation:</strong> Instalasi dan konfigurasi server (Linux/Windows Server)</li>
                    <li><strong>Network Setup:</strong> Setup jaringan internal, firewall, dan security</li>
                    <li><strong>Data Backup System:</strong> Sistem backup otomatis untuk keamanan data</li>
                    <li><strong>Server Maintenance:</strong> Maintenance berkala dan monitoring 24/7</li>
                    <li><strong>Cloud Migration:</strong> Migrasi ke cloud infrastructure (AWS, GCP, Azure)</li>
                    <li><strong>Onsite Support:</strong> Dukungan teknisi langsung di lokasi</li>
                </ul>
                <h4>Keunggulan Layanan Kami:</h4>
                <ul>
                    <li>Setup Aman & Terpercaya</li>
                    <li>Backup Otomatis</li>
                    <li>Monitoring 24/7</li>
                    <li>Onsite Support Available</li>
                    <li>Scalable Infrastructure</li>
                    <li>Cost-Effective Solutions</li>
                </ul>',
                'features' => [
                    'Secure Setup',
                    'Auto Backup',
                    '24/7 Monitoring',
                    'Onsite Support',
                    'Scalable Infrastructure',
                    'Cost-Effective'
                ],
                'technologies' => ['Linux Server', 'Windows Server', 'Docker', 'Kubernetes', 'Cloud Infrastructure'],
                'pricing_starting_from' => 10000000,
                'delivery_time' => '1-4 minggu',
                'order' => 3,
                'is_active' => true,
                'meta_title' => 'Jasa Office Server & IT Infrastructure - Sekawan Putra Pratama',
                'meta_description' => 'Jasa instalasi, konfigurasi, dan maintenance server kantor profesional dengan dukungan teknisi onsite.',
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($service['title'])],
                $service
            );
        }
    }
}


