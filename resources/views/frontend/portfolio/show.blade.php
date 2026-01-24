@extends('frontend.layouts.app')

@section('title', $portfolio->meta_title ?? $portfolio->title . ' - Portfolio Sekawan Putra Pratama')
@section('meta_description', $portfolio->meta_description ?? Str::limit($portfolio->short_description, 160))
@section('meta_keywords', $portfolio->meta_keywords)

@section('content')

{{-- Hero Section - Minimalist --}}
<section class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('portfolio.index') }}" class="text-decoration-none">Portfolio</a></li>
                @if($portfolio->category)
                    <li class="breadcrumb-item"><a href="{{ route('portfolio.index', ['category' => $portfolio->category->slug]) }}" class="text-decoration-none">{{ $portfolio->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active">{{ Str::limit($portfolio->title, 40) }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- Title & Meta --}}
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        @if($portfolio->category)
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">{{ $portfolio->category->name }}</span>
                        @endif
                        <span class="text-muted small">{{ $portfolio->created_at->format('M Y') }}</span>
                        @if($portfolio->client_name)
                            <span class="text-muted small">• {{ $portfolio->client_name }}</span>
                        @endif
                    </div>
                    <h1 class="display-5 fw-bold text-dark mb-3">{{ $portfolio->title }}</h1>
                    <p class="lead text-muted mb-0" style="line-height: 1.6;">{{ $portfolio->short_description }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Featured Image --}}
<section class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($portfolio->featured_image)
                <div class="rounded-3 overflow-hidden shadow-sm">
                    <img src="{{ Storage::url($portfolio->featured_image) }}" class="img-fluid w-100" alt="{{ $portfolio->title }}" style="max-height: 600px; object-fit: cover;">
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Project Overview - Simple Grid --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                @if($portfolio->challenge || $portfolio->solution || $portfolio->results)
                <div class="row g-4 mb-5">
                    @if($portfolio->challenge)
                    <div class="col-md-4">
                        <div class="border-start border-warning border-3 ps-3">
                            <h6 class="text-warning fw-bold text-uppercase small mb-2">Challenge</h6>
                            <p class="text-muted mb-0 small" style="line-height: 1.6;">{{ $portfolio->challenge }}</p>
                        </div>
                    </div>
                    @endif

                    @if($portfolio->solution)
                    <div class="col-md-4">
                        <div class="border-start border-primary border-3 ps-3">
                            <h6 class="text-primary fw-bold text-uppercase small mb-2">Solution</h6>
                            <p class="text-muted mb-0 small" style="line-height: 1.6;">{{ $portfolio->solution }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if($portfolio->results)
                    <div class="col-md-4">
                        <div class="border-start border-success border-3 ps-3">
                            <h6 class="text-success fw-bold text-uppercase small mb-2">Results</h6>
                            <p class="text-muted mb-0 small" style="line-height: 1.6;">{{ $portfolio->results }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                {{-- Content --}}
                @if($portfolio->content)
                <div class="mb-5">
                    <div class="article-content text-muted" style="font-size: 1rem; line-height: 1.8;">
                        {!! $portfolio->content !!}
                    </div>
                </div>
                @endif

                {{-- Metrics - Clean Cards --}}
                @if($portfolio->metrics && is_array($portfolio->metrics) && count($portfolio->metrics) > 0)
                <div class="mb-5">
                    <h5 class="fw-bold mb-4">Key Metrics</h5>
                    <div class="row g-3">
                        @foreach($portfolio->metrics as $metric)
                            @if(isset($metric['label']) && isset($metric['value']))
                            <div class="col-md-4">
                                <div class="p-4 border rounded-3 bg-light text-center h-100">
                                    <h3 class="fw-bold text-primary mb-1">{{ $metric['value'] }}</h3>
                                    <p class="text-muted small mb-0">{{ $metric['label'] }}</p>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Gallery - Minimal Grid --}}
                @if($portfolio->images && is_array($portfolio->images) && count($portfolio->images) > 0)
                <div class="mb-5">
                    <h5 class="fw-bold mb-4">Gallery</h5>
                    <div class="row g-3">
                        @foreach($portfolio->images as $image)
                            <div class="col-md-4 col-6">
                                <a href="{{ Storage::url($image) }}" data-lightbox="gallery" data-title="{{ $portfolio->title }}">
                                    <div class="rounded-2 overflow-hidden gallery-item border" style="height: 200px;">
                                        <img src="{{ Storage::url($image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $portfolio->title }}">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Tech Stack - Simple Badges --}}
                @if($portfolio->technologies)
                <div class="mb-5">
                    <h5 class="fw-bold mb-3">Technologies</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach(is_array($portfolio->technologies) ? $portfolio->technologies : explode(',', $portfolio->technologies) as $tech)
                            <span class="badge bg-dark bg-opacity-10 text-dark fw-normal px-3 py-2">{{ is_array($tech) ? $tech : trim($tech) }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Project Info & CTA - Horizontal Layout --}}
                @if($portfolio->client_name || $portfolio->project_url)
                <div class="border-top pt-4">
                    <div class="row align-items-center">
                        @if($portfolio->client_name)
                        <div class="col-md-6 mb-3 mb-md-0">
                            <p class="text-muted small mb-1">Client</p>
                            <p class="fw-bold mb-0">{{ $portfolio->client_name }}</p>
                            @if($portfolio->client_industry)
                                <p class="text-muted small mb-0">{{ $portfolio->client_industry }}</p>
                            @endif
                        </div>
                        @endif
                        
                        @if($portfolio->project_url)
                        <div class="col-md-6 text-md-end">
                            <a href="{{ $portfolio->project_url }}" target="_blank" class="btn btn-primary px-4">
                                Visit Project <i class="fas fa-arrow-right ms-2 small"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

