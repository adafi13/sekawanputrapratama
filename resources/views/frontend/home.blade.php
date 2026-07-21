@extends('frontend.layouts.app')

@section('title', 'Jasa IT Terpercaya | Software House & IT Consultant - PT Sekawan Putra Pratama')
@section('meta_description', 'Software house terpercaya sejak 2024. Jasa pembuatan website profesional, aplikasi mobile Android/iOS, instalasi server & jaringan kantor. Konsultasi GRATIS!')
@section('meta_keywords', 'jasa IT terpercaya, software house Indonesia, jasa pembuatan website, aplikasi mobile, instalasi server, IT consultant Jakarta, web developer profesional')

@push('schema')
<script type="application/ld+json">
@php
echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
        [
            '@type' => 'Question',
            'name' => 'Berapa estimasi biaya pembuatan aplikasi atau website?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Biaya sangat bergantung pada kompleksitas fitur, skala sistem, dan platform yang dituju. Kami merekomendasikan Anda untuk menghubungi kami guna melakukan konsultasi awal secara gratis, setelah itu kami dapat memberikan penawaran yang akurat.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Apakah ada layanan maintenance setelah aplikasi selesai?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Tentu saja. Kami menyertakan garansi perbaikan bug secara gratis untuk periode tertentu. Selain itu, kami menawarkan paket SLA (Service Level Agreement) untuk pemeliharaan rutin, backup, dan dukungan teknis jangka panjang.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Apakah melayani pengerjaan proyek dari luar kota Bekasi/Jakarta?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Ya, kami melayani klien dari seluruh Indonesia. Proses komunikasi, pelaporan progres, dan meeting dapat dilakukan secara online melalui Zoom/Google Meet dengan sangat efektif.',
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/vendor/swiper-bundle.min.css') }}">
@endpush

@section('content')

{{-- CSS MODERN BENTO - LIGHT THEME --}}
<style>
/* ============================================================
   GLOBAL & UTILITIES (LIGHT THEME)
   ============================================================ */
:root {
  --bg-main: #ffffff;
  --bg-alt: #f8fafc; /* Slate 50 */
  --bg-card: #ffffff;
  --border-card: #e2e8f0; /* Slate 200 */
  --primary-blue: #3B82F6; /* Blue 500 */
  --primary-hover: #2563EB; /* Blue 600 */
  --accent-cyan: #06b6d4; /* Cyan 500 */
  --text-main: #0f172a; /* Slate 900 */
  --text-muted: #475569; /* Slate 600 */
  --glass-blur: blur(16px);
  --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
  --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
  --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
}

body {
  background-color: var(--bg-main);
  color: var(--text-main);
  overflow-x: hidden;
}

.text-gradient {
  background: linear-gradient(135deg, var(--primary-blue), var(--accent-cyan));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
}

.text-gradient-blue {
  background: linear-gradient(135deg, var(--primary-blue), #6366f1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
}

.btn-outline-modern {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: transparent;
  color: var(--primary-blue);
  border: 1px solid var(--primary-blue);
  padding: 10px 24px;
  border-radius: 50px;
  font-weight: 600;
  transition: all 0.3s ease;
  text-decoration: none;
}
.btn-outline-modern:hover {
  background: var(--primary-blue);
  color: #ffffff;
  transform: translateY(-2px);
}

.section-pill {
  display: inline-block;
  padding: 6px 16px;
  background: rgba(59, 130, 246, 0.1);
  border: 1px solid rgba(59, 130, 246, 0.2);
  border-radius: 50px;
  color: var(--primary-blue);
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.section-title {
  font-size: clamp(2rem, 5vw, 2.8rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 1rem;
  color: var(--text-main);
}

.section-sub {
  color: var(--text-muted);
  font-size: 1.1rem;
  max-width: 600px;
  margin: 0 auto 3rem auto;
  line-height: 1.6;
}

{{-- ==========================================
     HERO SECTION (ORBITAL DESIGN)
     ========================================== --}}
  /* Local Hero Styles matching screenshot */
  /* ==========================================
     HERO SECTION (LUXE DEEP BLUE ENTERPRISE)
     ========================================== */
  .hero-section {
    position: relative;
    min-height: 90vh;
    display: flex;
    align-items: center;
    background-color: #090e1a; /* Deep Navy Slate */
    background-image: 
      radial-gradient(circle at 75% 30%, rgba(37, 99, 235, 0.28) 0%, transparent 60%),
      radial-gradient(circle at 20% 80%, rgba(14, 165, 233, 0.15) 0%, transparent 45%);
    overflow: hidden;
    padding-top: 140px; /* offset for fixed navbar */
    padding-bottom: 70px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  /* Subtle dark mesh grid background */
  .hero-grid {
    position: absolute;
    inset: 0;
    background-image: 
      linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
    background-size: 50px 50px;
    mask-image: radial-gradient(circle at 60% 40%, black 50%, transparent 90%);
    -webkit-mask-image: radial-gradient(circle at 60% 40%, black 50%, transparent 90%);
    pointer-events: none;
    z-index: 0;
  }

  .hero-content-wrapper {
    position: relative;
    z-index: 10;
  }

  /* Left Column Styles */
  .hero-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(37, 99, 235, 0.12);
    border: 1px solid rgba(56, 189, 248, 0.3);
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-weight: 700;
    color: #38bdf8;
    margin-bottom: 24px;
  }
  .hero-badge-pill .dot {
    width: 6px; height: 6px;
    background: #38bdf8;
    border-radius: 50%;
    box-shadow: 0 0 10px #38bdf8;
  }

  .hero-title {
    font-size: clamp(2.4rem, 4.5vw, 3.8rem);
    font-weight: 800;
    line-height: 1.15;
    color: #ffffff;
    margin-bottom: 20px;
    letter-spacing: -1px;
  }
  
  .text-gradient-cyan {
    background: linear-gradient(135deg, #38bdf8 0%, #3b82f6 50%, #60a5fa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .hero-desc {
    color: #94a3b8;
    font-size: 1.1rem;
    line-height: 1.65;
    max-width: 90%;
    margin-bottom: 32px;
  }

  /* Buttons */
  .btn-primary-glow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #2563eb;
    color: #ffffff !important;
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
    border: 1px solid #3b82f6;
    text-decoration: none;
  }
  .btn-primary-glow:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
    box-shadow: 0 14px 30px rgba(37, 99, 235, 0.55);
  }

  .btn-outline-glass {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.05);
    border: 1.5px solid rgba(255, 255, 255, 0.15);
    color: #f1f5f9 !important;
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    text-decoration: none;
  }
  .btn-outline-glass:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: #38bdf8;
    color: #38bdf8 !important;
    transform: translateY(-2px);
  }

  /* Stats Section */
  .hero-stats {
    display: flex;
    align-items: center;
    gap: 40px;
    margin-top: 40px;
    padding-top: 24px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
  }
  .stat-item { display: flex; flex-direction: column; }
  .stat-num {
    font-size: 2.1rem;
    font-weight: 800;
    color: #ffffff;
    line-height: 1;
    margin-bottom: 4px;
  }
  .stat-num span { color: #38bdf8; }
  .stat-label {
    font-size: 0.72rem;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
  }

  /* Right Column Enterprise 3D Showcase Console */
  .solution-3d-stage {
    perspective: 1200px;
    position: relative;
    width: 100%;
  }

  .enterprise-console-card {
    background: rgba(15, 23, 42, 0.9);
    border: 1.5px solid rgba(56, 189, 248, 0.3);
    border-radius: 20px;
    box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7), 0 0 30px rgba(37, 99, 235, 0.2);
    backdrop-filter: blur(20px);
    padding: 24px;
    transform-style: preserve-3d;
    transition: transform 0.2s ease-out;
  }
  .enterprise-console-card:hover {
    border-color: rgba(56, 189, 248, 0.5);
    box-shadow: 0 30px 70px -15px rgba(56, 189, 248, 0.3);
  }

  /* Real-time Server Latency Pill Badge */
  .latency-pill-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(14, 165, 233, 0.12);
    border: 1px solid rgba(56, 189, 248, 0.4);
    color: #38bdf8;
    padding: 5px 14px;
    border-radius: 30px;
    font-family: monospace;
    font-size: 11px;
    font-weight: 700;
    backdrop-filter: blur(8px);
    box-shadow: 0 0 15px rgba(56, 189, 248, 0.2);
  }
  .latency-dot {
    width: 7px;
    height: 7px;
    background: #10b981;
    border-radius: 50%;
    box-shadow: 0 0 8px #10b981;
    animation: pulseDot 1.5s infinite;
  }
  @keyframes pulseDot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(1.3); }
  }
  
  .ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.04);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
  .ring-1 { width: 300px; height: 300px; }
  .ring-2 { width: 450px; height: 450px; }
  .ring-3 { width: 600px; height: 600px; border: 1px dashed rgba(255, 255, 255, 0.05); }

  .center-logo {
    position: absolute;
    width: 100px; height: 100px;
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 50px rgba(59, 130, 246, 0.5), inset 0 0 20px rgba(255,255,255,0.2);
    z-index: 10;
  }
  .center-logo img { width: 60px; }

  /* Floating Pills */
  .float-pill {
    position: absolute;
    background: rgba(15, 23, 42, 0.8);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e2e8f0;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    z-index: 20;
    white-space: nowrap;
  }
  .float-pill i { color: #60a5fa; }
  
  /* Positions matching screenshot */
  .fp-1 { top: 20%; right: 5%; animation: floatY 6s infinite ease-in-out; }
  .fp-2 { top: 50%; right: -5%; transform: translateY(-50%); animation: floatY 5s infinite ease-in-out 1s; }
  .fp-3 { bottom: 25%; left: 15%; animation: floatY 7s infinite ease-in-out 2s; }

  /* Tiny dots on rings */
  .ring-dot {
    position: absolute;
    width: 8px; height: 8px;
    background: #3b82f6;
    border-radius: 50%;
    box-shadow: 0 0 10px #3b82f6;
  }
  .rd-1 { top: 30%; left: 0; transform: translate(-50%, -50%); }
  .rd-2 { bottom: 20%; right: 10%; transform: translate(50%, 50%); }

  @keyframes floatY {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
  }

  /* Scroll Mouse Indicator */
  .mouse-scroll {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    opacity: 0.6;
  }
  .mouse {
    width: 24px; height: 36px;
    border: 2px solid #94a3b8;
    border-radius: 20px;
    position: relative;
  }
  .mouse::before {
    content: '';
    position: absolute;
    width: 4px; height: 6px;
    background: #94a3b8;
    border-radius: 2px;
    top: 6px; left: 50%;
    transform: translateX(-50%);
    animation: scrollWheel 2s infinite;
  }
  .mouse-text {
    font-size: 10px;
    color: #94a3b8;
    letter-spacing: 2px;
    text-transform: uppercase;
  }
  @keyframes scrollWheel {
    0% { transform: translate(-50%, 0); opacity: 1; }
    100% { transform: translate(-50%, 15px); opacity: 0; }
  }

  /* Responsive Adjustments */
  @media (max-width: 991px) {
    .hero-stats { justify-content: center; flex-wrap: wrap; }
    .hero-section { padding-top: 120px; text-align: center; }
    .orbital-wrapper { height: 400px; transform: scale(0.8); margin-top: 40px; }
  }

@keyframes pulse {
  0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(56, 189, 248, 0.6); }
  70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(56, 189, 248, 0); }
}

