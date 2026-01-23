@extends('frontend.layouts.app')

@section('title', 'Layanan Kami - Sekawan Putra Pratama')

@section('content')

<section class="position-relative py-5 overflow-hidden d-flex align-items-center" style="min-height: 450px; background-color: #0F172A;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <div class="position-absolute" 
             style="top: -20%; right: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(96, 165, 250, 0.15) 0%, rgba(0,0,0,0) 70%); filter: blur(100px); animation: drift 10s infinite alternate;">
        </div>
        <div class="position-absolute" 
             style="bottom: -20%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(167, 139, 250, 0.1) 0%, rgba(0,0,0,0) 70%); filter: blur(100px); animation: drift 8s infinite alternate-reverse;">
        </div>
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px); background-size: 60px 60px; mask-image: radial-gradient(ellipse at center, black, transparent 80%);">
    </div>

    <div class="container position-relative z-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                
                <div class="mb-4 animate-fade-in">
                    <span class="d-inline-flex align-items-center px-4 py-2 rounded-pill border border-white border-opacity-10 shadow-lg" 
                          style="background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(12px);">
                        <i class="fas fa-layer-group text-primary me-2" style="font-size: 0.8rem;"></i>
                        <span class="small fw-bold text-white-50 text-uppercase tracking-widest">Layanan & Spesialisasi</span>
                    </span>
                </div>

                <h1 class="display-3 fw-bold text-white mb-4 animate-slide-up" style="letter-spacing: -2px; line-height: 1.1;">
                    Solusi Digital <br>
                    <span class="gradient-text">Tanpa Batas</span>
                </h1>

                <p class="lead text-secondary mx-auto mb-5 animate-slide-up" style="max-width: 700px; font-weight: 300; line-height: 1.8; animation-delay: 0.2s;">
                    Kami mengintegrasikan strategi bisnis dengan <span class="text-white fw-medium">rekayasa teknologi mutakhir</span> untuk menciptakan ekosistem digital yang skalabel, aman, dan inovatif.
                </p>

                <div class="animate-bounce-slow mt-4">
                    <div class="d-inline-block p-1 rounded-pill border border-white border-opacity-10" style="background: rgba(255,255,255,0.05);">
                        <div class="bg-primary rounded-pill" style="width: 2px; height: 40px; margin: 0 auto;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="position-absolute bottom-0 start-0 w-100" style="height: 1px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);"></div>
</section>

