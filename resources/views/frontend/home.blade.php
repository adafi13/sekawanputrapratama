@extends('frontend.layouts.app')

@section('title', 'Jasa IT Terpercaya | Software House & IT Consultant - Sekawan Putra Pratama')
@section('meta_description', 'Software house terpercaya sejak 2024. Jasa pembuatan website profesional, aplikasi mobile Android/iOS, instalasi server & jaringan kantor. Konsultasi GRATIS! Hubungi kami sekarang.')
@section('meta_keywords', 'jasa IT terpercaya, software house Indonesia, jasa pembuatan website, aplikasi mobile, instalasi server, IT consultant Jakarta, web developer profesional')

@section('og_title', 'Sekawan Putra Pratama - Solusi IT Terintegrasi & Terpercaya')
@section('og_description', 'Software house & IT consultant terpercaya sejak 2015. Website, Aplikasi Mobile, Server & Jaringan. Konsultasi GRATIS!')

@section('content')

{{-- ===== HERO FULLSCREEN BLUE ===== --}}
<section id="spp-hero">
  <div class="hero-bg">
    <div class="hero-orb o1"></div>
    <div class="hero-orb o2"></div>
    <div class="hero-orb o3"></div>
    <div class="hero-particles" id="heroParticles"></div>
    <div class="hero-mesh"></div>
  </div>

  <div class="hero-inner container">
    <div class="hero-left">

      <div class="hero-eyebrow">
        <span class="eyebrow-dot"></span>
        <span>Mitra IT Terpercaya Sejak 2015</span>
      </div>

      <h1 class="hero-title">
        Solusi Digital<br>
        <span class="hero-accent">Kelas Dunia,</span><br>
        <span class="hero-white">Untuk Bisnis Anda</span>
      </h1>

      <p class="hero-sub">
        Kami membangun <strong>Aplikasi</strong>, <strong>Website</strong>, dan <strong>Infrastruktur IT</strong>
        yang mendorong pertumbuhan bisnis Anda secara nyata dan terukur.
      </p>

      <div class="hero-actions">
        <a href="{{ route('contact') }}" class="hero-btn-primary">
          <i class="fas fa-rocket"></i>
          Konsultasi Gratis
        </a>
        <a href="{{ route('portfolio.index') }}" class="hero-btn-ghost">
          Lihat Portofolio
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <div class="hero-stats">
        <div class="hstat">
          <span class="hstat-num">50<span class="hstat-plus">+</span></span>
          <span class="hstat-label">Proyek Selesai</span>
        </div>
        <div class="hstat-sep"></div>
        <div class="hstat">
          <span class="hstat-num">20<span class="hstat-plus">+</span></span>
          <span class="hstat-label">Klien Aktif</span>
        </div>
        <div class="hstat-sep"></div>
        <div class="hstat">
          <span class="hstat-num">99.9<span class="hstat-plus">%</span></span>
          <span class="hstat-label">Uptime SLA</span>
        </div>
      </div>

    </div>

    <div class="hero-right d-none d-lg-flex">
      <div class="hero-visual-ring rv1"></div>
      <div class="hero-visual-ring rv2"></div>
      <div class="hero-visual-ring rv3"></div>
      <div class="hero-core">
        <img src="{{ asset('assets/media/logo.png') }}" alt="SPP" class="hero-core-logo">
      </div>
      <div class="hero-orbit-card oc1">
        <i class="fas fa-shield-alt"></i>
        <span>Keamanan Enterprise</span>
      </div>
      <div class="hero-orbit-card oc2">
        <i class="fas fa-tachometer-alt"></i>
        <span>Performa Tinggi</span>
      </div>
      <div class="hero-orbit-card oc3">
        <i class="fas fa-code"></i>
        <span>Clean Code</span>
      </div>
      <div class="hero-orbit-dot od1"></div>
      <div class="hero-orbit-dot od2"></div>
      <div class="hero-orbit-dot od3"></div>
      <div class="hero-orbit-dot od4"></div>
    </div>
  </div>

  <div class="hero-scroll-cue">
    <div class="scroll-track"><div class="scroll-thumb"></div></div>
    <span>Scroll</span>
  </div>
</section>

<style>
/* ============================================================
   HERO — FULLSCREEN ELECTRIC BLUE
   ============================================================ */
#spp-hero {
  position: relative;
  width: 100%;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  overflow: hidden;
  background: #0A1628;
}

/* ---- Background layers ---- */
.hero-bg {
  position: absolute;
  inset: 0;
  pointer-events: none;
}

.hero-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(90px);
  opacity: 0.7;
  animation: orbFloat 14s ease-in-out infinite alternate;
}
.hero-orb.o1 {
  width: 700px; height: 700px;
  top: -20%; left: -15%;
  background: radial-gradient(circle, rgba(37,99,235,0.55) 0%, transparent 65%);
  animation-duration: 16s;
}
.hero-orb.o2 {
  width: 550px; height: 550px;
  bottom: -15%; right: -10%;
  background: radial-gradient(circle, rgba(99,102,241,0.45) 0%, transparent 65%);
  animation-duration: 12s;
  animation-direction: alternate-reverse;
}
.hero-orb.o3 {
  width: 350px; height: 350px;
  top: 50%; left: 50%;
  transform: translate(-50%,-50%);
  background: radial-gradient(circle, rgba(14,165,233,0.25) 0%, transparent 65%);
  animation-duration: 10s;
}
@keyframes orbFloat {
  from { transform: translate(0, 0) scale(1); }
  to   { transform: translate(40px, 30px) scale(1.08); }
}
.hero-orb.o3 {
  animation-name: orbFloat3;
}
@keyframes orbFloat3 {
  from { transform: translate(-50%,-50%) scale(1); }
  to   { transform: translate(calc(-50% + 30px), calc(-50% - 20px)) scale(1.1); }
}

