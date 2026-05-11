@extends('frontend.layouts.app')

@section('title', 'Portfolio Proyek IT | Website & Aplikasi - PT Sekawan Putra Pratama')
@section('meta_description', 'Lihat portfolio proyek IT kami: website perusahaan, aplikasi mobile, sistem ERP, dan instalasi server. Pengalaman 50+ proyek sukses. Konsultasi GRATIS!')

@push('styles')
<style>
    /* Portfolio Specific Styles */
    .portfolio-hero {
        background-color: var(--navy-dark);
        padding: 120px 0 100px;
        position: relative;
        overflow: hidden;
    }

    .portfolio-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(37, 99, 235, 0.1) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.3;
    }

    .portfolio-hero::after {
        content: '';
        position: absolute;
        top: -20%; right: -10%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, transparent 70%);
        filter: blur(100px);
        z-index: 0;
    }

    .gradient-text {
        background: linear-gradient(135deg, #60A5FA 0%, #2563EB 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Filter Styles */
    .filter-wrapper {
        margin-top: -45px;
        position: relative;
        z-index: 10;
        display: flex;
        justify-content: center;
    }

    .filter-container {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        padding: 8px;
        border-radius: 100px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        display: inline-flex;
        gap: 5px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .btn-filter {
        border: none;
        background: transparent;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        color: var(--slate-600);
        transition: var(--transition);
    }

    .btn-filter:hover {
        color: var(--electric-blue);
        background: rgba(37, 99, 235, 0.05);
    }

    .btn-filter.active {
        background: var(--electric-blue);
        color: #fff;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }

    /* Project Card Styles */
    .project-card {
        border: 1px solid rgba(226, 232, 240, 0.8);
        background: #fff;
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .project-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-card);
        border-color: transparent;
    }

    .project-image-wrapper {
        position: relative;
        height: 250px;
        background-color: #f1f5f9;
        overflow: hidden;
    }

    .project-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .project-card:hover .project-image-wrapper img {
        transform: scale(1.1);
    }

    .project-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(13, 27, 62, 0.65);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition);
    }

    .project-card:hover .project-overlay {
        opacity: 1;
    }

    .project-content {
        padding: 28px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .project-category {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
        color: var(--electric-blue);
        margin-bottom: 12px;
    }

    .project-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--midnight-blue);
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .project-description {
        font-size: 14px;
        color: var(--slate-600);
        margin-bottom: 24px;
        line-height: 1.65;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .tech-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: auto;
    }

    .tech-badge {
        font-size: 10px;
        padding: 5px 12px;
        background: #F8FAFC;
        color: #64748B;
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        font-weight: 600;
    }

    /* Reveal Animation - simplified */
    .reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease-out;
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Section Divider */
    .section-divider {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .section-divider h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--midnight-blue);
        white-space: nowrap;
        margin: 0;
    }

    .section-divider::after {
        content: '';
        flex-grow: 1;
        height: 1px;
        background: linear-gradient(to right, #E2E8F0, transparent);
    }

    @media (max-width: 768px) {
        .portfolio-hero { padding: 120px 0 80px; }
        .display-4 { font-size: 2.25rem; }
        .filter-container { border-radius: 25px; width: 100%; overflow-x: auto; flex-wrap: nowrap; justify-content: flex-start; padding: 6px; }
        .btn-filter { padding: 8px 18px; white-space: nowrap; }
    }
</style>
@endpush

@section('content')

{{-- Hero Section --}}
<section class="portfolio-hero text-center">
    <div class="container position-relative z-1">
        <div class="reveal">
            <span class="d-inline-block px-3 py-1 rounded-pill mb-3" style="background: rgba(37,99,235,0.1); border: 1px solid rgba(37,99,235,0.2); color: #60A5FA; font-size: 12px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;">
                Success Stories
            </span>
            <h1 class="display-4 fw-bold text-white mb-3">Karya & <span class="gradient-text">Inovasi Digital</span></h1>
            <p class="lead text-white-50 mx-auto mb-0" style="max-width: 700px; font-weight: 400;">
                Kami berkolaborasi dengan berbagai industri untuk menghadirkan solusi teknologi yang memberikan dampak nyata.
            </p>
        </div>
    </div>
</section>

{{-- Main Content Section --}}
<section class="pb-5 mb-5">
    <div class="container">
        
        {{-- Category Filter --}}
        <div class="filter-wrapper reveal">
            <div class="filter-container">
                <button class="btn-filter {{ !request('category') ? 'active' : '' }}" data-filter="">Semua Proyek</button>
                @foreach($categories as $cat)
                    <button class="btn-filter {{ request('category') == $cat->slug ? 'active' : '' }}" data-filter="{{ $cat->slug }}">{{ $cat->name }}</button>
                @endforeach
            </div>
        </div>

        {{-- Featured Projects --}}
        @if($featuredPortfolios->count() > 0 && !request()->has('search') && !request()->has('category'))
        <div class="mt-5 pt-5 mb-4">
            <div class="section-divider reveal">
                <h2>Proyek Unggulan</h2>
            </div>
            <div class="row g-4 mb-5">
                @foreach($featuredPortfolios as $featured)
                    <div class="col-md-6 portfolio-item reveal" data-category="{{ $featured->category ? $featured->category->slug : '' }}">
                        <div class="project-card">
                            <div class="project-image-wrapper">
                                @php
                                    $imageUrl = $featured->getFirstMediaUrl('featured_image');
                                    if (!$imageUrl && $featured->featured_image) {
                                        $imageUrl = Storage::url($featured->featured_image);
                                    }
                                @endphp
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="{{ $featured->title }}">
                                @else
                                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-image fa-3x"></i>
                                    </div>
                                @endif
                                <div class="project-overlay">
                                    <a href="{{ route('portfolio.show', $featured->slug) }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold shadow-lg">
                                        Lihat Studi Kasus <i class="fas fa-arrow-right ms-2 small"></i>
                                    </a>
                                </div>
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 shadow-sm" style="font-weight: 700;">
                                        <i class="fas fa-crown me-1"></i> Featured
                                    </span>
                                </div>
                            </div>
                            <div class="project-content">
                                <div class="project-category">{{ $featured->category->name ?? 'General' }}</div>
                                <h3 class="project-title">{{ $featured->title }}</h3>
                                <p class="project-description">{{ $featured->short_description ?? Str::limit(strip_tags($featured->description), 120) }}</p>
                                
                                @if($featured->technologies)
                                    <div class="tech-badges">
                                        @foreach($featured->technologies as $tech)
                                            <span class="tech-badge">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- All Projects Grid --}}
        <div class="mt-5 pt-4">
            <div class="section-divider reveal">
                <h2>Eksplorasi Proyek</h2>
            </div>

            <div class="row g-4" id="portfolio-grid">
                @foreach($portfolios as $portfolio)
                    <div class="col-md-6 col-lg-4 portfolio-item" data-category="{{ $portfolio->category ? $portfolio->category->slug : '' }}">
                        <div class="project-card">
                            <div class="project-image-wrapper">
                                @php
                                    $imageUrl = $portfolio->getFirstMediaUrl('featured_image');
                                    if (!$imageUrl && $portfolio->featured_image) {
                                        $imageUrl = Storage::url($portfolio->featured_image);
                                    }
                                @endphp
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="{{ $portfolio->title }}">
                                @else
                                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-image fa-3x"></i>
                                    </div>
                                @endif
                                <div class="project-overlay">
                                    <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold shadow-lg">
                                        Detail Proyek <i class="fas fa-arrow-right ms-2 small"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="project-content">
                                <div class="project-category">{{ $portfolio->category->name ?? 'General' }}</div>
                                <h3 class="project-title">{{ Str::limit($portfolio->title, 45) }}</h3>
                                <p class="project-description">{{ $portfolio->short_description ?? Str::limit(strip_tags($portfolio->description), 90) }}</p>
                                
                                @if($portfolio->technologies)
                                    <div class="tech-badges">
                                        @php $techs = is_array($portfolio->technologies) ? $portfolio->technologies : []; @endphp
                                        @foreach(array_slice($techs, 0, 3) as $tech)
                                            <span class="tech-badge">{{ $tech }}</span>
                                        @endforeach
                                        @if(count($techs) > 3)
                                            <span class="tech-badge">+{{ count($techs) - 3 }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($portfolios->isEmpty())
                    <div class="col-12 text-center py-5">
                        <div class="py-5">
                            <i class="fas fa-folder-open fa-4x text-light mb-4" style="color: #E2E8F0 !important;"></i>
                            <h4 class="text-muted">Belum ada portofolio yang tersedia</h4>
                            <p class="text-secondary">Kami sedang mengerjakan proyek-proyek menarik. Kembali lagi nanti!</p>
                        </div>
                    </div>
                @endif
            </div>

            @if($portfolios->hasPages())
            <div class="d-flex justify-content-center mt-5 pt-4 reveal">
                {{ $portfolios->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-5 mt-5">
    <div class="container reveal">
        <div class="rounded-4 p-5 text-center position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, var(--midnight-blue) 0%, #1E3A8A 100%);">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 20px 20px; opacity: 0.5;"></div>
            <div class="position-relative z-1">
                <h2 class="text-white fw-bold mb-3">Siap Menjadi Bagian dari Kesuksesan Kami?</h2>
                <p class="text-white-50 mb-4 mx-auto" style="max-width: 600px;">Diskusikan tantangan bisnis Anda dan mari kita bangun solusi teknologi masa depan bersama-sama.</p>
                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-lg">
                        Mulai Konsultasi Gratis <i class="fas fa-paper-plane ms-2"></i>
                    </a>
                    <a href="https://wa.me/6285156412702" class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold">
                        Hubungi via WhatsApp <i class="fab fa-whatsapp ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Filtering Logic with Animation ---
        const filters = document.querySelectorAll('.btn-filter');
        const items = document.querySelectorAll('.portfolio-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Update Active Button
                filters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                const category = this.getAttribute('data-filter');

                items.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    
                    if (category === '' || itemCategory === category) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0) scale(1)';
                        }, 50);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px) scale(0.95)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 400);
                    }
                });
            });
        });

        // --- Reveal Animation on Scroll ---
        const reveal = () => {
            const reveals = document.querySelectorAll('.reveal');
            reveals.forEach(el => {
                const windowHeight = window.innerHeight;
                const elementTop = el.getBoundingClientRect().top;
                const elementVisible = 100;
                if (elementTop < windowHeight - elementVisible) {
                    el.classList.add('active');
                }
            });
        };

        window.addEventListener('scroll', reveal);
        reveal(); // Initial check
    });
</script>
@endpush
