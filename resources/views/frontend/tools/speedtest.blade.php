@extends('frontend.layouts.app')

@section('title', 'SpeedTest Internet - Uji Kecepatan & Latensi Jaringan - PT Sekawan Putra Pratama')
@section('meta_description', 'Uji kecepatan download, upload, ping, dan jitter koneksi internet Anda secara real-time dengan tool SpeedTest gratis dari PT Sekawan Putra Pratama.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'SpeedTest Internet', 'url' => route('tools.speedtest')],
]])

@section('content')

{{-- HERO HEADER (Clean White Corporate Theme) --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 55px !important;">
  <div class="container text-center position-relative z-2">
    <div class="text-uppercase fw-bold text-primary small mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
      • PENGUJI KECEPATAN JARINGAN REAL-TIME
    </div>
    
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
        
        {{-- Clean Corporate Card Wrapper --}}
        <div class="p-3 p-md-4 rounded-4 bg-white border shadow-sm text-center" style="border-color: #e2e8f0 !important;">
          
          {{-- OpenSpeedTest HTML5 Engine Embed --}}
          <div class="position-relative overflow-hidden rounded-3 border mb-4" style="min-height: 540px; border-color: #e2e8f0 !important; background-color: #1e222d;">
            <iframe 
              src="https://openspeedtest.com/Get-widget.php" 
              style="width: 100%; height: 540px; border: none; overflow: hidden; display: block;" 
              allowfullscreen
              title="OpenSpeedTest Engine">
            </iframe>
          </div>

          {{-- Technical Specs & Client ISP Footer Bar --}}
          <div class="row g-3 text-start pt-3 border-top" style="border-color: #f1f5f9 !important;">
            
            <div class="col-12 col-md-6 col-lg-3">
              <div class="p-3 rounded-3 bg-light border h-100" style="border-color: #e2e8f0 !important;">
                <span class="d-block text-muted text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 0.8px;">PENYEDIA JARINGAN / CLIENT IP</span>
                <span id="client-isp-info" class="d-block" style="font-size: 12px;">
                  <span class="spinner-border spinner-border-sm me-1 text-primary" role="status"></span> Mendeteksi ISP &amp; IP...
                </span>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
              <div class="p-3 rounded-3 bg-light border h-100" style="border-color: #e2e8f0 !important;">
                <span class="d-block text-muted text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 0.8px;">ENGINE</span>
                <span class="fw-bold text-dark d-block" style="font-size: 12px;">
                  <i class="fas fa-microchip text-primary me-1"></i> OpenSpeedTest™ HTML5
                </span>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
              <div class="p-3 rounded-3 bg-light border h-100" style="border-color: #e2e8f0 !important;">
                <span class="d-block text-muted text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 0.8px;">PROTOCOL</span>
                <span class="fw-bold text-dark d-block" style="font-size: 12px;">
                  <i class="fas fa-lock text-success me-1"></i> HTTPS Secure (TLS 1.3)
                </span>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
              <div class="p-3 rounded-3 bg-light border h-100" style="border-color: #e2e8f0 !important;">
                <span class="d-block text-muted text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 0.8px;">LOCATION NODE</span>
                <span class="fw-bold text-dark d-block" style="font-size: 12px;">
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

@push('scripts')
<script>
  // Detect Real-time Client ISP & IP
  fetch('https://ipwho.is/')
    .then(res => res.json())
    .then(data => {
      if (data && data.ip) {
        let isp = data.connection && data.connection.isp ? data.connection.isp : (data.org || 'Penyedia Jaringan Utama');
        document.getElementById('client-isp-info').innerHTML = 
          '<div class="fw-bold text-primary mb-0.5 text-truncate" style="max-width: 100%;" title="' + isp + '"><i class="fas fa-network-wired me-1"></i> ' + isp + '</div>' +
          '<div class="font-monospace text-dark fw-bold" style="font-size: 11px;"><span class="text-muted">IP:</span> ' + data.ip + '</div>';
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
        document.getElementById('client-isp-info').innerHTML = '<div class="font-monospace text-primary fw-bold" style="font-size: 12px;"><i class="fas fa-network-wired me-1"></i> IP: ' + data.ip + '</div>';
      })
      .catch(() => {
        document.getElementById('client-isp-info').innerHTML = '<div class="text-muted small"><i class="fas fa-globe me-1"></i> Terhubung (Public Network)</div>';
      });
  }
</script>
@endpush

@endsection
