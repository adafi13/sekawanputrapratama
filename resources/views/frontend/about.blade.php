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
      <p class="abt-hero-sub reveal delay-200">
        Kami adalah kumpulan pemikir, pengembang, dan visioner yang berdedikasi untuk membangun solusi teknologi yang tidak hanya berfungsi, tetapi juga menginspirasi.
      </p>
    </div>
  </div>
</section>

{{-- MISSION & STATS --}}
<section class="abt-mission">
  <div class="container">
    <div class="mission-card reveal">
      <div class="mission-left">
        <span class="label">Misi Kami</span>
        <h2>Membangun Jembatan Menuju <span class="text-primary">Masa Depan Digital</span></h2>
        <p>
          Sejak 2024, PT Sekawan Putra Pratama telah berkomitmen untuk menghadirkan kualitas tingkat dunia dalam setiap baris kode yang kami tulis. Fokus kami adalah memberdayakan bisnis lokal untuk bersaing di panggung global melalui infrastruktur IT yang kokoh dan aplikasi yang intuitif.
        </p>
      </div>
      <div class="mission-right">
        <div class="stats-grid-mini">
          <div class="stat-box-mini reveal delay-100">
            <span class="num">50+</span>
            <span class="txt">Proyek Selesai</span>
          </div>
          <div class="stat-box-mini reveal delay-200">
            <span class="num">20+</span>
            <span class="txt">Klien Aktif</span>
          </div>
          <div class="stat-box-mini reveal delay-300">
            <span class="num">2024</span>
            <span class="txt">Tahun Berdiri</span>
          </div>
          <div class="stat-box-mini reveal delay-400">
            <span class="num">24/7</span>
            <span class="txt">Dukungan Teknis</span>
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