.hero-mesh {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
  background-size: 52px 52px;
  mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
}

/* Floating particles (JS populated) */
.hero-particle {
  position: absolute;
  width: 3px; height: 3px;
  background: rgba(96,165,250,0.6);
  border-radius: 50%;
  animation: particleFade 6s ease-in-out infinite;
}
@keyframes particleFade {
  0%,100% { opacity: 0; transform: translateY(0); }
  50%      { opacity: 1; transform: translateY(-30px); }
}

/* ---- Layout ---- */
.hero-inner {
  position: relative;
  z-index: 2;
  display: flex;
  align-items: center;
  gap: 60px;
  padding-top: 110px;
  padding-bottom: 80px;
  min-height: 100vh;
}
.hero-left  { flex: 1; max-width: 600px; }
.hero-right { flex: 0 0 480px; width: 480px; height: 480px; position: relative; align-items: center; justify-content: center; }

/* ---- Eyebrow ---- */
.hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: rgba(37,99,235,0.18);
  border: 1px solid rgba(96,165,250,0.3);
  border-radius: 50px;
  padding: 7px 18px;
  margin-bottom: 28px;
  font-family: var(--font-body);
  font-size: 12px;
  font-weight: 700;
  color: #93C5FD;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  backdrop-filter: blur(10px);
}
.eyebrow-dot {
  width: 8px; height: 8px;
  background: #22D3EE;
  border-radius: 50%;
  box-shadow: 0 0 10px #22D3EE;
  animation: pulse 2s infinite;
}
@keyframes pulse {
  0%,100% { box-shadow: 0 0 0 0 rgba(34,211,238,0.6); }
  50%      { box-shadow: 0 0 0 8px rgba(34,211,238,0); }
}

