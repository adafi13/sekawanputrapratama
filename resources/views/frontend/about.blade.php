@extends('frontend.layouts.app')

@section('title', 'Tentang Kami - Sekawan Putra Pratama')

@section('content')

<section class="position-relative py-5 overflow-hidden d-flex align-items-center" style="min-height: 500px; background-color: #0F172A;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
        <div class="position-absolute" 
             style="top: -10%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(59,130,246,0.2) 0%, rgba(0,0,0,0) 70%); filter: blur(80px);">
        </div>
        <div class="position-absolute" 
             style="bottom: -10%; right: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(139,92,246,0.2) 0%, rgba(0,0,0,0) 70%); filter: blur(80px);">
        </div>
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 50px 50px; opacity: 0.6;">
    </div>

    <div class="container position-relative z-2 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                <div class="mb-4 animate-up" style="animation-delay: 0.1s;">
                    <span class="d-inline-flex align-items-center px-3 py-2 rounded-pill border border-white border-opacity-10 shadow-sm" 
                          style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px);">
                        <span class="badge bg-primary rounded-circle p-1 me-2" style="font-size: 6px;">&nbsp;</span>
                        <span class="small fw-bold text-white tracking-wide text-uppercase">Tentang Perusahaan</span>
                    </span>
                </div>

                <h1 class="display-3 fw-bold text-white mb-4 animate-up" style="animation-delay: 0.2s; letter-spacing: -1px;">
                    Mengenal Lebih Dekat <br>
                    <span style="background: linear-gradient(to right, #60A5FA, #A78BFA); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Visi & Dedikasi Kami
                    </span>
                </h1>

                <p class="lead text-secondary mb-0 mx-auto animate-up" style="max-width: 700px; animation-delay: 0.3s; font-size: 1.25rem; font-weight: 300;">
                    Kami bukan sekadar pengembang kode, tetapi <strong class="text-white fw-medium">mitra strategis</strong> yang menerjemahkan kebutuhan bisnis Anda menjadi solusi teknologi nyata yang berdampak.
                </p>

            </div>
        </div>
    </div>
    
    <div class="position-absolute bottom-0 start-0 w-100" style="height: 1px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);"></div>
</section>

