@extends('frontend.layouts.app')

@section('title', 'Cek IP & DNS Lookup Domain - Tool Diagnostik IT - PT Sekawan Putra Pratama')
@section('meta_description', 'Lakukan pengecekan DNS Record (A, MX, TXT, NS, CNAME) dan Geolocation Alamat IP domain secara real-time dengan tool gratis PT Sekawan Putra Pratama.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'DNS Lookup & Cek IP', 'url' => route('tools.dns-lookup')],
]])

@section('content')

{{-- HERO HEADER --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 65px !important;">
  <div class="container text-center position-relative z-2">
    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
      <i class="fas fa-search-location me-2"></i> DIAGNOSTIK SERVER &amp; NETWORK TOOL
    </span>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Analisa <span class="text-primary">Record DNS &amp; IP</span> Domain
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      Periksa A Record, MX Record, Nameserver (NS), TXT, serta lokasi server domain pilihan Anda secara instan menggunakan resolver DNS publik Google &amp; Cloudflare.
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
          <form id="dnsForm" onsubmit="performDnsLookup(event)">
            <div class="row g-3 align-items-center">
              <div class="col-md-7">
                <label for="domainInput" class="form-label font-monospace fw-bold small text-muted">NAMA DOMAIN / HOSTNAME *</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="fas fa-globe text-primary"></i></span>
                  <input type="text" id="domainInput" class="form-control bg-light border-start-0 font-monospace" placeholder="Contoh: sekawanputrapratama.com" required>
                </div>
              </div>

              <div class="col-md-3">
                <label for="recordType" class="form-label font-monospace fw-bold small text-muted">TIPE RECORD *</label>
                <select id="recordType" class="form-select bg-light">
                  <option value="A" selected>A (IPv4 Address)</option>
                  <option value="MX">MX (Mail Server)</option>
                  <option value="NS">NS (Name Server)</option>
                  <option value="TXT">TXT (SPF / Verification)</option>
                  <option value="AAAA">AAAA (IPv6 Address)</option>
                  <option value="CNAME">CNAME (Alias)</option>
                </select>
              </div>

              <div class="col-md-2 pt-md-4">
                <button type="submit" id="btnLookup" class="btn btn-primary w-100 rounded-pill fw-bold py-2">
                  <i class="fas fa-search me-1"></i> Periksa
                </button>
              </div>
            </div>
          </form>
        </div>

        {{-- Results Card --}}
        <div id="resultsCard" class="p-4 p-md-5 rounded-4 bg-white border shadow-sm d-none" style="border-color: #e2e8f0 !important;">
          <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom">
            <div>
              <span class="text-muted small font-monospace d-block">HASIL DIAGNOSTIK DOMAIN</span>
              <h4 id="resDomain" class="fw-bold text-dark font-monospace mb-0">sekawanputrapratama.com</h4>
            </div>
            <span id="resRecordBadge" class="badge bg-primary text-white font-monospace px-3 py-2">TYPE: A</span>
          </div>

          {{-- Result Table --}}
          <div class="table-responsive">
            <table class="table table-hover align-middle border-top">
              <thead class="bg-light font-monospace small">
                <tr>
                  <th scope="col">HOSTNAME</th>
                  <th scope="col">TIPE</th>
                  <th scope="col">TTL</th>
                  <th scope="col">HASIL DATA / IP ADDRESS</th>
                </tr>
              </thead>
              <tbody id="dnsTableBody" class="font-monospace small">
                {{-- Dynamic rows inserted via JS --}}
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
function performDnsLookup(e) {
  e.preventDefault();
  const domain = document.getElementById('domainInput').value.trim().replace(/^https?:\/\//, '').replace(/\/.*$/, '');
  const type = document.getElementById('recordType').value;
  const btn = document.getElementById('btnLookup');
  const resultsCard = document.getElementById('resultsCard');
  const tableBody = document.getElementById('dnsTableBody');

  if (!domain) return;

  btn.disabled = true;
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Pengecekan...';

  fetch(`https://dns.google/resolve?name=${encodeURIComponent(domain)}&type=${type}`)
    .then(res => res.json())
    .then(data => {
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-search me-1"></i> Periksa';
      
      document.getElementById('resDomain').textContent = domain;
      document.getElementById('resRecordBadge').textContent = 'TYPE: ' + type;
      resultsCard.classList.remove('d-none');

      tableBody.innerHTML = '';

      if (data.Answer && data.Answer.length > 0) {
        data.Answer.forEach(ans => {
          const typeName = type;
          const ttl = ans.TTL + 's';
          const dataVal = ans.data;

          const row = document.createElement('tr');
          row.innerHTML = `
            <td><span class="fw-bold text-dark">${domain}</span></td>
            <td><span class="badge bg-info bg-opacity-15 text-info font-monospace">${typeName}</span></td>
            <td><span class="text-muted">${ttl}</span></td>
            <td><code class="text-primary fw-bold">${dataVal}</code></td>
          `;
          tableBody.appendChild(row);
        });
      } else {
        tableBody.innerHTML = `
          <tr>
            <td colspan="4" class="text-center text-muted py-4">
              <i class="fas fa-exclamation-circle text-warning fs-4 d-block mb-2"></i>
              Tidak ditemukan record <strong>${type}</strong> untuk domain <strong>${domain}</strong>.
            </td>
          </tr>
        `;
      }
    })
    .catch(() => {
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-search me-1"></i> Periksa';
      alert('Gagal mengambil data DNS. Pastikan nama domain sudah benar.');
    });
}
</script>
@endpush

@endsection