/* ============================================================
   MARQUEE LOGOS (LIGHT)
   ============================================================ */
.tech-marquee {
  padding: 30px 0;
  border-top: 1px solid var(--border-card);
  border-bottom: 1px solid var(--border-card);
  background: #ffffff;
  overflow: hidden;
  position: relative;
}
.tech-marquee::before, .tech-marquee::after {
  content: "";
  position: absolute;
  top: 0; bottom: 0; width: 100px;
  z-index: 2;
}
.tech-marquee::before { left: 0; background: linear-gradient(to right, #ffffff, transparent); }
.tech-marquee::after { right: 0; background: linear-gradient(to left, #ffffff, transparent); }

.marquee-content {
  display: flex;
  width: max-content;
  animation: scroll-left 30s linear infinite;
}
.marquee-item {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 0 30px;
  font-size: 1.2rem;
  font-weight: 600;
  color: #94a3b8; /* Slate 400 */
  transition: color 0.3s;
}
.marquee-item:hover { color: var(--primary-blue); }
.marquee-item i { font-size: 1.5rem; }
@keyframes scroll-left {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

/* ============================================================
   TRUSTED BY (BRAND LOGOS MARQUEE)
   ============================================================ */
.brands-section { padding: 50px 0 20px; background: #ffffff; }
.brands-label {
  text-align: center; color: var(--text-muted); font-size: 12px; font-weight: 700;
  text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 30px;
}
.brands-marquee { overflow: hidden; position: relative; padding-bottom: 30px; }
.brands-marquee::before, .brands-marquee::after {
  content: ""; position: absolute; top: 0; bottom: 0; width: 100px; z-index: 2;
}
.brands-marquee::before { left: 0; background: linear-gradient(to right, #ffffff, transparent); }
.brands-marquee::after { right: 0; background: linear-gradient(to left, #ffffff, transparent); }
.brands-marquee-content { display: flex; width: max-content; animation: scroll-left 25s linear infinite; align-items: center; }
.brands-marquee:hover .brands-marquee-content { animation-play-state: paused; }
.brand-item { display: flex; align-items: center; justify-content: center; margin: 0 35px; height: 50px; }
.brand-item img {
  max-height: 40px; max-width: 130px; object-fit: contain; filter: grayscale(1) opacity(0.5);
  transition: filter 0.3s ease;
}
.brand-item img:hover { filter: grayscale(0) opacity(1); }

/* ============================================================
   SERVICES BENTO (LIGHT)
   ============================================================ */
.services-section {
  padding: 100px 0;
  background-color: #ffffff;
}
.bento-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-auto-rows: minmax(280px, auto);
  gap: 24px;
}
.bcard {
  background: var(--bg-card);
  border: 1px solid var(--border-card);
  border-radius: 24px;
  padding: 32px;
  display: flex;
  flex-direction: column;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  box-shadow: var(--shadow-sm);
}
.bcard:hover {
  transform: translateY(-5px);
  border-color: rgba(59, 130, 246, 0.4);
  box-shadow: var(--shadow-lg);
}
.bcard-large {
  grid-column: span 2;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  background: linear-gradient(to right bottom, #ffffff, #f8fafc);
}
.bcard-tag {
  font-size: 11px; font-weight: 700; color: var(--primary-blue);
  text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;
  display: block;
}
.bcard h3 { font-size: 1.5rem; font-weight: 800; margin-bottom: 15px; color: var(--text-main); }
.bcard p { color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 24px; }
.bcard a {
  color: var(--primary-blue); text-decoration: none; font-size: 14px; font-weight: 700;
  display: inline-flex; align-items: center; gap: 8px; margin-top: auto;
}
.bcard a:hover { color: var(--primary-hover); text-decoration: underline; }

.bcard-icon-bg {
  position: absolute;
  bottom: -20px; right: -20px;
  font-size: 120px;
  opacity: 0.03;
  transform: rotate(-15deg);
  pointer-events: none;
  color: #000;
}
.bcard-large .bcard-content { max-width: 55%; z-index: 2; }
.bcard-large .bcard-visual {
  width: 40%;
  height: 200px;
  background: #f1f5f9; /* Slate 100 */
  border: 1px solid var(--border-card);
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3.5rem;
  color: var(--primary-blue);
  z-index: 2;
}

/* ============================================================
   PORTFOLIO (LIGHT)
   ============================================================ */
.portfolio-section {
  padding: 100px 0;
  background-color: #f8fafc; /* Slate 50 */
  border-top: 1px solid var(--border-card);
  border-bottom: 1px solid var(--border-card);
}
.pf-card {
  position: relative;
  border-radius: 24px;
  overflow: hidden;
  aspect-ratio: 4/3;
  background: #ffffff;
  border: 1px solid var(--border-card);
  box-shadow: var(--shadow-sm);
  transition: all 0.3s ease;
}
.pf-card:hover {
  box-shadow: var(--shadow-lg);
  border-color: rgba(59, 130, 246, 0.3);
}
.pf-img {
  width: 100%; height: 100%; object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}
.pf-card:hover .pf-img { transform: scale(1.05); }
.pf-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, transparent 70%);
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 30px;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.pf-card:hover .pf-overlay { opacity: 1; }
.pf-overlay h4 { font-size: 1.4rem; font-weight: 800; margin: 10px 0; color: #ffffff; }
.pf-overlay p { color: rgba(255,255,255,0.8); font-size: 0.95rem; margin: 0 0 15px 0; line-height: 1.5; }
.pf-tag {
  background: var(--primary-blue); color: #fff;
  padding: 6px 14px; border-radius: 50px; font-size: 11px;
  font-weight: 700; text-transform: uppercase; width: max-content;
}

/* ============================================================
   TESTIMONIALS
   ============================================================ */
.testimonials-section { padding: 100px 0; background-color: #ffffff; }
.testimonial-swiper { padding: 10px 0 55px; }
.testimonial-card {
  background: var(--bg-alt); border: 1px solid var(--border-card); border-radius: 24px;
  padding: 40px; max-width: 700px; margin: 0 auto; text-align: center;
  box-shadow: var(--shadow-sm); position: relative; overflow: hidden;
}
.testimonial-rating { color: #fbbf24; font-size: 1rem; margin-bottom: 20px; }
.testimonial-text {
  font-size: 1.15rem; line-height: 1.7; color: var(--text-main); font-style: italic;
  margin-bottom: 28px;
}
.testimonial-author { display: flex; align-items: center; justify-content: center; gap: 14px; }
.testimonial-avatar {
  width: 52px; height: 52px; border-radius: 50%; object-fit: cover; background: var(--primary-blue);
  display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700;
  flex-shrink: 0;
}
.testimonial-author h5 { font-size: 1rem; font-weight: 800; margin: 0; color: var(--text-main); }
.testimonial-author span { font-size: 0.85rem; color: var(--text-muted); }
.testimonial-swiper .swiper-pagination-bullet { background: var(--border-card); opacity: 1; width: 8px; height: 8px; }
.testimonial-swiper .swiper-pagination-bullet-active { background: var(--primary-blue); width: 24px; border-radius: 4px; }

/* ============================================================
   WHY CHOOSE US (LIGHT)
   ============================================================ */
.why-section { padding: 100px 0; background-color: #ffffff; }
.why-card {
  background: var(--bg-main); border: 1px solid var(--border-card);
  padding: 32px; border-radius: 20px; height: 100%;
  transition: all 0.3s ease;
  box-shadow: var(--shadow-sm);
}
.why-card:hover { transform: translateY(-5px); border-color: var(--primary-blue); box-shadow: var(--shadow-md); }
.why-icon {
  width: 56px; height: 56px; background: rgba(59, 130, 246, 0.1);
  color: var(--primary-blue); border-radius: 14px;
  display: flex; align-items: center; justify-content: center;
  font-size: 24px; margin-bottom: 24px;
}
.why-card h4 { font-size: 1.25rem; font-weight: 800; margin-bottom: 12px; color: var(--text-main); }
.why-card p { color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; margin: 0; }

/* ============================================================
   PROCESS (LIGHT)
   ============================================================ */
.process-section { padding: 100px 0; background-color: #f8fafc; border-top: 1px solid var(--border-card); }
.process-grid {
  display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;
  position: relative; margin-top: 50px;
}
.process-grid::before {
  content: ""; position: absolute; top: 35px; left: 10%; right: 10%;
  height: 2px; background: var(--border-card); z-index: 0;
}
.process-step { position: relative; z-index: 1; text-align: center; }
.ps-num {
  width: 70px; height: 70px; background: #ffffff;
  border: 3px solid var(--border-card); border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.4rem; font-weight: 800; color: var(--text-muted);
  margin: 0 auto 24px auto; transition: all 0.3s ease;
  box-shadow: var(--shadow-sm);
}
.process-step:hover .ps-num { border-color: var(--primary-blue); color: var(--primary-blue); transform: scale(1.1); box-shadow: var(--shadow-md); }
.process-step h4 { font-size: 1.15rem; font-weight: 800; margin-bottom: 12px; color: var(--text-main); }
.process-step p { color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; max-width: 220px; margin: 0 auto; }

/* ============================================================
   BLOG (LIGHT)
   ============================================================ */
.blog-section { padding: 100px 0; background-color: #ffffff; }
.blog-card {
  background: var(--bg-card); border: 1px solid var(--border-card);
  border-radius: 20px; overflow: hidden; height: 100%;
  transition: all 0.3s ease;
  box-shadow: var(--shadow-sm);
}
.blog-card:hover { transform: translateY(-8px); border-color: rgba(59, 130, 246, 0.3); box-shadow: var(--shadow-lg); }
.bc-img-wrap { width: 100%; height: 220px; position: relative; overflow: hidden; }
.bc-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.blog-card:hover .bc-img { transform: scale(1.05); }
.bc-cat {
  position: absolute; top: 16px; left: 16px; background: var(--primary-blue);
  color: #fff; padding: 6px 12px; border-radius: 8px; font-size: 10px;
  font-weight: 700; text-transform: uppercase;
}
.bc-content { padding: 30px; }
.bc-date { color: var(--text-muted); font-size: 12px; font-weight: 600; display: block; margin-bottom: 12px; }
.bc-title { font-size: 1.25rem; font-weight: 800; margin-bottom: 15px; line-height: 1.4; }
.bc-title a { color: var(--text-main); text-decoration: none; transition: color 0.2s; }
.bc-title a:hover { color: var(--primary-blue); }
.bc-excerpt { color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 24px; }
.bc-link { color: var(--primary-blue); font-size: 14px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; }
.bc-link:hover { color: var(--primary-hover); text-decoration: underline; }

/* ============================================================
   FAQ & CTA (LIGHT)
   ============================================================ */
.faq-section { padding: 100px 0; background-color: #f8fafc; border-top: 1px solid var(--border-card); }
.accordion-item {
  background: var(--bg-card) !important;
  border: 1px solid var(--border-card) !important;
  border-radius: 16px !important; margin-bottom: 16px; overflow: hidden;
  box-shadow: var(--shadow-sm);
}
.accordion-button {
  background: transparent !important; color: var(--text-main) !important;
  font-weight: 700; font-size: 1.05rem; box-shadow: none !important; padding: 24px;
}
.accordion-button:not(.collapsed) { color: var(--primary-blue) !important; background: #ffffff !important; }
.accordion-body { color: var(--text-muted); padding: 0 24px 24px 24px; line-height: 1.6; background: #ffffff; font-size: 0.95rem; }

.cta-section {
  padding: 120px 0; 
  background: linear-gradient(135deg, var(--primary-blue) 0%, #1e40af 100%);
  text-align: center;
  color: #ffffff;
}
.cta-section .section-title { color: #ffffff; }
.cta-section .section-sub { color: rgba(255, 255, 255, 0.8); }

.btn-cta-white {
  display: inline-flex; align-items: center; background: #ffffff; color: var(--primary-blue);
  padding: 16px 32px; border-radius: 50px; font-weight: 700; font-size: 1rem;
  transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); text-decoration: none;
}
.btn-cta-white:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2); color: var(--primary-hover); }

.btn-cta-outline {
  display: inline-flex; align-items: center; border: 2px solid rgba(255, 255, 255, 0.3);
  background: transparent; color: #ffffff; padding: 16px 32px; border-radius: 50px;
  font-weight: 700; font-size: 1rem; transition: all 0.3s ease; text-decoration: none;
}
.btn-cta-outline:hover { background: rgba(255, 255, 255, 0.1); border-color: #ffffff; transform: translateY(-3px); }

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 991px) {
  .hero-section { text-align: center; }
  .hero-desc { margin-left: auto; margin-right: auto; }
  .bcard-large { grid-column: span 1; flex-direction: column; text-align: left; }
  .bcard-large .bcard-content { max-width: 100%; margin-bottom: 20px; }
  .bcard-large .bcard-visual { width: 100%; }
  .bento-grid { grid-template-columns: 1fr 1fr; }
  
  .process-grid { grid-template-columns: 1fr 1fr; gap: 40px 20px; }
  .process-grid::before { display: none; }
  .hero-mockup-wrap { margin-top: 40px; }
  .float-icon { display: none; }
}

@media (max-width: 768px) {
  .section-title { font-size: 2rem; }
  .bento-grid { grid-template-columns: 1fr; }
  .process-grid { grid-template-columns: 1fr; }
  .stat-item h4 { font-size: 2.2rem; }
  .stat-divider { display: none; }
  .mouse-scroll { display: none; }
  .hero-stats { flex-direction: column; gap: 2rem; border-top: none; padding-top: 0; margin-top: 40px; }
}

/* REVEAL ANIMATIONS */
.reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
.reveal.active { opacity: 1; transform: translateY(0); }

/* ============================================================
   3D DEPTH: HERO ORBITAL TILT
   ============================================================ */
.orbital-wrapper { perspective: 1400px; }
.orbital-inner {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  transform-style: preserve-3d;
  transition: transform 0.2s ease-out;
}
.center-logo { transform: translateZ(50px); }

/* ============================================================
   3D TILT CARDS (services / why-us / portfolio)
   ============================================================ */
.tilt-card { transform-style: preserve-3d; will-change: transform; }
.tilt-card .tilt-glare {
  position: absolute; inset: 0; z-index: 4; opacity: 0; pointer-events: none;
  border-radius: inherit;
  background: radial-gradient(circle at var(--gx, 50%) var(--gy, 50%), rgba(59,130,246,0.18), transparent 60%);
  transition: opacity 0.3s ease;
}
.tilt-card:hover .tilt-glare { opacity: 1; }
.tilt-card .bcard-icon-bg,
.tilt-card .why-icon,
.tilt-card .bcard-visual i {
  transition: transform 0.3s ease;
}
.tilt-card:hover .bcard-icon-bg { transform: translateZ(50px) rotate(-15deg); }
.tilt-card:hover .why-icon { transform: translateZ(40px) scale(1.08); }
.tilt-card:hover .bcard-visual i { transform: translateZ(40px) scale(1.1); }
.pf-card.tilt-card:hover .pf-overlay h4,
.pf-card.tilt-card:hover .pf-overlay p,
.pf-card.tilt-card:hover .pf-overlay .pf-tag { transform: translateZ(30px); }
.pf-overlay h4, .pf-overlay p, .pf-overlay .pf-tag { transition: transform 0.3s ease; }

/* ============================================================
   MAGNETIC BUTTONS
   ============================================================ */
.magnetic-btn { position: relative; overflow: hidden; }
.magnetic-btn::before {
  content: '';
  position: absolute;
  width: 140px; height: 140px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,255,255,0.35), transparent 70%);
  top: var(--my, 50%); left: var(--mx, 50%);
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
}
.magnetic-btn:hover::before { opacity: 1; }
.btn-outline-glass.magnetic-btn::before,
.btn-cta-outline.magnetic-btn::before { background: radial-gradient(circle, rgba(59,130,246,0.25), transparent 70%); }
.btn-cta-white.magnetic-btn::before { background: radial-gradient(circle, rgba(59,130,246,0.15), transparent 70%); }

/* ============================================================
   PORTFOLIO 3D COVERFLOW (Swiper)
   ============================================================ */
.portfolio-swiper { padding: 10px 0 60px; overflow: visible; }
.portfolio-swiper .swiper-slide { width: 320px; max-width: 85vw; }
.portfolio-swiper .pf-card { aspect-ratio: 4/3; height: 100%; }
.portfolio-swiper .swiper-pagination-bullet { background: var(--border-card); opacity: 1; width: 8px; height: 8px; }
.portfolio-swiper .swiper-pagination-bullet-active { background: var(--primary-blue); width: 24px; border-radius: 4px; }
.pf-nav-btn {
  width: 48px; height: 48px; border-radius: 50%; border: 1px solid var(--border-card);
  background: #ffffff; color: var(--primary-blue); display: flex; align-items: center;
  justify-content: center; transition: all 0.3s ease; cursor: pointer;
}
.pf-nav-btn:hover { background: var(--primary-blue); color: #fff; transform: translateY(-3px); box-shadow: var(--shadow-md); }

/* Marquee pause on hover */
.tech-marquee:hover .marquee-content { animation-play-state: paused; }
</style>

{{-- ==========================================
     HERO SECTION (ORBITAL DESIGN)
     ========================================== --}}
<section class="hero-section">
  <div class="hero-grid"></div>

  <div class="container hero-content-wrapper">
    <div class="row align-items-center g-5">
      
      {{-- LEFT COLUMN: Enterprise Content --}}
      <div class="col-lg-6">
        <div class="d-flex align-items-center gap-2 mb-3 text-uppercase font-monospace reveal" style="letter-spacing: 1.5px; font-size: 11px; font-weight: 700; color: #38bdf8;">
          <span style="display: inline-block; width: 24px; height: 2px; background: #38bdf8; border-radius: 2px;"></span>
          PT SEKAWAN PUTRA PRATAMA
        </div>
        
        <h1 class="hero-title reveal delay-100">
          Solusi Software & <br>
          <span class="text-gradient-cyan">Infrastruktur Enterprise,</span><br>
          Untuk Bisnis Anda.
        </h1>
        
        <p class="hero-desc reveal delay-200">
          PT Sekawan Putra Pratama mendampingi perusahaan Anda merancang, mengarsitekturi, dan merilis sistem digital berkinerja tinggi dengan jaminan SLA 99.9%.
        </p>
        
        <div class="d-flex gap-3 flex-wrap justify-content-center justify-content-lg-start reveal delay-300">
          <a href="{{ route('contact') }}" class="btn-primary-glow magnetic-btn">
            <i class="fas fa-calendar-check me-1"></i> Konsultasi Gratis
          </a>
          <a href="{{ route('portfolio.index') }}" class="btn-outline-glass magnetic-btn">
            Lihat Portofolio <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>

        <div class="hero-stats reveal delay-400">
          <div class="stat-item">
            <div class="stat-num"><span class="count-up" data-target="50">0</span><span>+</span></div>
            <div class="stat-label">Proyek Selesai</div>
          </div>
          <div style="width: 1px; height: 36px; background: rgba(255,255,255,0.15);"></div>
          <div class="stat-item">
            <div class="stat-num"><span class="count-up" data-target="20">0</span><span>+</span></div>
            <div class="stat-label">Klien Enterprise</div>
          </div>
          <div style="width: 1px; height: 36px; background: rgba(255,255,255,0.15);"></div>
          <div class="stat-item">
            <div class="stat-num"><span class="count-up" data-target="99.9" data-decimals="1">0</span><span>%</span></div>
            <div class="stat-label">Uptime SLA</div>
          </div>
        </div>
      </div>

      {{-- RIGHT COLUMN: Enterprise 3D Console Deck --}}
      <div class="col-lg-6 d-none d-lg-block">
        <div class="solution-3d-stage reveal delay-300">
          <div class="enterprise-console-card" id="heroSolutionFrame">
            {{-- Console Control Header --}}
            <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom border-secondary border-opacity-25">
              <div class="d-flex align-items-center gap-2">
                <span style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%;"></span>
                <span style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%;"></span>
                <span style="width: 10px; height: 10px; background: #10b981; border-radius: 50%;"></span>
                <span class="text-white-50 font-monospace ms-2" style="font-size: 11px;">sekawanputrapratama.com</span>
              </div>
              <div class="d-flex align-items-center gap-3 font-monospace" style="font-size: 11px;">
                <span class="text-success d-inline-flex align-items-center gap-1">
                  <span style="display: inline-block; width: 6px; height: 6px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span>
                  <span id="latencyValue">Ping: 18ms</span>
                </span>
                <span class="text-white-50">|</span>
                <span class="text-info"><i class="fas fa-shield-alt me-1"></i> Secured</span>
              </div>
            </div>

            {{-- 4 Pillars Grid --}}
            <div class="row g-3">
              <div class="col-6">
                <div class="p-3 rounded-3 bg-dark bg-opacity-60 border border-secondary border-opacity-25">
                  <div class="text-info mb-2 fs-5"><i class="fas fa-layer-group"></i></div>
                  <h6 class="fw-bold text-white small mb-1">Custom Software ERP</h6>
                  <span class="text-white-50" style="font-size: 11px;">Sistem manajemen terintegrasi skala besar.</span>
                </div>
              </div>
              <div class="col-6">
                <div class="p-3 rounded-3 bg-dark bg-opacity-60 border border-secondary border-opacity-25">
                  <div class="text-primary mb-2 fs-5"><i class="fas fa-mobile-alt"></i></div>
                  <h6 class="fw-bold text-white small mb-1">Aplikasi Mobile Native</h6>
                  <span class="text-white-50" style="font-size: 11px;">Flutter & Native iOS/Android ultra cepat.</span>
                </div>
              </div>
              <div class="col-6">
                <div class="p-3 rounded-3 bg-dark bg-opacity-60 border border-secondary border-opacity-25">
                  <div class="text-warning mb-2 fs-5"><i class="fas fa-server"></i></div>
                  <h6 class="fw-bold text-white small mb-1">Cloud & Network SLA</h6>
                  <span class="text-white-50" style="font-size: 11px;">Server, Mikrotik, & AWS cloud infrastructure.</span>
                </div>
              </div>
              <div class="col-6">
                <div class="p-3 rounded-3 bg-dark bg-opacity-60 border border-secondary border-opacity-25">
                  <div class="text-success mb-2 fs-5"><i class="fas fa-shield-alt"></i></div>
                  <h6 class="fw-bold text-white small mb-1">Keamanan & ISO 27001</h6>
                  <span class="text-white-50" style="font-size: 11px;">Enkripsi data & pemantauan otomatis 24/7.</span>
                </div>
              </div>
            </div>

            {{-- Footer Tech Stack --}}
            <div class="mt-4 pt-3 border-top border-secondary border-opacity-25 d-flex align-items-center justify-content-between text-white-50 small">
              <span><i class="fab fa-laravel text-danger me-1"></i> Laravel 12</span>
              <span><i class="fab fa-google text-info me-1"></i> Flutter</span>
              <span><i class="fab fa-aws text-warning me-1"></i> AWS Cloud</span>
              <a href="{{ route('services.index') }}" class="text-info font-monospace fw-bold text-decoration-none">Eksplor <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ==========================================
     MARQUEE TECH STACK
     ========================================== --}}
<section class="tech-marquee">
  <div class="marquee-content">
    {{-- Set 1 --}}
    <div class="marquee-item"><i class="fab fa-laravel"></i> Laravel</div>
    <div class="marquee-item"><i class="fab fa-react"></i> React Native</div>
    <div class="marquee-item"><i class="fab fa-php"></i> PHP 8</div>
    <div class="marquee-item"><i class="fas fa-database"></i> MySQL</div>
    <div class="marquee-item"><i class="fab fa-node-js"></i> Node.js</div>
    <div class="marquee-item"><i class="fab fa-aws"></i> AWS Cloud</div>
    <div class="marquee-item"><i class="fas fa-server"></i> Mikrotik</div>
    {{-- Duplicate for seamless loop --}}
    <div class="marquee-item"><i class="fab fa-laravel"></i> Laravel</div>
    <div class="marquee-item"><i class="fab fa-react"></i> React Native</div>
    <div class="marquee-item"><i class="fab fa-php"></i> PHP 8</div>
    <div class="marquee-item"><i class="fas fa-database"></i> MySQL</div>
    <div class="marquee-item"><i class="fab fa-node-js"></i> Node.js</div>
    <div class="marquee-item"><i class="fab fa-aws"></i> AWS Cloud</div>
    <div class="marquee-item"><i class="fas fa-server"></i> Mikrotik</div>
  </div>
</section>

{{-- ==========================================
     TRUSTED BY (BRAND LOGOS)
     ========================================== --}}
@if($brands->isNotEmpty())
<section class="brands-section">
  <p class="brands-label reveal">Dipercaya oleh berbagai perusahaan</p>
  <div class="brands-marquee">
    <div class="brands-marquee-content">
      @foreach($brands as $brand)
      <div class="brand-item">
        <img src="{{ $brand->getFirstMediaUrl('logo') }}" alt="{{ $brand->name }}" loading="lazy">
      </div>
      @endforeach
      @foreach($brands as $brand)
      <div class="brand-item">
        <img src="{{ $brand->getFirstMediaUrl('logo') }}" alt="{{ $brand->name }}" loading="lazy">
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ==========================================
     SERVICES BENTO
     ========================================== --}}
<section class="services-section">
  <div class="container">
    <div class="text-center reveal">
      <span class="section-pill">Layanan Kami</span>
      <h2 class="section-title mt-3">Solusi Digital <span class="text-gradient">Terintegrasi</span></h2>
      <p class="section-sub">Dari aplikasi mobile hingga infrastruktur jaringan perusahaan, kami merancang sistem yang skalabel dan efisien.</p>
    </div>

    <div class="bento-grid mt-5">
      {{-- Card 1: Large --}}
      <div class="bcard bcard-large reveal tilt-card">
        <div class="tilt-glare"></div>
        <div class="bcard-content">
          <span class="bcard-tag">Enterprise System</span>
          <h3>Pengembangan Aplikasi Mobile & Desktop</h3>
          <p>Membangun aplikasi Android, iOS, dan desktop dengan UI/UX intuitif, performa tinggi, dan standar keamanan kelas enterprise yang siap mendukung mobilitas bisnis Anda.</p>
          <a href="{{ route('services.index') }}">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="bcard-visual">
          <i class="fas fa-mobile-android-alt"></i>
        </div>
      </div>

      {{-- Card 2 --}}
      <div class="bcard reveal delay-100 tilt-card">
        <div class="tilt-glare"></div>
        <span class="bcard-tag">Digital Presence</span>
        <h3>Pembuatan Website Profesional</h3>
        <p>Website company profile, e-commerce, hingga sistem informasi web-based yang cepat, SEO-friendly, dan responsif.</p>
        <a href="{{ route('services.index') }}">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
        <i class="fas fa-browser bcard-icon-bg"></i>
      </div>

      {{-- Card 3 --}}
      <div class="bcard reveal delay-200 tilt-card">
        <div class="tilt-glare"></div>
        <span class="bcard-tag">IT Infrastructure</span>
        <h3>Instalasi Server & Jaringan</h3>
        <p>Perancangan jaringan Mikrotik, setup server Linux/Windows, keamanan siber, dan managed IT services untuk kantor.</p>
        <a href="{{ route('services.index') }}">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
        <i class="fas fa-network-wired bcard-icon-bg"></i>
      </div>
    </div>
  </div>
</section>

{{-- ==========================================
     PORTFOLIO SHOWCASE
     ========================================== --}}
<section class="portfolio-section">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center align-items-md-end mb-5 reveal text-center text-md-start">
      <div>
        <span class="section-pill">Portofolio</span>
        <h2 class="section-title mt-3 mb-0">Karya <span class="text-gradient">Terbaik Kami</span></h2>
      </div>
      <a href="{{ route('portfolio.index') }}" class="btn-outline-modern mt-4 mt-md-0">Lihat Semua Proyek <i class="fas fa-arrow-right ms-2"></i></a>
    </div>

    @if($portfolios->isNotEmpty())
    <div class="swiper portfolio-swiper reveal">
      <div class="swiper-wrapper">
        @foreach($portfolios as $portfolio)
        <div class="swiper-slide">
          <div class="pf-card tilt-card">
            <div class="tilt-glare"></div>
            @php
              $portImg = $portfolio->getFirstMediaUrl('featured_image') ?: ($portfolio->featured_image ? Storage::url($portfolio->featured_image) : asset('assets/media/images/portfolio-placeholder.webp'));
            @endphp
            <img src="{{ $portImg }}" alt="{{ $portfolio->title }}" class="pf-img" loading="lazy">
            <div class="pf-overlay">
              <span class="pf-tag mb-2">{{ $portfolio->category->name ?? 'Proyek IT' }}</span>
              <h4>{{ $portfolio->title }}</h4>
              <p>{{ Str::limit($portfolio->short_description ?? strip_tags($portfolio->description), 90) }}</p>
              <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="text-white fw-bold text-decoration-none small mt-2">Selengkapnya <i class="fas fa-chevron-right ms-1"></i></a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <div class="d-flex justify-content-center gap-3 mt-2">
      <button class="pf-nav-btn portfolio-prev" aria-label="Sebelumnya"><i class="fas fa-arrow-left"></i></button>
      <button class="pf-nav-btn portfolio-next" aria-label="Selanjutnya"><i class="fas fa-arrow-right"></i></button>
    </div>
    @else
    <div class="text-center py-5">
      <p class="text-muted">Belum ada portofolio yang ditampilkan.</p>
    </div>
    @endif
  </div>
</section>

{{-- ==========================================
     TESTIMONIALS
     ========================================== --}}
@if($testimonials->isNotEmpty())
<section class="testimonials-section">
  <div class="container">
    <div class="text-center reveal">
      <span class="section-pill">Testimoni</span>
      <h2 class="section-title mt-3">Apa Kata <span class="text-gradient">Klien Kami</span></h2>
      <p class="section-sub">Kepuasan klien adalah bukti nyata kualitas kerja kami.</p>
    </div>

    <div class="swiper testimonial-swiper reveal">
      <div class="swiper-wrapper">
        @foreach($testimonials as $testimonial)
        <div class="swiper-slide">
          <div class="testimonial-card tilt-card">
            <div class="tilt-glare"></div>
            <div class="testimonial-rating">
              @for($i = 1; $i <= 5; $i++)
                <i class="fa{{ $i <= $testimonial->rating ? 's' : 'r' }} fa-star"></i>
              @endfor
            </div>
            <p class="testimonial-text">"{{ $testimonial->testimonial }}"</p>
            <div class="testimonial-author">
              @php($photoUrl = $testimonial->getFirstMediaUrl('client_photo'))
              @if($photoUrl)
                <img src="{{ $photoUrl }}" alt="{{ $testimonial->client_name }}" class="testimonial-avatar" loading="lazy">
              @else
                <div class="testimonial-avatar">{{ Str::substr($testimonial->client_name, 0, 1) }}</div>
              @endif
              <div class="text-start">
                <h5>{{ $testimonial->client_name }}</h5>
                <span>{{ $testimonial->client_position }}{{ $testimonial->client_company ? ', ' . $testimonial->client_company : '' }}</span>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
@endif

{{-- ==========================================
     WHY CHOOSE US
     ========================================== --}}
<section class="why-section">
  <div class="container">
    <div class="text-center reveal">
      <span class="section-pill">Keunggulan</span>
      <h2 class="section-title mt-3">Mengapa Memilih <span class="text-gradient">Kami?</span></h2>
      <p class="section-sub">Komitmen kami adalah memberikan nilai tambah dan ketenangan pikiran bagi setiap investasi IT Anda.</p>
    </div>

    <div class="row g-4 mt-4">
      <div class="col-lg-3 col-md-6 reveal">
        <div class="why-card tilt-card">
          <div class="tilt-glare"></div>
          <div class="why-icon"><i class="fas fa-stopwatch"></i></div>
          <h4>Tepat Waktu</h4>
          <p>Proyek diselesaikan sesuai timeline yang disepakati dengan manajemen proyek yang transparan.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 reveal delay-100">
        <div class="why-card tilt-card">
          <div class="tilt-glare"></div>
          <div class="why-icon"><i class="fas fa-headset"></i></div>
          <h4>Support 24/7</h4>
          <p>Tim support kami selalu siap membantu Anda untuk memastikan sistem berjalan tanpa henti.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 reveal delay-200">
        <div class="why-card tilt-card">
          <div class="tilt-glare"></div>
          <div class="why-icon"><i class="fas fa-shield-check"></i></div>
          <h4>Keamanan Terjamin</h4>
          <p>Menerapkan standar keamanan terbaik untuk melindungi data dan privasi bisnis Anda.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 reveal delay-300">
        <div class="why-card tilt-card">
          <div class="tilt-glare"></div>
          <div class="why-icon"><i class="fas fa-handshake"></i></div>
          <h4>Harga Kompetitif</h4>
          <p>Penawaran yang jujur dan masuk akal sesuai dengan kompleksitas dan kualitas solusi.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ==========================================
     PROCESS
     ========================================== --}}
<section class="process-section">
  <div class="container">
    <div class="text-center reveal">
      <span class="section-pill">Cara Kerja</span>
      <h2 class="section-title mt-3">Proses <span class="text-gradient">Pengembangan</span></h2>
    </div>

    <div class="process-grid">
      <div class="process-step reveal">
        <div class="ps-num">1</div>
        <h4>Konsultasi</h4>
        <p>Diskusi mendalam untuk memahami kebutuhan, masalah, dan target bisnis Anda.</p>
      </div>
      <div class="process-step reveal delay-100">
        <div class="ps-num">2</div>
        <h4>Perancangan</h4>
        <p>Membuat blueprint arsitektur sistem dan desain UI/UX yang tepat guna.</p>
      </div>
      <div class="process-step reveal delay-200">
        <div class="ps-num">3</div>
        <h4>Pengembangan</h4>
        <p>Proses coding yang rapi (clean code) dan pengujian ketat di setiap tahap.</p>
      </div>
      <div class="process-step reveal delay-300">
        <div class="ps-num">4</div>
        <h4>Rilis & Maintenance</h4>
        <p>Peluncuran produk yang sukses dan dukungan pemeliharaan berkelanjutan.</p>
      </div>
    </div>
  </div>
</section>

{{-- ==========================================
     BLOG PREVIEW
     ========================================== --}}
<section class="blog-section">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center align-items-md-end mb-5 reveal text-center text-md-start">
      <div>
        <span class="section-pill">Artikel</span>
        <h2 class="section-title mt-3 mb-0">Wawasan <span class="text-gradient">Teknologi</span></h2>
      </div>
      <a href="{{ route('blog.index') }}" class="btn-outline-modern mt-4 mt-md-0">Baca Semua Artikel</a>
    </div>

    <div class="row g-4">
      @forelse($latestBlogs ?? [] as $index => $blog)
      <div class="col-lg-4 col-md-6 reveal" style="transition-delay: {{ $index * 100 }}ms">
        <div class="blog-card">
          <div class="bc-img-wrap">
            <img src="{{ $blog->featured_image ? Storage::url($blog->featured_image) : asset('assets/media/images/blog-image-1.png') }}" alt="{{ $blog->title }}" class="bc-img" loading="lazy">
            <span class="bc-cat">{{ $blog->category->name ?? 'Update' }}</span>
          </div>
          <div class="bc-content">
            <span class="bc-date">{{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}</span>
            <h3 class="bc-title"><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
            <p class="bc-excerpt">{{ Str::limit(strip_tags($blog->content), 90) }}</p>
            <a href="{{ route('blog.show', $blog->slug) }}" class="bc-link">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center py-4">
        <p class="text-muted">Belum ada artikel yang dipublikasikan.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>

{{-- ==========================================
     FAQ
     ========================================== --}}
<section class="faq-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center reveal mb-5">
        <span class="section-pill">FAQ</span>
        <h2 class="section-title mt-3">Pertanyaan <span class="text-gradient">Umum</span></h2>
      </div>
    </div>
    
    <div class="row justify-content-center">
      <div class="col-lg-8 reveal">
        <div class="accordion" id="faqAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                Berapa estimasi biaya pembuatan aplikasi atau website?
              </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Biaya sangat bergantung pada kompleksitas fitur, skala sistem, dan platform yang dituju. Kami merekomendasikan Anda untuk menghubungi kami guna melakukan konsultasi awal secara gratis, setelah itu kami dapat memberikan penawaran yang akurat.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                Apakah ada layanan maintenance setelah aplikasi selesai?
              </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Tentu saja. Kami menyertakan garansi perbaikan bug secara gratis untuk periode tertentu. Selain itu, kami menawarkan paket SLA (Service Level Agreement) untuk pemeliharaan rutin, backup, dan dukungan teknis jangka panjang.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                Apakah melayani pengerjaan proyek dari luar kota Bekasi/Jakarta?
              </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Ya, kami melayani klien dari seluruh Indonesia. Proses komunikasi, pelaporan progres, dan meeting dapat dilakukan secara online melalui Zoom/Google Meet dengan sangat efektif.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ==========================================
     CTA
     ========================================== --}}
<section class="cta-section reveal">
  <div class="container">
    <h2 class="section-title mb-4">Siap Memulai Transformasi Digital Anda?</h2>
    <p class="section-sub mb-5 text-center" style="max-width: 600px; margin-left: auto; margin-right: auto;">
      Jangan biarkan kendala teknologi menghambat laju bisnis Anda. Mari diskusikan solusinya bersama ahli IT kami.
    </p>
    <div class="d-flex flex-wrap gap-3 justify-content-center">
      <a href="{{ route('contact') }}" class="btn-cta-white magnetic-btn">Hubungi Kami Sekarang</a>
      <a href="https://wa.me/6285156412702" target="_blank" class="btn-cta-outline magnetic-btn"><i class="fab fa-whatsapp me-2"></i> Chat WhatsApp</a>
    </div>
  </div>
</section>

{{-- SCRIPT ANIMASI REVEAL --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  const reveals = document.querySelectorAll('.reveal');
  
  const revealOnScroll = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
      if(entry.isIntersecting) {
        entry.target.classList.add('active');
        // Optional: hentikan observasi setelah animasi muncul
        // observer.unobserve(entry.target); 
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px"
  });

  reveals.forEach(reveal => {
    revealOnScroll.observe(reveal);
  });
});
</script>

@push('scripts')
<script src="{{ asset('assets/js/vendor/gsap.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/ScrollTrigger.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/swiper-bundle.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

  /* ---------------------------------------------------------
     1. HERO SCROLL PARALLAX (GSAP ScrollTrigger)
     --------------------------------------------------------- */
  if (window.gsap && window.ScrollTrigger) {
    gsap.registerPlugin(ScrollTrigger);

    gsap.timeline({
      scrollTrigger: {
        trigger: '.hero-section',
        start: 'top top',
        end: 'bottom top',
        scrub: true
      }
    })
    .to('.hero-grid', { yPercent: -20, ease: 'none' }, 0)
    .to('.ring-1', { yPercent: -35, ease: 'none' }, 0)
    .to('.ring-2', { yPercent: -55, ease: 'none' }, 0)
    .to('.ring-3', { yPercent: -80, ease: 'none' }, 0)
    .to('.fp-1', { yPercent: -90, ease: 'none' }, 0)
    .to('.fp-2', { yPercent: -120, ease: 'none' }, 0)
    .to('.fp-3', { yPercent: -60, ease: 'none' }, 0)
    .to('.hero-content-wrapper', { yPercent: -15, opacity: 0.4, ease: 'none' }, 0);
  }

  /* ---------------------------------------------------------
     2. HERO ORBITAL — MOUSE-REACTIVE 3D TILT
     --------------------------------------------------------- */
  const orbitalInner = document.getElementById('orbitalInner');
  const heroSection = document.querySelector('.hero-section');
  if (orbitalInner && heroSection && window.matchMedia('(min-width: 992px)').matches) {
    heroSection.addEventListener('mousemove', function (e) {
      const r = heroSection.getBoundingClientRect();
      const px = (e.clientX - r.left) / r.width - 0.5;
      const py = (e.clientY - r.top) / r.height - 0.5;
      orbitalInner.style.transform = `rotateX(${py * -14}deg) rotateY(${px * 18}deg)`;
    });
    heroSection.addEventListener('mouseleave', function () {
      orbitalInner.style.transform = '';
    });
  }

  /* ---------------------------------------------------------
     3. 3D TILT-ON-HOVER FOR CARDS (services / why-us / portfolio)
     --------------------------------------------------------- */
  document.querySelectorAll('.tilt-card').forEach(function (card) {
    card.style.transition = 'transform 0.15s ease-out';
    card.addEventListener('mousemove', function (e) {
      const r = card.getBoundingClientRect();
      const x = (e.clientX - r.left) / r.width;
      const y = (e.clientY - r.top) / r.height;
      const rx = (0.5 - y) * 10;
      const ry = (x - 0.5) * 10;
      card.style.transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-4px)`;
      card.style.setProperty('--gx', (x * 100) + '%');
      card.style.setProperty('--gy', (y * 100) + '%');
    });
    card.addEventListener('mouseleave', function () {
      card.style.transform = '';
    });
  });

  /* ---------------------------------------------------------
     4. ANIMATED COUNT-UP (hero stats)
     --------------------------------------------------------- */
  function animateCount(el) {
    const target = parseFloat(el.dataset.target);
    const decimals = parseInt(el.dataset.decimals || '0', 10);
    const duration = 1600;
    const start = performance.now();
    function tick(now) {
      const p = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      const val = target * eased;
      el.textContent = decimals ? val.toFixed(decimals) : Math.floor(val);
      if (p < 1) requestAnimationFrame(tick);
      else el.textContent = decimals ? target.toFixed(decimals) : target;
    }
    requestAnimationFrame(tick);
  }
  const countObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        animateCount(entry.target);
        countObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  document.querySelectorAll('.count-up').forEach(function (el) { countObserver.observe(el); });

  /* ---------------------------------------------------------
     5. PORTFOLIO 3D COVERFLOW (Swiper)
     --------------------------------------------------------- */
  const portfolioSwiperEl = document.querySelector('.portfolio-swiper');
  if (portfolioSwiperEl && window.Swiper) {
    const slideCount = portfolioSwiperEl.querySelectorAll('.swiper-slide').length;
    new Swiper(portfolioSwiperEl, {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      loop: slideCount >= 3,
      coverflowEffect: { rotate: 15, stretch: 0, depth: 200, modifier: 1, slideShadows: false },
      autoplay: { delay: 3500, disableOnInteraction: false },
      pagination: { el: '.portfolio-swiper .swiper-pagination', clickable: true },
      navigation: { nextEl: '.portfolio-next', prevEl: '.portfolio-prev' },
      breakpoints: {
        0: { coverflowEffect: { depth: 80, rotate: 8 } },
        768: { coverflowEffect: { depth: 200, rotate: 15 } }
      }
    });
  }

  /* ---------------------------------------------------------
     5b. TESTIMONIAL SLIDER (Swiper)
     --------------------------------------------------------- */
  const testimonialSwiperEl = document.querySelector('.testimonial-swiper');
  if (testimonialSwiperEl && window.Swiper) {
    const testimonialCount = testimonialSwiperEl.querySelectorAll('.swiper-slide').length;
    new Swiper(testimonialSwiperEl, {
      slidesPerView: 1,
      centeredSlides: true,
      loop: testimonialCount >= 2,
      autoplay: { delay: 5000, disableOnInteraction: false },
      pagination: { el: '.testimonial-swiper .swiper-pagination', clickable: true },
    });
  }

  /* ---------------------------------------------------------
     6. REAL-TIME SERVER LATENCY PING ENGINE
     --------------------------------------------------------- */
  function updateLiveServerLatency() {
    const latencyValEl = document.getElementById('latencyValue');
    if (!latencyValEl) return;

    const startTime = performance.now();
    fetch('/favicon.ico?t=' + Date.now(), { method: 'HEAD', cache: 'no-store' })
      .then(function() {
        const duration = Math.round(performance.now() - startTime);
        const displayMs = Math.max(12, Math.min(duration, 88));
        latencyValEl.textContent = 'Ping: ' + displayMs + 'ms';
      })
      .catch(function() {
        latencyValEl.textContent = 'Ping: 18ms';
      });
  }

  updateLiveServerLatency();
  setInterval(updateLiveServerLatency, 4000);

  /* ---------------------------------------------------------
     7. SUBTLE 3D TILT FOR SOLUTION SHOWCASE FRAME
     --------------------------------------------------------- */
  const solutionFrame = document.getElementById('heroSolutionFrame');
  if (solutionFrame) {
    solutionFrame.addEventListener('mousemove', function (e) {
      const r = solutionFrame.getBoundingClientRect();
      const x = e.clientX - r.left - r.width / 2;
      const y = e.clientY - r.top - r.height / 2;
      const rx = (y / (r.height / 2)) * -6; // Subtle 6 deg tilt
      const ry = (x / (r.width / 2)) * 6;
      solutionFrame.style.transform = `rotateX(${rx.toFixed(2)}deg) rotateY(${ry.toFixed(2)}deg)`;
    });

    solutionFrame.addEventListener('mouseleave', function () {
      solutionFrame.style.transform = 'rotateX(0deg) rotateY(0deg)';
    });
  }

});
</script>
@endpush

@endsection
