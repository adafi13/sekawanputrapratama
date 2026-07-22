@extends('frontend.layouts.app')

@section('title', 'Karir & Kesempatan Bergabung - PT Sekawan Putra Pratama')
@section('meta_description', 'Bergabunglah bersama tim developer & IT consultant PT Sekawan Putra Pratama. Temukan lowongan kerja Fullstack, Mobile App, UI/UX, dan DevOps Engineer!')

@push('styles')
<style>
    .careers-hero {
        background: radial-gradient(circle at 50% 0%, #1e293b 0%, #0f172a 60%, #020617 100%);
        position: relative;
        overflow: hidden;
        padding-top: 145px; /* Offset for fixed navbar header */
        padding-bottom: 60px;
    }
    .careers-hero::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.15) 0%, transparent 40%),
                    radial-gradient(circle at 20% 80%, rgba(14, 165, 233, 0.12) 0%, transparent 40%);
        pointer-events: none;
    }
    @media (max-width: 768px) {
        .careers-hero {
            padding-top: 125px !important;
            padding-bottom: 35px !important;
        }
        .careers-hero-badge {
            font-size: 0.75rem !important;
            padding: 6px 14px !important;
            margin-bottom: 10px !important;
        }
        .careers-hero-title {
            font-size: 1.65rem !important;
            line-height: 1.3 !important;
            letter-spacing: -0.5px !important;
            margin-bottom: 10px !important;
        }
        .careers-hero-desc {
            font-size: 0.925rem !important;
            line-height: 1.5 !important;
            padding: 0 10px !important;
            margin-bottom: 0 !important;
        }
    }
    .job-card {
        border: 2px solid #e2e8f0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .job-card:hover {
        transform: translateY(-5px);
        border-color: #3b82f6;
        box-shadow: 0 15px 30px -10px rgba(59, 130, 246, 0.15);
    }
</style>
@endpush

@section('content')

{{-- HERO SECTION --}}
<section class="careers-hero text-white">
    <div class="container text-center position-relative" style="z-index: 2;">
        <span class="badge bg-primary bg-opacity-25 text-info border border-info border-opacity-30 rounded-pill px-4 py-2 mb-3 fs-6 careers-hero-badge">
            <i class="fas fa-briefcase me-2"></i> Careers & Talent Recruitment
        </span>
        <h1 class="display-4 fw-black text-white mb-3 careers-hero-title" style="letter-spacing: -1px;">
            Tumbuh & Berkembang Bersama Tim Sekawan
        </h1>
        <p class="lead text-white-50 mx-auto careers-hero-desc" style="max-width: 720px; font-size: 1.15rem;">
            Kami percaya bahwa inovasi besar lahir dari kolaborasi tim yang solid, kreatif, dan berdedikasi tinggi dalam menciptakan solusi teknologi berkualitas.
        </p>
    </div>
</section>

{{-- CULTURE & BENEFITS --}}
<section class="py-5 bg-white">
    <div class="container py-3">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-2 rounded-pill mb-2">Mengapa Bergabung Dengan Kami?</span>
            <h2 class="fw-bold text-dark fs-2">Budaya Kerja & Fasilitas Tim</h2>
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
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Posisi Terbuka Saat Ini</h3>
                <p class="text-muted small mb-0">Temukan posisi yang sesuai dengan keahlian dan passion Anda.</p>
            </div>
            <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold">{{ count($jobs) }} Posisi Aktif</span>
        </div>

        <div class="row g-4">
            @forelse($jobs as $job)
                <div class="col-lg-6">
                    <div class="job-card bg-white p-4 p-md-5 rounded-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-2 rounded-pill">{{ $job->department }}</span>
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $job->type }}</span>
                            </div>

                            <h4 class="fw-bold text-dark mb-2 fs-5">{{ $job->title }}</h4>
                            <p class="text-muted small mb-4">{{ $job->description }}</p>

                            <div class="d-flex flex-wrap gap-3 small text-muted mb-4 pt-3 border-top">
                                <span><i class="fas fa-map-marker-alt text-primary me-1"></i> {{ $job->location }}</span>
                                <span><i class="fas fa-user-clock text-primary me-1"></i> {{ $job->experience }}</span>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('careers.show', $job->slug) }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                                Detail & Lamar Posisi <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="bg-white p-5 rounded-4 border text-center">
                        <i class="fas fa-briefcase text-muted fs-1 mb-3"></i>
                        <h5 class="fw-bold text-dark mb-1">Belum Ada Lowongan Aktif</h5>
                        <p class="text-muted small mb-0">Saat ini belum ada posisi lowongan kerja baru yang dibuka. Silakan cek kembali dalam waktu dekat.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
