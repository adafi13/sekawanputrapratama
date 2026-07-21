@extends('frontend.layouts.app')

@section('title', 'Karir & Kesempatan Bergabung - PT Sekawan Putra Pratama')
@section('meta_description', 'Bergabunglah bersama tim developer & IT consultant PT Sekawan Putra Pratama. Temukan lowongan kerja Fullstack, Mobile App, UI/UX, dan DevOps Engineer!')

@section('content')

{{-- HERO SECTION --}}
<section class="py-5 text-white" style="background: linear-gradient(135deg, #050b14 0%, #0f172a 100%);">
    <div class="container py-4 text-center">
        <span class="badge bg-primary bg-opacity-20 text-info border border-info border-opacity-30 rounded-pill px-3 py-2 mb-3">
            <i class="fas fa-briefcase me-1"></i> Careers & Talent Recruitment
        </span>
        <h1 class="display-4 fw-bold mb-3">Tumbuh & Berkembang Bersama Tim Sekawan</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 700px;">
            Kami percaya bahwa inovasi besar lahir dari kolaborasi tim yang solid, kreatif, dan berdedikasi tinggi dalam menciptakan solusi teknologi berkualitas.
        </p>
    </div>
</section>

{{-- CULTURE & BENEFITS --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase">Mengapa Bergabung Dengan Kami?</h6>
            <h2 class="fw-bold text-dark">Budaya Kerja & Fasilitas Tim</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light border text-center h-100 transition-all hover-shadow">
                    <div class="text-primary fs-1 mb-3"><i class="fas fa-laptop-house"></i></div>
                    <h5 class="fw-bold text-dark mb-2">Fleksibilitas Kerja</h5>
                    <p class="text-muted small mb-0">Dukungan sistem kerja Hybrid & Remote yang mengutamakan hasil (*result-oriented*) dan keseimbangan hidup.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light border text-center h-100 transition-all hover-shadow">
                    <div class="text-primary fs-1 mb-3"><i class="fas fa-rocket"></i></div>
                    <h5 class="fw-bold text-dark mb-2">Proyek Teknologi Terbaru</h5>
                    <p class="text-muted small mb-0">Pengalaman menangani proyek dari berbagai industri dengan teknologi terkini (Laravel 12, Flutter, Cloud, AI).</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light border text-center h-100 transition-all hover-shadow">
                    <div class="text-primary fs-1 mb-3"><i class="fas fa-graduation-cap"></i></div>
                    <h5 class="fw-bold text-dark mb-2">Pengembangan Skill</h5>
                    <p class="text-muted small mb-0">Dukungan pelatihan, sertifikasi IT profesional, dan bimbingan langsung dari tim senior consultant.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- OPEN POSITIONS --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Posisi Terbuka</h3>
                <p class="text-muted small mb-0">Temukan posisi yang sesuai dengan keahlian dan passion Anda.</p>
            </div>
            <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold">{{ count($jobs) }} Posisi Aktif</span>
        </div>

        <div class="row g-4">
            @foreach($jobs as $job)
                <div class="col-lg-6">
                    <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold">{{ $job['department'] }}</span>
                                <span class="badge bg-light text-dark border">{{ $job['type'] }}</span>
                            </div>

                            <h4 class="fw-bold text-dark mb-2">{{ $job['title'] }}</h4>
                            <p class="text-muted small mb-3">{{ $job['description'] }}</p>

                            <div class="d-flex flex-wrap gap-3 small text-muted mb-4">
                                <span><i class="fas fa-map-marker-alt text-primary me-1"></i> {{ $job['location'] }}</span>
                                <span><i class="fas fa-user-clock text-primary me-1"></i> Pengalaman: {{ $job['experience'] }}</span>
                            </div>
                        </div>

                        <div class="border-top pt-3 text-end">
                            <a href="{{ route('careers.show', $job['slug']) }}" class="btn btn-primary rounded-pill px-4 fw-bold">
                                Detail & Lamar Posisi <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
