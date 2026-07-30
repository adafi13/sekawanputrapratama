@extends('frontend.layouts.app')

@section('title', 'Generator Script MikroTik RouterOS & Networking Tools Gratis - PT Sekawan Putra Pratama')
@section('meta_description', 'Kumpulan tools MikroTik gratis: Load Balance ECMP, NTH, PCC, Failover, Simple Queue, Hotspot Generator, dan Subnet Calculator. Salin langsung ke Winbox Terminal.')
@section('meta_keywords', 'generator script mikrotik, load balance mikrotik, simple queue mikrotik, hotspot mikrotik, subnet calculator, script ecmp mikrotik, script pcc mikrotik, failover mikrotik, routeros v7, multi wan mikrotik indonesia')
@section('og_title', 'Generator Script MikroTik & Networking Tools Gratis - PT Sekawan Putra Pratama')
@section('og_description', 'Tools MikroTik gratis: Load Balance ECMP/NTH/PCC, Failover, Simple Queue, Hotspot Generator, Subnet Calculator. Akurat, siap pakai langsung di Winbox.')

@push('head')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Generator Script MikroTik RouterOS & Networking Tools",
  "description": "Kumpulan tool generator script MikroTik gratis untuk Load Balance ECMP, NTH, PCC, Failover, Simple Queue, Hotspot, dan Subnet Calculator.",
  "url": "{{ route('tools.mikrotik.index') }}",
  "publisher": {
    "@type": "Organization",
    "name": "PT Sekawan Putra Pratama",
    "url": "{{ route('home') }}"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
      {"@type":"ListItem","position":2,"name":"Tools","item":"{{ route('tools.speedtest') }}"},
      {"@type":"ListItem","position":3,"name":"MikroTik & Networking Tools","item":"{{ route('tools.mikrotik.index') }}"}
    ]
  }
}
</script>
@endpush

@section('content')

{{-- HERO HEADER (Clean White Corporate Theme) --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 55px !important;">
  <div class="container text-center position-relative z-2">
    <div class="text-uppercase fw-bold text-primary small mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
      • OTOMATISASI KONFIGURASI JARINGAN MIKROTIK
    </div>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Script Generator <span class="text-primary">MikroTik & Networking Tools</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      7 tools gratis untuk network engineer Indonesia. Script RouterOS v6 & v7 otomatis, siap salin dan pakai langsung di Winbox Terminal tanpa risiko kesalahan sintaks.
    </p>
  </div>
</section>

{{-- MAIN TOOLS GRID --}}
<section class="py-5 bg-light position-relative">
  <div class="container py-4">

    {{-- Section: Load Balance & Failover --}}
    <div class="mb-3">
      <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold mb-3 d-inline-block" style="font-size: 12px;">
        <i class="fas fa-random me-1"></i> LOAD BALANCE & FAILOVER
      </span>
    </div>
    <div class="row g-4 mb-5">
      
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

    {{-- Section: Management & Utilities --}}
    <div class="mb-3">
      <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold mb-3 d-inline-block" style="font-size: 12px;">
        <i class="fas fa-tools me-1"></i> MANAJEMEN & UTILITAS
      </span>
    </div>
    <div class="row g-4 mb-5">

      {{-- Tool Card 5: Simple Queue --}}
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm h-100 p-3 p-md-4 transition-all hover-translate-y bg-white">
          <div class="rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; background: rgba(99,102,241,0.1); color: #6366f1;">
            <i class="fas fa-tachometer-alt fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Simple Queue Generator</h5>
          <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
            Buat script limit bandwidth per user, per IP, atau massal (bulk) dengan support Burst Limit. Cocok untuk ISP, RT-RW Net, dan hotspot.
          </p>
          <a href="{{ route('tools.mikrotik.simple-queue') }}" class="btn rounded-pill w-100 fw-bold small" style="border: 2px solid #6366f1; color: #6366f1;">
            Buka Generator <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      {{-- Tool Card 6: Hotspot --}}
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm h-100 p-3 p-md-4 transition-all hover-translate-y bg-white">
          <div class="rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; background: rgba(236,72,153,0.1); color: #ec4899;">
            <i class="fas fa-wifi fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Hotspot Generator</h5>
          <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
            Generate script User Profile, User/Voucher massal, dan Server Profile untuk Hotspot MikroTik. Ideal untuk warnet, hotel, dan RT-RW Net.
          </p>
          <a href="{{ route('tools.mikrotik.hotspot') }}" class="btn rounded-pill w-100 fw-bold small" style="border: 2px solid #ec4899; color: #ec4899;">
            Buka Generator <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      {{-- Tool Card 7: Subnet Calculator --}}
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm h-100 p-3 p-md-4 transition-all hover-translate-y bg-white">
          <div class="rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; background: rgba(20,184,166,0.1); color: #14b8a6;">
            <i class="fas fa-network-wired fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Subnet Calculator</h5>
          <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
            Hitung Network Address, Broadcast, Range Host, Total Host, Wildcard, dan Class IP dari notasi CIDR secara instan.
          </p>
          <a href="{{ route('tools.mikrotik.subnet-calculator') }}" class="btn rounded-pill w-100 fw-bold small" style="border: 2px solid #14b8a6; color: #14b8a6;">
            Buka Calculator <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

    </div>

    {{-- LEAD GEN BANNER FOR ENTERPRISE SERVICES --}}
    <div class="row justify-content-center">
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

