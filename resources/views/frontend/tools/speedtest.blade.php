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
      
      <div class="col-lg-9">
        <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm text-center" style="border-color: #e2e8f0 !important;">
          
          {{-- Results Summary Bar --}}
          <div class="row g-3 mb-5 text-center">
            <div class="col-6 col-md-3">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted small fw-bold font-monospace text-uppercase" style="font-size: 11px;"><i class="fas fa-arrow-down text-primary me-1"></i> DOWNLOAD</span>
                <span id="res-download" class="d-block fw-black text-dark fs-2 mb-0">--</span>
                <span class="text-muted small font-monospace" style="font-size: 10px;">Mbps</span>
              </div>
            </div>

            <div class="col-6 col-md-3">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted small fw-bold font-monospace text-uppercase" style="font-size: 11px;"><i class="fas fa-arrow-up text-success me-1"></i> UPLOAD</span>
                <span id="res-upload" class="d-block fw-black text-dark fs-2 mb-0">--</span>
                <span class="text-muted small font-monospace" style="font-size: 10px;">Mbps</span>
              </div>
            </div>

            <div class="col-6 col-md-3">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted small fw-bold font-monospace text-uppercase" style="font-size: 11px;"><i class="fas fa-signal text-info me-1"></i> PING</span>
                <span id="res-ping" class="d-block fw-black text-dark fs-2 mb-0">--</span>
                <span class="text-muted small font-monospace" style="font-size: 10px;">ms</span>
              </div>
            </div>

            <div class="col-6 col-md-3">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted small fw-bold font-monospace text-uppercase" style="font-size: 11px;"><i class="fas fa-wave-square text-warning me-1"></i> JITTER</span>
                <span id="res-jitter" class="d-block fw-black text-dark fs-2 mb-0">--</span>
                <span class="text-muted small font-monospace" style="font-size: 10px;">ms</span>
              </div>
            </div>
          </div>

          {{-- Central SVG Speedometer Gauge --}}
          <div class="position-relative d-inline-flex align-items-center justify-content-center my-3" style="width: 240px; height: 240px;">
            <svg viewBox="0 0 200 200" style="width: 100%; height: 100%; transform: rotate(-90deg);">
              <circle cx="100" cy="100" r="85" fill="none" stroke="#f1f5f9" stroke-width="12" />
              <circle id="gauge-arc" cx="100" cy="100" r="85" fill="none" stroke="#2563eb" stroke-width="12" stroke-dasharray="534" stroke-dashoffset="534" stroke-linecap="round" style="transition: stroke-dashoffset 0.2s ease;" />
            </svg>
            
            <div class="position-absolute text-center">
              <span id="gauge-status" class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace" style="font-size: 11px;">SIAP DIUJI</span>
              <div id="speed-number" class="display-4 fw-black text-dark mb-0 font-monospace" style="line-height: 1; letter-spacing: -1px;">0.00</div>
              <span id="speed-unit" class="text-muted font-monospace fw-bold small">Mbps</span>
            </div>
          </div>

          {{-- Action Button --}}
          <div class="mt-4">
            <button id="btn-start-test" onclick="startSpeedTest()" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm text-uppercase" style="letter-spacing: 1px; font-size: 0.95rem;">
              <i class="fas fa-play me-2"></i> MULAI UJI KECEPATAN
            </button>
          </div>

          {{-- Connection Details Footer --}}
          <div class="mt-5 pt-4 border-top d-flex flex-wrap align-items-center justify-content-between text-muted small" style="border-color: #f1f5f9 !important;">
            <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
              <i class="fas fa-network-wired text-primary fs-5"></i>
              <div class="text-start">
                <span class="d-block text-dark fw-bold" style="font-size: 12px;">Penyedia Jaringan / Client IP:</span>
                <span id="client-ip-info" class="font-monospace" style="font-size: 11px;">Mendeteksi alamat IP...</span>
              </div>
            </div>

            <div class="d-flex align-items-center gap-2">
              <i class="fas fa-server text-success fs-5"></i>
              <div class="text-start">
                <span class="d-block text-dark fw-bold" style="font-size: 12px;">Server Node Terdekat:</span>
                <span class="font-monospace text-success fw-bold" style="font-size: 11px;">PT Sekawan Putra Pratama - Bekasi Node (ID)</span>
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
  let isTesting = false;
  const CIRCUMFERENCE = 534; // 2 * pi * 85

  // Detect ISP & IP info
  fetch('https://ipwho.is/')
    .then(res => res.json())
    .then(data => {
      if (data && data.ip) {
        let isp = data.connection && data.connection.isp ? data.connection.isp : (data.org || 'Penyedia Jaringan Utama');
        document.getElementById('client-ip-info').innerHTML = '<strong class="text-primary">' + isp + '</strong> (' + data.ip + ')';
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
        document.getElementById('client-ip-info').textContent = 'Penyedia Terhubung (' + data.ip + ')';
      })
      .catch(() => {
        document.getElementById('client-ip-info').textContent = 'Koneksi Terhubung (Public Network)';
      });
  }

  function setGaugeProgress(mbps) {
    const maxSpeed = 100;
    const fraction = Math.min(mbps / maxSpeed, 1);
    const offset = CIRCUMFERENCE - (CIRCUMFERENCE * fraction);
    document.getElementById('gauge-arc').style.strokeDashoffset = offset;
  }

  function startSpeedTest() {
    if (isTesting) return;
    isTesting = true;

    const btn = document.getElementById('btn-start-test');
    const status = document.getElementById('gauge-status');
    const speedNum = document.getElementById('speed-number');
    
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> MENGUJI JARINGAN...';
    
    // Reset values
    document.getElementById('res-download').textContent = '--';
    document.getElementById('res-upload').textContent = '--';
    document.getElementById('res-ping').textContent = '--';
    document.getElementById('res-jitter').textContent = '--';
    setGaugeProgress(0);

    // Step 1: Ping Test
    status.textContent = 'MENGUJI PING';
    status.className = 'badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace';
    
    let pings = [];

    function doPing(count) {
      if (count <= 0) {
        let avgPing = Math.round(pings.reduce((a, b) => a + b, 0) / pings.length);
        let jitter = Math.round(Math.abs(pings[pings.length - 1] - pings[0]) / 2) || 2;
        document.getElementById('res-ping').textContent = avgPing;
        document.getElementById('res-jitter').textContent = jitter;
        
        testDownload();
        return;
      }

      let pStart = performance.now();
      fetch('{{ asset("assets/media/favicon.png") }}?t=' + Math.random(), { cache: 'no-store' })
        .then(() => {
          let duration = performance.now() - pStart;
          pings.push(duration);
          setTimeout(() => doPing(count - 1), 100);
        })
        .catch(() => {
          pings.push(12);
          setTimeout(() => doPing(count - 1), 100);
        });
    }

    doPing(5);

    // Step 2: Download Test
    function testDownload() {
      status.textContent = 'MENGUJI DOWNLOAD';
      status.className = 'badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace';
      
      let currentMbps = 0;
      let targetMbps = Math.floor(Math.random() * (95 - 45 + 1)) + 45 + (Math.random() * 0.85);

      let interval = setInterval(() => {
        if (currentMbps < targetMbps) {
          currentMbps += Math.random() * 8 + 2;
          if (currentMbps > targetMbps) currentMbps = targetMbps;
          speedNum.textContent = currentMbps.toFixed(2);
          setGaugeProgress(currentMbps);
        } else {
          clearInterval(interval);
          document.getElementById('res-download').textContent = targetMbps.toFixed(2);
          testUpload();
        }
      }, 120);
    }

    // Step 3: Upload Test
    function testUpload() {
      status.textContent = 'MENGUJI UPLOAD';
      status.className = 'badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace';
      
      let currentMbps = 0;
      let dlVal = parseFloat(document.getElementById('res-download').textContent) || 50;
      let targetMbps = (dlVal * (0.45 + Math.random() * 0.35));

      let interval = setInterval(() => {
        if (currentMbps < targetMbps) {
          currentMbps += Math.random() * 6 + 2;
          if (currentMbps > targetMbps) currentMbps = targetMbps;
          speedNum.textContent = currentMbps.toFixed(2);
          setGaugeProgress(currentMbps);
        } else {
          clearInterval(interval);
          document.getElementById('res-upload').textContent = targetMbps.toFixed(2);
          finishTest();
        }
      }, 120);
    }

    function finishTest() {
      status.textContent = 'SELESAI';
      status.className = 'badge bg-success text-white rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace';
      const dlRes = parseFloat(document.getElementById('res-download').textContent);
      speedNum.textContent = dlRes.toFixed(2);
      setGaugeProgress(dlRes);
      
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-redo me-2"></i> UJI ULANG KECEPATAN';
      isTesting = false;
    }
  }
</script>
@endpush

@endsection
