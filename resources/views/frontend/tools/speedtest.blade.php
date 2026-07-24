@extends('frontend.layouts.app')

@section('title', 'SpeedTest Internet - Uji Kecepatan & Latensi Jaringan - PT Sekawan Putra Pratama')
@section('meta_description', 'Uji kecepatan download, upload, ping, dan jitter koneksi internet Anda secara real-time dengan tool SpeedTest gratis dari PT Sekawan Putra Pratama.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'SpeedTest Internet', 'url' => route('tools.speedtest')],
]])

@section('content')

{{-- HERO HEADER (Clean Light Corporate Theme) --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 65px !important;">
  <div class="container text-center position-relative z-2">
    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
      <i class="fas fa-tachometer-alt me-2"></i> UTILITAS JARINGAN REAL-TIME
    </span>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Uji Kecepatan &amp; Latensi <span class="text-primary">Koneksi Internet</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 680px; font-size: 1.05rem;">
      Uji performa jaringan Anda secara langsung. Mengukur throughput Download, Upload, Ping, dan Jitter secara presisi dari peramban Anda.
    </p>
  </div>
</section>

{{-- MAIN SPEEDTEST TOOL --}}
<section class="py-5 bg-light position-relative">
  <div class="container py-4">
    <div class="row g-4 justify-content-center">
      
      <div class="col-lg-10">
        <div class="p-3 p-md-4 rounded-4 bg-white border shadow-sm text-center" style="border-color: #e2e8f0 !important;">
          
          {{-- OpenSpeedTest HTML5 Engine Embed --}}
          <div class="position-relative overflow-hidden rounded-3 shadow-inner bg-dark mb-4" style="min-height: 580px;">
            <iframe 
              src="https://openspeedtest.com/Get-widget.php" 
              style="width: 100%; height: 580px; border: none; overflow: hidden; display: block;" 
              allowfullscreen
              title="OpenSpeedTest Engine">
            </iframe>
          </div>

          {{-- Technical Specs Footer --}}
          <div class="row g-3 text-start pt-3 border-top" style="border-color: #f1f5f9 !important;">
            <div class="col-md-4">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted text-uppercase font-monospace fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">ENGINE</span>
                <span class="fw-bold text-dark font-monospace" style="font-size: 13px;">
                  <i class="fas fa-microchip text-primary me-1"></i> OpenSpeedTest™ HTML5
                </span>
              </div>
            </div>

            <div class="col-md-4">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted text-uppercase font-monospace fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">PROTOCOL</span>
                <span class="fw-bold text-dark font-monospace" style="font-size: 13px;">
                  <i class="fas fa-lock text-success me-1"></i> HTTPS Secure (TLS 1.3)
                </span>
              </div>
            </div>

            <div class="col-md-4">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted text-uppercase font-monospace fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">LOCATION NODE</span>
                <span class="fw-bold text-dark font-monospace" style="font-size: 13px;">
                  <i class="fas fa-server text-info me-1"></i> Jakarta / Bekasi Node (ID)
                </span>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
@endsection
