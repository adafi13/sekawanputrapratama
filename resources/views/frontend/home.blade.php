@extends('frontend.layouts.app')

@section('title', 'Sekawan Putra Pratama - IT Consultant & Software House')

@push('styles')
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
@endpush

@section('content')
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
                    <span class='random-word h-91 color-sec'>{{ $bannerSettings['title'] ?? 'Transformasi Digital' }}</span>
                    <h1>{!! str_replace(['<br>', '<br/>'], ['<br>', '<br/>'], $bannerSettings['subtitle'] ?? 'Solusi Teknologi <br> Yang Terintegrasi') !!}</h1>
                </div>
                <p class="medium-gray mb-32">
                    {!! nl2br(e($bannerSettings['description'] ?? 'Kami membantu bisnis Anda berkembang melalui layanan Web Development, App Development, dan Infrastruktur Server yang handal.')) !!}
                </p>
                <a class="cus-btn m-auto" href="{{ route('services.index') }}">
                    <span>Jelajahi Layanan</span>
                </a>
            </div>
        </div>
    </div>
</section>

@if(isset($brands) && $brands->count() > 0)
<div class="brands">
    <div class="brand-slider">
        @foreach($brands as $brand)
            <div class="brand-slide">
                <div class="brand-block">
                    @if($brand->getFirstMediaUrl('logo'))
                        <a href="{{ $brand->website_url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $brand->getFirstMediaUrl('logo') }}" alt="{{ $brand->name }}" loading="lazy">
                        </a>
                    @else
                        <img src="{{ asset('assets/media/brands/brand-1.png') }}" alt="{{ $brand->name }}" loading="lazy">
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- Why Choose Us Section --}}
<section class="why-choose-us">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-2"></div>
    </div>
    <div class="container-fluid">
        <div class="heading text-center mb-64">
            <h2 class="white mb-16">Mengapa Memilih Kami?</h2>
            <p class="medium-gray mb-32">Komitmen kami untuk memberikan solusi terbaik bagi bisnis Anda</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-32">
                <div class="trust-indicator text-center">
                    <div class="icon-box mb-24">
                        <i class="fas fa-project-diagram color-primary" style="font-size: 48px;"></i>
                    </div>
                    <h3 class="white mb-16">{{ $stats['projects_completed'] ?? '50+' }} Proyek Selesai</h3>
                    <p class="medium-gray">Berpengalaman dalam menyelesaikan berbagai proyek IT untuk berbagai industri</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-32">
                <div class="trust-indicator text-center">
                    <div class="icon-box mb-24">
                        <i class="fas fa-users color-primary" style="font-size: 48px;"></i>
                    </div>
                    <h3 class="white mb-16">{{ $stats['happy_clients'] ?? '20+' }} Klien Puas</h3>
                    <p class="medium-gray">Kepercayaan klien adalah prioritas utama kami dalam setiap proyek</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-32">
                <div class="trust-indicator text-center">
                    <div class="icon-box mb-24">
                        <i class="fas fa-calendar-check color-primary" style="font-size: 48px;"></i>
                    </div>
                    <h3 class="white mb-16">{{ $stats['years_experience'] ?? '5+' }} Tahun Pengalaman</h3>
                    <p class="medium-gray">Pengalaman luas dalam mengembangkan solusi teknologi untuk bisnis dan enterprise</p>
                </div>
            </div>
        </div>
        
        <div class="row mt-48">
            <div class="col-lg-3 col-md-6 mb-32">
                <div class="trust-badge text-center">
                    <i class="fas fa-clock color-sec mb-16" style="font-size: 32px;"></i>
                    <h5 class="white mb-8">24/7 Support</h5>
                    <p class="medium-gray small">Dukungan teknis kapan saja Anda butuhkan</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-32">
                <div class="trust-badge text-center">
                    <i class="fas fa-shield-alt color-sec mb-16" style="font-size: 32px;"></i>
                    <h5 class="white mb-8">Terpercaya</h5>
                    <p class="medium-gray small">Keamanan data dan sistem adalah prioritas</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-32">
                <div class="trust-badge text-center">
                    <i class="fas fa-tools color-sec mb-16" style="font-size: 32px;"></i>
                    <h5 class="white mb-8">Solusi Lengkap</h5>
                    <p class="medium-gray small">Dari konsultasi hingga implementasi dan maintenance</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-32">
                <div class="trust-badge text-center">
                    <i class="fas fa-handshake color-sec mb-16" style="font-size: 32px;"></i>
                    <h5 class="white mb-8">Dedikasi Tinggi</h5>
                    <p class="medium-gray small">Tim profesional yang berkomitmen pada kualitas</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="video-sec">
    <div class="blur-2">
        <div class="animate-4"></div>
        <div class="animate-5"></div>
    </div>
    <div class="container-fluid">
        <div class="bg-video">
            <div class="clothing-video">
                <video 
                    id="videoPlayer" 
                    loop 
                    playsinline 
                    muted 
                    class="mb-32"
                    preload="metadata"
                    poster="{{ asset('assets/media/images/video-poster.jpg') }}"
                    loading="lazy"
                    style="width: 100%; height: auto; border-radius: 20px;">
                    <source src="{{ asset('assets/media/tech-video.mp4') }}" type="video/mp4">
                    {{-- Add WebM format if available for better compression --}}
                    {{-- <source src="{{ asset('assets/media/tech-video.webm') }}" type="video/webm"> --}}
                    Your browser does not support the video tag.
                </video>
                <h4 class="white text-center mb-32">Ingin tahu kami <br> lebih lanjut?</h4>
                <a class="cus-btn m-auto" href="{{ route('contact') }}">
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Lazy load video - play only when in viewport
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.getElementById('videoPlayer');
        if (!video) return;
        
        // Intersection Observer untuk lazy loading video
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    video.play().catch(e => {
                        // Autoplay might be blocked, that's okay
                        console.log('Video autoplay blocked:', e);
                    });
                } else {
                    video.pause();
                }
            });
        }, {
            threshold: 0.5
        });
        
        observer.observe(video);
        
        // Play video on user interaction (click)
        video.addEventListener('click', function() {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        });
    });
