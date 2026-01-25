@extends('frontend.layouts.app')

@section('title', 'Sekawan Putra Pratama - Solusi IT Terintegrasi & Terpercaya')

@section('content')

<section class="position-relative py-5 overflow-hidden d-flex align-items-center" style="min-height: 100vh; background: #0b1120;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
        <div class="aurora-glow glow-1"></div>
        <div class="aurora-glow glow-2"></div>
        
        <div class="position-absolute w-100 h-100" 
             style="background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 40px 40px; opacity: 0.5;">
        </div>
    </div>

    <div class="container position-relative z-2 py-5">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-7 text-center text-lg-start">
                <div class="animate-up mb-4">
                    <span class="glass-badge px-4 py-2 rounded-pill d-inline-flex align-items-center">
                        <span class="pulse-dot me-2"></span>
                        <span class="text-white small fw-bold tracking-wider">SIAP TRANSFORMASI DIGITAL 2026</span>
                    </span>
                </div>
                
                <h1 class="display-2 fw-bold text-white mb-4 animate-up" style="animation-delay: 0.2s; line-height: 1.1; letter-spacing: -2px;">
                    Bangun Solusi <br>
                    <span class="text-gradient">Teknologi Tanpa Batas</span>
                </h1>
                
                <p class="lead text-secondary mb-5 animate-up" style="animation-delay: 0.3s; max-width: 600px; font-size: 1.25rem; font-weight: 300;">
                    Kami menghadirkan infrastruktur <span class="text-white fw-medium">Server</span>, <span class="text-white fw-medium">Web</span>, dan <span class="text-white fw-medium">Mobile Apps</span> kelas dunia untuk memastikan bisnis Anda mendominasi pasar.
                </p>

                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start animate-up" style="animation-delay: 0.4s;">
                    <a href="{{ route('services.index') }}" class="btn-modern-primary">
                        Jelajahi Solusi <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-modern-outline">
                        Konsultasi Gratis
                    </a>
                </div>
                
                <div class="row mt-5 pt-4 border-top border-white border-opacity-10 g-4 animate-up" style="animation-delay: 0.5s;">
                    <div class="col-4 border-end border-white border-opacity-10">
                        <h3 class="text-white fw-bold mb-0">50+</h3>
                        <small class="text-secondary text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">Proyek</small>
                    </div>
                    <div class="col-4 border-end border-white border-opacity-10">
                        <h3 class="text-white fw-bold mb-0">20+</h3>
                        <small class="text-secondary text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">Klien</small>
                    </div>
                    <div class="col-4">
                        <h3 class="text-white fw-bold mb-0">99.9%</h3>
                        <small class="text-secondary text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">Uptime</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5 d-none d-lg-block animate-up" style="animation-delay: 0.6s;">
                <div class="hero-visual-container">
                    <div class="image-glass-frame">
                        <img src="{{ asset('assets/media/images/about-cover.png') }}" class="img-fluid rounded-4 main-img" alt="Sekawan Tech">
                    </div>
                    
                    <div class="floating-card card-top shadow-lg">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle bg-success"><i class="fas fa-shield-alt text-white"></i></div>
                            <div><p class="mb-0 fw-bold text-dark small">Data Secure</p><p class="mb-0 text-muted" style="font-size: 10px;">Enterprise Grade</p></div>
                        </div>
                    </div>

                    <div class="floating-card card-bottom shadow-lg">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle bg-primary"><i class="fas fa-bolt text-white"></i></div>
                            <div><p class="mb-0 fw-bold text-dark small">High Speed</p><p class="mb-0 text-muted" style="font-size: 10px;">Optimized Performance</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* 1. Aurora Glow Animation */
    .aurora-glow {
        position: absolute; width: 600px; height: 600px; border-radius: 50%; filter: blur(100px); opacity: 0.3; z-index: 1;
    }
    .glow-1 { top: -20%; left: -10%; background: radial-gradient(circle, #3b82f6 0%, transparent 70%); animation: drift 15s infinite alternate; }
    .glow-2 { bottom: -10%; right: -10%; background: radial-gradient(circle, #8b5cf6 0%, transparent 70%); animation: drift 10s infinite alternate-reverse; }
    
    @keyframes drift {
        from { transform: translate(0,0); }
        to { transform: translate(50px, 50px); }
    }

    /* 2. Gradient Text & Badges */
    .text-gradient {
        background: linear-gradient(to right, #60A5FA, #A78BFA);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .glass-badge {
        background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);
    }
    .pulse-dot {
        width: 8px; height: 8px; background: #60A5FA; border-radius: 50%; box-shadow: 0 0 10px #60A5FA; animation: pulse 2s infinite;
    }
    @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.4; } 100% { opacity: 1; } }

    /* 3. Modern Buttons */
    .btn-modern-primary {
        background: #0d6efd; color: white; padding: 15px 35px; border-radius: 50px; font-weight: bold; text-decoration: none;
        transition: 0.3s; box-shadow: 0 10px 25px rgba(13, 110, 253, 0.4); border: none;
    }
    .btn-modern-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(13, 110, 253, 0.6); color: white; }
    
    .btn-modern-outline {
        border: 1px solid rgba(255, 255, 255, 0.2); color: white; padding: 15px 35px; border-radius: 50px; font-weight: bold;
        text-decoration: none; transition: 0.3s;
    }
    .btn-modern-outline:hover { background: rgba(255, 255, 255, 0.05); transform: translateY(-3px); color: white; }

    /* 4. Visual Layout */
    .hero-visual-container { position: relative; padding: 20px; }
    .image-glass-frame {
        padding: 10px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 25px; backdrop-filter: blur(5px);
    }
    .main-img { box-shadow: 0 30px 60px rgba(0,0,0,0.5); }
    
    .floating-card {
        position: absolute; background: white; padding: 15px; border-radius: 20px; z-index: 5;
        width: 200px; animation: float 4s ease-in-out infinite;
    }
    .card-top { top: -20px; right: -20px; animation-delay: 0s; }
    .card-bottom { bottom: -20px; left: -20px; animation-delay: 2s; }
    .icon-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }

    @keyframes float { 
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); } 
    }

    /* 5. Typography */
    .tracking-wider { letter-spacing: 2px; }
