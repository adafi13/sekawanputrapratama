@extends('frontend.layouts.app')

@section('content')

{{-- Hero Section --}}
<section class="banner">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-2"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="text-reveal mb-32">
                    <span class='random-word h-91 color-sec'>Transformasi Digital</span>
                    <h1>Solusi Teknologi <br> Yang <span class='random-word h-91 color-primary'>Terintegrasi</span></h1>
                </div>
                <p class="medium-gray mb-32">
                    Kami membantu bisnis Anda berkembang melalui layanan <br> 
                    <strong>Web Development</strong>, <strong>App Development</strong>, dan <strong>Infrastruktur Server</strong> yang handal.
                </p>
                <a class="cus-btn m-auto" href="{{ route('services.index') }}">
                    <span>Jelajahi Layanan</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Video Section --}}
<section class="video-sec">
    <div class="blur-2">
        <div class="animate-4"></div>
        <div class="animate-5"></div>
    </div>
    <div class="container-fluid">
        <div class="bg-video">
            <div class="clothing-video">
                <video id="videoPlayer" loop playsinline muted autoplay class="mb-32">
                    <source src="{{ asset('assets/media/tech-video.mp4') }}" type="video/mp4">
                </video>
                <h4 class="white text-center mb-32">Ingin tahu kami <br> lebih lanjut?</h4>
                <a class="cus-btn m-auto" href="{{ route('contact') }}">
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Portfolio Section --}}
<section class="portfolio">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-2"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="portfolio-wrapper">
            <div class="heading text-center">
                <h2 class="white mb-16">Portofolio <br> Unggulan Kami</h2>
                <p class="medium-gray mb-32">
                    Kumpulan karya terbaik kami yang telah membantu banyak klien <br>
                    mencapai tujuan digital mereka.
                </p>
                <a class="cus-btn m-auto mb-64" href="{{ route('portfolio.index') }}">
                    <span>Lihat Semua Karya</span>
                </a>
            </div>
            
            @if($portfolios && $portfolios->count() > 0)
            <ul class="nav nav-tabs mb-48" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">
                        All Work
                    </button>
                </li>
                @foreach($portfolioCategories as $category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cat-{{ $category->slug }}-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#cat-{{ $category->slug }}" 
                            type="button">
                        {{ $category->name }}
                    </button>
                </li>
                @endforeach
            </ul>

            <div class="tab-content" id="myTabContent">
                {{-- All Portfolios Tab --}}
                <div class="tab-pane fade show active" id="all" role="tabpanel">
                    <div class="tab-wrapper">
                        <div class="row">
                            @foreach($portfolios->take(4) as $portfolio)
                            <div class="col-xl-6 col-lg-6 col-6">
                                <a href="{{ route('portfolio.show', $portfolio->slug) }}">
                                    <img src="{{ $portfolio->featured_image ? asset('storage/' . $portfolio->featured_image) : asset('assets/media/images/placeholder.png') }}" 
                                         loading="lazy" 
                                         alt="{{ $portfolio->title }}" 
                                         class="tab-image">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Category Tabs --}}
                @foreach($portfolioCategories as $category)
                <div class="tab-pane fade" id="cat-{{ $category->slug }}" role="tabpanel">
                    <div class="tab-wrapper">
                        <div class="row">
                            @foreach($category->portfolios->take(4) as $portfolio)
                            <div class="col-xl-6 col-lg-6 col-6">
                                <a href="{{ route('portfolio.show', $portfolio->slug) }}">
                                    <img src="{{ $portfolio->featured_image ? asset('storage/' . $portfolio->featured_image) : asset('assets/media/images/placeholder.png') }}" 
                                         loading="lazy" 
                                         alt="{{ $portfolio->title }}" 
                                         class="tab-image">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-center medium-gray">Belum ada portfolio yang ditampilkan.</p>
            @endif
        </div>
    </div>
</section>

