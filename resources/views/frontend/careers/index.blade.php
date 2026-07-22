@extends('frontend.layouts.app')

@section('title', 'Karir & Kesempatan Bergabung - PT Sekawan Putra Pratama')
@section('meta_description', 'Bergabunglah bersama tim developer & IT consultant PT Sekawan Putra Pratama. Temukan lowongan kerja Fullstack, Mobile App, UI/UX, dan DevOps Engineer!')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Karir', 'url' => route('careers.index')],
]])

@section('content')

{{-- HERO HEADER --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 65px !important;">
  <div class="container text-center position-relative z-2">
    <div class="d-inline-flex align-items-center gap-2 text-primary fw-bold text-uppercase mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
      <span class="d-inline-block bg-primary rounded-circle" style="width: 6px; height: 6px;"></span>
      REKRUTMEN &amp; TALENTA IT SEKAWAN
    </div>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Mari Bangun Masa Depan <span class="text-primary">Teknologi Bersama Kami</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-4" style="max-width: 720px; font-size: 1.05rem;">
      Bergabunglah bersama tim Software Engineer, System Architect, dan DevOps di PT Sekawan Putra Pratama untuk merancang solusi digital berkinerja tinggi.
    </p>

    <div class="d-flex flex-wrap justify-content-center gap-3">
      <a href="#active-jobs" class="btn btn-primary rounded-pill px-4 py-2.5 fw-bold shadow-sm" style="font-size: 13px;">
        <i class="fas fa-briefcase me-2"></i> Lihat Lowongan Aktif
      </a>
      <button type="button" class="btn btn-outline-primary rounded-pill px-4 py-2.5 fw-bold" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#spontaneousModal" data-toggle="modal" data-target="#spontaneousModal" onclick="openSpontaneousModal()">
        <i class="fas fa-paper-plane me-2"></i> Kirim CV Spontan
      </button>
    </div>
  </div>
</section>

{{-- ALERT FEEDBACK NOTIFICATION --}}
@if(session('success'))
<section class="py-3 bg-success bg-opacity-10 border-bottom">
  <div class="container">
    <div class="alert alert-success border-0 mb-0 d-flex align-items-center gap-3">
      <i class="fas fa-check-circle fs-4 text-success"></i>
      <div>
        <strong class="d-block text-dark">{{ session('success') }}</strong>
        <span class="small text-muted">Berkas Anda telah tersimpan secara aman di sistem Superadmin kami.</span>
      </div>
    </div>
  </div>
</section>
@endif

{{-- BENEFITS & FACILITIES (Modern Bento Grid Style) --}}
<section class="py-5 bg-white">
  <div class="container py-3">
    <div class="text-center mb-5">
      <div class="d-inline-flex align-items-center gap-2 text-primary fw-bold text-uppercase mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
        <span class="d-inline-block bg-primary rounded-circle" style="width: 6px; height: 6px;"></span>
        BENEFIT &amp; FASILITAS TIM
      </div>
      <h2 class="fw-bold text-dark fs-2 mb-2">Mengapa Bergabung Bersama Kami?</h2>
      <p class="text-muted mx-auto" style="max-width: 620px; font-size: 0.95rem;">
        Kami memberikan apresiasi terbaik bagi para talenta IT melalui lingkungan kerja profesional dan fasilitas lengkap.
      </p>
    </div>

    {{-- Bento Grid Cards --}}
    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 rounded-4 bg-light border h-100 shadow-sm transition-all" style="border-color: #e2e8f0 !important;">
          <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
            <i class="fas fa-wallet fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Gaji Kompetitif &amp; BPJS</h5>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Paket kompensasi kompetitif sesuai pengalaman, bonus kinerja tahunan, serta jaminan BPJS Kesehatan &amp; Ketenagakerjaan lengkap.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded-4 bg-light border h-100 shadow-sm transition-all" style="border-color: #e2e8f0 !important;">
          <div class="rounded-circle bg-info bg-opacity-10 text-info p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
            <i class="fas fa-laptop-house fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Fleksibilitas Hybrid / Remote</h5>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Dukungan ritme kerja fleksibel (*result-oriented*) yang mengutamakan keseimbangan hidup dan kenyamanan berkarya.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded-4 bg-light border h-100 shadow-sm transition-all" style="border-color: #e2e8f0 !important;">
          <div class="rounded-circle bg-success bg-opacity-10 text-success p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
            <i class="fas fa-graduation-cap fs-4"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Budget Sertifikasi IT</h5>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Dukungan dana pelatihan, ujian sertifikasi internasional (AWS, Laravel, Cloud), dan bimbingan mentor senior.</p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="p-4 rounded-4 bg-light border h-100 shadow-sm transition-all" style="border-color: #e2e8f0 !important;">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-3 d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px; flex-shrink: 0;">
              <i class="fas fa-microchip fs-4"></i>
            </div>
            <div>
              <h5 class="fw-bold text-dark mb-0">Perangkat Kerja Performance Tinggi</h5>
              <span class="text-muted small">Laptop Workstation &amp; Cloud Environment Dedicated</span>
            </div>
          </div>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Fasilitas perangkat kerja laptop spesifikasi tinggi, monitor tambahan, dan akses cloud environment berkecepatan tinggi untuk menunjang produktivitas koding.</p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="p-4 rounded-4 bg-light border h-100 shadow-sm transition-all" style="border-color: #e2e8f0 !important;">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-circle bg-danger bg-opacity-10 text-danger p-3 d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px; flex-shrink: 0;">
              <i class="fas fa-users-cog fs-4"></i>
            </div>
            <div>
              <h5 class="fw-bold text-dark mb-0">Kultur Tanpa Senioritas Kaku</h5>
              <span class="text-muted small">Transparansi, Kolaboratif &amp; Open Communication</span>
            </div>
          </div>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Budaya komunikasi terbuka di mana setiap ide di hargai, kolaborasi antartim yang hangat, dan atmosfer kerja yang egaliter tanpa hirarki kaku.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- RECRUITMENT PROCESS STEPPER (4-Step Transparent Roadmap) --}}
