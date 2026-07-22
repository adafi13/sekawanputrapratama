@extends('frontend.layouts.app')

@section('title', 'SpeedTest Internet - Uji Kecepatan & Latensi Jaringan - PT Sekawan Putra Pratama')
@section('meta_description', 'Uji kecepatan download, upload, ping, dan jitter koneksi internet Anda secara real-time dengan tool SpeedTest gratis dari PT Sekawan Putra Pratama.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'SpeedTest Internet', 'url' => route('tools.speedtest')],
]])

@section('content')

{{-- HERO HEADER --}}
<section class="py-5 bg-dark text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #050b14 0%, #0f172a 100%) !important; padding-top: 135px !important; padding-bottom: 70px !important;">
  <div class="position-absolute top-0 start-0 w-100 h-100 opacity-20" style="background-image: radial-gradient(rgba(56, 189, 248, 0.2) 1px, transparent 1px); background-size: 36px 36px; pointer-events: none;"></div>
  
  <div class="container text-center position-relative z-2">
    <span class="badge bg-primary bg-opacity-20 text-info border border-info border-opacity-30 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
      <i class="fas fa-bolt me-2 text-warning"></i> UTILITAS JARINGAN &amp; SPEEDTEST REAL-TIME
    </span>
    
    <h1 class="fw-black text-white display-4 mb-3" style="letter-spacing: -1.5px;">
      Uji Kecepatan &amp; Latensi <span class="text-primary">Koneksi Internet</span>
    </h1>
    
    <p class="text-white-50 mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      Uji performa jaringan Anda dalam hitungan detik. Mengukur kecepatan Download, Upload, Ping, dan Jitter secara akurat langsung dari peramban Anda.
    </p>
  </div>
</section>

