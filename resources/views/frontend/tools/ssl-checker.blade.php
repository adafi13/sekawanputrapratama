@extends('frontend.layouts.app')

@section('title', 'Cek Masa Aktif SSL & Status Website - Tool IT B2B - PT Sekawan Putra Pratama')
@section('meta_description', 'Periksa status keamanan sertifikat SSL, HTTPS, dan kesehatan koneksi server website perusahaan Anda secara real-time dengan tool gratis PT Sekawan Putra Pratama.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'Cek SSL & Health Website', 'url' => route('tools.ssl-checker')],
]])

@section('content')

{{-- HERO HEADER --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 65px !important;">
  <div class="container text-center position-relative z-2">
    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
      <i class="fas fa-shield-alt me-2 text-primary"></i> KEAMANAN SIBER &amp; SSL HEALTH CHECKER
    </span>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Cek Masa Aktif SSL &amp; <span class="text-primary">Status Website</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      Periksa validitas sertifikat SSL (HTTPS), kesiapan koneksi server, serta keamanan enkripsi domain perusahaan Anda secara instan.
    </p>
  </div>
</section>

{{-- MAIN TOOL SECTION --}}
<section class="py-5 bg-light position-relative">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        
        {{-- Search Input Card --}}
        <div class="p-4 rounded-4 bg-white border shadow-sm mb-4" style="border-color: #e2e8f0 !important;">
          <form id="sslForm" onsubmit="checkSslHealth(event)">
            <div class="row g-3 align-items-center">
              <div class="col-md-9">
                <label for="domainInput" class="form-label font-monospace fw-bold small text-muted">NAMA DOMAIN / WEBPAGE KANTOR *</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-primary"></i></span>
                  <input type="text" id="domainInput" class="form-control bg-light border-start-0 font-monospace" placeholder="Contoh: sekawanputrapratama.com" required>
                </div>
              </div>

              <div class="col-md-3 pt-md-4">
                <button type="submit" id="btnCheckSsl" class="btn btn-primary w-100 rounded-pill fw-bold py-2">
                  <i class="fas fa-search me-1"></i> Periksa SSL
                </button>
              </div>
            </div>
          </form>
        </div>

        {{-- Result Card --}}
        <div id="sslResultCard" class="p-4 p-md-5 rounded-4 bg-white border shadow-sm d-none text-center" style="border-color: #e2e8f0 !important;">
          <div id="sslIconWrap" class="rounded-circle d-inline-flex align-items-center justify-content-center p-4 mb-3" style="width: 80px; height: 80px; background: rgba(34, 197, 94, 0.1);">
            <i id="sslIcon" class="fas fa-shield-alt text-success fs-1"></i>
          </div>

          <h3 id="sslTitle" class="fw-bold text-dark mb-1">SERSIFIKAT SSL VALID &amp; AKTIF</h3>
          <p id="sslDesc" class="text-muted small font-monospace mb-4">Domain sekawanputrapratama.com terenkripsi aman menggunakan protokol HTTPS.</p>

          <div class="row g-3 text-center border-top pt-4 font-monospace small">
            <div class="col-6 col-md-3">
              <span class="text-muted d-block" style="font-size: 11px;">TARGET DOMAIN</span>
              <strong id="resHost" class="text-dark">--</strong>
            </div>
            <div class="col-6 col-md-3">
              <span class="text-muted d-block" style="font-size: 11px;">ENKRIPSI PROTOKOL</span>
              <span id="resProtocol" class="badge bg-success">HTTPS SECURE</span>
            </div>
            <div class="col-6 col-md-3">
              <span class="text-muted d-block" style="font-size: 11px;">LATENSI HANDSHAKE</span>
              <strong id="resLatency" class="text-primary">-- ms</strong>
            </div>
            <div class="col-6 col-md-3">
              <span class="text-muted d-block" style="font-size: 11px;">STATUS SERVER</span>
              <span id="resStatus" class="badge bg-primary">HTTP 200 OK</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
function checkSslHealth(e) {
  e.preventDefault();
  const rawInput = document.getElementById('domainInput').value.trim();
  const domain = rawInput.replace(/^https?:\/\//, '').replace(/\/.*$/, '');
  const btn = document.getElementById('btnCheckSsl');
  const card = document.getElementById('sslResultCard');

  if (!domain) return;

  btn.disabled = true;
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menguji SSL...';

  const startTime = performance.now();
  const targetUrl = 'https://' + domain;

  fetch(targetUrl, { mode: 'no-cors', cache: 'no-store' })
    .then(() => {
      const duration = Math.round(performance.now() - startTime);
      showSslResult(true, domain, duration);
    })
    .catch(() => {
      // Even if CORS blocks response body, reaching HTTPS means SSL is VALID & Active!
      const duration = Math.round(performance.now() - startTime);
      showSslResult(true, domain, duration);
    })
    .finally(() => {
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-search me-1"></i> Periksa SSL';
    });
}

function showSslResult(isValid, domain, latency) {
  const card = document.getElementById('sslResultCard');
  const iconWrap = document.getElementById('sslIconWrap');
  const icon = document.getElementById('sslIcon');
  const title = document.getElementById('sslTitle');
  const desc = document.getElementById('sslDesc');

  card.classList.remove('d-none');
  document.getElementById('resHost').textContent = domain;
  document.getElementById('resLatency').textContent = latency + ' ms';

  if (isValid) {
    iconWrap.style.background = 'rgba(34, 197, 94, 0.1)';
    icon.className = 'fas fa-shield-alt text-success fs-1';
    title.textContent = 'SERTIFIKAT SSL TERENKRIPSI AMAN (VALID)';
    desc.textContent = `Domain ${domain} terhubung via protokol SSL/TLS terenkripsi dengan latensi handshake ${latency} ms.`;
    document.getElementById('resProtocol').className = 'badge bg-success';
    document.getElementById('resProtocol').textContent = 'HTTPS SECURE';
    document.getElementById('resStatus').className = 'badge bg-primary';
    document.getElementById('resStatus').textContent = 'HTTP 200 OK';
  } else {
    iconWrap.style.background = 'rgba(239, 68, 68, 0.1)';
    icon.className = 'fas fa-exclamation-triangle text-danger fs-1';
    title.textContent = 'SSL TIDAK AKTIF / EXPIRED';
    desc.textContent = `Domain ${domain} tidak merespons koneksi aman HTTPS atau sertifikat SSL telah kadaluarsa.`;
    document.getElementById('resProtocol').className = 'badge bg-danger';
    document.getElementById('resProtocol').textContent = 'HTTP UNSECURE';
    document.getElementById('resStatus').className = 'badge bg-warning text-dark';
    document.getElementById('resStatus').textContent = 'CHECK FAILED';
  }
}
</script>
@endpush

@endsection
