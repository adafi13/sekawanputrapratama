@extends('frontend.layouts.app')

@section('title', 'Hubungi Kami - PT Sekawan Putra Pratama')
@section('meta_description', 'Konsultasikan kebutuhan software custom, ERP, server, dan jaringan kantor Anda secara gratis bersama PT Sekawan Putra Pratama Bekasi.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Kontak', 'url' => route('contact')],
]])

@section('content')

{{-- ===== HERO BANNER ===== --}}
<section class="py-5 bg-dark text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #050b14 0%, #0f172a 100%) !important; padding-top: 130px !important;">
  <div class="position-absolute top-0 start-0 w-100 h-100 opacity-20" style="background-image: radial-gradient(rgba(59, 130, 246, 0.2) 1px, transparent 1px); background-size: 36px 36px; pointer-events: none;"></div>
  
  <div class="container text-center position-relative z-2 py-4">
    <span class="badge bg-primary bg-opacity-20 text-info border border-info border-opacity-30 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
      <i class="fas fa-headset me-2"></i> KONSULTASI PROYEK &amp; SUPPORT IT
    </span>
    
    <h1 class="fw-black text-white display-4 mb-3" style="letter-spacing: -1.5px;">
      Mari Bangun Solusi Digital <span class="text-primary">Tepat Guna</span> Bersama Kami
    </h1>
    
    <p class="text-white-50 mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.1rem;">
      Tim ahli PT Sekawan Putra Pratama siap mendiskusikan kebutuhan sistem custom, jaringan server pabrik/kantor, hingga konsultasi IT Anda secara <strong>100% Gratis</strong>.
    </p>
  </div>
</section>