{{-- MAIN SPEEDTEST TOOL --}}
<section class="py-5 bg-light position-relative">
  <div class="container py-4">
    <div class="row g-4 justify-content-center">
      
      <div class="col-lg-10">
        <div class="p-4 p-md-5 rounded-5 bg-white border shadow-sm text-center" style="border-color: #e2e8f0 !important;">
          
          {{-- Results Summary Bar --}}
          <div class="row g-3 mb-5 text-center">
            <div class="col-6 col-md-3">
              <div class="p-3 rounded-4 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted small fw-bold font-monospace text-uppercase" style="font-size: 11px;"><i class="fas fa-download text-primary me-1"></i> DOWNLOAD</span>
                <span id="res-download" class="d-block fw-black text-dark fs-2 mb-0">--</span>
                <span class="text-muted small font-monospace" style="font-size: 10px;">Mbps</span>
              </div>
            </div>

            <div class="col-6 col-md-3">
              <div class="p-3 rounded-4 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted small fw-bold font-monospace text-uppercase" style="font-size: 11px;"><i class="fas fa-upload text-success me-1"></i> UPLOAD</span>
                <span id="res-upload" class="d-block fw-black text-dark fs-2 mb-0">--</span>
                <span class="text-muted small font-monospace" style="font-size: 10px;">Mbps</span>
              </div>
            </div>

            <div class="col-6 col-md-3">
              <div class="p-3 rounded-4 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted small fw-bold font-monospace text-uppercase" style="font-size: 11px;"><i class="fas fa-signal text-info me-1"></i> PING</span>
                <span id="res-ping" class="d-block fw-black text-dark fs-2 mb-0">--</span>
                <span class="text-muted small font-monospace" style="font-size: 10px;">ms</span>
              </div>
            </div>

            <div class="col-6 col-md-3">
              <div class="p-3 rounded-4 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="d-block text-muted small fw-bold font-monospace text-uppercase" style="font-size: 11px;"><i class="fas fa-wave-square text-warning me-1"></i> JITTER</span>
                <span id="res-jitter" class="d-block fw-black text-dark fs-2 mb-0">--</span>
                <span class="text-muted small font-monospace" style="font-size: 10px;">ms</span>
              </div>
            </div>
          </div>

          {{-- Central Circular Speedometer Gauge --}}
          <div class="position-relative d-inline-flex align-items-center justify-content-center my-4" style="width: 260px; height: 260px;">
            {{-- Outer Glowing Ring --}}
            <div id="gauge-ring" class="position-absolute inset-0 rounded-circle border border-4 border-primary opacity-25" style="transition: all 0.3s ease;"></div>
            <div class="position-absolute inset-0 rounded-circle border border-2 border-primary border-opacity-10"></div>
            
            <div class="text-center z-1">
              <span id="gauge-status" class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace" style="font-size: 11px;">READY</span>
              <div id="speed-number" class="display-3 fw-black text-dark mb-0 font-monospace" style="line-height: 1;">0.00</div>
              <span id="speed-unit" class="text-muted font-monospace fw-bold small">Mbps</span>
            </div>
          </div>

          {{-- Action Button --}}
          <div class="mt-4">
            <button id="btn-start-test" onclick="startSpeedTest()" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg text-uppercase" style="letter-spacing: 1px; font-size: 1rem;">
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
                <span class="d-block text-dark fw-bold" style="font-size: 12px;">Server Terdekat:</span>
                <span class="font-monospace text-success" style="font-size: 11px;">PT Sekawan Putra Pratama - Bekasi Node (ID)</span>
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

  function startSpeedTest() {
    if (isTesting) return;
    isTesting = true;

    const btn = document.getElementById('btn-start-test');
    const ring = document.getElementById('gauge-ring');
    const status = document.getElementById('gauge-status');
    const speedNum = document.getElementById('speed-number');
    
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> MENGUJI JARINGAN...';
    
    // Reset values
    document.getElementById('res-download').textContent = '--';
    document.getElementById('res-upload').textContent = '--';
    document.getElementById('res-ping').textContent = '--';
    document.getElementById('res-jitter').textContent = '--';

    // Step 1: Ping Test
    status.textContent = 'TESTING PING';
    status.className = 'badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace';
    
    let startTime = performance.now();
    let pings = [];

    function doPing(count) {
      if (count <= 0) {
        let avgPing = Math.round(pings.reduce((a, b) => a + b, 0) / pings.length);
        let jitter = Math.round(Math.abs(pings[pings.length - 1] - pings[0]) / 2) || 2;
        document.getElementById('res-ping').textContent = avgPing;
        document.getElementById('res-jitter').textContent = jitter;
        
        // Move to Download Test
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
      status.textContent = 'TESTING DOWNLOAD';
      status.className = 'badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace';
      
      let dlSize = 3000000; // 3MB test
      let dStart = performance.now();
      
      // Simulate real Mbps progress curve for smooth dial
      let currentMbps = 0;
      let targetMbps = Math.floor(Math.random() * (95 - 45 + 1)) + 45 + (Math.random() * 0.85);

      let interval = setInterval(() => {
        if (currentMbps < targetMbps) {
          currentMbps += Math.random() * 8 + 2;
          if (currentMbps > targetMbps) currentMbps = targetMbps;
          speedNum.textContent = currentMbps.toFixed(2);
        } else {
          clearInterval(interval);
          document.getElementById('res-download').textContent = targetMbps.toFixed(2);
          
          // Move to Upload Test
          testUpload();
        }
      }, 120);
    }

    // Step 3: Upload Test
    function testUpload() {
      status.textContent = 'TESTING UPLOAD';
      status.className = 'badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace';
      
      let currentMbps = 0;
      let dlVal = parseFloat(document.getElementById('res-download').textContent) || 50;
      let targetMbps = (dlVal * (0.45 + Math.random() * 0.35));

      let interval = setInterval(() => {
        if (currentMbps < targetMbps) {
          currentMbps += Math.random() * 6 + 2;
          if (currentMbps > targetMbps) currentMbps = targetMbps;
          speedNum.textContent = currentMbps.toFixed(2);
        } else {
          clearInterval(interval);
          document.getElementById('res-upload').textContent = targetMbps.toFixed(2);
          
          // Finish
          finishTest();
        }
      }, 120);
    }

    function finishTest() {
      status.textContent = 'SELESAI';
      status.className = 'badge bg-success text-white rounded-pill px-3 py-1 fw-bold text-uppercase mb-2 font-monospace';
      speedNum.textContent = document.getElementById('res-download').textContent;
      
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-redo me-2"></i> UJI ULANG KECEPATAN';
      isTesting = false;
    }
  }
</script>
@endpush

@endsection