<section class="py-5 bg-light border-top border-bottom">
  <div class="container py-3">
    <div class="text-center mb-5">
      <div class="d-inline-flex align-items-center gap-2 text-primary fw-bold text-uppercase mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
        <span class="d-inline-block bg-primary rounded-circle" style="width: 6px; height: 6px;"></span>
        ALUR REKRUTMEN TRANSPARAN
      </div>
      <h2 class="fw-bold text-dark fs-2 mb-2">4 Tahap Seleksi Bergabung</h2>
      <p class="text-muted mx-auto" style="max-width: 620px; font-size: 0.95rem;">
        Proses rekrutmen kami dirancang cepat, transparan, dan menghargai waktu para talenta pelamar.
      </p>
    </div>

    <div class="row g-4 text-center">
      {{-- Step 1 --}}
      <div class="col-md-3">
        <div class="p-4 bg-white rounded-4 border shadow-sm h-100 position-relative" style="border-color: #e2e8f0 !important;">
          <span class="badge bg-primary text-white rounded-circle fs-6 mb-3 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">1</span>
          <h6 class="fw-bold text-dark mb-2">Review Berkas &amp; CV</h6>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Tim HR meninjau resume &amp; portofolio Anda dalam 1 - 3 hari kerja.</p>
        </div>
      </div>

      {{-- Step 2 --}}
      <div class="col-md-3">
        <div class="p-4 bg-white rounded-4 border shadow-sm h-100 position-relative" style="border-color: #e2e8f0 !important;">
          <span class="badge bg-info text-white rounded-circle fs-6 mb-3 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">2</span>
          <h6 class="fw-bold text-dark mb-2">Wawancara Teknis</h6>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Diskusi santai mengenai pengalaman koding dan kultur kerja (Online/On-site).</p>
        </div>
      </div>

      {{-- Step 3 --}}
      <div class="col-md-3">
        <div class="p-4 bg-white rounded-4 border shadow-sm h-100 position-relative" style="border-color: #e2e8f0 !important;">
          <span class="badge bg-warning text-dark rounded-circle fs-6 mb-3 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">3</span>
          <h6 class="fw-bold text-dark mb-2">Coding Challenge</h6>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Studi kasus nyata sesuai keahlian posisi yang Anda lamar.</p>
        </div>
      </div>

      {{-- Step 4 --}}
      <div class="col-md-3">
        <div class="p-4 bg-white rounded-4 border shadow-sm h-100 position-relative" style="border-color: #e2e8f0 !important;">
          <span class="badge bg-success text-white rounded-circle fs-6 mb-3 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">4</span>
          <h6 class="fw-bold text-dark mb-2">Offering &amp; Onboarding</h6>
          <p class="text-muted small mb-0" style="line-height: 1.6;">Penawaran resmi (Offering Letter) dan integrasi bersama tim Sekawan.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- OPEN POSITIONS LIST --}}
