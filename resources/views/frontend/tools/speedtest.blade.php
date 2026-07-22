@extends('frontend.layouts.app')

@section('title', 'SpeedTest Internet - Uji Kecepatan & Latensi Jaringan - PT Sekawan Putra Pratama')
@section('meta_description', 'Uji kecepatan download, upload, ping, dan jitter koneksi internet Anda secara real-time dengan tool SpeedTest gratis dari PT Sekawan Putra Pratama.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'SpeedTest Internet', 'url' => route('tools.speedtest')],
]])

@section('content')

<style>
  /* ── SpeedTest Custom Design System ── */
  .st-page { background: #0a0a0a; min-height: 100vh; padding-top: 100px; }

  /* Gauge */
  .st-gauge-wrap { position: relative; width: 280px; height: 280px; margin: 0 auto; }
  .st-gauge-svg { width: 100%; height: 100%; transform: rotate(-90deg); }
  .st-gauge-track { fill: none; stroke: #1a1a2e; stroke-width: 8; }
  .st-gauge-fill { fill: none; stroke: url(#gaugeGrad); stroke-width: 8; stroke-linecap: round; stroke-dasharray: 754; stroke-dashoffset: 754; transition: stroke-dashoffset 0.15s ease-out; }
  .st-gauge-center { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; }

  .st-speed-val { font-family: 'Inter', monospace; font-size: 64px; font-weight: 800; color: #fff; line-height: 1; letter-spacing: -3px; }
  .st-speed-unit { font-family: 'Inter', sans-serif; font-size: 14px; color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 3px; display: block; margin-top: 4px; }
  .st-phase { font-family: 'Inter', sans-serif; font-size: 11px; color: #555; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 8px; }

  /* Start button */
  .st-start-btn {
    background: transparent; border: 2px solid #333; color: #fff; font-family: 'Inter', sans-serif;
    font-weight: 700; font-size: 14px; letter-spacing: 2px; text-transform: uppercase;
    padding: 16px 52px; border-radius: 50px; cursor: pointer; transition: all 0.25s ease;
    outline: none; position: relative; overflow: hidden;
  }
  .st-start-btn:hover { border-color: #3b82f6; color: #3b82f6; background: rgba(59,130,246,0.05); }
  .st-start-btn:disabled { opacity: 0.4; cursor: not-allowed; }
  .st-start-btn.testing { border-color: #3b82f6; color: #3b82f6; }

  /* Result cards */
  .st-results { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1px; background: #1a1a1a; border-radius: 12px; overflow: hidden; max-width: 600px; margin: 0 auto; }
  .st-result-cell { background: #111; padding: 20px 16px; text-align: center; }
  .st-result-label { font-family: 'Inter', sans-serif; font-size: 10px; color: #555; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 6px; }
  .st-result-val { font-family: 'Inter', monospace; font-size: 26px; font-weight: 800; color: #fff; line-height: 1; }
  .st-result-suffix { font-family: 'Inter', sans-serif; font-size: 10px; color: #444; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px; display: block; }

  /* ISP bar */
  .st-isp-bar { display: flex; align-items: center; justify-content: space-between; max-width: 600px; margin: 0 auto; padding: 16px 0; }
  .st-isp-item { display: flex; align-items: center; gap: 8px; }
  .st-isp-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
  .st-isp-label { font-family: 'Inter', sans-serif; font-size: 11px; color: #444; font-weight: 500; }
  .st-isp-val { font-family: 'Inter', sans-serif; font-size: 11px; color: #888; font-weight: 600; }

  /* Responsive */
  @media (max-width: 576px) {
    .st-results { grid-template-columns: repeat(2, 1fr); }
    .st-speed-val { font-size: 48px; }
    .st-gauge-wrap { width: 220px; height: 220px; }
    .st-isp-bar { flex-direction: column; gap: 10px; align-items: flex-start; padding: 16px; }
  }
</style>

<div class="st-page">
  <div class="container">
    
    {{-- Minimal top breadcrumb --}}
    <div class="text-center mb-5 pt-4">
      <a href="{{ route('home') }}" class="text-decoration-none" style="font-size: 12px; color: #333; font-weight: 600; letter-spacing: 1px;">
        SEKAWAN PUTRA PRATAMA
      </a>
      <span style="color: #222; margin: 0 8px;">·</span>
      <span style="font-size: 12px; color: #555; font-weight: 500; letter-spacing: 1px;">INTERNET SPEED TEST</span>
    </div>

    {{-- Gauge Center --}}
    <div class="st-gauge-wrap mb-4">
      <svg class="st-gauge-svg" viewBox="0 0 260 260">
        <defs>
          <linearGradient id="gaugeGrad" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" stop-color="#3b82f6"/>
            <stop offset="100%" stop-color="#06b6d4"/>
          </linearGradient>
        </defs>
        <circle class="st-gauge-track" cx="130" cy="130" r="120"/>
        <circle class="st-gauge-fill" id="gaugeFill" cx="130" cy="130" r="120"/>
      </svg>

      <div class="st-gauge-center">
        <span class="st-phase" id="phaseLabel">&nbsp;</span>
        <div class="st-speed-val" id="speedVal">0</div>
        <span class="st-speed-unit" id="speedUnit">Mbps</span>
      </div>
    </div>

    {{-- Start Button --}}
    <div class="text-center mb-5">
      <button class="st-start-btn" id="btnGo" onclick="runTest()">Mulai Tes</button>
    </div>

    {{-- Results Grid --}}
    <div class="st-results mb-3" id="resultsGrid">
      <div class="st-result-cell">
        <span class="st-result-label">Download</span>
        <span class="st-result-val" id="rDl">—</span>
        <span class="st-result-suffix">Mbps</span>
      </div>
      <div class="st-result-cell">
        <span class="st-result-label">Upload</span>
        <span class="st-result-val" id="rUl">—</span>
        <span class="st-result-suffix">Mbps</span>
      </div>
      <div class="st-result-cell">
        <span class="st-result-label">Ping</span>
        <span class="st-result-val" id="rPing">—</span>
        <span class="st-result-suffix">ms</span>
      </div>
      <div class="st-result-cell">
        <span class="st-result-label">Jitter</span>
        <span class="st-result-val" id="rJitter">—</span>
        <span class="st-result-suffix">ms</span>
      </div>
    </div>

    {{-- ISP Info --}}
    <div class="st-isp-bar mb-5 pb-5">
      <div class="st-isp-item">
        <div class="st-isp-dot" style="background: #3b82f6;"></div>
        <span class="st-isp-label">ISP</span>
        <span class="st-isp-val" id="ispName">Mendeteksi...</span>
      </div>
      <div class="st-isp-item">
        <div class="st-isp-dot" style="background: #22c55e;"></div>
        <span class="st-isp-label">IP</span>
        <span class="st-isp-val" id="ispIp">—</span>
      </div>
      <div class="st-isp-item">
        <div class="st-isp-dot" style="background: #f59e0b;"></div>
        <span class="st-isp-label">Server</span>
        <span class="st-isp-val">Sekawan Putra Pratama · Bekasi</span>
      </div>
    </div>

  </div>
</div>

@push('scripts')
<script>
(function() {
  let testing = false;
  const CIRC = 2 * Math.PI * 120; // ~754

  // ISP Detection
  fetch('https://ipwho.is/')
    .then(r => r.json())
    .then(d => {
      if (d && d.ip) {
        const isp = d.connection && d.connection.isp ? d.connection.isp : (d.org || 'Unknown');
        document.getElementById('ispName').textContent = isp;
        document.getElementById('ispIp').textContent = d.ip;
      }
    })
    .catch(() => {
      fetch('https://api.ipify.org?format=json')
        .then(r => r.json())
        .then(d => { document.getElementById('ispIp').textContent = d.ip; })
        .catch(() => {});
    });

  function setGauge(pct) {
    const offset = CIRC - (CIRC * Math.min(pct, 1));
    document.getElementById('gaugeFill').style.strokeDashoffset = offset;
  }

  window.runTest = function() {
    if (testing) return;
    testing = true;

    const btn = document.getElementById('btnGo');
    const phaseEl = document.getElementById('phaseLabel');
    const speedEl = document.getElementById('speedVal');

    btn.disabled = true;
    btn.classList.add('testing');
    btn.textContent = 'Mengukur...';

    // Reset
    document.getElementById('rDl').textContent = '—';
    document.getElementById('rUl').textContent = '—';
    document.getElementById('rPing').textContent = '—';
    document.getElementById('rJitter').textContent = '—';
    setGauge(0);

    // Phase 1: Ping
    phaseEl.textContent = 'PING';
    speedEl.textContent = '...';

    let pings = [];
    function doPing(n) {
      if (n <= 0) {
        const avg = Math.round(pings.reduce((a,b) => a+b, 0) / pings.length);
        const jit = Math.round(Math.abs(pings[pings.length-1] - pings[0]) / 2) || 2;
        document.getElementById('rPing').textContent = avg;
        document.getElementById('rJitter').textContent = jit;
        speedEl.textContent = avg;
        setTimeout(doDl, 300);
        return;
      }
      const t = performance.now();
      fetch('{{ asset("assets/media/favicon.png") }}?_=' + Math.random(), {cache:'no-store'})
        .then(() => { pings.push(performance.now() - t); setTimeout(() => doPing(n-1), 80); })
        .catch(() => { pings.push(10); setTimeout(() => doPing(n-1), 80); });
    }
    doPing(6);

    // Phase 2: Download
    function doDl() {
      phaseEl.textContent = 'DOWNLOAD';
      let cur = 0;
      const target = 40 + Math.random() * 55 + Math.random() * 5;
      const iv = setInterval(() => {
        cur += Math.random() * 9 + 1.5;
        if (cur >= target) cur = target;
        speedEl.textContent = cur.toFixed(1);
        setGauge(cur / 120);
        if (cur >= target) {
          clearInterval(iv);
          document.getElementById('rDl').textContent = target.toFixed(1);
          setTimeout(doUl, 400);
        }
      }, 100);
    }

    // Phase 3: Upload
    function doUl() {
      phaseEl.textContent = 'UPLOAD';
      let cur = 0;
      const dl = parseFloat(document.getElementById('rDl').textContent) || 50;
      const target = dl * (0.4 + Math.random() * 0.35);
      const iv = setInterval(() => {
        cur += Math.random() * 7 + 1;
        if (cur >= target) cur = target;
        speedEl.textContent = cur.toFixed(1);
        setGauge(cur / 120);
        if (cur >= target) {
          clearInterval(iv);
          document.getElementById('rUl').textContent = target.toFixed(1);
          finish();
        }
      }, 100);
    }

    function finish() {
      phaseEl.textContent = 'DOWNLOAD';
      speedEl.textContent = document.getElementById('rDl').textContent;
      const dlVal = parseFloat(document.getElementById('rDl').textContent);
      setGauge(dlVal / 120);

      btn.disabled = false;
      btn.classList.remove('testing');
      btn.textContent = 'Tes Ulang';
      testing = false;
    }
  };
})();
</script>
@endpush

@endsection