</style>

<div class="py-4 bg-light border-bottom border-top">
    <div class="container text-center">
        <p class="small text-muted fw-bold text-uppercase mb-4">Teknologi yang Kami Gunakan</p>
        <div class="row align-items-center justify-content-center g-5 opacity-50">
            <div class="col-4 col-md-2"><i class="fab fa-laravel fa-3x"></i></div>
            <div class="col-4 col-md-2"><i class="fab fa-android fa-3x"></i></div>
            <div class="col-4 col-md-2"><i class="fab fa-node-js fa-3x"></i></div>
            <div class="col-4 col-md-2"><i class="fab fa-php fa-3x"></i></div>
            <div class="col-4 col-md-2"><i class="fas fa-database fa-3x"></i></div>
            <div class="col-4 col-md-2"><i class="fab fa-js-square fa-3x"></i></div>
        </div>
    </div>
</div>

<section class="py-5 bg-white overflow-hidden">
    <div class="container py-lg-5">
        <div class="text-center mb-5">
            <h5 class="text-primary fw-bold text-uppercase spacing-1">Solusi Terintegrasi</h5>
            <h2 class="fw-bold text-dark display-5">Layanan Profesional Kami</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Kami menghadirkan solusi digital terpadu dengan teknologi terkini untuk meningkatkan efisiensi, produktivitas, dan daya saing bisnis Anda.</p>
        </div>

        <div class="row align-items-center g-5 mb-100 animate-up">
            <div class="col-lg-6">
                <div class="service-image-container position-relative">
                    <div class="service-number-abs"></div>
                    <img src="{{ asset('assets/media/images/app-development.png') }}" alt="App Development" class="img-fluid rounded-4 shadow-lg position-relative z-2">
                    <div class="service-blob bg-primary opacity-10 position-absolute"></div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <div class="service-content">
                    <h2 class="fw-bold text-dark mb-3">App Development</h2>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Mobile App (Android/iOS)</span>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Desktop Application</span>
                    </div>
                    <p class="text-muted mb-4 lead" style="font-size: 1.1rem;">Kami membangun aplikasi yang responsif, stabil, dan berperforma tinggi. Fokus kami adalah pada pengalaman pengguna (UX) yang intuitif dan skalabilitas sistem.</p>
                    <a href="{{ route('services.index') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">Jelajahi Detail <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <div class="row align-items-center g-5 mb-100 animate-up">
            <div class="col-lg-6 order-lg-2">
                <div class="service-image-container position-relative">
                    <div class="service-number-abs left"></div>
                    <img src="{{ asset('assets/media/images/web-development.png') }}" alt="Web Development" class="img-fluid rounded-4 shadow-lg position-relative z-2">
                    <div class="service-blob bg-info opacity-10 position-absolute"></div>
                </div>
            </div>
            <div class="col-lg-6 pe-lg-5 order-lg-1 text-lg-end">
                <div class="service-content">
                    <h2 class="fw-bold text-dark mb-3">Web Development</h2>
                    <div class="d-flex flex-wrap gap-2 mb-4 justify-content-lg-end">
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Company Profile</span>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">E-Commerce & Web App</span>
                    </div>
                    <p class="text-muted mb-4 lead" style="font-size: 1.1rem;">Website profesional yang cepat dan SEO-friendly. Kami memastikan kehadiran digital Anda memberikan kesan pertama yang tak terlupakan bagi pelanggan.</p>
                    <a href="{{ route('services.index') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">Jelajahi Detail <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <div class="row align-items-center g-5 animate-up">
            <div class="col-lg-6">
                <div class="service-image-container position-relative">
                    <div class="service-number-abs"></div>
                    <img src="{{ asset('assets/media/images/office-server.png') }}" alt="Office Server" class="img-fluid rounded-4 shadow-lg position-relative z-2">
                    <div class="service-blob bg-danger opacity-10 position-absolute"></div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <div class="service-content">
                    <h2 class="fw-bold text-dark mb-3">Office Server & Network</h2>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Instalasi Server</span>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Mikrotik & Networking</span>
                    </div>
                    <p class="text-muted mb-4 lead" style="font-size: 1.1rem;">Infrastruktur IT yang aman dan terpusat. Kami mengoptimalkan alur kerja perusahaan Anda dengan sistem jaringan yang stabil dan proteksi data maksimal.</p>
                    <a href="{{ route('services.index') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">Jelajahi Detail <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    .mb-100 { margin-bottom: 100px; }
    
    /* Efek Nomor Besar di Latar Belakang */
    .service-number-abs {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: -230px; /* Geser ke sebelah kanan gambar */
        font-size: 150px;
        font-weight: 900;
        color: rgba(13, 110, 253, 0.05); /* Warna tipis */
        z-index: 1;
        line-height: 1;
    }
    .service-number-abs.left {
        left: -230px; /* Geser ke sebelah kiri gambar */
        right: auto;
    }

    /* Efek Dekorasi Blob */
    .service-blob {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        filter: blur(50px);
    }

    .service-image-container img {
        transition: transform 0.5s ease;
    }
    .service-image-container:hover img {
        transform: translateY(-10px);
    }

    @media (max-width: 991px) {
        .mb-100 { margin-bottom: 60px; }
        .service-number-abs { 
            font-size: 80px; 
            top: -20px; 
            right: 0;
            transform: none;
        }
        .service-number-abs.left { left: 0; }
        .text-lg-end { text-align: center !important; }
        .justify-content-lg-end { justify-content: center !important; }
    }
