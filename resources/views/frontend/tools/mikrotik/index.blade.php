@extends('frontend.layouts.app')

@section('title', 'Generator Script MikroTik & ISP - PT Sekawan Putra Pratama')
@section('meta_description', 'Kumpulan tools generator script MikroTik & ISP gratis: Load Balance ECMP, NTH, PCC, dan Failover Recursive Gateway untuk RouterOS v6 dan v7.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'MikroTik Tools', 'url' => route('tools.mikrotik.index')],
]])

@section('content')

{{-- HERO HEADER (Clean White Corporate Theme) --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 55px !important;">
  <div class="container text-center position-relative z-2">
    <div class="text-uppercase fw-bold text-primary small mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
      • OTOMATISASI KONFIGURASI JARINGAN MIKROTIK
    </div>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Script Generator <span class="text-primary">MikroTik &amp; Multi-WAN ISP</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      Hasil racikan script RouterOS v6 &amp; v7 otomatis untuk optimasi Multi-ISP. Siap salin dan pakai langsung di Winbox Terminal tanpa risiko kesalahan sintaks.
    </p>
  </div>
</section>

{{-- MAIN TOOLS GRID --}}
<section class="py-5 bg-light position-relative">
  <div class="container py-4">
    <div class="row g-4 justify-content-center">
      
      {{-- Tool Card 1: ECMP --}}
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm h-100 p-3 p-md-4 transition-all hover-translate-y bg-white">
          <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
            <i class="fas fa-random fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Load Balance ECMP</h5>
          <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
            Metode Equal Cost Multi Path untuk pembagian lalu lintas secara otomatis ke banyak gateway ISP secara seimbang.
          </p>
          <a href="{{ route('tools.mikrotik.ecmp') }}" class="btn btn-outline-primary rounded-pill w-100 fw-bold small">
            Buka Generator <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      {{-- Tool Card 2: NTH --}}
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm h-100 p-3 p-md-4 transition-all hover-translate-y bg-white">
          <div class="rounded-circle bg-info bg-opacity-10 text-info p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
            <i class="fas fa-exchange-alt fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Load Balance NTH</h5>
          <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
            Pengaturan urutan paket (Round-Robin Every-Packet) untuk mengoptimalkan pembagian bandwidth hingga 10 ISP.
          </p>
          <a href="{{ route('tools.mikrotik.nth') }}" class="btn btn-outline-info rounded-pill w-100 fw-bold small">
            Buka Generator <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      {{-- Tool Card 3: PCC --}}
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm h-100 p-3 p-md-4 transition-all hover-translate-y bg-white">
          <div class="rounded-circle bg-success bg-opacity-10 text-success p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
            <i class="fas fa-project-diagram fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Load Balance PCC</h5>
          <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
            Per Connection Classifier untuk menjaga stabilitas sesi transaksi bank, E-Commerce, dan game online tanpa putus IP.
          </p>
          <a href="{{ route('tools.mikrotik.pcc') }}" class="btn btn-outline-success rounded-pill w-100 fw-bold small">
            Buka Generator <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      {{-- Tool Card 4: Failover Recursive --}}
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 rounded-4 shadow-sm h-100 p-3 p-md-4 transition-all hover-translate-y bg-white">
          <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
            <i class="fas fa-shield-alt fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Failover Recursive</h5>
          <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
            Sistem pengalihan gateway cadangan secara otomatis menggunakan pemeriksaan ping DNS publik (Google/Cloudflare).
          </p>
          <a href="{{ route('tools.mikrotik.failover') }}" class="btn btn-outline-warning text-dark rounded-pill w-100 fw-bold small">
            Buka Generator <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

    </div>

    {{-- LEAD GEN BANNER FOR ENTERPRISE SERVICES --}}
    <div class="mt-5 row justify-content-center">
      <div class="col-lg-10">
        <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm text-start position-relative overflow-hidden" style="border-color: #e2e8f0 !important; border-left: 5px solid #2563eb !important;">
          <div class="row align-items-center g-3">
            <div class="col-lg-8">
              <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 fw-bold small mb-2" style="font-size: 11px;">ENTERPRISE NETWORK ENGINEERING</span>
              <h4 class="fw-bold text-dark mb-2">Butuh Implementasi Jaringan Enterprise &amp; Managed Multi-WAN?</h4>
              <p class="text-muted small mb-0" style="line-height: 1.7; font-size: 0.95rem;">
                Tim Senior Network Architect PT Sekawan Putra Pratama melayani perancangan topology data center, konfigurasi Mikrotik/Cisco/Fortinet enterprise, VPN Inter-branch, dan SLA Uptime 99.9% untuk bisnis Anda.
              </p>
            </div>
            <div class="col-lg-4 text-lg-end">
              <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                <i class="fas fa-comments me-2"></i> Konsultasi Engineer
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

@endsection
