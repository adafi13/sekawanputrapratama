@extends('frontend.layouts.app')

@section('title', 'Sekawan Putra Pratama - IT Consultant & Software House')

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

<div class="brands">
    <div class="brand-slider">
        @for($i = 1; $i <= 6; $i++)
            <div class="brand-slide">
                <div class="brand-block">
                    <img src="{{ asset('assets/media/brands/brand-' . $i . '.png') }}" alt="Brand {{ $i }}">
                </div>
            </div>
        @endfor
    </div>
</div>

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
            
            @php
                $categories = \App\Models\PortfolioCategory::orderBy('order')->get();
                $featuredPortfolios = \App\Models\Portfolio::where('is_featured', true)->orderBy('order')->limit(4)->get();
            @endphp
            
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
                                    @if($portfolio->getFirstMediaUrl('featured_image'))
                                        <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image">
                                    @else
                                        <img src="{{ asset('assets/media/images/tab-image-' . (($loop->index % 4) + 1) . '.png') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image">
                                    @endif
                                </div>
                            @empty
                                @for($i = 1; $i <= 4; $i++)
                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <img src="{{ asset('assets/media/images/tab-image-' . $i . '.png') }}" loading="lazy" alt="Project {{ $i }}" class="tab-image">
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
                                @php
                                    $categoryPortfolios = \App\Models\Portfolio::where('category_id', $category->id)->limit(1)->get();
                                @endphp
                                @foreach($categoryPortfolios as $portfolio)
                                    <div class="col-xl-6 col-lg-6 col-6">
                                        @if($portfolio->getFirstMediaUrl('featured_image'))
                                            <img src="{{ $portfolio->getFirstMediaUrl('featured_image') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image">
                                        @else
                                            <img src="{{ asset('assets/media/images/tab-image-' . ($index + 1) . '.png') }}" loading="lazy" alt="{{ $portfolio->title }}" class="tab-image">
                                        @endif
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
            
            @php
                $services = \App\Models\Service::where('is_active', true)->orderBy('order')->limit(3)->get();
            @endphp
            
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
                                            <img src="{{ asset('assets/media/images/app-development.png') }}" loading="lazy" style="border-radius: 20px !important;" alt="{{ $service->title }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="service-text text-center">
                                <h2 class="white mb-16">{{ $service->title }}</h2>
                                <p class="medium-gray mb-32">{{ $service->description }}</p>
                                <a class="cus-btn m-auto" href="{{ route('services.index') }}">
                                    <span>Buat Aplikasi</span>
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
                                        <img src="{{ asset('assets/media/images/app-development.png') }}" loading="lazy" style="border-radius: 20px !important;" alt="App Dev">
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
                                <a class="cus-btn m-auto" href="{{ route('services.index') }}">
                                    <span>Buat Aplikasi</span>
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
        @php
            $teamMembers = \App\Models\TeamMember::where('is_active', true)->orderBy('order')->get();
        @endphp
        
        @forelse($teamMembers as $member)
            <div class="team-block">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="detail-box">
                            <div class="text-box">
                                <h4 class="white mb-8">{{ $member->name }}</h4>
                                <p class="fw-500 color-sec mb-32">{{ $member->position }}</p>
                                <p class="medium-gray">{{ $member->bio }}</p>
                            </div>
                            @if($member->years_experience)
                                <div class="member-advantages">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <img src="{{ asset('assets/media/vector/icon-1.png') }}" loading="lazy" alt="Experience">
                                                <div class="d-flex align-items-center gap-1">
                                                    <h5 class="color-sec ms-3">{{ $member->years_experience }}+</h5>
                                                    <p class="white ms-1">Tahun Pengalaman</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        @if($member->getFirstMediaUrl('photo'))
                            <img src="{{ $member->getFirstMediaUrl('photo') }}" loading="lazy" alt="{{ $member->name }}" class="member-image">
                        @else
                            <img src="{{ asset('assets/media/team/abdul-malik.png') }}" loading="lazy" alt="{{ $member->name }}" class="member-image">
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <!-- Default team members -->
            <div class="team-block">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="detail-box">
                            <div class="text-box">
                                <h4 class="white mb-8">Abdul Malik Ibrahim</h4>
                                <p class="fw-500 color-sec mb-32">App Developer</p>
                                <p class="medium-gray">Seorang App Developer berpengalaman dalam membangun aplikasi mobile dan desktop modern, responsif, dan berperforma tinggi.</p>
                            </div>
                            <div class="member-advantages">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <img src="{{ asset('assets/media/vector/icon-1.png') }}" loading="lazy" alt="Experience">
                                            <div class="d-flex align-items-center gap-1">
                                                <h5 class="color-sec ms-3">7+</h5>
                                                <p class="white ms-1">Tahun Pengalaman</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <img src="{{ asset('assets/media/team/abdul-malik.png') }}" loading="lazy" alt="Abdul Malik" class="member-image">
                    </div>
                </div>
            </div>
        @endforelse
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
                @php
                    $testimonials = \App\Models\Testimonial::where('is_featured', true)->orderBy('order')->get();
                @endphp
                
                @forelse($testimonials as $testimonial)
                    <div class="testimonial-block">
                        <div class="block-wrapper">
                            <div class="text-box">
                                <img src="{{ asset('assets/media/vector/qoutes.png') }}" loading="lazy" alt="" class="qoutes-image m-auto">
                                <h4 class="white mt-48 mb-48">"{{ $testimonial->testimonial }}"</h4>
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    @if($testimonial->getFirstMediaUrl('client_photo'))
                                        <img src="{{ $testimonial->getFirstMediaUrl('client_photo') }}" loading="lazy" alt="{{ $testimonial->client_name }}" class="user-image">
                                    @else
                                        <img src="{{ asset('assets/media/user/user-1.png') }}" loading="lazy" alt="{{ $testimonial->client_name }}" class="user-image">
                                    @endif
                                    <div>
                                        <p class="medium-gray fw-500 mb-0">{{ $testimonial->client_name }}</p>
                                        @if($testimonial->client_company)
                                            <p class="medium-gray small mb-0">{{ $testimonial->client_company }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Default testimonials -->
                    <div class="testimonial-block">
                        <div class="block-wrapper">
                            <div class="text-box">
                                <img src="{{ asset('assets/media/vector/qoutes.png') }}" loading="lazy" alt="" class="qoutes-image m-auto">
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
                            <p class="white mb-16">0851-5641-2702</p>
                            <a href="mailto:sekawanputrapratama@gmail.com" class="mb-16">sekawanputrapratama@gmail.com</a>
                            <p class="white">Sekawan Office - Bekasi, Jawa Barat</p>
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

<style>
    .team-slider .slick-track { display: flex !important; align-items: stretch; }
    .team-slider .slick-slide { height: auto !important; display: flex !important; justify-content: center; padding: 0 10px; }
    .member-image { width: 100%; height: 320px !important; object-fit: cover; object-position: top center; border-radius: 16px; }
</style>
@endsection