/* ---- Title ---- */
.hero-title {
  font-family: var(--font-heading, 'Poppins'), sans-serif;
  font-size: clamp(2.4rem, 5vw, 3.8rem);
  font-weight: 900;
  line-height: 1.08;
  letter-spacing: -2px;
  margin-bottom: 24px;
  color: #fff;
}
.hero-accent {
  background: linear-gradient(90deg, #60A5FA 0%, #A78BFA 60%, #22D3EE 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.hero-white { color: #fff; }

/* ---- Subtitle ---- */
.hero-sub {
  font-family: var(--font-body);
  font-size: 1rem;
  line-height: 1.8;
  color: rgba(255,255,255,0.55);
  max-width: 480px;
  margin-bottom: 36px;
  font-weight: 300;
}
.hero-sub strong { color: rgba(255,255,255,0.9); font-weight: 600; }

/* ---- CTA Buttons ---- */
.hero-actions { display: flex; flex-wrap: wrap; gap: 14px; margin-bottom: 48px; }

.hero-btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, #2563EB, #1D4ED8);
  color: #fff;
  padding: 15px 32px;
  border-radius: 50px;
  font-family: var(--font-body);
  font-weight: 700;
  font-size: 15px;
  text-decoration: none;
  box-shadow: 0 8px 32px rgba(37,99,235,0.5), 0 0 0 1px rgba(96,165,250,0.2);
  transition: all 0.25s;
}
.hero-btn-primary:hover {
  background: linear-gradient(135deg, #1D4ED8, #1E40AF);
  transform: translateY(-3px);
  box-shadow: 0 16px 48px rgba(37,99,235,0.65);
  color: #fff;
}

.hero-btn-ghost {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.18);
  color: rgba(255,255,255,0.85);
  padding: 14px 30px;
  border-radius: 50px;
  font-family: var(--font-body);
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  backdrop-filter: blur(10px);
  transition: all 0.25s;
}
.hero-btn-ghost:hover {
  background: rgba(255,255,255,0.12);
  border-color: rgba(255,255,255,0.3);
  color: #fff;
  transform: translateY(-2px);
}

/* ---- Stats ---- */
.hero-stats { display: flex; align-items: center; gap: 0; }
.hstat { text-align: left; }
.hstat-num {
  display: block;
  font-family: var(--font-heading);
  font-size: 1.9rem;
  font-weight: 800;
  color: #fff;
  line-height: 1;
}
.hstat-plus { font-size: 1.2rem; color: #60A5FA; }
.hstat-label {
  display: block;
  font-size: 11px;
  color: rgba(255,255,255,0.45);
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-top: 4px;
  font-weight: 500;
}
.hstat-sep {
  width: 1px;
  height: 40px;
  background: rgba(255,255,255,0.15);
  margin: 0 28px;
}

/* ---- Visual / Orbit ---- */
.hero-visual-ring {
  position: absolute;
  border-radius: 50%;
  border: 1px solid rgba(96,165,250,0.15);
  top: 50%; left: 50%;
  transform: translate(-50%,-50%);
  animation: ringPulse 6s ease-in-out infinite;
}
.rv1 { width: 440px; height: 440px; animation-delay: 0s; }
.rv2 { width: 320px; height: 320px; animation-delay: -2s; border-color: rgba(96,165,250,0.2); }
.rv3 { width: 200px; height: 200px; animation-delay: -4s; border-color: rgba(96,165,250,0.3); }
@keyframes ringPulse {
  0%,100% { opacity: 0.6; transform: translate(-50%,-50%) scale(1); }
  50%      { opacity: 1;   transform: translate(-50%,-50%) scale(1.03); }
}

.hero-core {
  position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%,-50%);
  width: 100px; height: 100px;
  background: linear-gradient(135deg, #1E3A8A, #2563EB);
  border-radius: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 0 12px rgba(37,99,235,0.15), 0 0 60px rgba(37,99,235,0.4);
  z-index: 3;
  animation: corePulse 4s ease-in-out infinite;
}
.hero-core-logo { width: 64px; height: 64px; object-fit: contain; }
@keyframes corePulse {
  0%,100% { box-shadow: 0 0 0 12px rgba(37,99,235,0.15), 0 0 60px rgba(37,99,235,0.4); }
  50%      { box-shadow: 0 0 0 20px rgba(37,99,235,0.08), 0 0 90px rgba(37,99,235,0.6); }
}

.hero-orbit-card {
  position: absolute;
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(13,27,62,0.85);
  border: 1px solid rgba(96,165,250,0.25);
  border-radius: 12px;
  padding: 10px 16px;
  font-family: var(--font-body);
  font-size: 12px;
  font-weight: 600;
  color: rgba(255,255,255,0.9);
  backdrop-filter: blur(16px);
  white-space: nowrap;
  z-index: 4;
  box-shadow: 0 8px 32px rgba(0,0,0,0.3);
  animation: cardFloat 5s ease-in-out infinite;
}
.hero-orbit-card i { color: #60A5FA; font-size: 14px; }
.oc1 { top: 10%; right: 5%;  animation-delay: 0s; }
.oc2 { bottom: 18%; left: 5%;  animation-delay: -1.5s; }
.oc3 { top: 45%; right: -5%; animation-delay: -3s; }
@keyframes cardFloat {
  0%,100% { transform: translateY(0px); }
  50%      { transform: translateY(-10px); }
}

.hero-orbit-dot {
  position: absolute;
  width: 10px; height: 10px;
  background: #3B82F6;
  border-radius: 50%;
  box-shadow: 0 0 14px rgba(59,130,246,0.7);
  z-index: 2;
}
.od1 { top: 12%; left: 18%; }
.od2 { top: 70%; right: 12%; }
.od3 { bottom: 10%; left: 35%; }
.od4 { top: 40%; left: 5%; }

/* ---- Scroll cue ---- */
.hero-scroll-cue {
  position: absolute;
  bottom: 36px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 5;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  color: rgba(255,255,255,0.4);
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 2px;
  text-transform: uppercase;
}
.scroll-track {
  width: 24px; height: 38px;
  border: 2px solid rgba(255,255,255,0.2);
  border-radius: 12px;
  display: flex;
  justify-content: center;
  padding-top: 6px;
}
.scroll-thumb {
  width: 4px; height: 8px;
  background: #60A5FA;
  border-radius: 2px;
  animation: scrollThumb 2s ease-in-out infinite;
}
@keyframes scrollThumb {
  0%   { transform: translateY(0); opacity: 1; }
  100% { transform: translateY(14px); opacity: 0; }
}

/* ---- Responsive ---- */
@media (max-width: 991px) {
  .hero-inner { flex-direction: column; text-align: center; padding-top: 130px; padding-bottom: 60px; gap: 40px; }
  .hero-left { max-width: 100%; }
  .hero-eyebrow { margin-left: auto; margin-right: auto; }
  .hero-sub { margin-left: auto; margin-right: auto; }
  .hero-actions { justify-content: center; }
  .hero-stats { justify-content: center; }
  .hero-scroll-cue { display: none; }
}
@media (max-width: 576px) {
  .hero-title { letter-spacing: -1px; }
  .hero-btn-primary, .hero-btn-ghost { padding: 13px 24px; font-size: 14px; }
}
</style>



{{-- ===== TRUSTED BY MARQUEE ===== --}}
<section class="spp-marquee-section">
  <div class="container mb-3 text-center">
    <p class="marquee-label">Teknologi yang Kami Gunakan</p>
  </div>
  <div class="marquee-track-wrap">
    <div class="marquee-track">
      <span class="mq-item"><i class="fab fa-laravel"></i> Laravel</span>
      <span class="mq-item"><i class="fab fa-android"></i> Android</span>
      <span class="mq-item"><i class="fab fa-node-js"></i> Node.js</span>
      <span class="mq-item"><i class="fab fa-php"></i> PHP</span>
      <span class="mq-item"><i class="fas fa-database"></i> MySQL</span>
      <span class="mq-item"><i class="fab fa-js-square"></i> JavaScript</span>
      <span class="mq-item"><i class="fab fa-react"></i> React</span>
      <span class="mq-item"><i class="fab fa-docker"></i> Docker</span>
      <span class="mq-item"><i class="fab fa-laravel"></i> Laravel</span>
      <span class="mq-item"><i class="fab fa-android"></i> Android</span>
      <span class="mq-item"><i class="fab fa-node-js"></i> Node.js</span>
      <span class="mq-item"><i class="fab fa-php"></i> PHP</span>
      <span class="mq-item"><i class="fas fa-database"></i> MySQL</span>
      <span class="mq-item"><i class="fab fa-js-square"></i> JavaScript</span>
      <span class="mq-item"><i class="fab fa-react"></i> React</span>
      <span class="mq-item"><i class="fab fa-docker"></i> Docker</span>
    </div>
  </div>
</section>

{{-- ===== SERVICES BENTO GRID ===== --}}
<section class="spp-bento-section">
  <div class="container">
    <div class="section-header text-center mb-5 reveal">
      <span class="section-pill">Layanan Kami</span>
      <h2 class="section-title mt-3">Solusi Terintegrasi,<br><span class="text-eb">Dieksekusi dengan Presisi</span></h2>
      <p class="section-sub">Dari aplikasi mobile hingga infrastruktur enterprise — kami merancang solusi yang siap berkembang bersama bisnis Anda.</p>
    </div>
    <div class="bento-grid">
      <div class="bento-card bc-large reveal">
        <div class="bc-icon-wrap bc-blue">
          <svg viewBox="0 0 48 48" fill="none"><rect x="10" y="4" width="28" height="40" rx="4" fill="rgba(37,99,235,0.15)" stroke="#2563EB" stroke-width="2"/><rect x="16" y="10" width="16" height="10" rx="2" fill="#3B82F6" opacity="0.5"/><circle cx="24" cy="36" r="3" fill="#2563EB"/></svg>
        </div>
        <span class="bc-badge">Mobile &middot; Desktop</span>
        <h3 class="bc-title">Pengembangan Aplikasi</h3>
        <p class="bc-desc">Aplikasi Android, iOS &amp; desktop berperforma tinggi, dibangun dengan UX intuitif dan skalabilitas kelas enterprise.</p>
        <a href="{{ route('services.index') }}" class="bc-link">Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
        <div class="bc-deco"></div>
      </div>
      <div class="bento-card bc-medium reveal delay-200">
        <div class="bc-icon-wrap bc-indigo">
          <svg viewBox="0 0 48 48" fill="none"><rect x="4" y="8" width="40" height="32" rx="4" fill="rgba(99,102,241,0.15)" stroke="#6366F1" stroke-width="2"/><rect x="4" y="8" width="40" height="10" rx="4" fill="rgba(99,102,241,0.3)"/><circle cx="11" cy="13" r="2" fill="#fff" opacity="0.7"/><circle cx="18" cy="13" r="2" fill="#fff" opacity="0.7"/></svg>
        </div>
        <span class="bc-badge">Web &middot; E-Commerce</span>
        <h3 class="bc-title">Pengembangan Website</h3>
        <p class="bc-desc">Website profesional yang cepat, SEO-friendly, dan berkesan — solusi kehadiran digital yang tak terlupakan.</p>
        <a href="{{ route('services.index') }}" class="bc-link">Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
      </div>
      <div class="bento-card bc-medium bc-dark reveal delay-400">
        <div class="bc-icon-wrap bc-sky">
          <svg viewBox="0 0 48 48" fill="none"><rect x="8" y="12" width="32" height="24" rx="3" fill="rgba(14,165,233,0.15)" stroke="#0EA5E9" stroke-width="2"/><rect x="14" y="18" width="20" height="4" rx="1" fill="#0EA5E9" opacity="0.5"/><rect x="14" y="26" width="14" height="4" rx="1" fill="#0EA5E9" opacity="0.3"/><line x1="24" y1="36" x2="24" y2="42" stroke="#0EA5E9" stroke-width="2"/><rect x="16" y="42" width="16" height="2" rx="1" fill="#0EA5E9"/></svg>
        </div>
        <span class="bc-badge">Server &middot; Jaringan</span>
        <h3 class="bc-title">Infrastruktur IT</h3>
        <p class="bc-desc">Instalasi server, jaringan Mikrotik &amp; layanan IT terkelola yang aman dan stabil untuk kantor Anda.</p>
        <a href="{{ route('services.index') }}" class="bc-link">Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
      </div>
    </div>
  </div>
</section>

{{-- ===== PORTFOLIO ===== --}}
<section class="spp-portfolio-section">
  <div class="container">
    <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3 reveal">
      <div>
        <span class="section-pill section-pill-dark">Portofolio</span>
        <h2 class="section-title dark mt-3">Proyek <span class="text-eb-dark">Unggulan Kami</span></h2>
      </div>
      <a href="{{ route('portfolio.index') }}" class="btn-outline-dark-pill">Lihat Semua Proyek <i class="fas fa-arrow-right ms-1"></i></a>
    </div>
    <div class="row g-4">
      <div class="col-md-6 reveal-left">
        <div class="pf-card">
          <div class="pf-img-wrap">
            <img src="{{ asset('assets/media/images/tab-image-1.png') }}" alt="Sistem Enterprise" class="pf-img">
            <div class="pf-overlay">
              <span class="pf-badge">Web Development</span>
              <h4 class="pf-title">Enterprise System V.1</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 reveal-right">
        <div class="pf-card">
          <div class="pf-img-wrap">
            <img src="{{ asset('assets/media/images/tab-image-2.png') }}" alt="Aplikasi Mobile" class="pf-img">
            <div class="pf-overlay">
              <span class="pf-badge pf-badge-purple">Mobile App</span>
              <h4 class="pf-title">Aplikasi Mobile</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===== TESTIMONIALS ===== --}}
    </div>
  </div>
</section>

{{-- ===== WHY CHOOSE US ===== --}}
<section class="spp-why-section">
  <div class="container">
    <div class="section-header text-center mb-5 reveal">
      <span class="section-pill section-pill-light">Keunggulan Kami</span>
      <h2 class="section-title mt-3 text-white">Mengapa Memilih <span class="text-eb">Sekawan Putra Pratama?</span></h2>
      <p class="section-sub">Kami memberikan lebih dari sekadar kode — kami memberikan solusi bisnis yang strategis.</p>
    </div>
    <div class="row g-4">
      <div class="col-lg-3 col-md-6 reveal">
        <div class="why-card">
          <div class="why-icon"><i class="fas fa-clock"></i></div>
          <h4 class="why-title">Tepat Waktu</h4>
          <p class="why-desc">Kami memahami waktu adalah uang. Komitmen kami adalah delivery proyek sesuai deadline.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 reveal delay-100">
        <div class="why-card">
          <div class="why-icon"><i class="fas fa-headset"></i></div>
          <h4 class="why-title">Support 24/7</h4>
          <p class="why-desc">Dukungan teknis purna jual yang sigap memastikan sistem Anda berjalan tanpa hambatan.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 reveal delay-200">
        <div class="why-card">
          <div class="why-icon"><i class="fas fa-hand-holding-usd"></i></div>
          <h4 class="why-title">Harga Transparan</h4>
          <p class="why-desc">Tanpa biaya tersembunyi. Penawaran kami jujur dan sesuai dengan kompleksitas proyek.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 reveal delay-300">
        <div class="why-card">
          <div class="why-icon"><i class="fas fa-certificate"></i></div>
          <h4 class="why-title">Tim Profesional</h4>
          <p class="why-desc">Dikerjakan oleh developer dan engineer bersertifikat dengan pengalaman bertahun-tahun.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===== HOW WE WORK ===== --}}
