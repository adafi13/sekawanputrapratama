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
        
        {{-- Enterprise Network Console Wrapper --}}
        <div class="rounded-4 overflow-hidden shadow-lg border-0" style="background-color: #0f172a !important;">
          
          {{-- Console Header Bar --}}
          <div class="px-4 py-3 border-bottom border-secondary border-opacity-25 d-flex flex-wrap align-items-center justify-content-between gap-2" style="background: rgba(15, 23, 42, 0.95);">
            <div class="d-flex align-items-center gap-2">
              <span class="rounded-circle d-inline-block" style="width: 12px; height: 12px; background-color: #ef4444;"></span>
              <span class="rounded-circle d-inline-block" style="width: 12px; height: 12px; background-color: #f59e0b;"></span>
              <span class="rounded-circle d-inline-block" style="width: 12px; height: 12px; background-color: #10b981;"></span>
              <span class="ms-2 font-monospace fw-bold text-white small" style="letter-spacing: 0.5px; font-size: 12px;">
                <i class="fas fa-terminal text-primary me-1"></i> SEKAWAN NETWORK CONSOLE v2.4
              </span>
            </div>

            <div class="d-flex align-items-center gap-2">
              <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-1 font-monospace small" style="font-size: 11px;">
                <i class="fas fa-circle me-1 animate-pulse" style="font-size: 8px;"></i> LIVE ENGINE
              </span>
            </div>
          </div>

          {{-- OpenSpeedTest HTML5 Engine Embed --}}
          <div class="position-relative overflow-hidden" style="min-height: 540px; background-color: #1e222d;">
            <iframe 
              src="https://openspeedtest.com/Get-widget.php" 
              style="width: 100%; height: 540px; border: none; overflow: hidden; display: block;" 
              allowfullscreen
              title="OpenSpeedTest Engine">
            </iframe>
          </div>

          {{-- Technical Specs & Client ISP Footer Bar --}}
          <div class="p-3 p-md-4 border-top border-secondary border-opacity-25" style="background-color: #0b1120;">
            <div class="row g-3 text-start">
              
              <div class="col-12 col-md-6 col-lg-3">
                <div class="p-3 rounded-3 border" style="background-color: #161f36; border-color: rgba(255,255,255,0.08) !important;">
                  <span class="d-block text-muted text-uppercase font-monospace fw-bold mb-1" style="font-size: 10px; letter-spacing: 0.5px;">PENYEDIA JARINGAN / CLIENT IP</span>
                  <span id="client-isp-info" class="fw-bold text-white font-monospace d-block text-truncate" style="font-size: 12px;">
                    <span class="spinner-border spinner-border-sm me-1 text-primary" role="status"></span> Mendeteksi ISP &amp; IP...
                  </span>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-3">
                <div class="p-3 rounded-3 border" style="background-color: #161f36; border-color: rgba(255,255,255,0.08) !important;">
                  <span class="d-block text-muted text-uppercase font-monospace fw-bold mb-1" style="font-size: 10px; letter-spacing: 0.5px;">ENGINE</span>
                  <span class="fw-bold text-white font-monospace d-block" style="font-size: 12px;">
                    <i class="fas fa-microchip text-primary me-1"></i> OpenSpeedTest™ HTML5
                  </span>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-3">
                <div class="p-3 rounded-3 border" style="background-color: #161f36; border-color: rgba(255,255,255,0.08) !important;">
                  <span class="d-block text-muted text-uppercase font-monospace fw-bold mb-1" style="font-size: 10px; letter-spacing: 0.5px;">PROTOCOL</span>
                  <span class="fw-bold text-white font-monospace d-block" style="font-size: 12px;">
                    <i class="fas fa-lock text-success me-1"></i> HTTPS Secure (TLS 1.3)
                  </span>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-3">
                <div class="p-3 rounded-3 border" style="background-color: #161f36; border-color: rgba(255,255,255,0.08) !important;">
                  <span class="d-block text-muted text-uppercase font-monospace fw-bold mb-1" style="font-size: 10px; letter-spacing: 0.5px;">LOCATION NODE</span>
                  <span class="fw-bold text-white font-monospace d-block" style="font-size: 12px;">
                    <i class="fas fa-server text-info me-1"></i> Jakarta / Bekasi Node (ID)
                  </span>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</section>

@push('scripts')
<script>
  // Detect Real-time Client ISP & IP
  fetch('https://ipwho.is/')
    .then(res => res.json())
    .then(data => {
      if (data && data.ip) {
        let isp = data.connection && data.connection.isp ? data.connection.isp : (data.org || 'Penyedia Jaringan Utama');
        document.getElementById('client-isp-info').innerHTML = '<i class="fas fa-network-wired text-primary me-1"></i> <strong class="text-primary">' + isp + '</strong> <span class="text-muted">(' + data.ip + ')</span>';
      } else {
        fallbackIp();
      }
    })
    .catch(() => {
      fallbackIp();
    });

  function fallbackIp() {
    fetch('https://api.ipify.org?format=json')
      .then(res => res.json())
      .then(data => {
        document.getElementById('client-isp-info').innerHTML = '<i class="fas fa-network-wired text-primary me-1"></i> <span class="text-primary font-monospace">' + data.ip + '</span>';
      })
      .catch(() => {
        document.getElementById('client-isp-info').innerHTML = '<i class="fas fa-globe text-muted me-1"></i> Terhubung (Public Network)';
      });
  }
</script>
@endpush

@endsection
