<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa saja layanan yang ditawarkan Sekawan Putra Pratama?',
                'answer' => '<p>Kami menyediakan layanan lengkap untuk kebutuhan IT bisnis Anda:</p>
                <ul>
                    <li><strong>Web Development:</strong> Company Profile, E-Commerce, Web Application</li>
                    <li><strong>App Development:</strong> Mobile App (Android/iOS), Desktop Application</li>
                    <li><strong>Office Server:</strong> Instalasi, Konfigurasi, dan Maintenance Server</li>
                    <li><strong>IT Consulting:</strong> Konsultasi teknologi untuk solusi bisnis</li>
                    <li><strong>Onsite Support:</strong> Dukungan teknisi langsung di lokasi</li>
                </ul>',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama waktu pengerjaan proyek website?',
                'answer' => '<p>Waktu pengerjaan bervariasi tergantung kompleksitas proyek:</p>
                <ul>
                    <li><strong>Company Profile:</strong> 2-4 minggu</li>
                    <li><strong>E-Commerce:</strong> 4-8 minggu</li>
                    <li><strong>Web Application:</strong> 6-12 minggu</li>
                    <li><strong>Mobile App:</strong> 8-16 minggu</li>
                </ul>
                <p>Kami akan memberikan timeline yang jelas setelah diskusi kebutuhan proyek Anda.</p>',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah website yang dibuat SEO-friendly?',
                'answer' => '<p>Ya, semua website yang kami buat sudah dioptimasi untuk SEO (Search Engine Optimization). Kami menerapkan:</p>
                <ul>
                    <li>Struktur HTML yang semantik</li>
                    <li>Meta tags yang lengkap (title, description, keywords)</li>
                    <li>Optimasi kecepatan loading</li>
                    <li>Mobile-friendly dan responsive design</li>
                    <li>Structured data (JSON-LD) untuk search engine</li>
                    <li>Sitemap otomatis</li>
                </ul>',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah tersedia layanan maintenance setelah proyek selesai?',
                'answer' => '<p>Ya, kami menyediakan paket maintenance untuk memastikan website/aplikasi Anda selalu berjalan optimal:</p>
                <ul>
                    <li><strong>Maintenance Rutin:</strong> Update konten, backup data, monitoring</li>
                    <li><strong>Technical Support:</strong> Perbaikan bug, optimasi performa</li>
                    <li><strong>Security Update:</strong> Update keamanan dan patch</li>
                    <li><strong>24/7 Support:</strong> Dukungan teknis kapan saja Anda butuhkan</li>
                </ul>',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana proses kerja sama dengan Sekawan Putra Pratama?',
                'answer' => '<p>Proses kerja sama kami terstruktur dan transparan:</p>
                <ol>
                    <li><strong>Konsultasi Gratis:</strong> Diskusi kebutuhan dan solusi yang tepat</li>
                    <li><strong>Proposal & Quotation:</strong> Penawaran detail dengan timeline dan budget</li>
                    <li><strong>Kontrak & Pembayaran:</strong> Kesepakatan kontrak dan pembayaran</li>
                    <li><strong>Development:</strong> Proses pengembangan dengan update progress berkala</li>
                    <li><strong>Testing & Revisi:</strong> Uji coba dan perbaikan sesuai feedback</li>
                    <li><strong>Launch & Handover:</strong> Peluncuran dan serah terima proyek</li>
                    <li><strong>Support & Maintenance:</strong> Dukungan pasca launch</li>
                </ol>',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah website bisa dikelola sendiri setelah selesai?',
                'answer' => '<p>Ya, kami menyediakan CMS (Content Management System) yang user-friendly sehingga Anda dapat mengelola konten website sendiri tanpa perlu pengetahuan teknis. Kami juga menyediakan:</p>
                <ul>
                    <li>Training penggunaan CMS</li>
                    <li>Dokumentasi lengkap</li>
                    <li>Video tutorial</li>
                    <li>Support untuk pertanyaan teknis</li>
                </ul>
                <p>Namun, jika Anda lebih nyaman, kami juga menyediakan layanan content management.</p>',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'question' => 'Teknologi apa saja yang digunakan?',
                'answer' => '<p>Kami menggunakan teknologi modern dan terdepan untuk memastikan kualitas terbaik:</p>
                <ul>
                    <li><strong>Backend:</strong> Laravel, Node.js, PHP</li>
                    <li><strong>Frontend:</strong> Vue.js, React, Tailwind CSS</li>
                    <li><strong>Mobile:</strong> Flutter, React Native</li>
                    <li><strong>Database:</strong> MySQL, PostgreSQL, MongoDB</li>
                    <li><strong>Server:</strong> Linux, Docker, Cloud Infrastructure</li>
                    <li><strong>Tools:</strong> Git, CI/CD, Automated Testing</li>
                </ul>',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah tersedia layanan onsite support?',
                'answer' => '<p>Ya, kami menyediakan layanan teknisi onsite untuk:</p>
                <ul>
                    <li>Instalasi server di lokasi kantor</li>
                    <li>Setup jaringan dan infrastruktur IT</li>
                    <li>Troubleshooting masalah teknis</li>
                    <li>Training tim IT internal</li>
                    <li>Maintenance berkala</li>
                </ul>
                <p>Layanan onsite tersedia untuk area Jabodetabek dan sekitarnya. Untuk area lain, dapat didiskusikan lebih lanjut.</p>',
                'order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