<section class="spp-process-section">
  <div class="container">
    <div class="section-header text-center mb-5 reveal">
      <span class="section-pill section-pill-dark">Proses Kerja</span>
      <h2 class="section-title dark mt-3">Bagaimana Kami <span class="text-eb-dark">Mewujudkan Ide Anda?</span></h2>
    </div>
    <div class="process-steps">
      <div class="process-step reveal">
        <div class="ps-num">01</div>
        <h4 class="ps-title">Konsultasi</h4>
        <p class="ps-desc">Diskusi mendalam untuk memahami kebutuhan dan tantangan bisnis Anda.</p>
      </div>
      <div class="process-step reveal delay-100">
        <div class="ps-num">02</div>
        <h4 class="ps-title">Perancangan</h4>
        <p class="ps-desc">Penyusunan konsep, arsitektur sistem, dan desain UI/UX yang intuitif.</p>
      </div>
      <div class="process-step reveal delay-200">
        <div class="ps-num">03</div>
        <h4 class="ps-title">Pengembangan</h4>
        <p class="ps-desc">Proses coding dan integrasi sistem dengan standar keamanan tinggi.</p>
      </div>
      <div class="process-step reveal delay-300">
        <div class="ps-num">04</div>
        <h4 class="ps-title">Launch & Support</h4>
        <p class="ps-desc">Implementasi sistem dan pendampingan pasca-rilis secara berkelanjutan.</p>
      </div>
    </div>
  </div>
