@extends('frontend.layouts.app')

@section('title', 'Portfolio Proyek IT | Website & Aplikasi - Sekawan Putra Pratama')
@section('meta_description', 'Lihat portfolio proyek IT kami: website perusahaan, aplikasi mobile, sistem ERP, dan instalasi server. Pengalaman 50+ proyek sukses. Konsultasi GRATIS!')
@section('meta_keywords', 'portfolio IT, contoh website, contoh aplikasi mobile, proyek IT, portfolio software house, jasa pembuatan website terpercaya')

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
        
        {{-- Category Filter Pills --}}
        <div class="d-flex justify-content-center mb-5 animate-up">
            <div class="filter-scroll-wrapper p-2 bg-light rounded-pill d-inline-flex flex-nowrap gap-1 border shadow-sm" style="max-width: fit-content;">
                <button class="btn btn-filter {{ !request('category') ? 'active' : '' }} rounded-pill px-4 py-2 fw-bold small text-nowrap" data-filter="">Semua</button>
                @foreach($categories as $cat)
                    <button class="btn btn-filter {{ request('category') == $cat->slug ? 'active' : '' }} rounded-pill px-4 py-2 fw-bold small text-nowrap" data-filter="{{ $cat->slug }}">{{ $cat->name }}</button>
                @endforeach
            </div>
        </div>

        @if($featuredPortfolios->count() > 0 && !request()->has('search') && !request()->has('category'))
        <div class="mb-5">
            <div class="text-center mb-4">
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3">
                    <i class="fas fa-star me-1"></i> Featured Projects
                </span>
                <h2 class="fw-bold text-dark">Proyek Unggulan</h2>
            </div>
            <div class="row g-4 mb-5">
                @foreach($featuredPortfolios as $featured)
                    <div class="col-md-6 col-lg-4 portfolio-item" data-category="{{ $featured->category ? $featured->category->slug : '' }}" style="opacity: 1; transition: opacity 0.3s ease;">
                        <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden project-card featured">
                            <div class="position-relative overflow-hidden" style="height: 280px;">
                                @php
                                    $featImg = $featured->getFirstMediaUrl('featured_image') ?: ($featured->featured_image ? Storage::url($featured->featured_image) : null);
                                @endphp
                                @if($featImg)
                                    <img src="{{ $featImg }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $featured->title }}">
                                @else
                                    <div class="w-100 h-100 bg-gradient d-flex align-items-center justify-content-center">
                                        <i class="fas fa-briefcase fa-4x text-white opacity-25"></i>
                                    </div>
                                @endif
                                <div class="project-overlay">
                                    <a href="{{ route('portfolio.show', $featured->slug) }}" class="btn btn-light rounded-pill fw-bold px-4 py-2">
                                        <i class="fas fa-eye me-2"></i> Lihat Detail
                                    </a>
                                </div>
                                <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark rounded-pill">
                                    <i class="fas fa-star me-1"></i> Featured
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    @if($featured->category)
                                        <span class="badge bg-primary bg-opacity-10 text-primary border-primary border-opacity-10 rounded-pill px-3">
                                            {{ $featured->category->name }}
                                        </span>
                                    @endif
                                    <small class="text-muted">
                                        <i class="far fa-calendar-alt me-1"></i> {{ $featured->created_at->format('Y') }}
                                    </small>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ Str::limit($featured->title, 45) }}</h5>
                                <p class="text-muted small mb-0 text-truncate-2">{{ Str::limit($featured->short_description, 100) }}</p>
                                @if($featured->client_name)
                                    <div class="mt-3 pt-3 border-top">
                                        <small class="text-muted">
                                            <i class="fas fa-building me-1"></i> {{ $featured->client_name }}
                                        </small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark">Semua Proyek</h3>
            <p class="text-muted">Eksplorasi portofolio lengkap kami</p>
        </div>

        <div class="row g-4" id="portfolio-grid">
            @forelse($portfolios as $portfolio)
                <div class="col-md-6 col-lg-4 portfolio-item" data-category="{{ $portfolio->category ? $portfolio->category->slug : '' }}" style="opacity: 1; transition: opacity 0.3s ease;">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden project-card">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            @php
                                $portImg = $portfolio->getFirstMediaUrl('featured_image') ?: ($portfolio->featured_image ? Storage::url($portfolio->featured_image) : null);
                            @endphp
                            @if($portImg)
                                <img src="{{ $portImg }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $portfolio->title }}">
                            @else
                                <div class="w-100 h-100 bg-gradient d-flex align-items-center justify-content-center">
                                    <i class="fas fa-briefcase fa-4x text-white opacity-25"></i>
                                </div>
                            @endif
                            <div class="project-overlay">
                                <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="btn btn-light rounded-pill fw-bold px-4 py-2">
                                    <i class="fas fa-eye me-2"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                @if($portfolio->category)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border-primary border-opacity-10 rounded-pill px-3">
                                        {{ $portfolio->category->name }}
                                    </span>
                                @endif
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $portfolio->created_at->format('Y') }}
                                </small>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">{{ Str::limit($portfolio->title, 50) }}</h5>
                            <p class="text-muted small mb-0 text-truncate-2">{{ Str::limit($portfolio->short_description, 100) }}</p>
                            @if($portfolio->client_name)
                                <div class="mt-3 pt-3 border-top">
                                    <small class="text-muted">
                                        <i class="fas fa-building me-1"></i> {{ $portfolio->client_name }}
                                    </small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada portfolio tersedia</h4>
                        <p class="text-muted">Portfolio akan muncul di sini setelah dipublikasikan</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($portfolios->hasPages())
        <nav class="mt-5 pt-4">
            {{ $portfolios->links('pagination::bootstrap-5') }}
        </nav>
        @endif
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('.btn-filter');
        const items = document.querySelectorAll('.portfolio-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Update Active Button
                filters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                const category = this.getAttribute('data-filter');

                // Filter items with smooth animation
                items.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    
                    if (category === '' || itemCategory === category) {
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

