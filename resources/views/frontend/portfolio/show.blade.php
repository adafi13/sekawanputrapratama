@extends('frontend.layouts.app')

@section('title', ($portfolio->meta_title ?? $portfolio->title) . ' - Portfolio | PT Sekawan Putra Pratama')
@section('meta_description', $portfolio->meta_description ?? Str::limit($portfolio->short_description, 160))

@push('styles')
<style>
    .project-detail-hero {
        background-color: var(--navy-dark);
        padding: 140px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .project-detail-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(37, 99, 235, 0.1) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.2;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.3);
    }

    .project-meta-card {
        background: #fff;
        border: 1px solid var(--slate-200);
        border-radius: var(--radius-lg);
        padding: 30px;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .section-title-modern {
        font-weight: 800;
        color: var(--midnight-blue);
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 25px;
        display: inline-block;
    }

    .section-title-modern::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 50px; height: 4px;
        background: var(--electric-blue);
        border-radius: 2px;
    }

    .metric-card {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        transition: var(--transition);
    }

    .metric-card:hover {
        transform: translateY(-5px);
        border-color: var(--electric-blue);
        background: #fff;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--electric-blue);
        margin-bottom: 5px;
    }

    .metric-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--slate-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .tech-pill {
        background: #F1F5F9;
        color: #475569;
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 8px;
        margin-right: 8px;
        border: 1px solid #E2E8F0;
    }

    .gallery-thumb {
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
        aspect-ratio: 4/3;
    }

    .gallery-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-thumb:hover img {
        transform: scale(1.1);
    }

    .gallery-thumb::after {
        content: '\f067';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 24px;
        opacity: 0;
        transition: var(--transition);
        z-index: 2;
    }

    .gallery-thumb:hover::after {
        opacity: 1;
    }

    .gallery-thumb::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(37, 99, 235, 0.4);
        opacity: 0;
        transition: var(--transition);
        z-index: 1;
    }

    .gallery-thumb:hover::before {
        opacity: 1;
    }

    .challenge-solution-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.03);
        border: 1px solid #F1F5F9;
    }

    .icon-box-modern {
        width: 60px;
        height: 60px;
        background: rgba(37, 99, 235, 0.1);
        color: var(--electric-blue);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    .article-content p {
        margin-bottom: 1.5rem;
        color: var(--slate-600);
        line-height: 1.8;
    }

    @media (max-width: 768px) {
        .project-detail-hero { padding: 120px 0 60px; }
        .display-5 { font-size: 2rem; }
        .challenge-solution-card { padding: 25px; }
    }
</style>
@endpush

@section('content')

{{-- Project Hero --}}
<section class="project-detail-hero">
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-4 reveal">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('portfolio.index') }}" class="text-white-50 text-decoration-none">Portfolio</a></li>
                        @if($portfolio->category)
                            <li class="breadcrumb-item"><a href="{{ route('portfolio.index', ['category' => $portfolio->category->slug]) }}" class="text-white-50 text-decoration-none">{{ $portfolio->category->name }}</a></li>
                        @endif
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($portfolio->title, 30) }}</li>
                    </ol>
                </nav>
                <div class="reveal">
                    <h1 class="display-5 fw-bold text-white mb-4">{{ $portfolio->title }}</h1>
                    <p class="lead text-white-50 mb-0" style="max-width: 650px;">{{ $portfolio->short_description }}</p>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0 reveal">
                @if($portfolio->project_url)
                    <a href="{{ $portfolio->project_url }}" target="_blank" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg">
                        Lihat Website <i class="fas fa-external-link-alt ms-2 small"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Featured Image & Stats --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8 reveal">
                @if($portfolio->featured_image)
                    <div class="rounded-4 overflow-hidden shadow-lg border">
                        <img src="{{ Storage::url($portfolio->featured_image) }}" class="w-100" alt="{{ $portfolio->title }}">
                    </div>
                @else
                    <div class="rounded-4 bg-light d-flex align-items-center justify-content-center border" style="height: 450px;">
                        <i class="fas fa-image fa-5x text-muted opacity-25"></i>
                    </div>
                @endif
            </div>
            <div class="col-lg-4 reveal">
                <div class="project-meta-card">
                    <h5 class="fw-bold mb-4" style="color: var(--midnight-blue);">Detail Proyek</h5>
                    <div class="mb-4 pb-3 border-bottom">
                        <small class="text-muted text-uppercase d-block mb-1">Klien</small>
                        <span class="fw-bold text-dark">{{ $portfolio->client_name ?? 'Confidential' }}</span>
                    </div>
                    @if($portfolio->client_industry)
                    <div class="mb-4 pb-3 border-bottom">
                        <small class="text-muted text-uppercase d-block mb-1">Industri</small>
                        <span class="fw-bold text-dark">{{ $portfolio->client_industry }}</span>
                    </div>
                    @endif
                    <div class="mb-4 pb-3 border-bottom">
                        <small class="text-muted text-uppercase d-block mb-1">Kategori</small>
                        <span class="fw-bold text-dark">{{ $portfolio->category->name ?? 'General IT' }}</span>
                    </div>
                    <div class="mb-0">
                        <small class="text-muted text-uppercase d-block mb-1">Tahun Selesai</small>
                        <span class="fw-bold text-dark">{{ $portfolio->created_at->format('Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Challenge & Solution --}}
@if($portfolio->challenge || $portfolio->solution)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @if($portfolio->challenge)
            <div class="col-md-6 reveal">
                <div class="challenge-solution-card h-100">
                    <div class="icon-box-modern">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 class="section-title-modern">Tantangan</h3>
                    <p class="text-secondary" style="font-size: 1.05rem; line-height: 1.7;">{{ $portfolio->challenge }}</p>
                </div>
            </div>
            @endif
            @if($portfolio->solution)
            <div class="col-md-6 reveal">
                <div class="challenge-solution-card h-100" style="border-top: 4px solid var(--electric-blue);">
                    <div class="icon-box-modern" style="background: rgba(37,99,235,0.1); color: var(--electric-blue);">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="section-title-modern">Solusi Kami</h3>
                    <p class="text-secondary" style="font-size: 1.05rem; line-height: 1.7;">{{ $portfolio->solution }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- Main Content --}}
@if($portfolio->content)
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 reveal">
                <h3 class="section-title-modern">Gambaran Proyek</h3>
                <div class="article-content text-secondary" style="font-size: 1.1rem;">
                    {!! $portfolio->content !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Metrics --}}
@if($portfolio->metrics && is_array($portfolio->metrics) && count($portfolio->metrics) > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <h3 class="fw-bold" style="color: var(--midnight-blue);">Dampak & Hasil</h3>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($portfolio->metrics as $metric)
                @if(isset($metric['label']) && isset($metric['value']))
                <div class="col-md-3 col-6 reveal">
                    <div class="metric-card">
                        <div class="metric-value">{{ $metric['value'] }}</div>
                        <div class="metric-label">{{ $metric['label'] }}</div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Technologies Used --}}
