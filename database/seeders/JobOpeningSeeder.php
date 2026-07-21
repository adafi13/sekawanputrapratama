<?php

namespace Database\Seeders;

use App\Models\JobOpening;
use Illuminate\Database\Seeder;

class JobOpeningSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Fullstack Web Developer (Laravel & React)',
                'slug' => 'fullstack-web-developer',
                'department' => 'Engineering',
                'location' => 'Bekasi / Hybrid (Remote)',
                'type' => 'Full-time / Internship',
                'experience' => '1 - 3 Tahun',
                'description' => 'Kami mencari Fullstack Web Developer yang berpengalaman membangun aplikasi web berbasis Laravel dan React/Vue dengan performa tinggi & keamanan tinggi.',
                'responsibilities' => [
                    'Mengembangkan RESTful API & arsitektur database MySQL/PostgreSQL.',
                    'Membangun antarmuka web modern yang responsif dan cepat.',
                    'Melakukan QA testing, optimasi query DB, dan deployment ke Cloud Server (AWS/DigitalOcean).',
                    'Bekerja sama dengan Project Manager & UI/UX Designer dalam mengimplementasikan fitur.',
                ],
                'requirements' => [
                    'Menguasai PHP Framework (Laravel 10/11/12) & JavaScript (React/Vue/Node.js).',
                    'Pengalaman menggunakan Git version control (GitHub/GitLab).',
                    'Memahami arsitektur REST API & pemahaman baik tentang database relational.',
                    'Memiliki portofolio aplikasi web nyata yang pernah dibuat.',
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Mobile App Developer (Flutter / React Native)',
                'slug' => 'mobile-flutter-developer',
                'department' => 'Mobile Engineering',
                'location' => 'Bekasi / Remote',
                'type' => 'Full-time',
                'experience' => '1 - 2 Tahun',
                'description' => 'Mengembangkan aplikasi mobile cross-platform (Android & iOS) dengan Flutter/React Native yang memiliki UX tinggi dan terintegrasi dengan REST API.',
                'responsibilities' => [
                    'Mengembangkan dan memelihara aplikasi mobile Android & iOS.',
                    'Integrasi Payment Gateway, Push Notification, dan Google Maps SDK.',
                    'Build & publish rilis aplikasi ke Google Play Store & Apple App Store.',
                ],
                'requirements' => [
                    'Pengalaman Flutter / Dart / React Native minimal 1 tahun.',
                    'Memahami State Management (Bloc / Provider / Riverpod / Redux).',
                    'Pernah merilis minimal 1 aplikasi ke Play Store / App Store.',
                ],
                'is_active' => true,
            ],
            [
                'title' => 'UI/UX Designer & Product Specialist',
                'slug' => 'ui-ux-designer',
                'department' => 'Design',
                'location' => 'Bekasi / Remote',
                'type' => 'Full-time / Part-time',
                'experience' => '1+ Tahun',
                'description' => 'Merancang pengalaman pengguna (UX) dan antarmuka visual (UI) yang memukau, modern, dan berstandar internasional untuk produk website & aplikasi mobile.',
                'responsibilities' => [
                    'Membuat Wireframe, High-Fidelity Prototype di Figma.',
                    'Menyusun Design System, UI Kit, dan kustomisasi aset ikon visual.',
                    'Melakukan User Research dan Usability Testing.',
                ],
                'requirements' => [
                    'Mahir menggunakan Figma, Adobe XD, atau Photoshop/Illustrator.',
                    'Portofolio UI/UX yang dapat ditunjukkan di Behance, Dribbble, atau Figma link.',
                    'Memahami prinsip responsive design & micro-animation.',
                ],
                'is_active' => true,
            ],
            [
                'title' => 'DevOps & IT Server Administrator',
                'slug' => 'devops-system-administrator',
                'department' => 'Infrastructure',
                'location' => 'Bekasi / On-site / Remote',
                'type' => 'Full-time',
                'experience' => '2+ Tahun',
                'description' => 'Mengelola server Linux, Docker containerization, CI/CD pipeline, serta instalasi jaringan & infrastruktur IT untuk klien enterprise.',
                'responsibilities' => [
                    'Setup & maintenance Linux Web Server (Nginx, Apache, MySQL, Redis).',
                    'Konfigurasi Cloud VPS (AWS EC2, DigitalOcean, cPanel) & Security Firewall.',
                    'Monitoring server uptime, automated backup, dan SLA 99.9%.',
                ],
                'requirements' => [
                    'Pengalaman Linux System Administration (Ubuntu/Debian/CentOS).',
                    'Menguasai Docker, CI/CD GitHub Actions, & Nginx Reverse Proxy.',
                    'Pemahaman baik tentang jaringan TCP/IP, DNS, SSL/TLS, & Firewall.',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($jobs as $job) {
            JobOpening::updateOrCreate(['slug' => $job['slug']], $job);
        }
    }
}