<style>
    .tracking-wide { letter-spacing: 1.5px; }
    
    .animate-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.8s ease forwards;
    }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<section class="py-5 bg-white">
    <div class="container py-lg-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="rounded-4 overflow-hidden shadow-lg position-relative z-2">
                        <img src="{{ asset('assets/media/images/about-cover.png') }}" alt="Tentang Sekawan" class="img-fluid w-100" style="object-fit: cover; min-height: 400px;">
                    </div>
                    <div class="position-absolute bg-primary rounded-4" style="width: 100%; height: 100%; top: 20px; left: 20px; z-index: 1; opacity: 0.1;"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <h5 class="text-primary fw-bold text-uppercase spacing-1 mb-2">Siapa Kami?</h5>
                    <h2 class="display-6 fw-bold text-dark mb-4">Mitra Teknologi <br>Terpercaya Anda</h2>
                    
                    <p class="text-muted mb-4 lead" style="font-size: 1.1rem; line-height: 1.8;">
                        <strong>Sekawan Putra Pratama</strong> adalah tim konsultan IT dan pengembang perangkat lunak yang berfokus pada solusi digital terintegrasi.
                    </p>
                    <p class="text-muted mb-5">
                        Kami tidak hanya membuat kode, tetapi kami membangun solusi. Mulai dari perancangan sistem backend yang kompleks, instalasi server kantor yang aman, hingga antarmuka aplikasi yang memanjakan pengguna.
                    </p>

                    <div class="row g-3">
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3 text-center border h-100">
                                <h3 class="fw-bold text-primary mb-0">50+</h3>
                                <small class="text-secondary fw-bold">Proyek Selesai</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3 text-center border h-100">
                                <h3 class="fw-bold text-primary mb-0">20+</h3>
                                <small class="text-secondary fw-bold">Klien Puas</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3 text-center border h-100">
                                <h3 class="fw-bold text-primary mb-0">5+</h3>
                                <small class="text-secondary fw-bold">Tahun Pengalaman</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="team">
    <div class="container py-lg-5">
        <div class="text-center mb-5">
            <h5 class="text-primary fw-bold text-uppercase spacing-1">Tim Inti Kami</h5>
            <h2 class="fw-bold text-dark display-6">Profesional di Balik Layar</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                Orang-orang yang mewujudkan ide Anda dengan dedikasi dan keahlian tinggi.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 team-card overflow-hidden rounded-4 bg-white">
                    <div class="team-img-wrapper position-relative">
                        <img src="{{ asset('assets/media/team/abdul-malik.png') }}" class="card-img-top" alt="Abdul Malik Ibrahim">
                        <div class="exp-badge position-absolute bottom-0 end-0 m-3 bg-white px-3 py-1 rounded-pill shadow-sm text-dark fw-bold small">
                            <i class="fas fa-star text-warning me-1"></i> 7+ Tahun
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold text-dark mb-1">Abdul Malik Ibrahim</h5>
                        <p class="text-primary fw-bold small mb-3 text-uppercase spacing-1">App Developer</p>
                        <hr class="mx-auto opacity-25" style="width: 50px;">
                        <p class="card-text text-muted small">
                            Seorang App Developer berpengalaman dalam membangun aplikasi mobile dan desktop modern, responsif, dan berperforma tinggi.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 team-card overflow-hidden rounded-4 bg-white">
                    <div class="team-img-wrapper position-relative">
                        <img src="{{ asset('assets/media/team/aries-adityanto.png') }}" class="card-img-top" alt="Aries Adityanto">
                        <div class="exp-badge position-absolute bottom-0 end-0 m-3 bg-white px-3 py-1 rounded-pill shadow-sm text-dark fw-bold small">
                            <i class="fas fa-star text-warning me-1"></i> 5+ Tahun
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold text-dark mb-1">Aries Adityanto</h5>
                        <p class="text-primary fw-bold small mb-3 text-uppercase spacing-1">Project Manager</p>
                        <hr class="mx-auto opacity-25" style="width: 50px;">
                        <p class="card-text text-muted small">
                            Profesional dalam manajemen proyek IT, memastikan setiap tahap pengembangan berjalan presisi, tepat waktu, dan sesuai kebutuhan klien.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 team-card overflow-hidden rounded-4 bg-white">
                    <div class="team-img-wrapper position-relative">
                        <img src="{{ asset('assets/media/team/aditya-novaldy.png') }}" class="card-img-top" alt="M. Aditya Novaldy">
                        <div class="exp-badge position-absolute bottom-0 end-0 m-3 bg-white px-3 py-1 rounded-pill shadow-sm text-dark fw-bold small">
                            <i class="fas fa-star text-warning me-1"></i> 6+ Tahun
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold text-dark mb-1">M. Aditya Novaldy</h5>
                        <p class="text-primary fw-bold small mb-3 text-uppercase spacing-1">Server & Networking</p>
                        <hr class="mx-auto opacity-25" style="width: 50px;">
                        <p class="card-text text-muted small">
                            Ahli Office Server dan Networking. Terampil memastikan koneksi stabil, aman, serta sistem internal perusahaan berjalan lancar.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 team-card overflow-hidden rounded-4 bg-white">
                    <div class="team-img-wrapper position-relative">
                        <img src="{{ asset('assets/media/team/muhammad-naufal-fauthuroni.png') }}" class="card-img-top" alt="M. Naufal Fathuroni">
                        <div class="exp-badge position-absolute bottom-0 end-0 m-3 bg-white px-3 py-1 rounded-pill shadow-sm text-dark fw-bold small">
                            <i class="fas fa-star text-warning me-1"></i> 2+ Tahun
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold text-dark mb-1">M. Naufal Fathuroni</h5>
                        <p class="text-primary fw-bold small mb-3 text-uppercase spacing-1">UI/UX Designer</p>
                        <hr class="mx-auto opacity-25" style="width: 50px;">
                        <p class="card-text text-muted small">
                            Ahli merancang antarmuka aplikasi dan website yang intuitif. Fokus pada pengalaman pengguna, estetika visual, dan interaksi efisien.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 team-card overflow-hidden rounded-4 bg-white">
                    <div class="team-img-wrapper position-relative">
                        <img src="{{ asset('assets/media/team/alfario-daffa-mustofa.png') }}" class="card-img-top" alt="Alfario Dafa Mustofa">
                        <div class="exp-badge position-absolute bottom-0 end-0 m-3 bg-white px-3 py-1 rounded-pill shadow-sm text-dark fw-bold small">
                            <i class="fas fa-star text-warning me-1"></i> 5+ Tahun
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold text-dark mb-1">Alfario Dafa Mustofa</h5>
                        <p class="text-primary fw-bold small mb-3 text-uppercase spacing-1">Office Server</p>
                        <hr class="mx-auto opacity-25" style="width: 50px;">
                        <p class="card-text text-muted small">
                            Fokus dalam setup server kantor, konfigurasi jaringan internal, dan manajemen data perusahaan. Menjamin server berjalan aman.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container text-center py-4">
        <h3 class="fw-bold text-dark mb-3">Siap Berkolaborasi dengan Tim Kami?</h3>
        <p class="text-muted mb-4">Jangan ragu untuk mendiskusikan ide Anda. Kami siap membantu.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-lg glow-on-hover">
            Hubungi Kami Sekarang <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</section>

<style>
    .spacing-1 { letter-spacing: 1px; }
    
    /* Team Card Styling */
    .team-card {
        transition: all 0.3s ease;
    }
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .team-img-wrapper {
        height: 320px;
        overflow: hidden;
        background-color: #f1f5f9;
    }
    .team-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center; /* Fokus ke wajah */
        transition: transform 0.5s ease;
    }
    .team-card:hover .team-img-wrapper img {
        transform: scale(1.05); /* Zoom effect saat hover */
    }

    /* Button Glow */
    .glow-on-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(13, 110, 253, 0.4) !important;
    }
</style>

@endsection