</section>

{{-- ===== BLOG PREVIEW (DYNAMIC) ===== --}}
<section class="spp-blog-preview">
  <div class="container">
    <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3 reveal">
      <div>
        <span class="section-pill section-pill-light">Artikel Terbaru</span>
        <h2 class="section-title mt-3 text-white">Wawasan <span class="text-eb">Teknologi Terkini</span></h2>
      </div>
      <a href="{{ route('blog.index') }}" class="hero-btn-ghost">Baca Semua Artikel <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
    <div class="row g-4">
      @forelse($latestBlogs as $index => $blog)
      <div class="col-lg-4 col-md-6 reveal" style="transition-delay: {{ $index * 150 }}ms">
        <div class="blog-card-new">
          <div class="bcn-img-wrap">
            <img src="{{ $blog->thumbnail ? asset('storage/'.$blog->thumbnail) : asset('assets/media/images/placeholder-blog.png') }}" alt="{{ $blog->title }}" class="bcn-img">
            <span class="bcn-cat">{{ $blog->category->name ?? 'Uncategorized' }}</span>
          </div>
          <div class="bcn-body">
            <span class="bcn-date">{{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}</span>
            <h4 class="bcn-title"><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h4>
            <p class="bcn-excerpt">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
            <a href="{{ route('blog.show', $blog->slug) }}" class="bcn-link">Baca Selengkapnya <i class="fas fa-chevron-right ms-1"></i></a>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center py-5">
        <p class="text-white-50">Belum ada artikel yang diterbitkan.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>

{{-- ===== FAQ SECTION ===== --}}
<section class="spp-faq-section">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-5 reveal-left">
        <span class="section-pill section-pill-dark">FAQ</span>
        <h2 class="section-title dark mt-3">Pertanyaan yang <span class="text-eb-dark">Sering Diajukan</span></h2>
        <p class="section-sub text-start mx-0">Masih ragu? Berikut adalah beberapa jawaban untuk pertanyaan yang paling sering kami terima dari klien.</p>
        <div class="faq-cta-box mt-4">
          <h5>Punya pertanyaan lain?</h5>
          <p>Tim kami siap membantu Anda secara langsung.</p>
          <a href="{{ route('contact') }}" class="btn-primary-hero">Hubungi Kami <i class="fas fa-comment-dots ms-2"></i></a>
        </div>
      </div>
      <div class="col-lg-7 reveal-right">
        <div class="accordion spp-accordion" id="faqAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                Berapa lama waktu pengerjaan sebuah website?
              </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Waktu pengerjaan sangat bervariasi tergantung kompleksitas. Website landing page biasanya memakan waktu 1-2 minggu, sementara sistem enterprise bisa 1-3 bulan.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                Apakah ada garansi setelah proyek selesai?
              </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Tentu. Kami memberikan garansi bug-free selama 3 bulan dan dukungan teknis purna jual untuk memastikan sistem Anda berjalan dengan baik.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                Apakah saya bisa berkonsultasi mengenai ide bisnis saya?
              </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Sangat bisa! Kami menawarkan konsultasi GRATIS untuk membantu Anda memvalidasi ide dari sisi teknis dan merencanakan roadmap pengembangannya.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                Teknologi apa yang kalian gunakan?
              </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Kami menggunakan teknologi modern seperti Laravel, React, Node.js, Flutter, dan infrastruktur cloud terpercaya untuk menjamin performa dan keamanan.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===== CTA BANNER ===== --}}
<section class="spp-cta-section" style="margin-top: -1px; border-top: none;">
  <div class="cta-grid-overlay"></div>
  <div class="container text-center position-relative z-2">
    <h2 class="cta-title">Siap Membangun Sesuatu yang<br><span class="text-eb">Luar Biasa?</span></h2>
    <p class="cta-sub">Jangan tunda ide terbaik Anda. Bicarakan kebutuhan teknologi bisnis Anda bersama tim ahli kami sekarang — konsultasi gratis!</p>
    <div class="d-flex flex-wrap gap-3 justify-content-center mt-4">
      <a href="{{ route('contact') }}" class="btn-cta-primary">Mulai Konsultasi Gratis</a>
      <a href="https://wa.me/6285156412702" class="btn-cta-outline" target="_blank"><i class="fab fa-whatsapp me-2"></i>Chat via WhatsApp</a>
    </div>
  </div>
