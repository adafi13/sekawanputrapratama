@extends('frontend.layouts.app')

@section('title', 'Tentang Kami - PT Sekawan Putra Pratama')
@section('meta_description', 'Mengenal tim profesional PT Sekawan Putra Pratama — mitra IT terpercaya sejak 2024 untuk solusi web, mobile, dan infrastruktur teknologi.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tentang Kami', 'url' => route('about')],
]])

@section('content')

{{-- CSS & DESIGN SYSTEM (UI-UX-PRO-MAX) --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap');

:root {
  --font-lexend: 'Lexend', sans-serif;
  --color-primary: #0891B2; /* Cyan 600 */
  --color-secondary: #22D3EE; /* Cyan 400 */
  --color-accent: #22C55E; /* Green 500 */
  --color-navy: #050b14; /* Match Home */
  --color-text-main: #0f172a;
  --color-text-muted: #64748b;
  --bg-light: #f8fafc;
  --glass-bg: rgba(255, 255, 255, 0.03);
  --glass-border: rgba(255, 255, 255, 0.1);
}

body { font-family: 'Inter', sans-serif; color: var(--color-text-main); }
h1, h2, h3, h4, h5, h6 { font-family: var(--font-lexend); }

.abt-grad {
  background: linear-gradient(135deg, #60A5FA, #22D3EE, #34D399);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
}

/* ---- HERO SECTION ---- */
.abt-hero {
  position: relative;
  min-height: 70vh;
  background-color: var(--color-navy);
  display: flex;
  align-items: center;
  overflow: hidden;
  padding-top: 100px;
}
.abt-hero-grid {
  position: absolute;
  inset: 0;
  background-image: 
    linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 60px 60px;
  mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
  z-index: 0;
}
.abt-hero-glow {
  position: absolute;
  top: 50%; left: 50%; transform: translate(-50%, -50%);
  width: 800px; height: 800px;
  background: radial-gradient(circle, rgba(8, 145, 178, 0.15) 0%, transparent 70%);
  z-index: 1;
}

.abt-hero-content { position: relative; z-index: 10; text-align: center; }
.abt-hero-pill {
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
.abt-hero-title {
  font-size: clamp(2.5rem, 6vw, 4.5rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.1;
  margin-bottom: 24px;
  letter-spacing: -2px;
}
.abt-hero-sub {
  color: #94a3b8;
  font-size: 1.2rem;
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.6;
}

/* ---- MISSION BLOCK SECTION ---- */
.abt-mission { padding: 120px 0; background: #fff; }
.mission-card {
  background: var(--bg-light);
  border-radius: 32px;
  padding: 60px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
  border: 1px solid #e2e8f0;
  transition: transform 0.3s ease;
}
.mission-card:hover { transform: translateY(-5px); box-shadow: 0 40px 80px -20px rgba(0,0,0,0.08); }

.mission-left .label { color: var(--color-primary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 12px; display: block; margin-bottom: 12px; }
.mission-left h2 { font-size: 2.5rem; font-weight: 800; color: var(--color-text-main); margin-bottom: 24px; }
.mission-left p { font-size: 1.1rem; color: var(--color-text-muted); line-height: 1.8; }

.stats-grid-mini { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
.stat-box-mini { background: #fff; padding: 30px; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 10px 25px rgba(0,0,0,0.02); }
.stat-box-mini .num { font-size: 2.2rem; font-weight: 800; color: var(--color-primary); display: block; }
.stat-box-mini .txt { font-size: 13px; color: var(--color-text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }

/* ---- VALUES (Bento Grid Style) ---- */
.abt-values { padding: 100px 0; background: var(--bg-light); }
.section-header { text-align: center; margin-bottom: 60px; }
.section-header h2 { font-size: 3rem; font-weight: 800; letter-spacing: -1px; }

.values-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
.value-card { background: #fff; padding: 40px; border-radius: 24px; border: 1px solid #e2e8f0; transition: all 0.3s ease; }
.value-card:hover { background: var(--color-navy); border-color: var(--color-primary); transform: translateY(-10px); }
.value-card:hover h4, .value-card:hover p { color: #fff; }
.value-card .icon-wrap { width: 60px; height: 60px; background: rgba(8, 145, 178, 0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--color-primary); margin-bottom: 24px; transition: all 0.3s ease; }
.value-card:hover .icon-wrap { background: var(--color-primary); color: #fff; transform: rotate(10deg); }
.value-card h4 { font-size: 1.5rem; font-weight: 700; margin-bottom: 16px; }
.value-card p { font-size: 0.95rem; color: var(--color-text-muted); line-height: 1.6; }

/* ---- TEAM SECTION ---- */
.abt-team { padding: 120px 0; background: #fff; }
.team-card { position: relative; border-radius: 24px; overflow: hidden; background: #fff; transition: all 0.4s ease; border: 1px solid #f1f5f9; }
.team-img-wrap { position: relative; width: 100%; aspect-ratio: 4/5; overflow: hidden; background: #f8fafc; }
.team-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
.team-card:hover img { transform: scale(1.1); }

.team-info { padding: 24px; text-align: center; position: relative; z-index: 2; }
.team-name { font-size: 1.25rem; font-weight: 700; color: var(--color-text-main); margin-bottom: 4px; }
.team-role { font-size: 0.8rem; font-weight: 700; color: var(--color-primary); text-transform: uppercase; letter-spacing: 1.5px; }

.team-social { position: absolute; inset: 0; background: rgba(5, 11, 20, 0.8); backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center; gap: 16px; opacity: 0; transition: all 0.4s ease; }
.team-card:hover .team-social { opacity: 1; }
.social-icon { width: 44px; height: 44px; background: #fff; color: var(--color-navy); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; transition: all 0.3s ease; }
.social-icon:hover { background: var(--color-primary); color: #fff; transform: translateY(-5px); }

/* ---- CTA ---- */
.abt-cta { padding: 100px 0; }
.cta-box { background: var(--color-navy); border-radius: 40px; padding: 80px 40px; text-align: center; position: relative; overflow: hidden; }
.cta-box .glow { position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle at center, rgba(34, 211, 238, 0.1) 0%, transparent 60%); }
.cta-title { font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: #fff; margin-bottom: 24px; position: relative; z-index: 2; }
.cta-btn { display: inline-flex; align-items: center; gap: 12px; background: #fff; color: var(--color-navy); padding: 18px 40px; border-radius: 50px; font-weight: 700; font-size: 1.1rem; transition: all 0.3s ease; text-decoration: none; position: relative; z-index: 2; }
.cta-btn:hover { background: var(--color-secondary); transform: scale(1.05); }

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .abt-hero { min-height: auto; padding: 120px 0 80px; text-align: center; }
  .mission-card { grid-template-columns: 1fr; padding: 40px; text-align: center; }
  .values-grid { grid-template-columns: 1fr 1fr; }
  .abt-mission, .abt-values, .abt-team { padding: 60px 0; }
}
@media (max-width: 768px) {
  .values-grid { grid-template-columns: 1fr; }
  .abt-hero-title { font-size: 2.5rem; }
  .stats-grid-mini { grid-template-columns: 1fr; }
  .abt-mission, .abt-values, .abt-team { padding: 40px 0; }
  .mission-card { padding: 30px 20px; }
  .abt-cta { padding: 40px 0; }
  .cta-box { padding: 60px 20px; }
}
</style>

{{-- HERO --}}
<section class="abt-hero">
  <div class="abt-hero-grid"></div>
  <div class="abt-hero-glow"></div>
  <div class="container">
    <div class="abt-hero-content">
      <div class="abt-hero-pill reveal">
        <i class="fas fa-sparkles me-2"></i> KREATIVITAS TANPA BATAS
      </div>
      <h1 class="abt-hero-title reveal delay-100">
        Transformasi Bisnis Melalui <br>
        <span class="abt-grad">Inovasi Digital</span>
      </h1>
      <p class="abt-hero-sub reveal delay-200 mb-4">
        Kami adalah kumpulan pemikir, pengembang, dan visioner yang berdedikasi untuk membangun solusi teknologi yang tidak hanya berfungsi, tetapi juga menginspirasi.
      </p>
      <div class="reveal delay-300">
        <a href="{{ route('company-profile') }}" target="_blank" class="btn btn-outline-info text-white border-info rounded-pill px-4 py-3 fw-bold shadow-sm me-2 mb-2" style="background: rgba(34, 211, 238, 0.15); backdrop-filter: blur(8px);">
          <i class="fas fa-file-pdf me-2 text-info"></i> Unduh Company Profile Resmi (PDF)
        </a>
        <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow-sm mb-2">
          <i class="fas fa-comments me-2"></i> Konsultasi Gratis
        </a>
      </div>
    </div>
  </div>
</section>

{{-- LEGAL & COMPLIANCE VERIFICATION BADGE --}}
<section class="py-4 bg-light border-bottom">
  <div class="container">
    <div class="row g-3 align-items-center justify-content-center text-center text-md-start">
      <div class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; flex-shrink: 0;">
          <i class="fas fa-file-contract fs-5"></i>
        </div>
        <div>
          <span class="d-block text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Nomor Induk Berusaha (NIB)</span>
          <strong class="text-dark font-monospace fs-6">0505260088735</strong>
          <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 ms-1" style="font-size: 10px;">OSS BKPM RI</span>
        </div>
      </div>

      <div class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; flex-shrink: 0;">
          <i class="fas fa-id-card fs-5"></i>
        </div>
        <div>
          <span class="d-block text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">NPWP Badan Perusahaan</span>
          <strong class="text-dark font-monospace fs-6">1000 0000 0948 6824</strong>
          <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-20 ms-1" style="font-size: 10px;">DJP Cikarang</span>
        </div>
      </div>

      <div class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
        <div class="rounded-circle bg-success bg-opacity-10 text-success p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; flex-shrink: 0;">
          <i class="fas fa-shield-alt fs-5"></i>
        </div>
        <div>
          <span class="d-block text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Status Legalitas PT</span>
          <strong class="text-dark small">PT Resmi Terdaftar Kemenkumham & DJP</strong>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- PROFIL PERUSAHAAN & VISI MISI --}}
<section class="py-5 bg-white">
  <div class="container py-4">
    {{-- Grid 2 Kolom: Profil Perusahaan & Stats --}}
    <div class="row g-4 align-items-center mb-5">
      <div class="col-lg-7 reveal">
        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
          <i class="fas fa-building me-2"></i> PROFIL PERUSAHAAN
        </span>
        <h2 class="fw-black text-dark display-6 mb-4" style="letter-spacing: -1px;">
          Mitra Strategis <span class="text-primary">Transformasi Digital</span> Bisnis Anda
        </h2>
        <p class="text-muted leading-relaxed mb-3" style="font-size: 1.05rem; line-height: 1.8;">
          <strong>PT Sekawan Putra Pratama</strong> adalah perusahaan teknologi informasi yang berdedikasi menghadirkan solusi digital terintegrasi. Kami hadir menjembatani kebutuhan bisnis—mulai dari UMKM hingga perusahaan berskala besar—dengan inovasi teknologi yang tepat guna.
        </p>
        <p class="text-muted leading-relaxed mb-0" style="font-size: 1.05rem; line-height: 1.8;">
          Kami memahami bahwa setiap bisnis memiliki tantangan unik. Oleh karena itu, kami tidak menerapkan pendekatan <em>"satu solusi untuk semua"</em>. Kami merancang sistem yang disesuaikan (custom) dengan alur kerja, target pasar, dan standar operasional Anda untuk memastikan efisiensi dan pertumbuhan yang nyata.
        </p>
      </div>

      <div class="col-lg-5 reveal delay-100">
        <div class="row g-3">
          <div class="col-6">
            <div class="p-4 rounded-4 bg-light border text-center transition-all" style="border-color: #e2e8f0 !important;">
              <span class="d-block fw-black text-primary display-5 mb-1">50+</span>
              <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">Proyek Selesai</span>
            </div>
          </div>
          <div class="col-6">
            <div class="p-4 rounded-4 bg-light border text-center transition-all" style="border-color: #e2e8f0 !important;">
              <span class="d-block fw-black text-info display-5 mb-1">20+</span>
              <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">Klien Aktif</span>
            </div>
          </div>
          <div class="col-6">
            <div class="p-4 rounded-4 bg-light border text-center transition-all" style="border-color: #e2e8f0 !important;">
              <span class="d-block fw-black text-dark display-5 mb-1">2024</span>
              <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">Tahun Berdiri</span>
            </div>
          </div>
          <div class="col-6">
            <div class="p-4 rounded-4 bg-light border text-center transition-all" style="border-color: #e2e8f0 !important;">
              <span class="d-block fw-black text-success display-5 mb-1">24/7</span>
              <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">Dukungan Teknis</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- VISI & MISI BLOCK --}}
    <div class="p-4 p-lg-5 rounded-4 bg-light border reveal" style="border-color: #e2e8f0 !important;">
      <div class="row g-4">
        {{-- VISI --}}
        <div class="col-lg-5 border-end-lg">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-3 bg-primary text-white p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
              <i class="fas fa-eye fs-4"></i>
            </div>
            <div>
              <span class="text-primary fw-bold small text-uppercase" style="letter-spacing: 1px;">PANDANGAN STRATEGIS</span>
              <h3 class="fw-bold text-dark mb-0 fs-4">VISI KAMI</h3>
            </div>
          </div>
          <p class="text-muted leading-relaxed mb-0" style="font-size: 1.05rem; line-height: 1.8;">
            "Menjadi katalisator transformasi digital terpercaya yang mendorong pertumbuhan bisnis di seluruh Indonesia melalui inovasi teknologi yang solutif."
          </p>
        </div>

        {{-- MISI --}}
        <div class="col-lg-7 ps-lg-4">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-3 bg-success text-white p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
              <i class="fas fa-bullseye fs-4"></i>
            </div>
            <div>
              <span class="text-success fw-bold small text-uppercase" style="letter-spacing: 1px;">PILAR EKSEKUSI</span>
              <h3 class="fw-bold text-dark mb-0 fs-4">MISI KAMI</h3>
            </div>
          </div>

          <div class="row g-3">
            <div class="col-md-12">
              <div class="p-3 bg-white rounded-3 border" style="border-color: #e2e8f0 !important;">
                <h6 class="fw-bold text-dark mb-1"><i class="fas fa-check-circle text-primary me-2"></i> Solusi Tepat Guna</h6>
                <p class="text-muted small mb-0" style="line-height: 1.6;">Menghadirkan infrastruktur dan sistem IT yang aman, efektif, dan terukur sesuai kebutuhan bisnis Anda.</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="p-3 bg-white rounded-3 border" style="border-color: #e2e8f0 !important;">
                <h6 class="fw-bold text-dark mb-1"><i class="fas fa-check-circle text-success me-2"></i> Orientasi Kualitas</h6>
                <p class="text-muted small mb-0" style="line-height: 1.6;">Mengembangkan produk digital berstandar tinggi dengan pendekatan profesional demi kepuasan klien.</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="p-3 bg-white rounded-3 border" style="border-color: #e2e8f0 !important;">
                <h6 class="fw-bold text-dark mb-1"><i class="fas fa-check-circle text-info me-2"></i> Kemitraan Jangka Panjang</h6>
                <p class="text-muted small mb-0" style="line-height: 1.6;">Membangun hubungan profesional yang berkelanjutan melalui pelayanan responsif dan dukungan teknis handal.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- CORE VALUES --}}
<section class="abt-values">
  <div class="container">
    <div class="section-header reveal">
      <span class="abt-hero-pill mb-3" style="background: rgba(8, 145, 178, 0.05); color: var(--color-primary);">NILAI KAMI</span>
      <h2>Prinsip Utama Kami</h2>
    </div>
    <div class="values-grid">
      <div class="value-card reveal delay-100">
        <div class="icon-wrap"><i class="fas fa-lightbulb"></i></div>
        <h4>Inovasi</h4>
        <p>Kami tidak pernah berhenti bereksperimen dengan teknologi terbaru untuk memberikan solusi yang paling relevan.</p>
      </div>
      <div class="value-card reveal delay-200">
        <div class="icon-wrap"><i class="fas fa-shield-alt"></i></div>
        <h4>Integritas</h4>
        <p>Kepercayaan adalah pondasi kami. Kami bekerja dengan transparansi penuh dan kejujuran di setiap langkah.</p>
      </div>
      <div class="value-card reveal delay-300">
        <div class="icon-wrap"><i class="fas fa-users"></i></div>
        <h4>Kolaborasi</h4>
        <p>Kami percaya bahwa hasil terbaik lahir dari kerjasama yang erat antara tim kami dan tim Anda.</p>
      </div>
    </div>
  </div>
</section>

{{-- SLA & GUARANTEE COMMITMENT MATRIX (Ultra-Clean Light Bento Grid Style) --}}
<section class="py-5 bg-white border-top border-bottom">
  <div class="container py-4">
    <div class="text-center mb-5 reveal">
      <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
        <i class="fas fa-award me-2"></i> JAMINAN & STANDAR OPERASIONAL (SLA)
      </span>
      <h2 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1px;">Komitmen Kualitas Tanpa Kompromi</h2>
      <p class="text-muted mx-auto" style="max-width: 680px; font-size: 1.05rem; line-height: 1.6;">
        Setiap solusi teknologi dan infrastruktur yang dirancang oleh PT Sekawan Putra Pratama dilindungi oleh 3 pilar garansi utama untuk ketenangan dan keamanan investasi bisnis Anda.
      </p>
    </div>

    <div class="row g-4">
      {{-- Card 1: 99.9% Uptime --}}
      <div class="col-lg-4 col-md-6 reveal delay-100">
        <div class="p-4 p-xl-5 rounded-4 h-100 bg-light border transition-all shadow-sm-hover" style="border-color: #e2e8f0 !important; transition: all 0.3s ease;">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
              <i class="fas fa-server fs-4"></i>
            </div>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-3 py-2 fw-bold" style="font-size: 11px;">
              99.9% UPTIME SLA
            </span>
          </div>
          <h4 class="fw-bold text-dark mb-3">Server & Infrastructure SLA</h4>
          <p class="text-muted small mb-4" style="line-height: 1.7;">
            Jaminan keandalan uptime server, ketersediaan jaringan, dan manajemen cloud yang stabil untuk memastikan operasional bisnis Anda terus berjalan tanpa gangguan 24/7.
          </p>
          <ul class="list-unstyled text-dark small fw-semibold mb-0 d-flex flex-column gap-2 border-top pt-3" style="border-color: #e2e8f0 !important;">
            <li class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-primary"></i> 24/7 Server Active Monitoring</li>
            <li class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-primary"></i> Automatic Failover & Cloud Backup</li>
          </ul>
        </div>
      </div>

      {{-- Card 2: 100% Source Code Ownership --}}
      <div class="col-lg-4 col-md-6 reveal delay-200">
        <div class="p-4 p-xl-5 rounded-4 h-100 bg-light border transition-all shadow-sm-hover" style="border-color: #e2e8f0 !important; transition: all 0.3s ease;">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="rounded-3 bg-success bg-opacity-10 text-success p-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
              <i class="fas fa-code-branch fs-4"></i>
            </div>
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 rounded-pill px-3 py-2 fw-bold" style="font-size: 11px;">
              100% HAK MILIK
            </span>
          </div>
          <h4 class="fw-bold text-dark mb-3">Full Source Code Ownership</h4>
          <p class="text-muted small mb-4" style="line-height: 1.7;">
            Seluruh <em>source code</em>, arsitektur sistem, dan hak cipta sepenuhnya menjadi milik perusahaan Anda tanpa ada keterikatan penguncian vendor (<em>No Vendor Lock-In</em>).
          </p>
          <ul class="list-unstyled text-dark small fw-semibold mb-0 d-flex flex-column gap-2 border-top pt-3" style="border-color: #e2e8f0 !important;">
            <li class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-success"></i> Full IP & Intellectual Ownership</li>
            <li class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-success"></i> Clean Standardized Code Base</li>
          </ul>
        </div>
      </div>

      {{-- Card 3: 1 Year Maintenance --}}
      <div class="col-lg-4 col-md-12 reveal delay-300">
        <div class="p-4 p-xl-5 rounded-4 h-100 bg-light border transition-all shadow-sm-hover" style="border-color: #e2e8f0 !important; transition: all 0.3s ease;">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
              <i class="fas fa-user-shield fs-4"></i>
            </div>
            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20 rounded-pill px-3 py-2 fw-bold" style="font-size: 11px;">
              GARANSI 1 TAHUN
            </span>
          </div>
          <h4 class="fw-bold text-dark mb-3">Maintenance & On-Call Support</h4>
          <p class="text-muted small mb-4" style="line-height: 1.7;">
            Dukungan teknis responsif 24/7 dan pemeliharaan perbaikan bug secara gratis selama 12 bulan penuh setelah tanggal serah terima pekerjaan (BAST).
          </p>
          <ul class="list-unstyled text-dark small fw-semibold mb-0 d-flex flex-column gap-2 border-top pt-3" style="border-color: #e2e8f0 !important;">
            <li class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-warning"></i> Free 12-Month Bug Fixing</li>
            <li class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-warning"></i> Emergency On-Call Response</li>
          </ul>
        </div>
      </div>
  </div>
</section>

{{-- INTERACTIVE TECH STACK ARSENAL --}}
<section class="py-5 bg-light border-bottom">
  <div class="container py-4">
    <div class="text-center mb-5 reveal">
      <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
        <i class="fas fa-microchip me-2"></i> TECH STACK ARSENAL
      </span>
      <h2 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1px;">Teknologi Modern Teruji Industri</h2>
      <p class="text-muted mx-auto" style="max-width: 680px; font-size: 1.05rem; line-height: 1.6;">
        Kami menggunakan kombinasi <em>framework</em>, bahasa pemrograman, dan infrastruktur cloud terbaik untuk menghasilkan aplikasi berkecepatan tinggi, aman, dan siap tumbuh bersama bisnis Anda.
      </p>

      {{-- Filter Pills --}}
      <div class="d-flex flex-wrap justify-content-center gap-2 mt-4" id="tech-stack-filters">
        <button type="button" class="btn btn-primary rounded-pill px-4 py-2 fw-bold active filter-btn mb-1" data-filter="all">Semua Tech Stack</button>
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold filter-btn mb-1" data-filter="backend">⚙️ Backend</button>
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold filter-btn mb-1" data-filter="frontend">📱 Frontend & Mobile</button>
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold filter-btn mb-1" data-filter="cloud">☁️ Cloud & Networking</button>
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold filter-btn mb-1" data-filter="database">🗄️ Database & Cache</button>
      </div>
    </div>

    {{-- Tech Cards Grid --}}
    <div class="row g-3" id="tech-stack-grid">
      @php
        $techStack = [
          // Backend
          ['name' => 'Laravel 11', 'cat' => 'backend', 'icon' => 'fab fa-laravel text-danger', 'badge' => 'Enterprise Standard', 'desc' => 'Framework PHP nomor #1 untuk arsitektur backend robust, secure API, & ERP.'],
          ['name' => 'PHP 8.4', 'cat' => 'backend', 'icon' => 'fab fa-php text-primary', 'badge' => 'High Performance', 'desc' => 'Eksekusi server ultra-cepat dengan JIT Compiler & sistem tipe modern.'],
          ['name' => 'Node.js', 'cat' => 'backend', 'icon' => 'fab fa-node-js text-success', 'badge' => 'Real-time & Async', 'desc' => 'Arsitektur event-driven non-blocking untuk microservices & WebSocket.'],
          ['name' => 'Python', 'cat' => 'backend', 'icon' => 'fab fa-python text-warning', 'badge' => 'Automation & AI', 'desc' => 'Scripting otomasi cerdas, pemrosesan data masif, & integrasi model AI.'],

          // Frontend & Mobile
          ['name' => 'Flutter', 'cat' => 'frontend', 'icon' => 'fas fa-mobile-alt text-info', 'badge' => 'Cross-Platform', 'desc' => 'Aplikasi Android & iOS performa native dari satu basis kode terpadu.'],
          ['name' => 'React Native', 'cat' => 'frontend', 'icon' => 'fab fa-react text-info', 'badge' => 'Mobile App', 'desc' => 'Aplikasi seluler responsif dengan komponen antarmuka native modern.'],
          ['name' => 'Vue.js / Next', 'cat' => 'frontend', 'icon' => 'fab fa-vuejs text-success', 'badge' => 'Reactive UI', 'desc' => 'Antarmuka web interaktif, SPA, dan SSR berkecepatan tinggi.'],
          ['name' => 'Tailwind CSS', 'cat' => 'frontend', 'icon' => 'fas fa-wind text-info', 'badge' => 'Modern Design', 'desc' => 'Styling sistem UI/UX presisi, ringan, dan 100% responsif di layar HP.'],

          // Cloud & Server
          ['name' => 'AWS Cloud', 'cat' => 'cloud', 'icon' => 'fab fa-aws text-warning', 'badge' => 'Global Cloud', 'desc' => 'Layanan server EC2, S3 storage, & Auto Scaling kapasitas tinggi.'],
          ['name' => 'Google Cloud', 'cat' => 'cloud', 'icon' => 'fab fa-google text-primary', 'badge' => 'Cloud Native', 'desc' => 'Infrastruktur cloud andal untuk analitik data & scalable hosting.'],
          ['name' => 'Docker', 'cat' => 'cloud', 'icon' => 'fab fa-docker text-primary', 'badge' => 'Containerization', 'desc' => 'Isolasi aplikasi dalam kontainer untuk deployment instan tanpa kendala.'],
          ['name' => 'Mikrotik & Network', 'cat' => 'cloud', 'icon' => 'fas fa-network-wired text-dark', 'badge' => 'Hardware Net', 'desc' => 'Instalasi jaringan LAN/WAN kantor, VPN dedicated, & keamanan router.'],

          // Database
          ['name' => 'PostgreSQL', 'cat' => 'database', 'icon' => 'fas fa-database text-primary', 'badge' => 'Relational DB', 'desc' => 'Database SQL ACID-compliant kelas enterprise untuk data kompleks.'],
          ['name' => 'MySQL / MariaDB', 'cat' => 'database', 'icon' => 'fas fa-database text-warning', 'badge' => 'High Speed DB', 'desc' => 'Manajemen basis data relasional populer, cepat, dan sangat stabil.'],
          ['name' => 'Redis Cache', 'cat' => 'database', 'icon' => 'fas fa-bolt text-danger', 'badge' => 'In-Memory Cache', 'desc' => 'Caching memori super cepat untuk mempercepat respon query & session.']
        ];
      @endphp

      @foreach($techStack as $tech)
        <div class="col-lg-3 col-md-4 col-sm-6 tech-card-item" data-category="{{ $tech['cat'] }}">
          <div class="p-4 rounded-4 bg-white border h-100 shadow-sm transition-all" style="border-color: #e2e8f0 !important; transition: all 0.3s ease;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="rounded-3 bg-light p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="{{ $tech['icon'] }} fs-4"></i>
              </div>
              <span class="badge bg-light text-dark border rounded-pill px-2 py-1" style="font-size: 10px;">{{ $tech['badge'] }}</span>
            </div>
            <h5 class="fw-bold text-dark mb-2 fs-6">{{ $tech['name'] }}</h5>
            <p class="text-muted mb-0" style="font-size: 12px; line-height: 1.5;">{{ $tech['desc'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('#tech-stack-filters .filter-btn');
    const techItems = document.querySelectorAll('#tech-stack-grid .tech-card-item');

    filterBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        filterBtns.forEach(b => {
          b.classList.remove('btn-primary', 'active');
          b.classList.add('btn-outline-secondary');
        });
        this.classList.remove('btn-outline-secondary');
        this.classList.add('btn-primary', 'active');

        const filter = this.getAttribute('data-filter');
        techItems.forEach(item => {
          if (filter === 'all' || item.getAttribute('data-category') === filter) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  });
</script>
@endpush

{{-- INTERACTIVE MILESTONE & JOURNEY TIMELINE (Ultra-Luxury Vertical Roadmap Stepper) --}}
<section class="py-5 bg-light border-bottom position-relative overflow-hidden">
  <div class="container py-4">
    <div class="text-center mb-5 reveal">
      <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
        <i class="fas fa-route me-2"></i> PETA PERJALANAN PERUSAHAAN
      </span>
      <h2 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1px;">Rekam Jejak & Milestone Tumbuh</h2>
      <p class="text-muted mx-auto" style="max-width: 680px; font-size: 1.05rem; line-height: 1.6;">
        Dari awal berdirinya hingga dipercaya oleh perusahaan manufaktur nasional dan entitas Tbk, berikut adalah perjalanan kami dalam menghadirkan solusi teknologi yang tepat guna.
      </p>
    </div>

    {{-- Stepper Wrapper --}}
    <div class="position-relative mx-auto" style="max-width: 900px;">
      {{-- Vertical Glowing Line --}}
      <div class="position-absolute top-0 bottom-0 start-50 translate-middle-x z-0 d-none d-md-block" style="width: 4px; background: linear-gradient(180deg, #3b82f6 0%, #0284c7 50%, #10b981 100%); border-radius: 4px;"></div>

      {{-- Step 1: 2024 --}}
      <div class="row g-4 align-items-center mb-5 reveal">
        <div class="col-md-5 text-md-end order-2 order-md-1">
          <div class="p-4 rounded-4 bg-white border shadow-sm transition-all" style="border-color: #e2e8f0 !important; border-right: 4px solid #3b82f6 !important;">
            <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-1 rounded-pill mb-2" style="font-size: 11px;">FASE FONDASI</span>
            <h4 class="fw-bold text-dark mb-2 fs-5">Pendirian & Solusi Perdana</h4>
            <p class="text-muted small mb-3" style="line-height: 1.6;">
              Resmi berdirinya <strong>PT Sekawan Putra Pratama</strong> di Bekasi. Berfokus menghadirkan solusi pengembang sistem custom dan perancangan website profesional bagi puluhan klien awal.
            </p>
            <div class="bg-light p-3 rounded-3 border text-start" style="border-color: #f1f5f9 !important;">
              <span class="d-block text-primary fw-bold small mb-1"><i class="fas fa-check-circle me-1"></i> Milestone Utama:</span>
              <ul class="list-unstyled mb-0 text-muted small" style="font-size: 12px; line-height: 1.6;">
                <li>• Legalitas Badan Hukum Resmikan PT</li>
                <li>• Rilis 20+ Proyek Web & Software Custom</li>
                <li>• Pembentukan Tim Eng & Infrastructure</li>
              </ul>
            </div>
          </div>
        </div>

        {{-- Center Node Badge --}}
        <div class="col-md-2 text-center order-1 order-md-2 position-relative z-1">
          <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white font-monospace fw-bold shadow-lg border border-4 border-white mx-auto" style="width: 68px; height: 68px; font-size: 1.1rem; box-shadow: 0 0 20px rgba(59, 130, 246, 0.35) !important;">
            2024
          </div>
        </div>

        <div class="col-md-5 d-none d-md-block order-3"></div>
      </div>

      {{-- Step 2: 2025 --}}
      <div class="row g-4 align-items-center mb-5 reveal">
        <div class="col-md-5 d-none d-md-block order-1"></div>

        {{-- Center Node Badge --}}
        <div class="col-md-2 text-center order-1 order-md-2 position-relative z-1">
          <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info text-white font-monospace fw-bold shadow-lg border border-4 border-white mx-auto" style="width: 68px; height: 68px; font-size: 1.1rem; box-shadow: 0 0 20px rgba(14, 165, 233, 0.35) !important;">
            2025
          </div>
        </div>

        <div class="col-md-5 text-start order-2 order-md-3">
          <div class="p-4 rounded-4 bg-white border shadow-sm transition-all" style="border-color: #e2e8f0 !important; border-left: 4px solid #0284c7 !important;">
            <span class="badge bg-info bg-opacity-10 text-info fw-bold px-3 py-1 rounded-pill mb-2" style="font-size: 11px;">FASE EKSPANSI ENTERPRISE</span>
            <h4 class="fw-bold text-dark mb-2 fs-5">Kemitraan Manufaktur & Tbk</h4>
            <p class="text-muted small mb-3" style="line-height: 1.6;">
              Dipercaya oleh raksasa industri seperti <strong>PT Astra Daihatsu Motor</strong> (QC & Production Monitoring) dan <strong>PT Sarana Mitra Luas Tbk</strong> (ERP OPTIMA & Server Network).
            </p>
            <div class="bg-light p-3 rounded-3 border text-start" style="border-color: #f1f5f9 !important;">
              <span class="d-block text-success fw-bold small mb-1"><i class="fas fa-check-circle me-1"></i> Milestone Utama:</span>
              <ul class="list-unstyled mb-0 text-muted small" style="font-size: 12px; line-height: 1.6;">
                <li>• Deployment Real-time QC Dashboard ADM</li>
                <li>• Peluncuran ERP Multi-Modul (CRM, WMS, Finance)</li>
                <li>• Instalasi CCTV & Server PT Banyu Ayu Kosmetika</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      {{-- Step 3: 2026 --}}
      <div class="row g-4 align-items-center reveal">
        <div class="col-md-5 text-md-end order-2 order-md-1">
          <div class="p-4 rounded-4 bg-white border shadow-sm transition-all" style="border-color: #e2e8f0 !important; border-right: 4px solid #10b981 !important;">
            <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-1 rounded-pill mb-2" style="font-size: 11px;">FASE ECOSYSTEM & SAAS PLATFORMS</span>
            <h4 class="fw-bold text-dark mb-2 fs-5">Ekosistem Digital & Produk SaaS Inovatif</h4>
            <p class="text-muted small mb-3" style="line-height: 1.6;">
              Peluncuran dua platform SaaS unggulan: <strong>APO Apps</strong> (Ekosistem Manajemen Operasional) &amp; <strong>Smart RT Vision</strong> (Platform Keamanan Lingkungan Cerdas).
            </p>
            <div class="bg-light p-3 rounded-3 border text-start" style="border-color: #f1f5f9 !important;">
              <span class="d-block text-success fw-bold small mb-2"><i class="fas fa-rocket me-1"></i> Launching Produk Unggulan:</span>
              <ul class="list-unstyled mb-0 text-muted small" style="font-size: 12px; line-height: 1.8;">
                <li class="mb-2">
                  • <a href="https://apoapps.sekawanputrapratama.com/" target="_blank" class="fw-bold text-primary text-decoration-none">APO Apps Platform <i class="fas fa-external-link-alt ms-1" style="font-size: 10px;"></i></a>
                  <span class="d-block text-muted ps-3" style="font-size: 11px;">(Enterprise Operational Cloud Platform)</span>
                </li>
                <li>
                  • <a href="https://smartrtvision.sekawanputrapratama.com/" target="_blank" class="fw-bold text-info text-decoration-none">Smart RT Vision Platform <i class="fas fa-external-link-alt ms-1" style="font-size: 10px;"></i></a>
                  <span class="d-block text-muted ps-3" style="font-size: 11px;">(Smart Security &amp; Resident Vision System)</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        {{-- Center Node Badge --}}
        <div class="col-md-2 text-center order-1 order-md-2 position-relative z-1">
          <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success text-white font-monospace fw-bold shadow-lg border border-4 border-white mx-auto" style="width: 68px; height: 68px; font-size: 1.1rem; box-shadow: 0 0 20px rgba(16, 185, 129, 0.35) !important;">
            2026
          </div>
        </div>

        <div class="col-md-5 d-none d-md-block order-3"></div>
      </div>
    </div>
  </div>
</section>

{{-- TEAM SECTION --}}
<section class="abt-team">
  <div class="container">
    <div class="section-header reveal">
      <span class="abt-hero-pill mb-3" style="background: rgba(8, 145, 178, 0.05); color: var(--color-primary);">TIM KAMI</span>
      <h2>Profesional Dibalik Layar</h2>
    </div>
    
    <div class="row g-4">
      @php
          $team = [
              [
                'name' => 'Abdul Malik Ibrahim', 
                'role' => 'App Developer', 
                'img' => 'abdul-malik.webp',
                'ig' => 'https://www.instagram.com/malikibrahim915/',
                'exp' => '7+ Tahun',
                'desc' => 'Berpengalaman membangun aplikasi mobile dan desktop modern, responsif, dan berperforma tinggi.'
              ],
              [
                'name' => 'Aries Adityanto', 
                'role' => 'Project Manager', 
                'img' => 'aries-adityanto.webp',
                'ig' => 'https://www.instagram.com/arisadit_ya/',
                'exp' => '5+ Tahun',
                'desc' => 'Memastikan setiap proyek berjalan presisi, tepat waktu, dan sesuai kebutuhan klien.'
              ],
              [
                'name' => 'M. Aditya Novaldy', 
                'role' => 'Server & Networking', 
                'img' => 'aditya-novaldy.webp',
                'ig' => 'https://www.instagram.com/aditya13nvl/',
                'exp' => '6+ Tahun',
                'desc' => 'Ahli infrastruktur server dan jaringan, memastikan koneksi stabil dan sistem berjalan lancar.'
              ],
              [
                'name' => 'M. Naufal Fathuroni', 
                'role' => 'UI/UX Designer', 
                'img' => 'muhammad-naufal-fauthuroni.webp',
                'ig' => 'https://www.instagram.com/nnovalf/',
                'exp' => '2+ Tahun',
                'desc' => 'Merancang antarmuka intuitif yang fokus pada pengalaman pengguna dan estetika visual.'
              ],
              [
                'name' => 'Alfario Dafa Mustofa', 
                'role' => 'Office Server', 
                'img' => 'alfario-daffa-mustofa.webp',
                'ig' => 'https://www.instagram.com/dafmstfa_/',
                'exp' => '5+ Tahun',
                'desc' => 'Spesialis setup server kantor, konfigurasi jaringan internal, dan keamanan data perusahaan.'
              ]
          ];
      @endphp

      @foreach($team as $index => $member)
      <div class="col-lg-4 col-md-6 reveal" style="transition-delay: {{ $index * 100 }}ms;">
        <div class="team-card">
          <div class="team-img-wrap">
            <img src="{{ asset('assets/media/team/' . $member['img']) }}" alt="{{ $member['name'] }}" loading="lazy">
            <div class="team-social">
              <a href="{{ $member['ig'] }}" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="abt-team-exp" style="position: absolute; bottom: 12px; right: 12px; background: #fff; border-radius: 50px; padding: 5px 12px; font-size: 12px; font-weight: 700; color: #1E293B; display: flex; align-items: center; gap: 5px; box-shadow: 0 4px 16px rgba(0,0,0,0.12); z-index: 5;">
              <i class="fas fa-star" style="color: #F59E0B; font-size: 11px;"></i> {{ $member['exp'] }}
            </div>
          </div>
          <div class="team-info">
            <h5 class="team-name">{{ $member['name'] }}</h5>
            <span class="team-role">{{ $member['role'] }}</span>
            <p class="team-desc" style="font-size: 13px; color: #94A3B8; line-height: 1.6; margin-top: 12px;">{{ $member['desc'] }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="abt-cta container mb-5">
  <div class="cta-box reveal">
    <div class="glow"></div>
    <h2 class="cta-title">Siap Bertransformasi <br> Bersama Kami?</h2>
    <p class="abt-hero-sub mb-5" style="color: rgba(255,255,255,0.6)">Mari diskusikan bagaimana teknologi kami dapat mempercepat pertumbuhan bisnis Anda.</p>
    <a href="{{ route('contact') }}" class="cta-btn">
      Mulai Konsultasi Gratis <i class="fas fa-arrow-right ms-2"></i>
    </a>
  </div>
</section>

@endsection
