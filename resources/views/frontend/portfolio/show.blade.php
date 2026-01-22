@extends('frontend.layouts.app')

@section('title', $portfolio->title . ' - Portfolio - ' . config('app.name'))

@section('content')
{{-- Portfolio Header --}}
<section class="portfolio-header pt-120 pb-80 bg-dark-blue">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if($portfolio->category)
                <span class="portfolio-category mb-16">{{ $portfolio->category->name }}</span>
                @endif
                <h1 class="white mb-24">{{ $portfolio->title }}</h1>
                @if($portfolio->description)
                <p class="light-gray fs-18">{{ $portfolio->description }}</p>
                @endif
            </div>
        </div>
        
        {{-- Project Info --}}
        <div class="row mt-40">
            @if($portfolio->client_name)
            <div class="col-lg-3 col-md-6 mb-24">
                <div class="info-box">
                    <span class="info-label medium-gray">Client</span>
                    <h5 class="white">{{ $portfolio->client_name }}</h5>
                </div>
            </div>
            @endif
            
            @if($portfolio->project_date)
            <div class="col-lg-3 col-md-6 mb-24">
                <div class="info-box">
                    <span class="info-label medium-gray">Date</span>
                    <h5 class="white">{{ $portfolio->project_date->format('M Y') }}</h5>
                </div>
            </div>
            @endif
            
            @if($portfolio->technologies && count($portfolio->technologies) > 0)
            <div class="col-lg-3 col-md-6 mb-24">
                <div class="info-box">
                    <span class="info-label medium-gray">Technologies</span>
                    <div class="tech-tags mt-8">
                        @foreach(array_slice($portfolio->technologies, 0, 3) as $tech)
                        <span class="tech-tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            
            @if($portfolio->project_url)
            <div class="col-lg-3 col-md-6 mb-24">
                <div class="info-box">
                    <span class="info-label medium-gray">Live Project</span>
                    <a href="{{ $portfolio->project_url }}" target="_blank" class="btn btn-sm btn-blue mt-8">
                        Visit Website <i class="fas fa-external-link-alt ms-2"></i>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- Featured Image --}}
@if($portfolio->hasMedia('featured_image'))
<section class="portfolio-featured-image pt-0 pb-0">
    <div class="container-fluid px-0">
        <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}" 
             alt="{{ $portfolio->title }}" 
             class="w-100">
    </div>
</section>
@endif

{{-- Portfolio Content --}}
<section class="portfolio-content pt-80 pb-80 bg-dark-blue-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if($portfolio->content)
                <div class="content-section mb-60">
                    <h3 class="white mb-24">About This Project</h3>
                    <div class="content light-gray">
                        {!! $portfolio->content !!}
                    </div>
                </div>
                @endif
                
                @if($portfolio->challenge)
                <div class="content-section mb-60">
                    <h3 class="white mb-24">The Challenge</h3>
                    <div class="content light-gray">
                        {!! $portfolio->challenge !!}
                    </div>
                </div>
                @endif
                
                @if($portfolio->solution)
                <div class="content-section mb-60">
                    <h3 class="white mb-24">Our Solution</h3>
                    <div class="content light-gray">
                        {!! $portfolio->solution !!}
                    </div>
                </div>
                @endif
                
                @if($portfolio->results)
                <div class="content-section mb-60">
                    <h3 class="white mb-24">Results</h3>
                    <div class="content light-gray">
                        {!! $portfolio->results !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Gallery --}}
@if($portfolio->hasMedia('images'))
<section class="portfolio-gallery pt-80 pb-80 bg-dark-blue">
    <div class="container">
        <div class="row mb-40">
            <div class="col-lg-12 text-center">
                <h2 class="white">Project Gallery</h2>
            </div>
        </div>
        <div class="row g-4">
            @foreach($portfolio->getMedia('images') as $image)
            <div class="col-lg-6">
                <a href="{{ $image->getUrl() }}" data-lightbox="portfolio">
                    <img src="{{ $image->getUrl('thumb') }}" 
                         alt="{{ $portfolio->title }}" 
                         class="w-100 rounded"
                         loading="lazy">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Related Projects --}}
@if($relatedPortfolios->count() > 0)
<section class="related-projects pt-80 pb-120 bg-dark-blue-2">
    <div class="container">
        <div class="row mb-60">
            <div class="col-lg-12 text-center">
                <h2 class="white">Related Projects</h2>
            </div>
        </div>
        <div class="row">
            @foreach($relatedPortfolios as $related)
            <div class="col-lg-4 mb-30">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        @if($related->hasMedia('featured_image'))
                        <img src="{{ $related->getFirstMediaUrl('featured_image', 'thumb') }}" 
                             alt="{{ $related->title }}"
                             loading="lazy">
                        @else
                        <img src="{{ asset('assets/media/placeholder-portfolio.jpg') }}" 
                             alt="{{ $related->title }}"
                             loading="lazy">
                        @endif
                        <div class="portfolio-overlay">
                            <a href="{{ route('portfolio.show', $related->slug) }}" class="view-project">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="portfolio-info">
                        @if($related->category)
                        <span class="portfolio-category">{{ $related->category->name }}</span>
                        @endif
                        <h4 class="white mb-12">
                            <a href="{{ route('portfolio.show', $related->slug) }}">{{ $related->title }}</a>
                        </h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="cta-section pt-80 pb-80 bg-blue">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="white mb-16">Interested in Similar Results?</h2>
                <p class="light-gray fs-18 mb-0">Let's discuss your project requirements</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-white btn-lg">Contact Us</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.portfolio-category {
    display: inline-block;
    padding: 6px 16px;
    background: rgba(79, 172, 254, 0.1);
    color: var(--blue);
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
}
.info-box {
    padding: 20px;
    background: rgba(255,255,255,0.03);
    border-radius: 8px;
}
.info-label {
    display: block;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
}
.tech-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.tech-tag {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(79, 172, 254, 0.15);
    color: var(--blue);
    border-radius: 4px;
    font-size: 12px;
}
.content-section {
    padding: 30px;
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
}
.content p {
    margin-bottom: 16px;
    line-height: 1.8;
}
.portfolio-card {
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease;
}
.portfolio-card:hover {
    transform: translateY(-8px);
}
.portfolio-image {
    position: relative;
    overflow: hidden;
    padding-top: 66.67%;
}
.portfolio-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.portfolio-card:hover .portfolio-overlay {
    opacity: 1;
}
.view-project {
    width: 60px;
    height: 60px;
    background: var(--blue);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 20px;
}
.portfolio-info {
    padding: 24px;
}
</style>
@endpush