{{-- Services Section --}}
<section class="services">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="services-wrapper">
            <div class="heading text-center">
                <h2 class="white mb-16">Layanan Profesional <br> Kami</h2>
                <p class="medium-gray mb-32">
                    Solusi lengkap untuk mendukung infrastruktur dan <br> 
                    ekosistem digital bisnis Anda.
                </p>
                <a class="cus-btn m-auto mb-64" href="{{ route('services.index') }}">
                    <span>Lihat Detail Layanan</span>
                </a>
            </div>
            
            {{-- Service 1: App Development --}}
            <div class="service-block mb-80">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="image-block">
                            <div class="text-box text-center">
                                <h2 class="service-number mb-48">1</h2>
                                <h4 class="white">App Development</h4>
                                <div class="hover-block">
                                    <img src="{{ asset('assets/media/images/app-development.png') }}" 
                                         loading="lazy" 
                                         style="border-radius: 20px !important;" 
                                         alt="App Development">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="service-text text-center">
                            <h2 class="white mb-16">App Development</h2>
                            <ul class="list-unstyled">
                                <li class="label p-18 dark-black">Mobile App (Android/iOS)</li>
                                <li class="label p-18 dark-black">Desktop App</li>
                            </ul>
                            <p class="medium-gray mb-32">
                                Aplikasi responsif dan stabil untuk kebutuhan bisnis Anda.
                            </p>
                            <a class="cus-btn m-auto" href="{{ route('services.index') }}">
                                <span>Buat Aplikasi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Service 2: Web Development --}}
            <div class="service-block mb-80">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="image-block">
                            <div class="text-box text-center">
                                <h2 class="service-number mb-48">2</h2>
                                <h4 class="white">Web Development</h4>
                                <div class="hover-block">
                                    <img src="{{ asset('assets/media/images/web-development.png') }}" 
                                         loading="lazy" 
                                         style="border-radius: 20px !important;" 
                                         alt="Web Development">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="service-text text-center">
                            <h2 class="white mb-16">Web Development</h2>
                            <ul class="list-unstyled">
                                <li class="label p-18 dark-black">Company Profile</li>
                                <li class="label p-18 dark-black">Web App / E-Commerce</li>
                            </ul>
                            <p class="medium-gray mb-32">
                                Website profesional yang cepat dan SEO-friendly.
                            </p>
                            <a class="cus-btn m-auto" href="{{ route('services.index') }}">
                                <span>Buat Website</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Service 3: Office Server --}}
            <div class="service-block mb-80">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="image-block">
                            <div class="text-box text-center">
                                <h2 class="service-number mb-48">3</h2>
                                <h4 class="white">Office Server</h4>
                                <div class="hover-block">
                                    <img src="{{ asset('assets/media/images/office-server.png') }}" 
                                         loading="lazy" 
                                         style="border-radius: 20px !important;" 
                                         alt="Office Server">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="service-text text-center">
                            <h2 class="white mb-16">Office Server</h2>
                            <ul class="list-unstyled">
                                <li class="label p-18 dark-black">Instalasi Server</li>
                                <li class="label p-18 dark-black">Manajemen Jaringan</li>
                            </ul>
                            <p class="medium-gray mb-32">
                                Server aman dan terpusat untuk alur kerja perusahaan.
                            </p>
                            <a class="cus-btn m-auto" href="{{ route('services.index') }}">
                                <span>Konsultasi Server</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Blog Section --}}
@if($latestBlogs && $latestBlogs->count() > 0)
<section class="blog">
    <div class="blur">
        <div class="animate-2"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="heading text-center">
            <h2 class="white mb-16">Artikel & Insight</h2>
            <p class="medium-gray mb-32">
                Tips, tutorial, dan berita terkini seputar teknologi.
            </p>
            <a class="cus-btn m-auto mb-64" href="{{ route('blog.index') }}">
                <span>Lihat Semua Artikel</span>
            </a>
        </div>
        
        <div class="row">
            @foreach($latestBlogs as $blog)
            <div class="col-md-4 mb-32">
                <div class="blog-card">
                    <a href="{{ route('blog.show', $blog->slug) }}">
                        <img src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('assets/media/images/blog-placeholder.png') }}" 
                             alt="{{ $blog->title }}" 
                             loading="lazy"
                             class="blog-image">
                    </a>
                    <div class="blog-content">
                        <span class="blog-category">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                        <h4 class="white mb-16">
                            <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                        </h4>
                        <p class="medium-gray">{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                        <div class="blog-meta">
                            <span>{{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Contact CTA Section --}}
<section class="contact-cta">
    <div class="blur-2">
        <div class="animate-4"></div>
        <div class="animate-5"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="cta-content text-center">
                    <h2 class="white mb-24">Siap Memulai Proyek Anda?</h2>
                    <p class="medium-gray mb-32">
                        Konsultasikan kebutuhan digital bisnis Anda bersama tim ahli kami.
                    </p>
                    <a class="cus-btn m-auto" href="{{ route('contact') }}">
                        <span>Hubungi Kami Sekarang</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
