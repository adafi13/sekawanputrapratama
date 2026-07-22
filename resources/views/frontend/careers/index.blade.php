@extends('frontend.layouts.app')

@section('title', 'Karir & Kesempatan Bergabung - PT Sekawan Putra Pratama')
@section('meta_description', 'Bergabunglah bersama tim developer & IT consultant PT Sekawan Putra Pratama. Temukan lowongan kerja Fullstack, Mobile App, UI/UX, dan DevOps Engineer!')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Karir', 'url' => route('careers.index')],
]])

@section('content')

{{-- HERO HEADER (Clean Light Corporate Theme) --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 65px !important;">
  <div class="container text-center position-relative z-2">
    <div class="d-inline-flex align-items-center gap-2 text-primary fw-bold text-uppercase mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
      <span class="d-inline-block bg-primary rounded-circle" style="width: 6px; height: 6px;"></span>
      REKRUTMEN &amp; TALENTA IT SEKAWAN
    </div>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Mari Bangun Masa Depan <span class="text-primary">Teknologi Bersama Kami</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      Bergabunglah bersama tim Software Engineer, System Architect, dan DevOps di PT Sekawan Putra Pratama untuk merancang solusi digital berkinerja tinggi.
    </p>
  </div>
</section>

{{-- CULTURE & BENEFITS --}}
<section class="py-5 bg-white">
  <div class="container py-3">
    <div class="text-center mb-5">
      <div class="d-inline-flex align-items-center gap-2 text-primary fw-bold text-uppercase mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
        <span class="d-inline-block bg-primary rounded-circle" style="width: 6px; height: 6px;"></span>
        KULTUR &amp; LINGKUNGAN KERJA
      </div>
      <h2 class="fw-bold text-dark fs-2">Budaya Kerja &amp; Fasilitas Tim</h2>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 rounded-4 bg-light border text-center h-100 transition-all shadow-sm" style="border-color: #e2e8f0 !important;">
          <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
            <i class="fas fa-laptop-house fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Fleksibilitas Kerja</h5>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Dukungan sistem kerja Hybrid &amp; Remote yang mengutamakan hasil (*result-oriented*) dan keseimbangan hidup.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded-4 bg-light border text-center h-100 transition-all shadow-sm" style="border-color: #e2e8f0 !important;">
          <div class="rounded-circle bg-info bg-opacity-10 text-info p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
            <i class="fas fa-rocket fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Proyek Teknologi Terbaru</h5>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Pengalaman menangani proyek dari berbagai industri dengan teknologi terkini (Laravel 11, Flutter, Cloud, AI).</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded-4 bg-light border text-center h-100 transition-all shadow-sm" style="border-color: #e2e8f0 !important;">
          <div class="rounded-circle bg-success bg-opacity-10 text-success p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
            <i class="fas fa-graduation-cap fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Pengembangan Skill</h5>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Dukungan pelatihan, sertifikasi IT profesional, dan bimbingan langsung dari tim senior consultant.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- OPEN POSITIONS --}}
<section class="py-5 bg-light border-top">
  <div class="container py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <div class="d-inline-flex align-items-center gap-2 text-primary fw-bold text-uppercase mb-1" style="letter-spacing: 1.5px; font-size: 11px;">
          <span class="d-inline-block bg-primary rounded-circle" style="width: 6px; height: 6px;"></span>
          POSISI TERBUKA SAAT INI
        </div>
        <h3 class="fw-bold text-dark mb-0 fs-3">Lowongan Karir Aktif</h3>
      </div>
      <span class="badge bg-primary text-white font-monospace px-3 py-2 fw-bold rounded-pill" style="font-size: 12px;">{{ count($jobs) }} POSISI AKTIF</span>
    </div>

    <div class="row g-4">
      @forelse($jobs as $job)
        <div class="col-lg-6">
          <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between" style="border-color: #e2e8f0 !important; transition: all 0.3s ease;">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-3">
                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-1.5 rounded-pill" style="font-size: 11px;">{{ $job->department }}</span>
                <span class="badge bg-light text-dark border px-3 py-1.5 rounded-pill" style="font-size: 11px;">{{ $job->type }}</span>
              </div>

              <h4 class="fw-bold text-dark mb-2 fs-5">{{ $job->title }}</h4>
              <p class="text-muted small mb-4" style="line-height: 1.6;">{{ $job->description }}</p>

              <div class="d-flex flex-wrap gap-3 small text-muted mb-4 pt-3 border-top" style="border-color: #f1f5f9 !important;">
                <span><i class="fas fa-map-marker-alt text-primary me-1"></i> {{ $job->location }}</span>
                <span><i class="fas fa-user-clock text-primary me-1"></i> {{ $job->experience }}</span>
              </div>
            </div>

            <div class="text-end">
              <a href="{{ route('careers.show', $job->slug) }}" class="btn btn-primary rounded-pill px-4 py-2.5 fw-bold shadow-sm" style="font-size: 13px;">
                Detail &amp; Lamar Posisi <i class="fas fa-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="bg-white p-5 rounded-4 border text-center shadow-sm" style="border-color: #e2e8f0 !important;">
            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-briefcase text-muted fs-3"></i>
            </div>
            <h5 class="fw-bold text-dark mb-1">Belum Ada Lowongan Aktif</h5>
            <p class="text-muted small mb-0">Saat ini belum ada posisi lowongan kerja baru yang dibuka. Silakan cek kembali secara berkala.</p>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>

@endsection
