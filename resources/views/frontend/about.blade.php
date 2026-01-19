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
                    
                    @php
                        $statsSettings = \App\Models\Setting::getGroup('stats');
                    @endphp
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="counter-block mb-24">
                                <h2 class="counter-number color-primary mb-8">{{ $statsSettings['stats.projects_completed'] ?? '50+' }}</h2>
                                <p class="white">Proyek Selesai</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="counter-block mb-24">
                                <h2 class="counter-number color-primary mb-8">{{ $statsSettings['stats.happy_clients'] ?? '20+' }}</h2>
                                <p class="white">Klien Puas</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="counter-block mb-24">
                                <h2 class="counter-number color-primary mb-8">{{ $statsSettings['stats.years_experience'] ?? '5+' }}</h2>
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
                @forelse(isset($teamMembers) ? $teamMembers : [] as $member)
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
                    {{-- Fallback jika tidak ada team members --}}
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
    </div>
</section>

<style>
    .team-slider .slick-track { display: flex !important; align-items: stretch; }
    .team-slider .slick-slide { height: auto !important; display: flex !important; justify-content: center; padding: 0 10px; }
    .member-image { width: 100%; height: 320px !important; object-fit: cover; object-position: top center; border-radius: 16px; }
</style>
@endsection


