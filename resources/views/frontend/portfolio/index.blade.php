@extends('frontend.layouts.app')

@section('title', 'Portofolio - Sekawan Putra Pratama')

@section('content')
<section class="banner-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-inner-block text-center">
                    <h1 class="banner-inner-title h-91 color-sec">Portofolio Kami</h1>
                    <p class="banner-text medium-gray">
                        Lihat hasil karya terbaik yang telah kami kerjakan untuk klien kami.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="portfolio mb-100">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-2"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="portfolio-wrapper">
            
            <ul class="nav nav-tabs mb-48" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">All Work</button>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="{{ $category->slug }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $category->slug }}" type="button">{{ $category->name }}</button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel">
                    <div class="tab-wrapper">
                        <div class="row">
                            @forelse($portfolios as $portfolio)
                                <div class="col-xl-6 col-lg-6 col-6">
                                    <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="d-block portfolio-item position-relative">
                                        @if($portfolio->getFirstMediaUrl('featured_image'))
                                            <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image">
                                        @else
                                            <img src="{{ asset('assets/media/images/tab-image-1.png') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image">
                                        @endif
                                        <div class="portfolio-overlay">
                                            <h5 class="white mb-2">{{ $portfolio->title }}</h5>
                                            @if($portfolio->category)
                                                <span class="badge bg-primary">{{ $portfolio->category->name }}</span>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <!-- Default portfolio images jika belum ada data -->
                                <div class="col-xl-6 col-lg-6 col-6">
                                    <img src="{{ asset('assets/media/images/tab-image-1.png') }}" loading="lazy" alt="" class="tab-image">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-6">
                                    <img src="{{ asset('assets/media/images/tab-image-2.png') }}" loading="lazy" alt="" class="tab-image">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-6">
                                    <img src="{{ asset('assets/media/images/tab-image-3.png') }}" loading="lazy" alt="" class="tab-image">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-6">
                                    <img src="{{ asset('assets/media/images/tab-image-4.png') }}" loading="lazy" alt="" class="tab-image">
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                @foreach($categories as $category)
                    <div class="tab-pane fade" id="{{ $category->slug }}" role="tabpanel">
                        <div class="tab-wrapper">
                            <div class="row">
                                @foreach($portfolios->where('category_id', $category->id) as $portfolio)
                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="d-block portfolio-item position-relative">
                                            @if($portfolio->getFirstMediaUrl('featured_image'))
                                                <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image">
                                            @else
                                                <img src="{{ asset('assets/media/images/tab-image-1.png') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image">
                                            @endif
                                            <div class="portfolio-overlay">
                                                <h5 class="white mb-2">{{ $portfolio->title }}</h5>
                                                <span class="badge bg-primary">{{ $category->name }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="cta mb-100">
    <div class="container-fluid">
        <div class="bg-primary p-5 text-center" style="border-radius: 20px; background: linear-gradient(45deg, #1a1a1a, #2a2a2a);">
            <h2 class="white mb-24">Tertarik Bekerja Sama?</h2>
            <p class="medium-gray mb-32">Kami siap mewujudkan ide digital Anda menjadi kenyataan.</p>
            <a href="{{ route('contact') }}" class="cus-btn">
                <span>Hubungi Kami</span>
            </a>
        </div>
    </div>
</section>

<style>
    .portfolio-item {
        transition: transform 0.3s ease, opacity 0.3s ease;
        display: block;
        overflow: hidden;
        border-radius: 16px;
    }
    .portfolio-item:hover {
        transform: scale(1.05);
    }
    .portfolio-item .tab-image {
        transition: transform 0.3s ease;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .portfolio-item:hover .tab-image {
        transform: scale(1.1);
    }
    .portfolio-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .portfolio-item:hover .portfolio-overlay {
        opacity: 1;
    }
</style>
@endsection


