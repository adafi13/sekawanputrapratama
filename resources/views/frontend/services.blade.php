@extends('frontend.layouts.app')

@section('title', 'Layanan Kami - PT Sekawan Putra Pratama')
@section('meta_description', 'Layanan IT profesional: Web Development, App Development, dan Infrastruktur Server & Jaringan untuk bisnis Anda.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Layanan', 'url' => route('services.index')],
]])

@section('content')

{{-- CSS & DESIGN SYSTEM (UI-UX-PRO-MAX) --}}
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

/* ---- HERO SECTION ---- */
.svc-hero {
  position: relative;
  min-height: 60vh;
  background-color: var(--color-navy);
  display: flex;
  align-items: center;
  overflow: hidden;
  padding: 120px 0 80px;
}
.svc-hero-grid {
  position: absolute;
  inset: 0;
  background-image: 
    linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 50px 50px;
  mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
}
.svc-hero-content { position: relative; z-index: 10; text-align: center; width: 100%; }
.svc-hero-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(8, 145, 178, 0.1);
  border: 1px solid rgba(8, 145, 178, 0.3);
  padding: 8px 20px;
  border-radius: 50px;
  color: #22D3EE;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 24px;
}
.svc-hero-title {
  font-size: clamp(2.5rem, 6vw, 4.5rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.1;
  margin-bottom: 24px;
  letter-spacing: -2px;
}
.svc-hero-sub {
  color: #94a3b8;
  font-size: 1.2rem;
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.6;
}

/* ---- SERVICES GRID ---- */
.svc-body { padding: 120px 0; background: #fff; }
.svc-card {
  background: #fff;
  border-radius: 40px;
  border: 1px solid #f1f5f9;
  padding: 80px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
  margin-bottom: 80px;
  transition: all 0.4s ease;
  box-shadow: 0 10px 40px rgba(0,0,0,0.02);
}
.svc-card:hover { border-color: var(--color-secondary); transform: translateY(-10px); box-shadow: 0 40px 80px -20px rgba(0,0,0,0.1); }
.svc-card-rev { grid-template-columns: 1fr 1fr; }
.svc-card-rev .svc-info { order: 2; }
.svc-card-rev .svc-visual { order: 1; }

.svc-visual { position: relative; }
.svc-img-main { width: 100%; border-radius: 30px; box-shadow: 0 30px 60px rgba(0,0,0,0.1); }
.svc-float-badge {
  position: absolute;
  top: -20px; right: -20px;
  width: 80px; height: 80px;
  background: var(--color-primary);
  border-radius: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 32px;
  box-shadow: 0 15px 30px rgba(8, 145, 178, 0.3);
}

.svc-info .label { color: var(--color-primary); font-weight: 800; text-transform: uppercase; letter-spacing: 3px; font-size: 11px; display: block; margin-bottom: 12px; }
.svc-info h2 { font-size: 3rem; font-weight: 800; color: var(--color-text-main); margin-bottom: 24px; letter-spacing: -1.5px; }
.svc-info p { font-size: 1.1rem; color: var(--color-text-muted); line-height: 1.8; margin-bottom: 32px; }

.feat-list { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px; }
.feat-item { display: flex; align-items: flex-start; gap: 12px; }
.feat-item i { color: var(--color-accent); font-size: 18px; margin-top: 4px; }
.feat-item span { font-weight: 600; font-size: 15px; color: var(--color-text-main); }

.svc-btn-outline {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  padding: 16px 36px;
  border-radius: 50px;
  border: 2px solid var(--color-primary);
  color: var(--color-primary);
  font-weight: 700;
  text-decoration: none;
  transition: all 0.3s ease;
}
.svc-btn-outline:hover { background: var(--color-primary); color: #fff; transform: translateX(10px); }

/* ---- WORKFLOW ---- */
.svc-wf { padding: 100px 0; background: var(--bg-light); }
.wf-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; position: relative; }
.wf-grid::before {
  content: '';
  position: absolute;
  top: 45px; left: 10%; right: 10%;
  height: 2px;
  background: dashed #e2e8f0;
  z-index: 0;
}
.wf-card { background: #fff; padding: 40px 30px; border-radius: 24px; text-align: center; position: relative; z-index: 1; border: 1px solid #e2e8f0; transition: all 0.3s ease; }
.wf-card:hover { transform: translateY(-10px); border-color: var(--color-primary); }
.wf-num {
  width: 60px; height: 60px;
  background: var(--color-navy);
  color: #fff;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 20px;
  margin: 0 auto 24px;
}
.wf-card h4 { font-size: 1.25rem; font-weight: 700; margin-bottom: 12px; }
.wf-card p { font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin: 0; }

/* ---- CTA ---- */
.svc-cta { padding: 100px 0; }
.cta-box { background: var(--color-navy); border-radius: 40px; padding: 80px 40px; text-align: center; position: relative; overflow: hidden; }
.cta-title { font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: #fff; margin-bottom: 24px; position: relative; z-index: 2; }
.cta-btn { display: inline-flex; align-items: center; gap: 12px; background: #fff; color: var(--color-navy); padding: 18px 40px; border-radius: 50px; font-weight: 700; font-size: 1.1rem; transition: all 0.3s ease; text-decoration: none; position: relative; z-index: 2; }
.cta-btn:hover { background: var(--color-secondary); transform: scale(1.05); }

/* ---- RESPONSIVE ---- */
@media (max-width: 1200px) {
  .svc-card { padding: 60px; gap: 40px; }
}
@media (max-width: 991px) {
  .svc-card, .svc-card-rev { grid-template-columns: 1fr; gap: 40px; padding: 40px; text-align: center; }
  .svc-card-rev .svc-info { order: 1; }
  .svc-card-rev .svc-visual { order: 2; }
  .feat-list { grid-template-columns: 1fr; }
  .feat-item { justify-content: center; }
  .wf-grid { grid-template-columns: 1fr 1fr; }
  .wf-grid::before { display: none; }
  .svc-hero { min-height: auto; padding: 120px 0 60px; }
  .svc-body, .svc-wf { padding: 60px 0; }
}
@media (max-width: 768px) {
  .svc-hero-title { font-size: 3rem; }
  .svc-info h2 { font-size: 2.2rem; }
  .wf-grid { grid-template-columns: 1fr; }
  .svc-card { margin-bottom: 40px; }
}
</style>

{{-- HERO --}}
<section class="svc-hero">
  <div class="svc-hero-grid"></div>
  <div class="container">
    <div class="svc-hero-content">
      <div class="svc-hero-pill reveal">
        <i class="fas fa-microchip me-2"></i> KEAHLIAN TEKNOLOGI KAMI
      </div>
      <h1 class="svc-hero-title reveal delay-100">
        Teknologi Andal untuk <br>
        <span class="svc-grad">Pertumbuhan Bisnis</span>
      </h1>
      <p class="svc-hero-sub reveal delay-200">
        Kami menyediakan spektrum penuh layanan teknologi yang dirancang untuk membantu bisnis Anda berkembang, mengotomatisasi proses, dan mengamankan masa depan digital Anda.
      </p>
    </div>
  </div>
</section>

{{-- SERVICES BODY --}}
<section class="svc-body">
  <div class="container">

    @php
      $badgeColors = ['#0891B2', '#6366F1', '#0EA5E9', '#22C55E', '#F59E0B'];
      $fallbackImages = ['web-development.webp', 'app-development.webp', 'office-server.webp'];
    @endphp

    @forelse($services as $service)
    <div class="svc-card reveal {{ $loop->iteration % 2 === 0 ? 'svc-card-rev' : '' }}">
      <div class="svc-info">
        <span class="label">
          @if($service->pricing_starting_from)
            MULAI Rp{{ number_format($service->pricing_starting_from, 0, ',', '.') }}
          @endif
          @if($service->delivery_time)
            &bull; {{ $service->delivery_time }}
          @endif
        </span>
        <h2>{{ $service->title }}</h2>
        <p>{{ $service->description }}</p>
        @if(!empty($service->features))
        <div class="feat-list">
          @foreach($service->features as $feature)
          <div class="feat-item"><i class="fas fa-check-circle"></i> <span>{{ $feature }}</span></div>
          @endforeach
        </div>
        @endif
        <a href="{{ route('contact') }}" class="svc-btn-outline">
          Konsultasi Sekarang <i class="fas fa-arrow-right"></i>
        </a>
      </div>
      <div class="svc-visual">
        @php
          $svcImg = $service->getFirstMediaUrl('images') ?: asset('assets/media/images/' . ($fallbackImages[$loop->index] ?? 'portfolio-placeholder.webp'));
        @endphp
        <img src="{{ $svcImg }}" alt="{{ $service->title }}" class="svc-img-main" loading="lazy">
        <div class="svc-float-badge" style="background: {{ $badgeColors[$loop->index % count($badgeColors)] }};">
          <i class="{{ $service->icon ?: 'fas fa-cogs' }}"></i>
        </div>
      </div>
    </div>
    @empty
    <div class="text-center py-5">
      <p class="text-muted">Belum ada layanan yang ditampilkan.</p>
    </div>
    @endforelse

  </div>
</section>

{{-- WORKFLOW --}}
<section class="svc-wf">
  <div class="container">
    <div class="text-center mb-5 reveal">
      <span class="svc-hero-pill mb-3" style="background: rgba(8, 145, 178, 0.05); color: var(--color-primary);">CARA KERJA</span>
      <h2>Proses Kerja Kami</h2>
    </div>
    
    <div class="wf-grid">
      <div class="wf-card reveal delay-100">
        <div class="wf-num">01</div>
        <h4>Discovery</h4>
        <p>Konsultasi mendalam untuk memahami tantangan dan tujuan bisnis Anda.</p>
      </div>
      <div class="wf-card reveal delay-200">
        <div class="wf-num">02</div>
        <h4>Planning</h4>
        <p>Penyusunan arsitektur sistem dan desain UI/UX yang berpusat pada pengguna.</p>
      </div>
      <div class="wf-card reveal delay-300">
        <div class="wf-num">03</div>
        <h4>Execution</h4>
        <p>Proses pengembangan yang lincah (Agile) dengan pengujian berkelanjutan.</p>
      </div>
      <div class="wf-card reveal delay-400">
        <div class="wf-num">04</div>
        <h4>Support</h4>
        <p>Peluncuran produk dan dukungan pemeliharaan jangka panjang.</p>
      </div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="svc-cta container mb-5">
  <div class="cta-box reveal">
    <h2 class="cta-title">Butuh Solusi Teknologi <br> yang Tepat?</h2>
    <p class="svc-hero-sub mb-5" style="color: rgba(255,255,255,0.6)">Setiap proyek adalah unik. Mari buat sesuatu yang hebat bersama-sama.</p>
    <a href="{{ route('contact') }}" class="cta-btn">
      Dapatkan Penawaran Gratis <i class="fas fa-paper-plane ms-2"></i>
    </a>
  </div>
</section>

@endsection