</script>

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
            
            
            <ul class="nav nav-tabs mb-48" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">All Work</button>
                </li>
                @foreach($categories->take(3) as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="{{ $category->slug }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $category->slug }}" type="button">{{ $category->name }}</button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel">
                    <div class="tab-wrapper">
                        <div class="row">
                            @forelse($featuredPortfolios as $portfolio)
                                <div class="col-xl-6 col-lg-6 col-6">
                                    <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="d-block portfolio-item position-relative">
                                        @if($portfolio->getFirstMediaUrl('featured_image'))
                                            <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image" width="600" height="400">
                                        @else
                                            <img src="{{ asset('assets/media/images/tab-image-' . (($loop->index % 4) + 1) . '.png') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image" width="600" height="400">
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
                                @for($i = 1; $i <= 4; $i++)
                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <img src="{{ asset('assets/media/images/tab-image-' . $i . '.png') }}" loading="lazy" alt="Project {{ $i }}" class="tab-image" width="600" height="400">
                                    </div>
                                @endfor
                            @endforelse
                        </div>
                    </div>
                </div>
                @foreach($categories->take(3) as $index => $category)
                    <div class="tab-pane fade" id="{{ $category->slug }}" role="tabpanel">
                        <div class="tab-wrapper">
                            <div class="row">
                                @foreach($featuredPortfolios->where('category_id', $category->id)->take(1) as $portfolio)
                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="d-block portfolio-item position-relative">
                                            @if($portfolio->getFirstMediaUrl('featured_image'))
                                                <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image" width="600" height="400">
                                            @else
                                                <img src="{{ asset('assets/media/images/tab-image-' . ($index + 1) . '.png') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image" width="600" height="400">
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

<section class="services">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="services-wrapper">
            <div class="heading text-center">
                <h2 class="white mb-16">Layanan Profesional <br> Kami</h2>
                <p class="medium-gray mb-32">Solusi lengkap untuk mendukung infrastruktur dan <br> ekosistem digital bisnis Anda.</p>
                <a class="cus-btn m-auto mb-64" href="{{ route('services.index') }}">
                    <span>Lihat Detail Layanan</span>
                </a>
            </div>
            
            
            @forelse($services as $index => $service)
                <div class="service-block mb-80">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="image-block">
                                <div class="text-box text-center">
                                    <h2 class="service-number mb-48">{{ $index + 1 }}</h2>
                                    <h4 class="white">{{ $service->title }}</h4>
                                    <div class="hover-block">
                                        @if($service->getFirstMediaUrl('images'))
                                            <img src="{{ $service->getFirstMediaUrl('images') }}" loading="lazy" style="border-radius: 20px !important;" alt="{{ $service->title }}">
                                        @else
                                            <img src="{{ asset('assets/media/images/app-development.png') }}" loading="lazy" style="border-radius: 20px !important;" alt="{{ $service->title }}" width="400" height="300">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="service-text text-center">
                                <h2 class="white mb-16">{{ $service->title }}</h2>
                                <p class="medium-gray mb-32">{{ $service->description }}</p>
                                <a class="cus-btn m-auto" href="{{ route('services.show', $service->slug) }}">
                                    <span>Pelajari Lebih Lanjut</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Default services -->
                <div class="service-block mb-80">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="image-block">
                                <div class="text-box text-center">
                                    <h2 class="service-number mb-48">1</h2>
                                    <h4 class="white">App Development</h4>
                                    <div class="hover-block">
                                        <img src="{{ asset('assets/media/images/app-development.png') }}" loading="lazy" style="border-radius: 20px !important;" alt="App Dev" width="400" height="300">
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
                                <p class="medium-gray mb-32">Aplikasi responsif dan stabil untuk kebutuhan bisnis Anda.</p>
                                <a class="cus-btn m-auto" href="{{ route('contact') }}">
                                    <span>Konsultasi Gratis</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="team" id="team">
    <div class="blur">
        <div class="animate-1"></div>
    </div>
    <div class="container-fluid">
        <div class="heading text-center">
            <h2 class="white mb-16">Tim Profesional Kami</h2>
            <p class="medium-gray mb-32">Dedikasi dan keahlian untuk memberikan hasil terbaik.</p>
        </div>
    </div>
            <div class="team-slider">
                @forelse($teamMembers ?? [] as $member)
                    <div class="team-block">
                        <div class="row">
                            <div class="col-lg-6 col-md-7">
                                <div class="detail-box">
                                    <div class="text-box">
                                        <h4 class="white mb-8">{{ $member->name }}</h4>
                                        <p class="fw-500 color-sec mb-32">{{ $member->position }}</p>
                                        <p class="medium-gray">{{ $member->bio ?? 'Tim profesional yang berdedikasi memberikan hasil terbaik.' }}</p>
                                    </div>
                                    <div class="member-advantages">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <img src="{{ asset('assets/media/vector/icon-1.png') }}" loading="lazy" alt="Experience" width="24" height="24">
                                                    <div class="d-flex align-items-center gap-1">
                                                        <h5 class="color-sec ms-3">{{ $member->experience_years ?? 0 }}+</h5>
                                                        <p class="white ms-1">Tahun Pengalaman</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($member->skills && count($member->skills) > 0)
                                                <div class="col-lg-12 mt-16">
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach(array_slice($member->skills, 0, 3) as $skill)
                                                            <span class="badge bg-secondary">{{ $skill }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5">
                                @if($member->getFirstMediaUrl('photo'))
                                    <img src="{{ $member->getFirstMediaUrl('photo') }}" loading="lazy" alt="{{ $member->name }}" class="member-image" width="400" height="320">
                                @else
                                    <img src="{{ asset('assets/media/team/abdul-malik.png') }}" loading="lazy" alt="{{ $member->name }}" class="member-image" width="400" height="320">
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Fallback to default if no team members in database --}}
                    <div class="team-block">
                        <div class="row">
                            <div class="col-lg-6 col-md-7">
                                <div class="detail-box">
                                    <div class="text-box">
                                        <h4 class="white mb-8">Tim Profesional</h4>
                                        <p class="fw-500 color-sec mb-32">Kami siap membantu Anda</p>
                                        <p class="medium-gray">Tim profesional yang berdedikasi memberikan hasil terbaik untuk bisnis Anda.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5">
                                <img src="{{ asset('assets/media/team/abdul-malik.png') }}" loading="lazy" alt="Team" class="member-image" width="400" height="320">
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
    </div>