{{-- Related Projects - Minimal Cards --}}
@if(isset($relatedPortfolios) && $relatedPortfolios->count() > 0)
<section class="py-5 bg-light border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h5 class="fw-bold mb-4">Related Projects</h5>
                
                <div class="row g-3">
                    @foreach($relatedPortfolios as $related)
                        <div class="col-md-4">
                            <a href="{{ route('portfolio.show', $related->slug) }}" class="text-decoration-none">
                                <div class="card border-0 shadow-sm h-100 project-card">
                                    <div class="position-relative overflow-hidden" style="height: 180px;">
                                        @if($related->featured_image)
                                            <img src="{{ Storage::url($related->featured_image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $related->title }}">
                                        @else
                                            <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                                <i class="fas fa-briefcase fa-2x text-muted opacity-25"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body p-3">
                                        @if($related->category)
                                            <span class="badge bg-primary bg-opacity-10 text-primary small mb-2">{{ $related->category->name }}</span>
                                        @endif
                                        <h6 class="fw-bold text-dark mb-1">{{ Str::limit($related->title, 50) }}</h6>
                                        <p class="text-muted small mb-0">{{ Str::limit($related->short_description, 80) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<style>
    /* Minimal & Professional Styles */
    .project-card { 
        transition: all 0.3s ease; 
        border-radius: 8px;
    }
    .project-card:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; 
    }
    .project-card img { transition: transform 0.5s ease; }
    .project-card:hover img { transform: scale(1.05); }
    
    .gallery-item { 
        transition: all 0.3s ease; 
        cursor: pointer;
        background: #f8f9fa;
    }
    .gallery-item:hover { 
        opacity: 0.9;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .article-content img { 
        max-width: 100%; 
        height: auto; 
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    .article-content p { margin-bottom: 1rem; }
    .article-content h2, .article-content h3, .article-content h4 { 
        margin-top: 2rem; 
        margin-bottom: 1rem;
        font-weight: 700;
    }
    .article-content ul, .article-content ol { 
        margin-bottom: 1rem; 
        padding-left: 1.5rem;
    }
    .article-content blockquote {
        border-left: 3px solid #0d6efd;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #6c757d;
    }
</style>

@endsection