@if($portfolio->technologies)
<section class="py-5 bg-white border-top">
    <div class="container text-center reveal">
        <h4 class="fw-bold mb-4" style="color: var(--midnight-blue);">Teknologi yang Digunakan</h4>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            @php $techs = is_array($portfolio->technologies) ? $portfolio->technologies : explode(',', $portfolio->technologies); @endphp
            @foreach($techs as $tech)
                <span class="tech-pill">{{ is_array($tech) ? $tech : trim($tech) }}</span>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Gallery --}}
@if($portfolio->images && is_array($portfolio->images) && count($portfolio->images) > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-divider reveal">
            <h2>Galeri Proyek</h2>
        </div>
        <div class="row g-4 reveal">
            @foreach($portfolio->images as $image)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ Storage::url($image) }}" data-lightbox="project-gallery" data-title="{{ $portfolio->title }}">
                        <div class="gallery-thumb shadow-sm">
                            <img src="{{ Storage::url($image) }}" alt="Project Screenshot">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Related Projects --}}
@if(isset($relatedPortfolios) && $relatedPortfolios->count() > 0)
<section class="py-5 bg-white border-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5 reveal">
            <h3 class="fw-bold m-0" style="color: var(--midnight-blue);">Proyek Serupa</h3>
            <a href="{{ route('portfolio.index') }}" class="btn btn-outline-primary rounded-pill px-4">Lihat Semua</a>
        </div>
        <div class="row g-4 reveal">
            @foreach($relatedPortfolios as $related)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden" style="transition: var(--transition);">
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                            @if($related->featured_image)
                                <img src="{{ Storage::url($related->featured_image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $related->title }}">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-briefcase fa-2x text-muted opacity-25"></i>
                                </div>
                            @endif
                            <a href="{{ route('portfolio.show', $related->slug) }}" class="stretched-link"></a>
                        </div>
                        <div class="card-body p-4">
                            <div class="project-category" style="font-size: 10px;">{{ $related->category->name ?? 'General' }}</div>
                            <h5 class="fw-bold text-dark mb-2">{{ Str::limit($related->title, 45) }}</h5>
                            <p class="text-muted small mb-0">{{ Str::limit($related->short_description, 80) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Final CTA --}}
<section class="py-5 bg-light">
    <div class="container reveal">
        <div class="rounded-4 p-5 text-center bg-white shadow-sm border">
            <h2 class="fw-bold mb-3" style="color: var(--midnight-blue);">Tertarik dengan hasil seperti ini?</h2>
            <p class="text-secondary mb-4 mx-auto" style="max-width: 600px;">Mari kita bicarakan bagaimana kami bisa membantu bisnis Anda mencapai hasil yang sama luar biasanya.</p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">Mulai Sekarang</a>
                <a href="https://wa.me/6285156412702" class="btn btn-outline-success rounded-pill px-5 py-3 fw-bold">
                    <i class="fab fa-whatsapp me-2"></i> Konsultasi via WA
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
        reveal();
    });
</script>
@endpush