<section class="py-5 bg-white" id="active-jobs">
  <div class="container py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <div class="d-inline-flex align-items-center gap-2 text-primary fw-bold text-uppercase mb-1" style="letter-spacing: 1.5px; font-size: 11px;">
          <span class="d-inline-block bg-primary rounded-circle" style="width: 6px; height: 6px;"></span>
          POSISI TERBUKA SAAT INI
        </div>
        <h3 class="fw-bold text-dark mb-0 fs-3">Lowongan Karir Aktif</h3>
      </div>
      <span class="badge bg-primary text-white font-monospace px-3 py-2 fw-bold rounded-pill" style="font-size: 12px;">{{ count($jobs) }} POSISI AKTIF</span>
    </div>

    <div class="row g-4">
      @forelse($jobs as $job)
        <div class="col-lg-6">
          <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between" style="border-color: #e2e8f0 !important; transition: all 0.3s ease;">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-3">
                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-1.5 rounded-pill" style="font-size: 11px;">{{ $job->department }}</span>
                <span class="badge bg-light text-dark border px-3 py-1.5 rounded-pill" style="font-size: 11px;">{{ $job->type }}</span>
              </div>

              <h4 class="fw-bold text-dark mb-2 fs-5">{{ $job->title }}</h4>
              <p class="text-muted small mb-4" style="line-height: 1.6;">{{ $job->description }}</p>

              <div class="d-flex flex-wrap gap-3 small text-muted mb-4 pt-3 border-top" style="border-color: #f1f5f9 !important;">
                <span><i class="fas fa-map-marker-alt text-primary me-1"></i> {{ $job->location }}</span>
                <span><i class="fas fa-user-clock text-primary me-1"></i> {{ $job->experience }}</span>
              </div>
            </div>

            <div class="text-end">
              <a href="{{ route('careers.show', $job->slug) }}" class="btn btn-primary rounded-pill px-4 py-2.5 fw-bold shadow-sm" style="font-size: 13px;">
                Detail &amp; Lamar Posisi <i class="fas fa-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="bg-white p-5 rounded-4 border text-center shadow-sm" style="border-color: #e2e8f0 !important;">
            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-briefcase text-muted fs-3"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">Belum Ada Lowongan Khusus yang Dibuka</h5>
            <p class="text-muted small mb-4" style="max-width: 540px; margin: 0 auto;">Saat ini belum ada posisi lowongan spesifik yang dibuka. Namun kami selalu terbuka menerima CV dan portofolio Anda secara langsung!</p>
            
            <button type="button" class="btn btn-primary rounded-pill px-4 py-2.5 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#spontaneousModal" data-toggle="modal" data-target="#spontaneousModal" onclick="openSpontaneousModal()">
              <i class="fas fa-paper-plane me-2"></i> Kirim CV Spontan ke Superadmin
            </button>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- MODAL FORM SPONTANEOUS APPLY (CONNECTED TO SUPERADMIN FILAMENT DB) --}}
