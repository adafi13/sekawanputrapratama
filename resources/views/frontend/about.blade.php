@extends('frontend.layouts.app')

@section('title', 'Tentang Kami - Sekawan Putra Pratama')

@section('content')
<section class="banner-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-inner-block text-center">
                    <h1 class="banner-inner-title h-91 color-sec">Tentang Kami</h1>
                    <p class="banner-text medium-gray">
                        Mengenal lebih dekat siapa kami, visi kami, dan dedikasi kami dalam dunia teknologi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about">
    <div class="blur">
        <div class="animate-1"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="image-block">
                    <img src="{{ asset('assets/media/images/about-cover.png') }}" alt="Tentang Sekawan" class="about-image-main">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-block">
                    <h2 class="white mb-16">Mitra Teknologi <br> Terpercaya Anda</h2>
                    <p class="medium-gray mb-24">
                        <strong>Sekawan Putra Pratama</strong> adalah tim konsultan IT dan pengembang perangkat lunak yang berfokus pada solusi digital terintegrasi.
                    </p>
                    <p class="medium-gray mb-48">
                        Kami tidak hanya membuat kode, tetapi kami membangun solusi. Mulai dari perancangan sistem backend yang kompleks, instalasi server kantor yang aman, hingga antarmuka aplikasi yang memanjakan pengguna.
                    </p>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="counter-block mb-24">
                                <h2 class="counter-number color-primary mb-8">50+</h2>
                                <p class="white">Proyek Selesai</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="counter-block mb-24">
                                <h2 class="counter-number color-primary mb-8">20+</h2>
                                <p class="white">Klien Puas</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="counter-block mb-24">
                                <h2 class="counter-number color-primary mb-8">5+</h2>
                                <p class="white">Tahun Pengalaman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team mb-100">
    <div class="container-fluid">
        <div class="heading text-center">
            <h2 class="white mb-16">Tim Inti Kami</h2>
            <p class="medium-gray mb-32">Orang-orang di balik layar yang mewujudkan ide Anda.</p>
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
                <!-- Default team members jika belum ada data -->
                <div class="team-block">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <div class="detail-box">
                                <div class="text-box">
                                    <h4 class="white mb-8">Abdul Malik Ibrahim</h4>
                                    <p class="fw-500 color-sec mb-32">App Developer</p>
                                    <p class="medium-gray">Seorang App Developer berpengalaman dalam membangun aplikasi mobile dan desktop modern.</p>
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
    </div>
</section>

<style>
    .team-slider .slick-track { display: flex !important; align-items: stretch; }
    .team-slider .slick-slide { height: auto !important; display: flex !important; justify-content: center; padding: 0 10px; }
    .member-image { width: 100%; height: 320px !important; object-fit: cover; object-position: top center; border-radius: 16px; }
</style>
@endsection

