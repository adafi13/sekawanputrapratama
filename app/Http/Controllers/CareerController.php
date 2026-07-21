<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Active career job openings.
     */
    protected function getJobs()
    {
        return [
            'fullstack-web-developer' => [
                'id' => 1,
                'slug' => 'fullstack-web-developer',
                'title' => 'Fullstack Web Developer (Laravel & React)',
                'department' => 'Engineering',
                'location' => 'Bekasi / Hybrid (Remote)',
                'type' => 'Full-time / Magang (Internship)',
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
            ],
            'mobile-flutter-developer' => [
                'id' => 2,
                'slug' => 'mobile-flutter-developer',
                'title' => 'Mobile App Developer (Flutter / React Native)',
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
            ],
            'ui-ux-designer' => [
                'id' => 3,
                'slug' => 'ui-ux-designer',
                'title' => 'UI/UX Designer & Product Specialist',
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
            ],
            'devops-system-administrator' => [
                'id' => 4,
                'slug' => 'devops-system-administrator',
                'title' => 'DevOps & IT Server Administrator',
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
            ],
        ];
    }

    /**
     * Display list of active careers.
     */
    public function index()
    {
        $jobs = $this->getJobs();
        return view('frontend.careers.index', compact('jobs'));
    }

    /**
     * Display job details & application form.
     */
    public function show($slug)
    {
        $jobs = $this->getJobs();

        if (!isset($jobs[$slug])) {
            abort(404);
        }

        $job = $jobs[$slug];
        return view('frontend.careers.show', compact('job'));
    }

    /**
     * Handle job application form submission.
     */
    public function apply(Request $request, $slug)
    {
        $jobs = $this->getJobs();

        if (!isset($jobs[$slug])) {
            abort(404);
        }

        $job = $jobs[$slug];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'portfolio_link' => 'nullable|url|max:255',
            'resume' => 'required|file|mimes:pdf|max:5120',
            'cover_letter' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'phone.required' => 'Nomor HP/WA wajib diisi.',
            'resume.required' => 'File Resume / CV (PDF) wajib diunggah.',
            'resume.mimes' => 'Format resume harus berupa PDF.',
            'resume.max' => 'Ukuran file resume maksimal 5MB.',
        ]);

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
        }

        return back()->with('success', 'Terima kasih! Lamaran posisi ' . $job['title'] . ' berhasil dikirim. Tim HR Sekawan Putra Pratama akan meninjau CV Anda.');
    }
}