</section>

<style>
/* ====== HERO ====== */
#spp-hero{background:var(--midnight-blue);position:relative;overflow:hidden;}
.hero-bg-layers{position:absolute;inset:0;pointer-events:none;}
.hero-glow{position:absolute;border-radius:50%;filter:blur(100px);opacity:.35;}
.hero-glow.g1{width:600px;height:600px;top:-15%;left:-10%;background:radial-gradient(circle,#2563EB,transparent 70%);animation:gDrift 14s infinite alternate;}
.hero-glow.g2{width:500px;height:500px;bottom:-10%;right:-8%;background:radial-gradient(circle,#4F46E5,transparent 70%);animation:gDrift 10s infinite alternate-reverse;}
.hero-grid{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:38px 38px;}
@keyframes gDrift{from{transform:translate(0,0);}to{transform:translate(40px,40px);}}
.hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(10px);padding:8px 18px;border-radius:50px;font-size:13px;font-weight:600;color:rgba(255,255,255,.9);letter-spacing:.5px;}
.pulse-dot{width:8px;height:8px;background:#3B82F6;border-radius:50%;box-shadow:0 0 10px #3B82F6;animation:pls 2s infinite;}
@keyframes pls{0%,100%{opacity:1;}50%{opacity:.3;}}
.hero-title{font-family:var(--font-heading);font-size:clamp(2.4rem,5vw,3.8rem);font-weight:800;color:#fff;line-height:1.1;letter-spacing:-1.5px;}
.hero-gradient{background:linear-gradient(135deg,#60A5FA,#818CF8);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.hero-sub{font-size:1.1rem;color:rgba(255,255,255,.6);max-width:560px;line-height:1.7;}
.hero-sub strong{color:rgba(255,255,255,.9);}
.btn-primary-hero{background:var(--electric-blue);color:#fff;padding:14px 32px;border-radius:50px;font-weight:600;font-size:15px;text-decoration:none;transition:var(--transition);box-shadow:0 8px 28px rgba(37,99,235,.45);display:inline-flex;align-items:center;gap:8px;}
.btn-primary-hero:hover{background:var(--electric-hover);color:#fff;transform:translateY(-3px);box-shadow:0 14px 35px rgba(37,99,235,.6);}
.btn-outline-hero{border:1.5px solid rgba(255,255,255,.25);color:rgba(255,255,255,.85);padding:14px 32px;border-radius:50px;font-weight:600;font-size:15px;text-decoration:none;transition:var(--transition);display:inline-flex;align-items:center;}
.btn-outline-hero:hover{background:rgba(255,255,255,.08);color:#fff;border-color:rgba(255,255,255,.5);}
.hero-stats{display:flex;align-items:center;gap:32px;padding-top:32px;border-top:1px solid rgba(255,255,255,.1);}
.stat-item{display:flex;flex-direction:column;}
.stat-num{font-family:var(--font-heading);font-size:1.8rem;font-weight:800;color:#fff;}
.stat-label{font-size:11px;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,.5);font-weight:600;}
.stat-divider{width:1px;height:40px;background:rgba(255,255,255,.1);}
.hero-visual{position:relative;width:420px;height:420px;}
.hero-svg{width:100%;height:100%;animation:svgSpin 30s linear infinite;}
@keyframes svgSpin{from{transform:rotate(0deg);}to{transform:rotate(360deg);}}
.svg-node{animation:nodeGlow 3s ease-in-out infinite alternate;}
@keyframes nodeGlow{from{filter:drop-shadow(0 0 4px #2563EB);}to{filter:drop-shadow(0 0 12px #60A5FA);}}
.hero-card{position:absolute;background:rgba(255,255,255,.1);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.15);border-radius:14px;padding:12px 18px;display:flex;align-items:center;gap:10px;color:#fff;font-size:13px;font-weight:600;white-space:nowrap;}
.hero-card i{font-size:16px;color:#60A5FA;}
.hc1{top:40px;right:-20px;animation:hcFloat 4s ease-in-out infinite;}
.hc2{bottom:60px;left:-20px;animation:hcFloat 4s ease-in-out infinite 2s;}
@keyframes hcFloat{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}

/* ====== MARQUEE ====== */
.spp-marquee-section{background:#fff;padding:28px 0;border-top:1px solid var(--slate-200);border-bottom:1px solid var(--slate-200);overflow:hidden;}
.marquee-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:var(--slate-400);margin-bottom:16px;}
.marquee-track-wrap{overflow:hidden;mask-image:linear-gradient(to right,transparent,black 10%,black 90%,transparent);}
.marquee-track{display:flex;gap:48px;animation:marqueeScroll 25s linear infinite;width:max-content;}
.mq-item{display:flex;align-items:center;gap:10px;font-size:15px;font-weight:600;color:var(--slate-400);white-space:nowrap;filter:grayscale(1);transition:var(--transition);}
.mq-item:hover{filter:grayscale(0);color:var(--electric-blue);}
.mq-item i{font-size:22px;}
@keyframes marqueeScroll{from{transform:translateX(0);}to{transform:translateX(-50%);}}

/* ====== BENTO GRID ====== */
.spp-bento-section{background:var(--midnight-blue);padding:100px 0;}
.section-pill{background:rgba(37,99,235,.15);color:#60A5FA;border:1px solid rgba(37,99,235,.3);padding:6px 16px;border-radius:50px;font-size:12px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;}
.section-pill-light{background:rgba(255,255,255,.08);color:rgba(255,255,255,.7);border:1px solid rgba(255,255,255,.15);}
.section-pill-dark{background:rgba(37,99,235,.1);color:var(--electric-blue);border:1px solid rgba(37,99,235,.2);}
.section-title{font-family:var(--font-heading);font-size:clamp(1.8rem,3.5vw,2.8rem);font-weight:800;color:#fff;line-height:1.2;}
.section-title.dark{color:var(--midnight-blue);}
.section-sub{color:var(--slate-400);max-width:580px;margin:12px auto 0;font-size:1rem;line-height:1.7;}
.text-eb{background:linear-gradient(135deg,#60A5FA,#818CF8);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.text-eb-dark{background:linear-gradient(135deg,var(--electric-blue),#6366F1);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.bento-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.bento-card{background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-xl);padding:36px;position:relative;overflow:hidden;transition:var(--transition);cursor:default;}
.bento-card:hover{transform:translateY(-8px);border-color:rgba(37,99,235,.4);box-shadow:0 20px 60px rgba(0,0,0,.4),var(--shadow-glow);}
.bc-large{grid-column:span 1;grid-row:span 2;}
.bc-medium{grid-column:span 1;}
.bc-dark{background:rgba(37,99,235,.08);}
.bc-icon-wrap{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:24px;}
.bc-icon-wrap svg{width:36px;height:36px;}
.bc-blue{background:rgba(37,99,235,.15);}
.bc-indigo{background:rgba(99,102,241,.15);}
.bc-sky{background:rgba(14,165,233,.15);}
.bc-badge{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--slate-400);margin-bottom:12px;display:block;}
.bc-title{font-family:var(--font-heading);font-size:1.35rem;font-weight:700;color:#fff;margin-bottom:12px;}
.bc-desc{font-size:.9rem;color:var(--slate-400);line-height:1.7;margin-bottom:20px;}
.bc-link{color:#60A5FA;font-size:14px;font-weight:600;text-decoration:none;transition:color .2s;}
.bc-link:hover{color:#fff;}
.bc-deco{position:absolute;bottom:-40px;right:-40px;width:160px;height:160px;border-radius:50%;background:radial-gradient(circle,rgba(37,99,235,.15),transparent 70%);}

/* ====== PORTFOLIO ====== */
.spp-portfolio-section{background:var(--off-white);padding:100px 0;}
.btn-outline-dark-pill{border:2px solid var(--midnight-blue);color:var(--midnight-blue);padding:10px 24px;border-radius:50px;font-weight:600;font-size:14px;text-decoration:none;transition:var(--transition);white-space:nowrap;}
.btn-outline-dark-pill:hover{background:var(--midnight-blue);color:#fff;}
.pf-card{border-radius:var(--radius-xl);overflow:hidden;}
.pf-img-wrap{position:relative;overflow:hidden;border-radius:var(--radius-xl);}
.pf-img{width:100%;display:block;transition:transform .5s ease;}
.pf-img-wrap:hover .pf-img{transform:scale(1.06);}
.pf-overlay{position:absolute;inset:0;background:linear-gradient(to bottom,transparent 40%,rgba(10,22,40,.92));display:flex;flex-direction:column;justify-content:flex-end;padding:28px;opacity:.95;}
.pf-badge{background:var(--electric-blue);color:#fff;padding:5px 14px;border-radius:50px;font-size:12px;font-weight:700;width:fit-content;margin-bottom:8px;}
.pf-badge-purple{background:#6366F1;}


/* ====== CTA ====== */
.spp-cta-section{background:linear-gradient(135deg,var(--midnight-blue) 0%,#1E40AF 50%,#2563EB 100%);padding:100px 0;position:relative;overflow:hidden;}
.cta-grid-overlay{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.05) 1px,transparent 1px);background-size:40px 40px;pointer-events:none;}
.cta-title{font-family:var(--font-heading);font-size:clamp(2rem,4vw,3rem);font-weight:800;color:#fff;line-height:1.2;margin-bottom:16px;}
.cta-sub{color:rgba(255,255,255,.7);font-size:1.1rem;max-width:560px;margin:0 auto;line-height:1.7;}
.btn-cta-primary{background:#fff;color:var(--electric-blue);padding:14px 32px;border-radius:50px;font-weight:700;font-size:15px;text-decoration:none;transition:var(--transition);box-shadow:0 8px 28px rgba(0,0,0,.2);}
.btn-cta-primary:hover{transform:translateY(-3px);box-shadow:0 14px 40px rgba(0,0,0,.3);color:var(--electric-hover);}
.btn-cta-outline{border:2px solid rgba(255,255,255,.4);color:#fff;padding:14px 32px;border-radius:50px;font-weight:700;font-size:15px;text-decoration:none;transition:var(--transition);display:inline-flex;align-items:center;}
.btn-cta-outline:hover{background:rgba(255,255,255,.1);border-color:#fff;color:#fff;}

/* ====== WHY US ====== */
.spp-why-section{background:#0A1628;padding:100px 0;}
.why-card{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);padding:32px;border-radius:20px;height:100%;transition:all .3s ease;}
.why-card:hover{background:rgba(37,99,235,.05);border-color:rgba(37,99,235,.3);transform:translateY(-8px);}
.why-icon{width:50px;height:50px;background:rgba(37,99,235,.15);border-radius:12px;display:flex;align-items:center;justify-content:center;color:#60A5FA;font-size:22px;margin-bottom:20px;}
.why-title{color:#fff;font-size:1.15rem;font-weight:700;margin-bottom:12px;font-family:var(--font-heading);}
.why-desc{color:rgba(255,255,255,.5);font-size:.9rem;line-height:1.6;margin:0;}

/* ====== PROCESS ====== */
.spp-process-section{background:#fff;padding:100px 0;}
.process-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-top:40px;position:relative;}
.process-steps::after{content:'';position:absolute;top:40px;left:0;right:0;height:2px;background:linear-gradient(to right,#E2E8F0,transparent);z-index:0;}
.process-step{position:relative;z-index:1;}
.ps-num{width:80px;height:80px;background:#fff;border:2px solid #E2E8F0;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.8rem;font-weight:800;color:var(--midnight-blue);margin-bottom:24px;transition:all .3s ease;box-shadow:0 10px 30px rgba(0,0,0,.05);}
.process-step:hover .ps-num{border-color:var(--electric-blue);color:var(--electric-blue);transform:scale(1.1);}
.ps-title{font-family:var(--font-heading);font-size:1.1rem;font-weight:700;color:var(--midnight-blue);margin-bottom:8px;}
.ps-desc{color:var(--slate-500);font-size:.85rem;line-height:1.6;}

/* ====== BLOG NEW ====== */
.spp-blog-preview{background:#0A1628;padding:100px 0;}
.blog-card-new{background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.08);border-radius:24px;overflow:hidden;transition:all .3s ease;height:100%;}
.blog-card-new:hover{transform:translateY(-10px);border-color:rgba(37,99,235,.4);box-shadow:0 20px 50px rgba(0,0,0,.3);}
.bcn-img-wrap{position:relative;height:220px;overflow:hidden;}
.bcn-img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease;}
.blog-card-new:hover .bcn-img{transform:scale(1.1);}
.bcn-cat{position:absolute;top:16px;left:16px;background:var(--electric-blue);color:#fff;padding:4px 14px;border-radius:50px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;}
.bcn-body{padding:28px;}
.bcn-date{display:block;font-size:12px;color:rgba(255,255,255,.4);margin-bottom:10px;font-weight:600;}
.bcn-title{font-family:var(--font-heading);font-size:1.2rem;font-weight:700;margin-bottom:12px;line-height:1.4;}
.bcn-title a{color:#fff;text-decoration:none;transition:color .2s;}
.bcn-title a:hover{color:#60A5FA;}
.bcn-excerpt{color:rgba(255,255,255,.5);font-size:.9rem;line-height:1.6;margin-bottom:20px;}
.bcn-link{color:#60A5FA;font-size:13px;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;transition:all .2s;}
.bcn-link:hover{color:#fff;gap:10px;}

/* ====== FAQ ====== */
.spp-faq-section{background:#F8FAFC;padding:100px 0;}
.faq-cta-box{background:#fff;border:1px solid #E2E8F0;padding:28px;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,.03);}
.faq-cta-box h5{font-weight:700;color:var(--midnight-blue);margin-bottom:10px;}
.faq-cta-box p{font-size:.9rem;color:var(--slate-500);margin-bottom:20px;}
.spp-accordion .accordion-item{background:#fff;border:1px solid #E2E8F0;border-radius:16px !important;margin-bottom:14px;overflow:hidden;}
.spp-accordion .accordion-button{padding:20px 24px;font-weight:600;color:var(--midnight-blue);font-size:1rem;background:#fff;box-shadow:none;}
.spp-accordion .accordion-button:not(.collapsed){background:#F1F5F9;color:var(--electric-blue);}
.spp-accordion .accordion-body{padding:20px 24px;color:var(--slate-600);line-height:1.7;font-size:.95rem;}


/* ====== REVEAL ANIMATIONS ====== */
.reveal {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
  will-change: transform, opacity;
}
.reveal.active {
  opacity: 1;
  transform: translateY(0);
}
.reveal-left {
  opacity: 0;
  transform: translateX(-40px);
  transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
}
.reveal-left.active {
  opacity: 1;
  transform: translateX(0);
}
.reveal-right {
  opacity: 0;
  transform: translateX(40px);
  transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
}
.reveal-right.active {
  opacity: 1;
  transform: translateX(0);
}

/* Stagger delays */
.delay-100 { transition-delay: 100ms; }
.delay-200 { transition-delay: 200ms; }
.delay-300 { transition-delay: 300ms; }
.delay-400 { transition-delay: 400ms; }
.delay-500 { transition-delay: 500ms; }

/* ====== RESPONSIVE ====== */
@media(max-width:991px){
  .bento-grid{grid-template-columns:1fr 1fr;}
  .bc-large{grid-column:span 2;grid-row:span 1;}
  .hero-stats{gap:20px;}
  .stat-num{font-size:1.4rem;}
}
@media(max-width:600px){
  .bento-grid{grid-template-columns:1fr;}
  .bc-large{grid-column:span 1;}
  .hero-stats{gap:16px;flex-wrap:wrap;}
  .process-steps{grid-template-columns:1fr 1fr;gap:32px;}
  .process-steps::after{display:none;}
  .spp-bento-section,.spp-portfolio-section,.spp-testi-section,.spp-cta-section,.spp-why-section,.spp-process-section,.spp-blog-preview,.spp-faq-section{padding:70px 0;}
}
@media(max-width:480px){
  .process-steps{grid-template-columns:1fr;}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // 1. Hero Particles
  const p = document.getElementById('heroParticles');
  if(p) {
    for(let i=0; i<22; i++) {
      const d = document.createElement('div');
      d.className = 'hero-particle';
      d.style.left = Math.random()*100 + '%';
      d.style.top = Math.random()*100 + '%';
      d.style.animationDelay = (Math.random()*6) + 's';
      d.style.animationDuration = (4+Math.random()*6) + 's';
      d.style.opacity = Math.random()*0.7;
      p.appendChild(d);
    }
  }

  // 2. Scroll Reveal Engine
  const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
  
  if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('active');
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));
  } else {
    // Fallback for old browsers
    revealElements.forEach(el => el.classList.add('active'));
  }
});
</script>

@endsection
