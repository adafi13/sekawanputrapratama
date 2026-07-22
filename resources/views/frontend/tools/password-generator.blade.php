@extends('frontend.layouts.app')

@section('title', 'Generator Password & Hash Siber - Tool Keamanan IT - PT Sekawan Putra Pratama')
@section('meta_description', 'Buat kata sandi terenkripsi tingkat tinggi dan hasilkan Hash SHA-256 / MD5 secara aman untuk kebutuhan admin IT dan keamanan aplikasi.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'Generator Password & Hash', 'url' => route('tools.password-generator')],
]])

@section('content')

{{-- HERO HEADER --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 65px !important;">
  <div class="container text-center position-relative z-2">
    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
      <i class="fas fa-shield-alt me-2"></i> TOOL KEAMANAN SIBER &amp; ENKRIPSI
    </span>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Generator Password &amp; <span class="text-primary">Hash Enkripsi</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      Hasilkan kata sandi kuat acak (cryptographically secure) dan konversikan teks ke Hash SHA-256 untuk keamanan database &amp; akun administrator Anda.
    </p>
  </div>
</section>

{{-- MAIN TOOL SECTION --}}
<section class="py-5 bg-light position-relative">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        
        <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm mb-4" style="border-color: #e2e8f0 !important;">
          
          {{-- Generated Output Display --}}
          <div class="mb-4 text-center">
            <label class="form-label font-monospace fw-bold small text-muted">KATA SANDI TERGENERATE</label>
            <div class="input-group input-group-lg">
              <input type="text" id="passOutput" class="form-control font-monospace fw-bold text-center bg-light text-primary fs-4" readonly style="letter-spacing: 2px;">
              <button class="btn btn-primary px-4 fw-bold" onclick="copyPassword()"><i class="fas fa-copy me-1"></i> Salin</button>
            </div>
            <span id="copyNotice" class="text-success small fw-bold font-monospace mt-2 d-none"><i class="fas fa-check me-1"></i> Kata sandi berhasil disalin ke clipboard!</span>
          </div>

          {{-- Password Controls --}}
          <div class="border-top pt-4 mt-4">
            <div class="mb-3">
              <div class="d-flex justify-content-between font-monospace small mb-2">
                <span class="fw-bold text-muted">PANJANG KATA SANDI:</span>
                <span id="lengthVal" class="fw-bold text-primary">16 Karakter</span>
              </div>
              <input type="range" class="form-range" id="passLength" min="8" max="64" value="16" oninput="updateLength(this.value)">
            </div>

            <div class="row g-3 font-monospace small mb-4">
              <div class="col-6 col-md-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="chkUpper" checked onchange="generatePass()">
                  <label class="form-check-label text-dark fw-bold" for="chkUpper">ABC (Kapital)</label>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="chkLower" checked onchange="generatePass()">
                  <label class="form-check-label text-dark fw-bold" for="chkLower">abc (Kecil)</label>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="chkNum" checked onchange="generatePass()">
                  <label class="form-check-label text-dark fw-bold" for="chkNum">123 (Angka)</label>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="chkSym" checked onchange="generatePass()">
                  <label class="form-check-label text-dark fw-bold" for="chkSym">!@# (Simbol)</label>
                </div>
              </div>
            </div>

            <button class="btn btn-outline-primary w-100 rounded-pill fw-bold py-3" onclick="generatePass()">
              <i class="fas fa-sync-alt me-2"></i> ACAK KATA SANDI BARU
            </button>
          </div>

          {{-- SHA-256 Hash Converter Section --}}
          <div class="border-top pt-4 mt-5">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-lock text-warning me-2"></i> Convert Teks ke Hash SHA-256</h5>
            <div class="mb-3">
              <input type="text" id="hashInput" class="form-control bg-light font-monospace" placeholder="Ketik teks untuk di-hash..." oninput="computeHash(this.value)">
            </div>
            <div>
              <span class="text-muted small font-monospace d-block mb-1">RESULT HASIL SHA-256:</span>
              <code id="hashOutput" class="d-block p-3 bg-light border rounded text-dark font-monospace text-break" style="font-size: 12px;">--</code>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
function updateLength(val) {
  document.getElementById('lengthVal').textContent = val + ' Karakter';
  generatePass();
}

function generatePass() {
  const len = parseInt(document.getElementById('passLength').value);
  const useUpper = document.getElementById('chkUpper').checked;
  const useLower = document.getElementById('chkLower').checked;
  const useNum = document.getElementById('chkNum').checked;
  const useSym = document.getElementById('chkSym').checked;

  let chars = '';
  if (useUpper) chars += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  if (useLower) chars += 'abcdefghijklmnopqrstuvwxyz';
  if (useNum) chars += '0123456789';
  if (useSym) chars += '!@#$%^&*()_+-=[]{}|;:,.<>?';

  if (!chars) {
    document.getElementById('passOutput').value = 'Pilih minimal 1 karakter';
    return;
  }

  let res = '';
  const array = new Uint32Array(len);
  window.crypto.getRandomValues(array);
  for (let i = 0; i < len; i++) {
    res += chars[array[i] % chars.length];
  }

  document.getElementById('passOutput').value = res;
  computeHash(res);
}

function copyPassword() {
  const pass = document.getElementById('passOutput').value;
  if (!pass) return;
  navigator.clipboard.writeText(pass);
  
  const notice = document.getElementById('copyNotice');
  notice.classList.remove('d-none');
  setTimeout(() => notice.classList.add('d-none'), 3000);
}

async function computeHash(text) {
  if (!text) {
    document.getElementById('hashOutput').textContent = '--';
    return;
  }
  const encoder = new TextEncoder();
  const data = encoder.encode(text);
  const hashBuffer = await crypto.subtle.digest('SHA-256', data);
  const hashArray = Array.from(new Uint8Array(hashBuffer));
  const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
  document.getElementById('hashOutput').textContent = hashHex;
}

document.addEventListener('DOMContentLoaded', generatePass);
</script>
@endpush

@endsection