<style>
    .gradient-text {
        background: linear-gradient(135deg, #60A5FA 0%, #A78BFA 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-style: italic;
    }

    .tracking-widest { letter-spacing: 3px; }

    /* Animasi */
    @keyframes drift {
        from { transform: translate(0, 0); }
        to { transform: translate(30px, 30px); }
    }

    .animate-fade-in { animation: fadeIn 1s ease-out forwards; }
    .animate-slide-up { animation: slideUp 0.8s ease-out forwards; }
    .animate-bounce-slow { animation: bounce 3s infinite; }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
</style>
<section class="py-5 bg-white">
    <div class="container py-lg-5">
        
        {{-- Service 1: Web Development --}}
        <div class="row align-items-center g-5 mb-100">
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="{{ asset('assets/media/images/web-development.png') }}" alt="Web Development" class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute top-0 end-0 bg-primary text-white p-3 rounded-4 mt-n3 me-n3 shadow-lg d-none d-md-block">
                        <i class="fas fa-globe fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h2 class="fw-bold text-dark mb-4">Web Development</h2>
                <p class="text-muted mb-4 lead">Kami menciptakan pengalaman digital yang menarik melalui website yang cepat, aman, dan mudah dikelola.</p>
                
                <div class="row g-4 mb-5">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-primary mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Company Profile</h6>
                                <p class="small text-muted mb-0">Branding digital profesional untuk meningkatkan kredibilitas bisnis.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-primary mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">E-Commerce</h6>
                                <p class="small text-muted mb-0">Toko online dengan sistem pembayaran otomatis dan manajemen stok.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-primary mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Web Application</h6>
                                <p class="small text-muted mb-0">Sistem internal kustom (ERP/CRM) berbasis cloud untuk operasional.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-primary mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">SEO Optimized</h6>
                                <p class="small text-muted mb-0">Struktur website yang ramah mesin pencari untuk traffic maksimal.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">Konsultasi Web <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>

        {{-- Service 2: App Development (Reverse) --}}
        <div class="row align-items-center g-5 mb-100">
            <div class="col-lg-6 order-lg-2">
                <div class="position-relative">
                    <img src="{{ asset('assets/media/images/app-development.png') }}" alt="App Development" class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute top-0 start-0 bg-success text-white p-3 rounded-4 mt-n3 ms-n3 shadow-lg d-none d-md-block">
                        <i class="fas fa-mobile-alt fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pe-lg-5 order-lg-1">
                <h2 class="fw-bold text-dark mb-4">App Development</h2>
                <p class="text-muted mb-4 lead">Hadirkan bisnis Anda ke genggaman pelanggan dengan aplikasi mobile yang intuitif dan berperforma tinggi.</p>
                
                <div class="row g-4 mb-5">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-success mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Android & iOS</h6>
                                <p class="small text-muted mb-0">Pengembangan aplikasi Native maupun Hybrid (Flutter/React Native).</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-success mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">UX Focused</h6>
                                <p class="small text-muted mb-0">Desain antarmuka yang memudahkan pengguna bertransaksi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-success mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">API Integration</h6>
                                <p class="small text-muted mb-0">Sinkronisasi data real-time antara aplikasi dan sistem pusat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-success mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Maintenance</h6>
                                <p class="small text-muted mb-0">Dukungan pembaruan berkala dan perbaikan bug setelah rilis.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="btn btn-success rounded-pill px-5 py-3 fw-bold text-white">Buat Aplikasi <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>

        {{-- Service 3: Office Server --}}
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="{{ asset('assets/media/images/office-server.png') }}" alt="Office Server" class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute top-0 end-0 bg-danger text-white p-3 rounded-4 mt-n3 me-n3 shadow-lg d-none d-md-block">
                        <i class="fas fa-server fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h2 class="fw-bold text-dark mb-4">Infrastructure & Server</h2>
                <p class="text-muted mb-4 lead">Bangun pondasi IT yang kokoh untuk menjamin keamanan data dan kelancaran kolaborasi tim Anda.</p>
                
                <div class="row g-4 mb-5">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-danger mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Server Setup</h6>
                                <p class="small text-muted mb-0">Instalasi Linux/Windows Server untuk pusat data internal.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-check-circle text-danger mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Networking</h6>
                                <p class="small text-muted mb-0">Konfigurasi Mikrotik, VPN, dan Load Balancing yang stabil.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                <div class="d-flex align-items-start gap-3">
                     <i class="fas fa-project-diagram text-danger mt-1"></i>
                         <div>
                           <h6 class="fw-bold mb-1">Infrastruktur Fiber Optic</h6>
                              <p class="small text-muted mb-0">Solusi instalasi jaringan FTTH (Fiber to the Home) dengan koneksi kecepatan tinggi yang minim gangguan.</p>
                          </div>
                            </div>
                                </div>
                    <div class="col-sm-6">
    <div class="d-flex align-items-start gap-3">
        <i class="fas fa-video text-danger mt-1"></i>
        <div>
            <h6 class="fw-bold mb-1">CCTV & Security System</h6>
            <p class="small text-muted mb-0">Instalasi kamera keamanan IP-Cam/Analog dengan akses monitoring real-time dari smartphone Anda.</p>
        </div>
    </div>
</div>
                <a href="{{ route('contact') }}" class="btn btn-danger rounded-pill px-5 py-3 fw-bold text-white">Konsultasi Server <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>

    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-lg-5 text-center">
        <h5 class="text-primary fw-bold text-uppercase spacing-1 mb-2">Workflow</h5>
        <h2 class="fw-bold text-dark mb-5">Bagaimana Kami Bekerja?</h2>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm border-0 h-100">
                    <div class="text-primary mb-3"><i class="fas fa-comments fa-3x"></i></div>
                    <h6 class="fw-bold">1. Konsultasi</h6>
                    <p class="small text-muted mb-0">Kami mendengar kebutuhan bisnis Anda dan memberikan saran terbaik.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm border-0 h-100">
                    <div class="text-primary mb-3"><i class="fas fa-pencil-ruler fa-3x"></i></div>
                    <h6 class="fw-bold">2. Perencanaan</h6>
                    <p class="small text-muted mb-0">Penyusunan alur kerja, desain UI/UX, dan arsitektur sistem.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm border-0 h-100">
                    <div class="text-primary mb-3"><i class="fas fa-code fa-3x"></i></div>
                    <h6 class="fw-bold">3. Pengembangan</h6>
                    <p class="small text-muted mb-0">Tim ahli kami membangun solusi Anda dengan teknologi terkini.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm border-0 h-100">
                    <div class="text-primary mb-3"><i class="fas fa-rocket fa-3x"></i></div>
                    <h6 class="fw-bold">4. Launch & Support</h6>
                    <p class="small text-muted mb-0">Uji coba final, go-live, dan dukungan pemeliharaan rutin.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
    <div class="container py-4 text-center">
        <h2 class="text-white fw-bold display-6 mb-3">Butuh Solusi IT Kustom?</h2>
        <p class="text-white text-opacity-75 mb-5 mx-auto" style="max-width: 600px;">Setiap bisnis unik. Kami siap mendengarkan kebutuhan spesifik Anda dan memberikan penawaran terbaik.</p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary shadow-lg">
            Diskusikan Proyek Anda <i class="fas fa-paper-plane ms-2"></i>
        </a>
    </div>
</section>

<style>
    .spacing-1 { letter-spacing: 1px; }
    .mb-100 { margin-bottom: 100px; }
    .img-fluid { transition: transform 0.4s ease; }
    .row:hover .img-fluid { transform: scale(1.02); }
    
    @media (max-width: 991px) {
        .mb-100 { margin-bottom: 60px; }
        .text-lg-end { text-align: center !important; }
    }
</style>

@endsection