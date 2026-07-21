@extends('frontend.layouts.app')

@section('title', $service->meta_title ?: $service->title . ' - PT Sekawan Putra Pratama')
@section('meta_description', $service->meta_description ?: Str::limit($service->description, 160))

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Layanan', 'url' => route('services.index')],
    ['name' => $service->title, 'url' => route('services.show', $service->slug)],
]])

@section('content')

{{-- CSS & DESIGN SYSTEM --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap');

:root {
  --font-lexend: 'Lexend', sans-serif;
  --color-primary: #0891B2;
  --color-secondary: #22D3EE;
  --color-accent: #22C55E;
  --color-navy: #050b14;
  --color-text-main: #0f172a;
  --color-text-muted: #64748b;
  --bg-light: #f8fafc;
}

body { font-family: 'Inter', sans-serif; color: var(--color-text-main); }
h1, h2, h3, h4, h5, h6 { font-family: var(--font-lexend); }

.svc-grad {
  background: linear-gradient(135deg, #60A5FA, #22D3EE, #34D399);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
}

/* HERO SECTION */
.svc-detail-hero {
  position: relative;
  min-height: 50vh;
  background-color: var(--color-navy);
  display: flex;
  align-items: center;
  overflow: hidden;
  padding: 130px 0 70px;
}
.svc-detail-hero-grid {
  position: absolute;
  inset: 0;
  background-image: 
    linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 40px 40px;
  mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
}
.svc-detail-hero-content { position: relative; z-index: 10; width: 100%; }

.svc-badge-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(8, 145, 178, 0.15);
  border: 1px solid rgba(34, 211, 238, 0.3);
  padding: 8px 20px;
  border-radius: 50px;
  color: #22D3EE;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 20px;
}

.svc-meta-badge {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 10px 20px;
  border-radius: 16px;
  color: #e2e8f0;
  font-size: 14px;
  margin-right: 12px;
  margin-top: 10px;
}

/* CONTENT LAYOUT */
.svc-detail-body { padding: 80px 0; background: var(--bg-light); }
.svc-main-card {
  background: #ffffff;
  border-radius: 28px;
  padding: 50px;
  border: 1px solid #e2e8f0;
  box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.feat-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin: 30px 0; }
.feat-box {
  background: #f8fafc;
  border: 1px solid #f1f5f9;
  border-radius: 16px;
  padding: 20px;
  display: flex;
  align-items: flex-start;
  gap: 16px;
  transition: all 0.3s ease;
}
.feat-box:hover { border-color: var(--color-primary); transform: translateY(-3px); box-shadow: 0 10px 25px rgba(8,145,178,0.08); }
.feat-icon {
  width: 42px; height: 42px;
  background: rgba(8, 145, 178, 0.1);
  color: var(--color-primary);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
}

/* TECH BADGES */
.tech-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #f1f5f9;
  color: #334155;
  padding: 8px 18px;
  border-radius: 50px;
  font-size: 13px;
  font-weight: 600;
  margin: 4px;
  border: 1px solid #e2e8f0;
}

/* SIDEBAR STICKY CARD */
.svc-sidebar-card {
  position: sticky;
  top: 100px;
  background: var(--color-navy);
  color: #fff;
  border-radius: 28px;
  padding: 40px 30px;
  box-shadow: 0 20px 40px rgba(5, 11, 20, 0.2);
}

.wa-direct-btn {
  background: #25D366;
  color: #fff !important;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 16px;
  border-radius: 16px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 10px 20px rgba(37, 211, 102, 0.3);
}
.wa-direct-btn:hover { background: #20ba5a; transform: translateY(-3px); }

/* RESPONSIVE */
@media (max-width: 991px) {
  .svc-main-card { padding: 30px; }
  .feat-grid { grid-template-columns: 1fr; }
  .svc-sidebar-card { position: static; margin-top: 40px; }
}
</style>

{{-- HERO --}}
<section class="svc-detail-hero">
  <div class="svc-detail-hero-grid"></div>
  <div class="container position-relative z-index-10">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="svc-badge-pill">
          <i class="{{ $service->icon ?: 'fas fa-cogs' }} me-1"></i> Layanan Profesional
        </div>
        <h1 class="text-white fw-bold display-4 mb-3">
          {{ $service->title }} <br>
          <span class="svc-grad">Sekawan Putra Pratama</span>
        </h1>
        <p class="lead text-light opacity-75 mb-4" style="max-width: 700px;">
          {{ $service->description }}
        </p>
        <div class="d-flex flex-wrap align-items-center">
          @if($service->pricing_starting_from)
            <div class="svc-meta-badge">
              <i class="fas fa-tag text-cyan"></i>
              <span>Mulai <strong>Rp{{ number_format($service->pricing_starting_from, 0, ',', '.') }}</strong></span>
            </div>
          @endif
          @if($service->delivery_time)
            <div class="svc-meta-badge">
              <i class="fas fa-clock text-cyan"></i>
              <span>Estimasi: <strong>{{ $service->delivery_time }}</strong></span>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

{{-- MAIN CONTENT --}}
<section class="svc-detail-body">
  <div class="container">
    <div class="row g-4">
      
      {{-- LEFT COLUMN: DETAIL CONTENT --}}
      <div class="col-lg-8">
        <div class="svc-main-card mb-4">
          
          <h3 class="fw-bold mb-4 text-dark"><i class="fas fa-info-circle text-primary me-2"></i> Gambaran Layanan</h3>
          <div class="text-muted lh-lg mb-5" style="font-size: 1.05rem;">
            @if($service->content)
              {!! $service->content !!}
            @else
              <p>{{ $service->description }}</p>
              <p>Tim ahli kami di PT Sekawan Putra Pratama siap mendampingi seluruh proses dari tahap perencanaan hingga peluncuran sistem untuk memastikan hasil sesuai dengan standar kualitas terbaik.</p>
            @endif
          </div>

          {{-- FEATURES LIST --}}
          @if(!empty($service->features))
            <h4 class="fw-bold mb-3 text-dark"><i class="fas fa-star text-primary me-2"></i> Fitur & Keunggulan Layanan</h4>
            <div class="feat-grid mb-5">
              @foreach($service->features as $feature)
                <div class="feat-box">
                  <div class="feat-icon"><i class="fas fa-check"></i></div>
                  <div>
                    <h6 class="fw-bold text-dark mb-1">{{ $feature }}</h6>
                    <span class="small text-muted">Dirancang untuk keandalan & efisiensi maksimal bisnis Anda.</span>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

          {{-- TECHNOLOGIES STACK --}}
          @if(!empty($service->technologies))
            <h4 class="fw-bold mb-3 text-dark"><i class="fas fa-code text-primary me-2"></i> Teknologi Yang Digunakan</h4>
            <div class="mb-5">
              @foreach($service->technologies as $tech)
                <span class="tech-tag"><i class="fas fa-layer-group text-primary"></i> {{ $tech }}</span>
              @endforeach
            </div>
          @endif

          {{-- WORKFLOW --}}
          <h4 class="fw-bold mb-4 text-dark"><i class="fas fa-tasks text-primary me-2"></i> Alur Pengerjaan Proyek</h4>
          <div class="row g-3 text-center mb-4">
            <div class="col-md-3 col-6">
              <div class="p-3 bg-light rounded-4 border">
                <div class="badge bg-primary rounded-circle mb-2" style="width: 32px; height: 32px; line-height: 24px;">1</div>
                <h6 class="fw-bold text-dark mb-1 small">Konsultasi</h6>
                <span class="text-muted" style="font-size: 11px;">Analisis Kebutuhan</span>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="p-3 bg-light rounded-4 border">
                <div class="badge bg-primary rounded-circle mb-2" style="width: 32px; height: 32px; line-height: 24px;">2</div>
                <h6 class="fw-bold text-dark mb-1 small">Penawaran</h6>
                <span class="text-muted" style="font-size: 11px;">Proposal & MoU</span>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="p-3 bg-light rounded-4 border">
                <div class="badge bg-primary rounded-circle mb-2" style="width: 32px; height: 32px; line-height: 24px;">3</div>
                <h6 class="fw-bold text-dark mb-1 small">Pengembangan</h6>
                <span class="text-muted" style="font-size: 11px;">Agile Sprint & QA</span>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="p-3 bg-light rounded-4 border">
                <div class="badge bg-primary rounded-circle mb-2" style="width: 32px; height: 32px; line-height: 24px;">4</div>
                <h6 class="fw-bold text-dark mb-1 small">Rilis & Garansi</h6>
                <span class="text-muted" style="font-size: 11px;">Deploy & Maintenance</span>
              </div>
            </div>
          </div>

        </div>
      </div>

      {{-- RIGHT COLUMN: STICKY SIDEBAR CTA --}}
      <div class="col-lg-4">
        <div class="svc-sidebar-card">
          <h4 class="fw-bold text-white mb-3">Tertarik dengan Layanan Ini?</h4>
          <p class="text-white-50 small mb-4">
            Diskusikan ide proyek Anda dengan tim IT konsultan kami secara **GRATIS** tanpa komitmen.
          </p>

          @php
            $waMsg = rawurlencode("Halo Tim Sekawan Putra Pratama, saya tertarik untuk berkonsultasi mengenai layanan *" . $service->title . "*. Mohon info lebih lanjut.");
          @endphp

          <a href="https://wa.me/6285156412702?text={{ $waMsg }}" target="_blank" rel="noopener noreferrer" class="wa-direct-btn mb-3">
            <i class="fab fa-whatsapp fa-lg"></i> Chat via WhatsApp
          </a>

          <a href="{{ route('contact') }}" class="btn btn-outline-light w-100 rounded-3 py-3 fw-bold small">
            <i class="fas fa-envelope me-2"></i> Kirim Form Penawaran
          </a>

          <hr class="my-4 border-secondary opacity-25">

          <div class="small text-white-50">
            <div class="d-flex align-items-center gap-2 mb-2">
              <i class="fas fa-shield-alt text-cyan"></i> <span>Garansi Pemeliharaan Sistem</span>
            </div>
            <div class="d-flex align-items-center gap-2 mb-2">
              <i class="fas fa-user-check text-cyan"></i> <span>Dedicated Project Manager</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <i class="fas fa-file-contract text-cyan"></i> <span>Perjanjian Kerahasiaan (NDA)</span>
            </div>
          </div>
        </div>
      </div>

    </div>

    {{-- OTHER SERVICES CAROUSEL / GRID --}}
    @if(isset($relatedServices) && $relatedServices->count() > 0)
      <div class="mt-5 pt-4">
        <h3 class="fw-bold text-dark mb-4 text-center">Layanan Kami Lainnya</h3>
        <div class="row g-4">
          @foreach($relatedServices as $relSvc)
            <div class="col-md-4">
              <div class="bg-white p-4 rounded-4 border h-100 d-flex flex-column transition-all hover-shadow">
                <div class="text-primary mb-3" style="font-size: 28px;">
                  <i class="{{ $relSvc->icon ?: 'fas fa-cube' }}"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">{{ $relSvc->title }}</h5>
                <p class="text-muted small mb-4 flex-grow-1">{{ Str::limit($relSvc->description, 100) }}</p>
                <a href="{{ route('services.show', $relSvc->slug) }}" class="fw-bold text-primary text-decoration-none small">
                  Detail Layanan <i class="fas fa-arrow-right ms-1"></i>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif

  </div>
</section>

@endsection
