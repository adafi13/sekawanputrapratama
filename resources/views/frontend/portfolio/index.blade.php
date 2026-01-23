@extends('frontend.layouts.app')

@section('title', 'Portofolio - Sekawan Putra Pratama')

@section('content')

<section class="position-relative py-5 overflow-hidden d-flex align-items-center" style="min-height: 400px; background-color: #0F172A;">
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <div class="position-absolute" style="top: -10%; left: -5%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(96, 165, 250, 0.1) 0%, rgba(0,0,0,0) 70%); filter: blur(80px);"></div>
        <div class="position-absolute w-100 h-100" style="background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 30px 30px; opacity: 0.5;"></div>
    </div>

    <div class="container position-relative z-3 text-center">
        <span class="d-inline-flex align-items-center px-3 py-2 rounded-pill border border-white border-opacity-10 mb-4" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px);">
            <i class="fas fa-th-large text-primary me-2"></i>
            <span class="small fw-bold text-white-50 text-uppercase tracking-widest">Showcase Proyek</span>
        </span>
        <h1 class="display-3 fw-bold text-white mb-3">Karya <span class="gradient-text">Terbaik Kami</span></h1>
        <p class="lead text-secondary mx-auto" style="max-width: 600px; font-weight: 300;">
            Eksplorasi bagaimana kami membantu berbagai klien mencapai potensi maksimal melalui solusi teknologi yang inovatif.
        </p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-lg-5">
        
        <div class="d-flex justify-content-center mb-5 animate-up">
            <div class="p-2 bg-light rounded-pill d-inline-flex gap-1 border shadow-sm">
                <button class="btn btn-filter active rounded-pill px-4 py-2 fw-bold small" data-filter="all">Semua</button>
                <button class="btn btn-filter rounded-pill px-4 py-2 fw-bold small" data-filter="web">Website</button>
                <button class="btn btn-filter rounded-pill px-4 py-2 fw-bold small" data-filter="app">Aplikasi</button>
                <button class="btn btn-filter rounded-pill px-4 py-2 fw-bold small" data-filter="infra">Infrastruktur</button>
            </div>
        </div>

        <div class="row g-4" id="portfolio-grid">
            
            <div class="col-md-6 col-lg-4 portfolio-item" data-category="web">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden project-card">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('assets/media/images/tab-image-1.png') }}" class="card-img-top transition-all" alt="Project 1">
                        <div class="project-overlay">
                            <a href="{{ route('portfolio.show', 1) }}" class="btn btn-light rounded-pill fw-bold">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary border-primary border-opacity-10 rounded-pill px-3">Website</span>
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 2025</small>
                        </div>
                        <h5 class="fw-bold text-dark">Enterprise System ERP</h5>
                        <p class="text-muted small mb-0 text-truncate-2">Digitalisasi manajemen perusahaan dengan sistem web yang terintegrasi dan aman.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 portfolio-item" data-category="app">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden project-card">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('assets/media/images/tab-image-2.png') }}" class="card-img-top transition-all" alt="Project 2">
                        <div class="project-overlay">
                            <a href="{{ route('portfolio.show', 2) }}" class="btn btn-light rounded-pill fw-bold">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success bg-opacity-10 text-success border-success border-opacity-10 rounded-pill px-3">Aplikasi</span>
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 2025</small>
                        </div>
                        <h5 class="fw-bold text-dark">Marketplace Indonesia</h5>
                        <p class="text-muted small mb-0 text-truncate-2">Aplikasi mobile e-commerce dengan integrasi payment gateway dan kurir otomatis.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 portfolio-item" data-category="infra">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden project-card">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('assets/media/images/tab-image-3.png') }}" class="card-img-top transition-all" alt="Project 3">
                        <div class="project-overlay">
                            <a href="{{ route('portfolio.show', 3) }}" class="btn btn-light rounded-pill fw-bold">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-danger bg-opacity-10 text-danger border-danger border-opacity-10 rounded-pill px-3">Infrastruktur</span>
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 2024</small>
                        </div>
                        <h5 class="fw-bold text-dark">Data Center Bekasi</h5>
                        <p class="text-muted small mb-0 text-truncate-2">Instalasi server core dan manajemen fiber optic untuk konektivitas gedung.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container text-center py-4">
        <h3 class="fw-bold text-dark mb-3">Ingin Bisnis Anda Menjadi Portofolio Kami Selanjutnya?</h3>
        <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">Diskusikan kebutuhan Anda dan mari kita bangun solusi teknologi yang tepat sasaran bersama-sama.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-lg glow-on-hover">
            Mulai Proyek Sekarang <i class="fas fa-paper-plane ms-2"></i>
        </a>
    </div>
</section>

<style>
    .gradient-text {
        background: linear-gradient(135deg, #60A5FA 0%, #A78BFA 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .tracking-widest { letter-spacing: 3px; }
    
    /* Project Card Hover */
    .project-card { transition: all 0.4s ease; }
    .project-card:hover { transform: translateY(-10px); }
    .project-card img { transition: transform 0.6s ease; }
    .project-card:hover img { transform: scale(1.1); }
    
    .project-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.4s ease; z-index: 2;
    }
    .project-card:hover .project-overlay { opacity: 1; }
    
    /* Filter Button */
    .btn-filter { color: #64748b; border: none; }
    .btn-filter:hover { background: rgba(13, 110, 253, 0.05); color: #0d6efd; }
    .btn-filter.active { background: #0d6efd !important; color: white !important; box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3); }

    .text-truncate-2 {
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('.btn-filter');
        const items = document.querySelectorAll('.portfolio-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function() {
                // Update Active Button
                filters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                const category = this.getAttribute('data-filter');

                items.forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                        setTimeout(() => item.style.opacity = '1', 10);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => item.style.display = 'none', 300);
                    }
                });
            });
        });
    });
</script>

@endsection