</section>

<section class="testimonials">
    <div class="blur">
        <div class="animate-2"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="heading text-center">
            <h2 class="white mb-16">Apa Kata Klien Kami?</h2>
            <p class="medium-gray mb-32">Kepuasan klien adalah prioritas utama kami.</p>
        </div>
        <div class="testimonials-wrapper">
            <div class="testimonials-slider sliders" data-parent="testimonials">
                
                @forelse($testimonials as $testimonial)
                    <div class="testimonial-block">
                        <div class="block-wrapper">
                            <div class="text-box">
                                <img src="{{ asset('assets/media/vector/qoutes.png') }}" loading="lazy" alt="" class="qoutes-image m-auto" width="60" height="60">
                                
                                {{-- Rating Stars --}}
                                @if($testimonial->rating)
                                    <div class="d-flex justify-content-center gap-1 mb-24">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'color-primary' : 'medium-gray' }}" style="font-size: 16px;"></i>
                                        @endfor
                                    </div>
                                @endif
                                
                                <h4 class="white mt-24 mb-48">"{{ $testimonial->testimonial }}"</h4>
                                
                                <div class="d-flex align-items-center justify-content-center gap-3 mb-16">
                                    @if($testimonial->getFirstMediaUrl('client_logo'))
                                        <img src="{{ $testimonial->getFirstMediaUrl('client_logo') }}" loading="lazy" alt="{{ $testimonial->client_company ?? 'Company Logo' }}" class="company-logo" style="width: 60px; height: 60px; object-fit: contain; border-radius: 8px; background: rgba(255,255,255,0.1); padding: 8px;">
                                    @endif
                                    
                                    @if($testimonial->getFirstMediaUrl('client_photo'))
                                        <img src="{{ $testimonial->getFirstMediaUrl('client_photo') }}" loading="lazy" alt="{{ $testimonial->client_name }}" class="user-image">
                                    @else
                                        <img src="{{ asset('assets/media/user/user-1.png') }}" loading="lazy" alt="{{ $testimonial->client_name }}" class="user-image" width="80" height="80">
                                    @endif
                                </div>
                                
                                <div class="text-center">
                                    <p class="medium-gray fw-500 mb-2">
                                        {{ $testimonial->client_name }}
                                        @if($testimonial->is_verified)
                                            <i class="fas fa-check-circle color-primary" title="Verified" style="font-size: 14px;"></i>
                                        @endif
                                    </p>
                                    @if($testimonial->client_position)
                                        <p class="medium-gray small mb-2">{{ $testimonial->client_position }}</p>
                                    @endif
                                    @if($testimonial->client_company)
                                        <p class="medium-gray fw-600 mb-2">{{ $testimonial->client_company }}</p>
                                    @endif
                                    @if($testimonial->company_industry)
                                        <p class="medium-gray small mb-0">{{ $testimonial->company_industry }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Default testimonials -->
                    <div class="testimonial-block">
                        <div class="block-wrapper">
                            <div class="text-box">
                                <img src="{{ asset('assets/media/vector/qoutes.png') }}" loading="lazy" alt="" class="qoutes-image m-auto" width="60" height="60">
                                <h4 class="white mt-48 mb-48">"Pelayanan sangat profesional. Website sangat cepat."</h4>
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <img src="{{ asset('assets/media/user/user-1.png') }}" loading="lazy" alt="User" class="user-image">
                                    <p class="medium-gray fw-500">Budi Santoso</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="slider-arrows">
                <button type="button" class="arrow-btn btn-next" data-slide="testimonials-slider"></button>
                <button type="button" class="arrow-btn btn-prev" data-slide="testimonials-slider"></button>
            </div>
        </div>
    </div>
</section>

<section class="contact-us">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="heading text-center">
            <h2 class="white mb-16">Let's Connect and <br> Talk More.</h2>
            <p class="medium-gray mb-32">Hubungi kami untuk konsultasi gratis mengenai kebutuhan IT Anda.</p>
        </div>
        
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="image-block" style="overflow: hidden; border-radius: 20px;">
                        <iframe
                            src="https://www.google.com/maps?q=-6.3776515,107.1246921&z=18&output=embed"
                            width="100%"
                            height="100%"
                            style="border:0; min-height: 400px;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
        
                        <div class="detail-box">
                            <p class="white mb-16">{{ \App\Models\Setting::get('contact.phone', '0851-5641-2702') }}</p>
                            <a href="mailto:{{ \App\Models\Setting::get('contact.email', 'sekawanputrapratama@gmail.com') }}" class="mb-16">{{ \App\Models\Setting::get('contact.email', 'sekawanputrapratama@gmail.com') }}</a>
                            <p class="white">{{ \App\Models\Setting::get('contact.address', 'Sekawan Office - Bekasi, Jawa Barat') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="text-block">
                        @if(session('success'))
                            <div class="alert alert-success mb-4" style="background: #10b981; color: white; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-24">
                                        <label for="fullName" class="mb-8">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" id="fullName" placeholder="Nama Anda" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-24">
                                        <label for="eMail" class="mb-8">Email</label>
                                        <input type="email" class="form-control" name="email" id="eMail" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-24">
                                        <label for="phoneNumber" class="mb-8">No. Telepon</label>
                                        <input type="text" class="form-control" name="phone" id="phoneNumber" placeholder="+62..." value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-24">
                                        <label for="selectProj" class="mb-8">Layanan</label>
                                        <select name="service_type" class="has-nice-select form-control" id="selectProj">
                                            <option value="wd">Web Development</option>
                                            <option value="ad">App Development</option>
                                            <option value="os">Office Server</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="mb-24">
                                        <label for="comments" class="mb-8">Deskripsi Proyek</label>
                                        <textarea name="message" class="form-control" id="comments" cols="30" rows="10" placeholder="Ceritakan kebutuhan Anda..." required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="submit" class="cus-btn">
                                            <span>Kirim Pesan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Get Started CTA Section --}}
<section class="get-started">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-2"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="text-center">
            <h2 class="white mb-16">Siap Memulai Proyek Anda?</h2>
            <p class="medium-gray mb-32">
                Mari berdiskusi tentang kebutuhan IT bisnis Anda dan temukan solusi yang tepat. <br>
                Konsultasi gratis untuk membantu Anda mencapai tujuan digital.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a class="cus-btn" href="{{ route('contact') }}">
                    <span>Hubungi Kami</span>
                </a>
                <a class="cus-btn-2" href="{{ route('services.index') }}">
                    <span>Lihat Layanan</span>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .team-slider .slick-track { display: flex !important; align-items: stretch; }
    .team-slider .slick-slide { height: auto !important; display: flex !important; justify-content: center; padding: 0 10px; }
    .member-image { width: 100%; height: 320px !important; object-fit: cover; object-position: top center; border-radius: 16px; }
    
    .trust-indicator, .trust-badge {
        padding: 30px;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: transform 0.3s ease, background 0.3s ease;
    }
    
    .trust-indicator:hover, .trust-badge:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.05);
    }
    
    .get-started {
        padding: 100px 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.03) 0%, rgba(255,255,255,0.01) 100%);
    }
    
    .social-link {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .social-link:hover {
        background: var(--color-primary);
        transform: translateY(-3px);
        color: #fff;
    }
    
    .footer-links a {
        transition: color 0.3s ease;
        text-decoration: none;
    }
    
    .footer-links a:hover {
        color: var(--color-primary) !important;
    }
</style>
@endsection