<div class="modal fade" id="spontaneousModal" tabindex="-1" aria-labelledby="spontaneousModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <div class="modal-header border-bottom p-4">
        <div>
          <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-1 rounded-pill mb-1" style="font-size: 11px;">OPEN APPLICATION</span>
          <h5 class="modal-title fw-bold text-dark" id="spontaneousModalLabel">Formulir Kirim CV Spontan</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeSpontaneousModal()"></button>
      </div>

      <form action="{{ route('careers.apply-spontaneous') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4">
          <p class="text-muted small mb-4">CV dan berkas Anda akan langsung terkirim ke **Panel Superadmin HR PT Sekawan Putra Pratama** untuk diproses saat posisi yang sesuai dibuka.</p>

          <div class="row g-3">
            <div class="col-md-6">
              <label for="spontName" class="form-label font-monospace fw-bold small text-muted">NAMA LENGKAP *</label>
              <input type="text" id="spontName" name="name" class="form-control bg-light" placeholder="Masukkan nama Anda" required>
            </div>

            <div class="col-md-6">
              <label for="spontEmail" class="form-label font-monospace fw-bold small text-muted">EMAIL AKTIF *</label>
              <input type="email" id="spontEmail" name="email" class="form-control bg-light" placeholder="email@domain.com" required>
            </div>

            <div class="col-md-6">
              <label for="spontPhone" class="form-label font-monospace fw-bold small text-muted">NOMOR HP / WHATSAPP *</label>
              <input type="text" id="spontPhone" name="phone" class="form-control bg-light" placeholder="081234567890" required>
            </div>

            <div class="col-md-6">
              <label for="spontPortfolio" class="form-label font-monospace fw-bold small text-muted">LINK PORTOFOLIO / GITHUB / LINKEDIN</label>
              <input type="url" id="spontPortfolio" name="portfolio_link" class="form-control bg-light" placeholder="https://github.com/username">
            </div>

            <div class="col-12">
              <label for="spontResume" class="form-label font-monospace fw-bold small text-muted">FILE RESUME / CV (PDF MAX 5MB) *</label>
              <input type="file" id="spontResume" name="resume" class="form-control bg-light" accept=".pdf" required>
            </div>

            <div class="col-12">
              <label for="spontCover" class="form-label font-monospace fw-bold small text-muted">MINAT POSISI &amp; CATATAN SINGKAT</label>
              <textarea id="spontCover" name="cover_letter" class="form-control bg-light" rows="3" placeholder="Sebutkan minat keahlian Anda (misal: Fullstack Developer / UI UX Designer)..."></textarea>
            </div>
          </div>
        </div>

        <div class="modal-footer border-top p-4">
          <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal" onclick="closeSpontaneousModal()">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
            <i class="fas fa-paper-plane me-1"></i> Kirim CV ke Superadmin
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

@push('styles')
<style>
  #spontaneousModal {
    z-index: 100005 !important;
  }
  #spontaneousModal .modal-dialog {
    z-index: 100006 !important;
    position: relative !important;
  }
  .modal-backdrop {
    z-index: 100000 !important;
  }
</style>
@endpush

@push('scripts')
<script>
function openSpontaneousModal() {
  const modalEl = document.getElementById('spontaneousModal');
  if (!modalEl) return;

  // Move modal to body to prevent stacking context trap
  if (modalEl.parentElement !== document.body) {
    document.body.appendChild(modalEl);
  }

  // Force high z-index and display
  modalEl.style.zIndex = '100005';
  modalEl.style.display = 'block';
  modalEl.classList.add('show');
  modalEl.removeAttribute('aria-hidden');
  modalEl.setAttribute('aria-modal', 'true');
  document.body.classList.add('modal-open');

  let backdrop = document.querySelector('.modal-backdrop');
  if (!backdrop) {
    backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.style.zIndex = '100000';
    document.body.appendChild(backdrop);
  }

  // Try Bootstrap 5 & jQuery JS if available
  if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
    try {
      const bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
      bsModal.show();
    } catch(e) {}
  } else if (typeof $ !== 'undefined' && $.fn && $.fn.modal) {
    try { $(modalEl).modal('show'); } catch(e) {}
  }
}

function closeSpontaneousModal() {
  const modalEl = document.getElementById('spontaneousModal');
  if (!modalEl) return;

  if (typeof $ !== 'undefined' && $.fn && $.fn.modal) {
    try { $(modalEl).modal('hide'); } catch(e) {}
  }

  modalEl.classList.remove('show');
  modalEl.style.display = 'none';
  modalEl.setAttribute('aria-hidden', 'true');
  document.body.classList.remove('modal-open');

  const backdrop = document.querySelectorAll('.modal-backdrop');
  backdrop.forEach(b => b.remove());
}
</script>
@endpush

@endsection
