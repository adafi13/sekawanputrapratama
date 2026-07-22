@extends('frontend.layouts.app')

@section('title', 'IP Geolokasi & Server WHOIS - Tool Diagnostik Server - PT Sekawan Putra Pratama')
@section('meta_description', 'Lakukan pengecekan lokasi fisik server (Negara, Kota, Provider Hosting, ASN) dari Alamat IP atau Domain secara real-time dengan tool gratis PT Sekawan Putra Pratama.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'IP Geolokasi & Server WHOIS', 'url' => route('tools.ip-lookup')],
]])

@section('content')

{{-- HERO HEADER --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 65px !important;">
  <div class="container text-center position-relative z-2">
    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
      <i class="fas fa-map-marked-alt me-2"></i> INFRASTRUKTUR &amp; GEOLOKASI SERVER
    </span>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      IP Geolokasi &amp; <span class="text-primary">Server WHOIS</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      Periksa lokasi fisik server, negara, kota, penyedia jaringan (ISP), provider hosting, hingga koordinat GPS dari Alamat IP atau Domain pilihan Anda.
    </p>
  </div>
</section>

{{-- MAIN TOOL SECTION --}}
<section class="py-5 bg-light position-relative">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        
        {{-- Search Input Card --}}
        <div class="p-4 rounded-4 bg-white border shadow-sm mb-4" style="border-color: #e2e8f0 !important;">
          <form id="ipForm" onsubmit="lookupIpAddress(event)">
            <div class="row g-3 align-items-center">
              <div class="col-md-9">
                <label for="ipInput" class="form-label font-monospace fw-bold small text-muted">ALAMAT IP ATAU DOMAIN HOST *</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="fas fa-search-location text-primary"></i></span>
                  <input type="text" id="ipInput" class="form-control bg-light border-start-0 font-monospace" placeholder="Kosongkan untuk IP Anda sendiri, atau masukkan misal: 8.8.8.8 / sekawanputrapratama.com">
                </div>
              </div>

              <div class="col-md-3 pt-md-4">
                <button type="submit" id="btnLookupIp" class="btn btn-primary w-100 rounded-pill fw-bold py-2">
                  <i class="fas fa-compass me-1"></i> Cek Lokasi IP
                </button>
              </div>
            </div>
          </form>
        </div>

        {{-- Results Card --}}
        <div id="ipResultCard" class="p-4 p-md-5 rounded-4 bg-white border shadow-sm d-none" style="border-color: #e2e8f0 !important;">
          <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-4 border-bottom">
            <div>
              <span class="text-muted small font-monospace d-block">INFORMASI GEOLOKASI SERVER</span>
              <h3 id="resIpTarget" class="fw-bold text-dark font-monospace mb-0">8.8.8.8</h3>
            </div>
            <span id="resCountryBadge" class="badge bg-primary text-white font-monospace px-3 py-2 fs-6 mt-2 mt-md-0">
              <span id="resFlag">🇮🇩</span> <span id="resCountry">Indonesia</span>
            </span>
          </div>

          {{-- Grid Details --}}
          <div class="row g-4 mb-4">
            <div class="col-md-6">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="text-muted small font-monospace d-block mb-1"><i class="fas fa-building text-primary me-1"></i> PENYEDIA JARINGAN / ISP</span>
                <strong id="resIsp" class="text-dark font-monospace fs-6">PT Remala Abadi Tbk</strong>
              </div>
            </div>

            <div class="col-md-6">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="text-muted small font-monospace d-block mb-1"><i class="fas fa-city text-info me-1"></i> KOTA &amp; PROVINSI</span>
                <strong id="resCity" class="text-dark font-monospace fs-6">Jakarta, DKI Jakarta</strong>
              </div>
            </div>

            <div class="col-md-6">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="text-muted small font-monospace d-block mb-1"><i class="fas fa-network-wired text-success me-1"></i> ASN / NOMOR OTONOM</span>
                <strong id="resAsn" class="text-dark font-monospace fs-6">AS136058</strong>
              </div>
            </div>

            <div class="col-md-6">
              <div class="p-3 rounded-3 bg-light border" style="border-color: #f1f5f9 !important;">
                <span class="text-muted small font-monospace d-block mb-1"><i class="fas fa-map-pin text-danger me-1"></i> KOORDINAT GPS (LAT/LONG)</span>
                <strong id="resCoords" class="text-dark font-monospace fs-6">-6.2088, 106.8456</strong>
              </div>
            </div>
          </div>

          {{-- Map Card Embed --}}
          <div class="rounded-3 overflow-hidden border shadow-sm mt-3">
            <iframe id="resMapFrame" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" src="https://www.google.com/maps?q=-6.2088,106.8456&z=12&output=embed"></iframe>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
function lookupIpAddress(e) {
  if (e) e.preventDefault();
  const query = document.getElementById('ipInput').value.trim().replace(/^https?:\/\//, '').replace(/\/.*$/, '');
  const btn = document.getElementById('btnLookupIp');
  const card = document.getElementById('ipResultCard');

  btn.disabled = true;
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Mencari...';

  const apiUrl = query ? `https://ipwho.is/${encodeURIComponent(query)}` : 'https://ipwho.is/';

  fetch(apiUrl)
    .then(res => res.json())
    .then(data => {
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-compass me-1"></i> Cek Lokasi IP';

      if (data && data.success !== false) {
        card.classList.remove('d-none');
        document.getElementById('resIpTarget').textContent = data.ip || query;
        document.getElementById('resFlag').textContent = data.flag ? data.flag.emoji : '🌐';
        document.getElementById('resCountry').textContent = data.country || 'Unknown';
        
        const ispName = (data.connection && data.connection.isp) ? data.connection.isp : (data.org || 'Penyedia Utama');
        document.getElementById('resIsp').textContent = ispName;
        
        const cityProv = (data.city ? data.city + ', ' : '') + (data.region || '');
        document.getElementById('resCity').textContent = cityProv || 'Terdeteksi';
        
        const asnNum = (data.connection && data.connection.asn) ? ('AS' + data.connection.asn) : 'AS System';
        document.getElementById('resAsn').textContent = asnNum;

        const lat = data.latitude || -6.2088;
        const lon = data.longitude || 106.8456;
        document.getElementById('resCoords').textContent = `${lat}, ${lon}`;
        
        document.getElementById('resMapFrame').src = `https://www.google.com/maps?q=${lat},${lon}&z=12&output=embed`;
      } else {
        alert('Gagal menemukan data IP/Domain. Pastikan format IP atau domain sudah benar.');
      }
    })
    .catch(() => {
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-compass me-1"></i> Cek Lokasi IP';
      alert('Terjadi kesalahan koneksi ke resolver IP.');
    });
}

// Auto run IP lookup on page load for client's current IP!
document.addEventListener('DOMContentLoaded', () => lookupIpAddress());
</script>
@endpush

@endsection