{{-- ===== MAIN CONTACT SECTION ===== --}}
<section class="py-5 bg-light position-relative">
  <div class="container py-4">
    <div class="row g-4 mt-n5 position-relative z-3">

      {{-- ===== LEFT SIDEBAR: Legal & Operational Info ===== --}}
      <div class="col-lg-5 reveal-left">
        <div class="d-flex flex-column gap-4">

          {{-- Direct WhatsApp & Fast Response Card --}}
          <div class="p-4 rounded-4 bg-white border shadow-sm" style="border-color: #e2e8f0 !important; border-left: 5px solid #22c55e !important;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 bg-success bg-opacity-10 text-success p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                  <i class="fab fa-whatsapp fs-4"></i>
                </div>
                <div>
                  <span class="text-muted small d-block font-monospace fw-bold" style="font-size: 11px;">WHATSAPP FAST-RESPONSE</span>
                  <h5 class="fw-bold text-dark mb-0 fs-6">+62 851-5641-2702</h5>
                </div>
              </div>
              <span class="badge bg-success bg-opacity-15 text-success rounded-pill px-3 py-1" style="font-size: 11px;">Respon &lt; 15 Mnt</span>
            </div>
            <p class="text-muted small mb-3" style="line-height: 1.6;">
              Hubungi tim support kami langsung via WhatsApp untuk diskusi cepat, penjadwalan meeting, atau penanganan darurat.
            </p>
            <a href="https://wa.me/6285156412702?text=Halo%20PT%20Sekawan%20Putra%20Pratama,%20saya%20ingin%20konsultasi%20mengenai%20proyek%20IT." target="_blank" class="btn btn-success btn-sm w-100 rounded-pill fw-bold shadow-sm" style="background: #25d366; border-color: #25d366;">
              <i class="fab fa-whatsapp me-2"></i> Chat WhatsApp Sekarang
            </a>
          </div>

          {{-- Email & Location Details --}}
          <div class="p-4 rounded-4 bg-white border shadow-sm" style="border-color: #e2e8f0 !important;">
            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-building text-primary me-2"></i> Kantor Resmi &amp; Legalitas</h5>
            
            <ul class="list-unstyled mb-4 text-muted small d-flex flex-column gap-3" style="font-size: 13px;">
              <li class="d-flex align-items-start gap-3">
                <i class="fas fa-map-marker-alt text-danger mt-1 fs-6"></i>
                <div>
                  <strong class="text-dark d-block">Alamat Resmi PT:</strong>
                  Perum Mega Regency Blok G3 No. 38, RT 002 / RW 020, Sukaragam, Kec. Serang Baru, Kab. Bekasi, Jawa Barat 17330
                  <a href="https://maps.app.goo.gl/CWZgdJDPenuBYPXi9" target="_blank" class="d-inline-block text-primary fw-bold text-decoration-none mt-1">
                    Buka Google Maps <i class="fas fa-external-link-alt ms-1" style="font-size: 10px;"></i>
                  </a>
                </div>
              </li>

              <li class="d-flex align-items-center gap-3 border-top pt-3" style="border-color: #f1f5f9 !important;">
                <i class="fas fa-envelope text-primary fs-6"></i>
                <div>
                  <strong class="text-dark d-block">Email Resmi:</strong>
                  <a href="mailto:sekawanputrapratama@gmail.com" class="text-decoration-none text-dark">sekawanputrapratama@gmail.com</a>
                </div>
              </li>

              <li class="d-flex align-items-center gap-3 border-top pt-3" style="border-color: #f1f5f9 !important;">
                <i class="fas fa-file-contract text-warning fs-6"></i>
                <div>
                  <strong class="text-dark d-block">Verifikasi Legalitas PT:</strong>
                  NIB: <code>0505260088735</code> | NPWP: <code>1000 0000 0948 6824</code>
                </div>
              </li>

              <li class="d-flex align-items-center gap-3 border-top pt-3" style="border-color: #f1f5f9 !important;">
                <i class="fas fa-clock text-info fs-6"></i>
                <div>
                  <strong class="text-dark d-block">Jam Operasional Kantor:</strong>
                  Senin - Sabtu: 08:00 - 17:00 WIB (On-Call SLA 24/7)
                </div>
              </li>
            </ul>

            {{-- Google Maps Embed --}}
            <div class="rounded-3 overflow-hidden border shadow-sm">
              <iframe
                src="https://www.google.com/maps?q=-6.3776515,107.1246921&z=17&output=embed"
                width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy">
              </iframe>
            </div>
          </div>

        </div>
      </div>

      {{-- ===== RIGHT: Authentic Form & B2B FAQ ===== --}}
      <div class="col-lg-7 reveal-right">
        <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm" style="border-color: #e2e8f0 !important;">
          <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom" style="border-color: #f1f5f9 !important;">
            <div class="rounded-3 bg-primary text-white p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
              <i class="fas fa-paper-plane fs-4"></i>
            </div>
            <div>
              <h3 class="fw-bold text-dark mb-0 fs-4">Formulir Konsultasi Proyek</h3>
              <p class="text-muted small mb-0">Isi formulir di bawah ini untuk mendapatkan estimasi penawaran &amp; konsultasi gratis.</p>
            </div>
          </div>

          @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center justify-content-between mb-4">
              <div><i class="fas fa-check-circle me-2"></i> {{ session('success') }}</div>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center justify-content-between mb-4">
              <div><i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}</div>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
            @csrf
            <input type="text" name="website" class="d-none" tabindex="-1" autocomplete="off" value="">

            <div class="row g-3">
              <div class="col-md-6">
                <label for="company_name" class="form-label font-monospace fw-bold small text-muted">NAMA PERUSAHAAN / INSTANSI *</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="fas fa-building text-muted"></i></span>
                  <input type="text" name="company_name" id="company_name" class="form-control bg-light border-start-0 @error('company_name') is-invalid @enderror" placeholder="Contoh: PT Astra Daihatsu Motor" value="{{ old('company_name') }}" required>
                </div>
                @error('company_name')<span class="text-danger small">{{ $message }}</span>@enderror
              </div>

              <div class="col-md-6">
                <label for="name" class="form-label font-monospace fw-bold small text-muted">NAMA PENANGGUNG JAWAB *</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                  <input type="text" name="name" id="name" class="form-control bg-light border-start-0 @error('name') is-invalid @enderror" placeholder="Nama Lengkap Anda" value="{{ old('name') }}" required>
                </div>
                @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
              </div>

              <div class="col-md-6">
                <label for="email" class="form-label font-monospace fw-bold small text-muted">EMAIL BISNIS *</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                  <input type="email" name="email" id="email" class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" placeholder="email@perusahaan.com" value="{{ old('email') }}" required>
                </div>
                @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
              </div>

              <div class="col-md-6">
                <label for="phone" class="form-label font-monospace fw-bold small text-muted">NOMOR WHATSAPP *</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="fab fa-whatsapp text-muted"></i></span>
                  <input type="text" name="phone" id="phone" class="form-control bg-light border-start-0 @error('phone') is-invalid @enderror" placeholder="085156412702" value="{{ old('phone') }}" required>
                </div>
                @error('phone')<span class="text-danger small">{{ $message }}</span>@enderror
              </div>

              <div class="col-12">
                <label for="service" class="form-label font-monospace fw-bold small text-muted">LAYANAN YANG DIBUTUHKAN *</label>
                <select name="service" id="service" class="form-select bg-light @error('service') is-invalid @enderror" required>
                  <option value="" disabled selected>Pilih kategori layanan...</option>
                  <option value="Web Development" {{ old('service')=='Web Development'?'selected':'' }}>🌐 Custom Web Development &amp; Software System</option>
                  <option value="App Development" {{ old('service')=='App Development'?'selected':'' }}>📱 Mobile Application (Android / iOS)</option>
                  <option value="Office Server" {{ old('service')=='Office Server'?'selected':'' }}>🖥️ Server &amp; Network Infrastructure / CCTV Pabrik</option>
                  <option value="Konsultasi" {{ old('service')=='Konsultasi'?'selected':'' }}>💡 Managed IT Services &amp; Audit Sistem</option>
                </select>
                @error('service')<span class="text-danger small">{{ $message }}</span>@enderror
              </div>

              <div class="col-12">
                <label for="message" class="form-label font-monospace fw-bold small text-muted">DETAIL RINGKAS PROYEK / PERTANYAAN *</label>
                <textarea name="message" id="message" rows="4" class="form-control bg-light @error('message') is-invalid @enderror" placeholder="Jelaskan secara singkat alur kebutuhan sistem atau masalah infrastruktur IT Anda..." required>{{ old('message') }}</textarea>
                @error('message')<span class="text-danger small">{{ $message }}</span>@enderror
              </div>

              <div class="col-12 pt-2">
                <button type="submit" id="submitBtn" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow-sm py-3">
                  <span class="ctc-btn-text"><i class="fas fa-paper-plane me-2"></i> Kirim Pesan &amp; Ajukan Konsultasi</span>
                  <span class="ctc-btn-loading d-none">
                    <span class="spinner-border spinner-border-sm me-2"></span> Mengirim...
                  </span>
                </button>
                <p class="text-muted text-center small mt-3 mb-0">
                  <i class="fas fa-shield-alt text-success me-1"></i> Data Anda dijamin aman &amp; dilindungi NDA. Balasan maksimal dalam <strong>1x24 Jam Kerja</strong>.
                </p>
              </div>
            </div>
          </form>
        </div>

        {{-- B2B FAQ Accordion Block --}}
        <div class="p-4 rounded-4 bg-white border shadow-sm mt-4" style="border-color: #e2e8f0 !important;">
          <h5 class="fw-bold text-dark mb-3"><i class="fas fa-question-circle text-primary me-2"></i> Pertanyaan Sering Diajukan (FAQ B2B)</h5>
          
          <div class="accordion accordion-flush" id="contactFaq">
            <div class="accordion-item border-bottom">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                  1. Apakah konsultasi proyek awal berbayar?
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                <div class="accordion-body text-muted small">
                  <strong>Sama sekali tidak berbayar (100% Gratis).</strong> Tim konsultan teknis PT Sekawan Putra Pratama siap melakukan analisa kebutuhan awal dan memberikan opsi arsitektur sistem secara cuma-cuma.
                </div>
              </div>
            </div>

            <div class="accordion-item border-bottom">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                  2. Apakah PT Sekawan Putra Pratama bersedia menandatangani NDA?
                </button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                <div class="accordion-body text-muted small">
                  <strong>Ya, tentu.</strong> Kami sangat menghargai privasi dan kerahasiaan ide serta data bisnis Anda. Kami siap menandatangani Non-Disclosure Agreement (NDA) sebelum pembahasan teknis dilakukan.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                  3. Apakah melayani kunjungan meeting ke lokasi kantor/pabrik?
                </button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#contactFaq">
                <div class="accordion-body text-muted small">
                  <strong>Ya, melayani.</strong> Tim engineer kami siap hadir untuk survei lokasi dan meeting tatap muka bagi wilayah kawasan industri Bekasi (Cikarang, MM2100, Jababeka), Karawang, serta Jabodetabek.
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
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('contactForm');
  const btn  = document.getElementById('submitBtn');
  if (form && btn) {
    form.addEventListener('submit', function () {
      btn.disabled = true;
      btn.querySelector('.ctc-btn-text').classList.add('d-none');
      btn.querySelector('.ctc-btn-loading').classList.remove('d-none');
    });
  }
});
</script>
@endpush

@endsection