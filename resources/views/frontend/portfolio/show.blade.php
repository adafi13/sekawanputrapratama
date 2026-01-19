@extends('frontend.layouts.app')

@section('title', $portfolio->meta_title ?? ($portfolio->title . ' - Sekawan Putra Pratama'))
@section('meta_description', $portfolio->meta_description ?? $portfolio->description)

@section('content')
<section class="banner-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-inner-block text-center">
                    <h1 class="banner-inner-title h-91 color-sec">{{ $portfolio->title }}</h1>
                    <p class="banner-text medium-gray">
                        @if($portfolio->category)
                            {{ $portfolio->category->name }}
                        @endif
                        @if($portfolio->project_date)
                            • {{ $portfolio->project_date->format('M Y') }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="portfolio-detail mb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if($portfolio->getFirstMediaUrl('featured_image'))
                    <div class="portfolio-featured-image mb-48">
                        <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}" loading="lazy" alt="{{ $portfolio->title }}" class="w-100" style="border-radius: 20px;">
                    </div>
                @endif
                
                <div class="portfolio-content">
                    <h2 class="white mb-24">{{ $portfolio->title }}</h2>
                    
                    @if($portfolio->description)
                        <p class="medium-gray mb-32 lead">{{ $portfolio->description }}</p>
                    @endif
                    
                    <div class="portfolio-info mb-48" style="background: #1a1a1a; padding: 30px; border-radius: 16px;">
                        <div class="row">
                            @if($portfolio->client_name)
                                <div class="col-md-6 mb-24">
                                    <h6 class="color-sec mb-8">Klien</h6>
                                    <p class="white mb-0">{{ $portfolio->client_name }}</p>
                                </div>
                            @endif
                            @if($portfolio->category)
                                <div class="col-md-6 mb-24">
                                    <h6 class="color-sec mb-8">Kategori</h6>
                                    <p class="white mb-0">{{ $portfolio->category->name }}</p>
                                </div>
                            @endif
                            @if($portfolio->project_date)
                                <div class="col-md-6 mb-24">
                                    <h6 class="color-sec mb-8">Tanggal Proyek</h6>
                                    <p class="white mb-0">{{ $portfolio->project_date->format('d M Y') }}</p>
                                </div>
                            @endif
                            @if($portfolio->project_url)
                                <div class="col-md-6 mb-24">
                                    <h6 class="color-sec mb-8">Link Proyek</h6>
                                    <a href="{{ $portfolio->project_url }}" target="_blank" class="color-primary" rel="noopener noreferrer">
                                        Kunjungi Website <i class="fas fa-external-link-alt ms-2"></i>
                                    </a>
                                </div>
                            @endif
                            @if($portfolio->technologies && count($portfolio->technologies) > 0)
                                <div class="col-md-12">
                                    <h6 class="color-sec mb-16">Teknologi</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($portfolio->technologies as $tech)
                                            <span class="badge bg-primary">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($portfolio->content)
                        <div class="portfolio-description mb-48">
                            {!! $portfolio->content !!}
                        </div>
                    @endif
                    
                    @if($portfolio->getMedia('images')->count() > 0)
                        <div class="portfolio-gallery mb-48">
                            <h3 class="white mb-32">Galeri Proyek</h3>
                            <div class="row">
                                @foreach($portfolio->getMedia('images') as $image)
                                    <div class="col-md-6 mb-24">
                                        <img src="{{ $image->getUrl() }}" loading="lazy" alt="{{ $portfolio->title }}" class="w-100" style="border-radius: 16px;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@if($relatedPortfolios->count() > 0)
    <section class="related-portfolio mb-100">
        <div class="container-fluid">
            <div class="heading text-center mb-48">
                <h2 class="white mb-16">Proyek Lainnya</h2>
                <p class="medium-gray">Lihat karya kami yang lainnya</p>
            </div>
            <div class="row">
                @foreach($relatedPortfolios as $related)
                    <div class="col-lg-4 col-md-6 mb-32">
                        <a href="{{ route('portfolio.show', $related->slug) }}" class="d-block">
                            <div class="portfolio-card" style="background: #1a1a1a; border-radius: 16px; overflow: hidden; transition: transform 0.3s;">
                                @if($related->getFirstMediaUrl('featured_image'))
                                    <img src="{{ $related->getFirstMediaUrl('featured_image') }}" loading="lazy" alt="{{ $related->title }}" class="w-100" style="height: 250px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/media/images/tab-image-1.png') }}" loading="lazy" alt="{{ $related->title }}" class="w-100" style="height: 250px; object-fit: cover;">
                                @endif
                                <div class="p-4">
                                    <h5 class="white mb-8">{{ $related->title }}</h5>
                                    @if($related->category)
                                        <p class="medium-gray mb-0">{{ $related->category->name }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section class="cta mb-100">
    <div class="container-fluid">
        <div class="bg-primary p-5 text-center" style="border-radius: 20px; background: linear-gradient(45deg, #1a1a1a, #2a2a2a);">
            <h2 class="white mb-24">Tertarik dengan Proyek Kami?</h2>
            <p class="medium-gray mb-32">Kami siap mewujudkan ide digital Anda menjadi kenyataan.</p>
            <a href="{{ route('contact') }}" class="cus-btn">
                <span>Hubungi Kami</span>
            </a>
        </div>
    </div>
</section>
@endsection