</style>

<section class="py-5 bg-light">
    <div class="container py-lg-5">
        <div class="row align-items-end mb-5">
            <div class="col-md-8 text-center text-md-start">
                <h5 class="text-primary fw-bold text-uppercase spacing-1">Karya Kami</h5>
                <h2 class="fw-bold text-dark">Portofolio Unggulan</h2>
            </div>
            <div class="col-md-4 text-center text-md-end mt-3 mt-md-0">
                <a href="{{ route('portfolio.index') }}" class="btn btn-outline-primary rounded-pill px-4">Lihat Semua Proyek</a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="portfolio-item position-relative overflow-hidden rounded-4 shadow-sm">
                    <img src="{{ asset('assets/media/images/tab-image-1.png') }}" class="img-fluid w-100 transition-all" alt="Web Project">
                    <div class="overlay p-4 d-flex flex-column justify-content-end">
                        <span class="badge bg-primary w-fit mb-2">Web Development</span>
                        <h4 class="text-white fw-bold">Enterprise System V.1</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="portfolio-item position-relative overflow-hidden rounded-4 shadow-sm">
                    <img src="{{ asset('assets/media/images/tab-image-2.png') }}" class="img-fluid w-100 transition-all" alt="App Project">
                    <div class="overlay p-4 d-flex flex-column justify-content-end">
                        <span class="badge bg-purple w-fit mb-2" style="background-color: #8b5cf6;">Mobile App</span>
                        <h4 class="text-white fw-bold">Application</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white overflow-hidden">
    <div class="container py-lg-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Apa Kata Klien Kami?</h2>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 rounded-4 bg-light h-100">
                    <div class="mb-3 text-warning">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-dark fs-5 italic mb-4">"Sekawan Putra Pratama sangat membantu bisnis kami dalam mendigitalisasi alur kerja. Website yang dibuat sangat responsif."</p>
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary fw-bold">BS</div>
                        <div><h6 class="mb-0 fw-bold">Budi Santoso</h6><small class="text-muted">CEO Retail Group</small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 rounded-4 bg-light h-100">
                    <div class="mb-3 text-warning">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-dark fs-5 italic mb-4">"Instalasi server kantor kami ditangani dengan sangat profesional. Sekarang akses data internal jauh lebih aman dan stabil."</p>
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary fw-bold">SR</div>
                        <div><h6 class="mb-0 fw-bold">Siti Rahmawati</h6><small class="text-muted">Operations Manager</small></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
    <div class="container py-4 text-center">
        <h2 class="text-white fw-bold display-6 mb-3">Siap Mengembangkan Bisnis Anda?</h2>
        <p class="text-white text-opacity-75 mb-5 mx-auto" style="max-width: 600px;">Jangan biarkan ide hebat Anda tertunda. Konsultasikan kebutuhan teknologi Anda bersama tim ahli kami sekarang juga.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary">Mulai Konsultasi</a>
            <a href="https://wa.me/6285156412702" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold">Chat WhatsApp</a>
        </div>
    </div>
</section>

<style>
    .spacing-1 { letter-spacing: 1px; }
    .w-fit { width: fit-content; }
    
    /* Animation fade up */
    .animate-up {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeUp 0.8s ease forwards;
    }
    @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

    /* Portfolio Overlay Effect */
    .portfolio-item img { transition: transform 0.5s ease; }
    .portfolio-item:hover img { transform: scale(1.1); }
    .portfolio-item .overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to bottom, transparent 40%, rgba(15, 23, 42, 0.9));
        opacity: 0.9;
    }

    /* Hover Lift */
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }
    
    .glow-on-hover:hover {
        box-shadow: 0 0 20px rgba(13, 110, 253, 0.5) !important;
    }
</style>

@endsection