@extends('frontend.layouts.app')

@section('title', 'Portfolio - ' . config('app.name'))

@section('content')
{{-- Page Header --}}
<section class="page-banner bg-dark-blue pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="white mb-16">Our Portfolio</h1>
                <p class="light-gray fs-18">Explore our latest projects and success stories</p>
            </div>
        </div>
    </div>
</section>

{{-- Portfolio Filter --}}
@if($categories->count() > 0)
<section class="portfolio-filter pt-60 pb-30 bg-dark-blue-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-buttons text-center mb-30">
                    <button class="filter-btn active" data-filter="*">All Projects</button>
                    @foreach($categories as $category)
                    <button class="filter-btn" data-filter=".{{ Str::slug($category->name) }}">
                        {{ $category->name }} 
                        @if($category->portfolios_count > 0)
                        <span>({{ $category->portfolios_count }})</span>
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Portfolio Grid --}}
<section class="portfolio-grid pt-80 pb-120 bg-dark-blue-2">
    <div class="container">
        @if($portfolios->count() > 0)
        <div class="row portfolio-items">
            @foreach($portfolios as $portfolio)
            <div class="col-lg-4 col-md-6 mb-40 portfolio-item {{ $portfolio->category ? Str::slug($portfolio->category->name) : '' }}">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        @if($portfolio->hasMedia('featured_image'))
                        <img src="{{ $portfolio->getFirstMediaUrl('featured_image', 'thumb') }}" 
                             alt="{{ $portfolio->title }}" 
                             loading="lazy">
                        @else
                        <img src="{{ asset('assets/media/placeholder-portfolio.jpg') }}" 
                             alt="{{ $portfolio->title }}"
                             loading="lazy">
                        @endif
                        <div class="portfolio-overlay">
                            <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="view-project">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="portfolio-info">
                        @if($portfolio->category)
                        <span class="portfolio-category">{{ $portfolio->category->name }}</span>
                        @endif
                        <h4 class="white mb-12">
                            <a href="{{ route('portfolio.show', $portfolio->slug) }}">{{ $portfolio->title }}</a>
                        </h4>
                        @if($portfolio->description)
                        <p class="medium-gray">{{ Str::limit($portfolio->description, 100) }}</p>
                        @endif
                        @if($portfolio->client_name)
                        <div class="client-info mt-12">
                            <span class="light-gray"><i class="fas fa-building"></i> {{ $portfolio->client_name }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($portfolios->hasPages())
        <div class="row mt-40">
            <div class="col-lg-12">
                <div class="pagination-wrapper text-center">
                    {{ $portfolios->links() }}
                </div>
            </div>
        </div>
        @endif
        @else
        <div class="row">
            <div class="col-lg-12">
                <div class="no-results text-center pt-60 pb-60">
                    <i class="fas fa-folder-open fs-64 medium-gray mb-24"></i>
                    <h3 class="white mb-16">No Projects Found</h3>
                    <p class="light-gray">We're working on adding new projects. Check back soon!</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
<section class="cta-section pt-80 pb-80 bg-blue">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="white mb-16">Ready to Start Your Project?</h2>
                <p class="light-gray fs-18 mb-0">Let's discuss how we can help bring your vision to life</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-white btn-lg">Get In Touch</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.portfolio-filter {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.filter-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
}
.filter-btn {
    padding: 12px 24px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.filter-btn:hover,
.filter-btn.active {
    background: var(--blue);
    border-color: var(--blue);
}
.portfolio-card {
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.portfolio-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.3);
}
.portfolio-image {
    position: relative;
    overflow: hidden;
    padding-top: 66.67%; /* 3:2 aspect ratio */
}
.portfolio-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.portfolio-card:hover .portfolio-image img {
    transform: scale(1.1);
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
    transform: scale(0.8);
    transition: transform 0.3s ease;
}
.portfolio-card:hover .view-project {
    transform: scale(1);
}
.portfolio-info {
    padding: 24px;
}
.portfolio-category {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(79, 172, 254, 0.1);
    color: var(--blue);
    border-radius: 4px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 12px;
}
.client-info {
    padding-top: 12px;
    border-top: 1px solid rgba(255,255,255,0.1);
}
.client-info i {
    margin-right: 6px;
    color: var(--blue);
}
.no-results i {
    opacity: 0.3;
}
</style>
@endpush
