@extends('frontend.layouts.app')

@section('title', 'Tentang Kami - PT Sekawan Putra Pratama')
@section('meta_description', 'Mengenal tim profesional PT Sekawan Putra Pratama — mitra IT terpercaya sejak 2015 untuk solusi web, mobile, dan infrastruktur teknologi.')

@section('content')

{{-- ===== HERO ===== --}}
<section class="abt-hero">
  <div class="abt-hero-orb o1"></div>
  <div class="abt-hero-orb o2"></div>
  <div class="abt-hero-mesh"></div>
  <div class="container text-center position-relative z-2">
    <span class="abt-pill"><i class="fas fa-building me-2"></i>Tentang Perusahaan</span>
    <h1 class="abt-hero-title">Mengenal Lebih Dekat<br><span class="abt-grad">Visi &amp; Dedikasi Kami</span></h1>
    <p class="abt-hero-sub mx-auto">Kami bukan sekadar pengembang kode — kami adalah <strong>mitra strategis</strong> yang menerjemahkan kebutuhan bisnis Anda menjadi solusi teknologi nyata yang berdampak.</p>
  </div>
</section>

{{-- ===== WHO WE ARE ===== --}}
<section class="abt-who">
  <div class="container">
    <div class="abt-who-grid">
      <div class="abt-who-img-col">
        <div class="abt-img-frame">
          <img src="{{ asset('assets/media/images/about-cover.png') }}" alt="Tentang PT Sekawan Putra Pratama" class="abt-img">
          <div class="abt-img-badge">
            <i class="fas fa-check-circle"></i>
            <span>Terpercaya Sejak 2015</span>
          </div>
        </div>
      </div>
      <div class="abt-who-text">
        <span class="abt-label">Siapa Kami?</span>
        <h2 class="abt-section-title">Mitra Teknologi <span class="abt-grad">Terpercaya</span> Anda</h2>
        <p class="abt-body"><strong>PT Sekawan Putra Pratama</strong> adalah tim konsultan IT dan pengembang perangkat lunak yang berfokus pada solusi digital terintegrasi untuk bisnis dari berbagai industri.</p>
        <p class="abt-body">Kami tidak hanya membuat kode, kami membangun solusi. Mulai dari perancangan sistem backend yang kompleks, instalasi server kantor yang aman, hingga antarmuka aplikasi yang memanjakan pengguna.</p>
        <div class="abt-stats-row">
          <div class="abt-stat">
            <span class="abt-stat-num">50<span class="abt-stat-plus">+</span></span>
            <span class="abt-stat-label">Proyek Selesai</span>
          </div>
          <div class="abt-stat-div"></div>
          <div class="abt-stat">
            <span class="abt-stat-num">20<span class="abt-stat-plus">+</span></span>
            <span class="abt-stat-label">Klien Puas</span>
          </div>
          <div class="abt-stat-div"></div>
          <div class="abt-stat">
            <span class="abt-stat-num">5<span class="abt-stat-plus">+</span></span>
            <span class="abt-stat-label">Tahun Pengalaman</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===== VISION & MISSION ===== --}}
<section class="abt-vm">
  <div class="abt-vm-glow"></div>
  <div class="container position-relative z-2">
    <div class="text-center mb-5">
      <span class="abt-pill abt-pill-light">Identitas Kami</span>
      <h2 class="abt-section-title mt-3 text-white">Visi &amp; <span class="abt-grad">Misi</span></h2>
    </div>
    <div class="abt-vm-grid">
      <div class="abt-vm-card">
        <div class="abt-vm-icon"><i class="fas fa-eye"></i></div>
        <h4 class="abt-vm-name">Visi</h4>
        <p class="abt-vm-desc">Menjadi perusahaan teknologi digital terdepan di Indonesia yang menghadirkan solusi inovatif, andal, dan berdampak nyata bagi perkembangan bisnis klien kami.</p>
      </div>
      <div class="abt-vm-card abt-vm-card-accent">
        <div class="abt-vm-icon"><i class="fas fa-rocket"></i></div>
        <h4 class="abt-vm-name">Misi</h4>
        <ul class="abt-vm-list">
          <li><i class="fas fa-check"></i> Memberikan solusi IT berkualitas tinggi dengan harga terjangkau</li>
          <li><i class="fas fa-check"></i> Mengutamakan kepuasan klien di setiap tahap pengerjaan</li>
          <li><i class="fas fa-check"></i> Terus berinovasi mengikuti perkembangan teknologi global</li>
          <li><i class="fas fa-check"></i> Membangun kemitraan jangka panjang berbasis kepercayaan</li>
        </ul>
      </div>
      <div class="abt-vm-card">
        <div class="abt-vm-icon"><i class="fas fa-gem"></i></div>
        <h4 class="abt-vm-name">Nilai Kami</h4>
        <div class="abt-values">
          <span class="abt-value-tag"><i class="fas fa-star"></i> Integritas</span>
          <span class="abt-value-tag"><i class="fas fa-lightbulb"></i> Inovasi</span>
          <span class="abt-value-tag"><i class="fas fa-users"></i> Kolaborasi</span>
          <span class="abt-value-tag"><i class="fas fa-award"></i> Kualitas</span>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===== TEAM ===== --}}
<section class="abt-team">
  <div class="container">
    <div class="text-center mb-5">
      <span class="abt-pill">Tim Inti Kami</span>
      <h2 class="abt-section-title mt-3">Profesional di <span class="abt-grad">Balik Layar</span></h2>
      <p class="abt-section-sub mx-auto">Orang-orang berdedikasi yang mewujudkan ide Anda dengan keahlian dan semangat tinggi.</p>
    </div>

    {{-- Row 1: 3 cards --}}
    <div class="abt-team-grid">
      <div class="abt-team-card">
        <div class="abt-team-img-wrap">
          <img src="{{ asset('assets/media/team/abdul-malik.png') }}" alt="Abdul Malik Ibrahim">
          <div class="abt-team-exp"><i class="fas fa-star"></i> 7+ Tahun</div>
        </div>
        <div class="abt-team-body">
          <h5 class="abt-team-name">Abdul Malik Ibrahim</h5>
          <span class="abt-team-role">App Developer</span>
          <p class="abt-team-desc">Berpengalaman membangun aplikasi mobile dan desktop modern, responsif, dan berperforma tinggi.</p>
        </div>
      </div>
      <div class="abt-team-card">
        <div class="abt-team-img-wrap">
          <img src="{{ asset('assets/media/team/aries-adityanto.png') }}" alt="Aries Adityanto">
          <div class="abt-team-exp"><i class="fas fa-star"></i> 5+ Tahun</div>
        </div>
        <div class="abt-team-body">
          <h5 class="abt-team-name">Aries Adityanto</h5>
          <span class="abt-team-role">Project Manager</span>
          <p class="abt-team-desc">Memastikan setiap proyek berjalan presisi, tepat waktu, dan sesuai kebutuhan klien.</p>
        </div>
      </div>
      <div class="abt-team-card">
        <div class="abt-team-img-wrap">
          <img src="{{ asset('assets/media/team/aditya-novaldy.png') }}" alt="M. Aditya Novaldy">
          <div class="abt-team-exp"><i class="fas fa-star"></i> 6+ Tahun</div>
        </div>
        <div class="abt-team-body">
          <h5 class="abt-team-name">M. Aditya Novaldy</h5>
          <span class="abt-team-role">Server &amp; Networking</span>
          <p class="abt-team-desc">Ahli infrastruktur server dan jaringan, memastikan koneksi stabil dan sistem berjalan lancar.</p>
        </div>
      </div>
    </div>

    {{-- Row 2: 2 cards centered --}}
    <div class="abt-team-grid abt-team-grid-center mt-4">
      <div class="abt-team-card">
        <div class="abt-team-img-wrap">
          <img src="{{ asset('assets/media/team/muhammad-naufal-fauthuroni.png') }}" alt="M. Naufal Fathuroni">
          <div class="abt-team-exp"><i class="fas fa-star"></i> 2+ Tahun</div>
        </div>
        <div class="abt-team-body">
          <h5 class="abt-team-name">M. Naufal Fathuroni</h5>
          <span class="abt-team-role">UI/UX Designer</span>
          <p class="abt-team-desc">Merancang antarmuka intuitif yang fokus pada pengalaman pengguna dan estetika visual.</p>
        </div>
      </div>
      <div class="abt-team-card">
        <div class="abt-team-img-wrap">
          <img src="{{ asset('assets/media/team/alfario-daffa-mustofa.png') }}" alt="Alfario Dafa Mustofa">
          <div class="abt-team-exp"><i class="fas fa-star"></i> 5+ Tahun</div>
        </div>
        <div class="abt-team-body">
          <h5 class="abt-team-name">Alfario Dafa Mustofa</h5>
          <span class="abt-team-role">Office Server</span>
          <p class="abt-team-desc">Spesialis setup server kantor, konfigurasi jaringan internal, dan keamanan data perusahaan.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===== CTA ===== --}}
<section class="abt-cta">
  <div class="abt-cta-mesh"></div>
  <div class="container text-center position-relative z-2">
    <div class="abt-cta-icon"><i class="fas fa-handshake"></i></div>
    <h2 class="abt-cta-title">Siap Berkolaborasi dengan Tim Kami?</h2>
    <p class="abt-cta-sub mx-auto">Jangan ragu untuk mendiskusikan ide Anda. Kami siap membantu mentransformasi bisnis Anda ke level digital berikutnya.</p>
    <a href="{{ route('contact') }}" class="abt-cta-btn">
      <i class="fas fa-paper-plane"></i>
      Hubungi Kami Sekarang
    </a>
  </div>
</section>

<style>
/* ============================================================
   ABOUT PAGE — Enterprise "Midnight Blue" v2
   ============================================================ */

/* ---- HERO ---- */
.abt-hero{background:#0A1628;min-height:420px;display:flex;align-items:center;position:relative;overflow:hidden;padding:120px 0 80px;}
.abt-hero-orb{position:absolute;border-radius:50%;filter:blur(90px);pointer-events:none;}
.abt-hero-orb.o1{width:560px;height:560px;top:-20%;left:-10%;background:radial-gradient(circle,rgba(37,99,235,.45),transparent 65%);animation:abtOrb 14s ease-in-out infinite alternate;}
.abt-hero-orb.o2{width:420px;height:420px;bottom:-15%;right:-8%;background:radial-gradient(circle,rgba(99,102,241,.35),transparent 65%);animation:abtOrb 10s ease-in-out infinite alternate-reverse;}
@keyframes abtOrb{from{transform:translate(0,0);}to{transform:translate(35px,25px);}}
.abt-hero-mesh{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.025) 1px,transparent 1px);background-size:48px 48px;mask-image:radial-gradient(ellipse 80% 80% at 50% 50%,black 30%,transparent 100%);}

.abt-pill{display:inline-flex;align-items:center;background:rgba(37,99,235,.15);border:1px solid rgba(96,165,250,.25);color:#93C5FD;padding:7px 18px;border-radius:50px;font-size:12px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:20px;}
.abt-pill-light{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.15);color:rgba(255,255,255,.7);}

.abt-hero-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:clamp(2rem,4.5vw,3.4rem);font-weight:800;color:#fff;line-height:1.12;letter-spacing:-1.5px;margin-bottom:20px;}
.abt-grad{background:linear-gradient(90deg,#60A5FA,#A78BFA 60%,#22D3EE);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.abt-hero-sub{max-width:620px;color:rgba(255,255,255,.55);font-size:1rem;line-height:1.8;font-weight:300;}
.abt-hero-sub strong{color:rgba(255,255,255,.9);font-weight:600;}

/* ---- WHO WE ARE ---- */
.abt-who{background:#fff;padding:100px 0;}
.abt-who-grid{display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:80px;}
.abt-img-frame{position:relative;border-radius:24px;overflow:visible;}
.abt-img{width:100%;border-radius:20px;box-shadow:0 30px 80px rgba(0,0,0,.14);display:block;transition:transform .4s ease;}
.abt-img-frame:hover .abt-img{transform:scale(1.02);}
.abt-img-badge{position:absolute;bottom:-16px;left:24px;background:#2563EB;color:#fff;padding:10px 20px;border-radius:12px;font-size:13px;font-weight:700;display:flex;align-items:center;gap:8px;box-shadow:0 8px 24px rgba(37,99,235,.4);}
.abt-img-badge i{color:#BAE6FD;}

.abt-label{display:block;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:2px;color:#2563EB;margin-bottom:12px;}
.abt-section-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:clamp(1.8rem,3vw,2.6rem);font-weight:800;color:#0F172A;line-height:1.15;letter-spacing:-1px;margin-bottom:20px;}
.abt-body{color:#64748B;font-size:.97rem;line-height:1.8;margin-bottom:16px;}
.abt-body strong{color:#1E293B;font-weight:700;}

.abt-stats-row{display:flex;align-items:center;margin-top:36px;padding:28px 0 0;border-top:1px solid #E2E8F0;}
.abt-stat{}
.abt-stat-num{display:block;font-family:var(--font-heading,'Poppins'),sans-serif;font-size:2rem;font-weight:800;color:#0F172A;line-height:1;}
.abt-stat-plus{color:#2563EB;font-size:1.2rem;}
.abt-stat-label{display:block;font-size:11px;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;margin-top:5px;font-weight:600;}
.abt-stat-div{width:1px;height:44px;background:#E2E8F0;margin:0 28px;}

/* ---- VISION & MISSION ---- */
.abt-vm{background:#0A1628;padding:100px 0;position:relative;overflow:hidden;}
.abt-vm-glow{position:absolute;width:600px;height:600px;top:50%;left:50%;transform:translate(-50%,-50%);background:radial-gradient(circle,rgba(37,99,235,.2),transparent 65%);filter:blur(80px);pointer-events:none;}
.abt-section-title.text-white{color:#fff !important;}
.abt-section-sub{color:#64748B;font-size:.97rem;line-height:1.8;max-width:560px;}

.abt-vm-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
.abt-vm-card{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:20px;padding:36px 28px;transition:all .25s;}
.abt-vm-card:hover{background:rgba(255,255,255,.07);border-color:rgba(96,165,250,.2);transform:translateY(-4px);}
.abt-vm-card-accent{background:rgba(37,99,235,.12);border-color:rgba(96,165,250,.25);}
.abt-vm-icon{width:52px;height:52px;background:linear-gradient(135deg,rgba(37,99,235,.3),rgba(99,102,241,.3));border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#60A5FA;margin-bottom:20px;}
.abt-vm-name{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:17px;font-weight:700;color:#fff;margin-bottom:14px;}
.abt-vm-desc{color:rgba(255,255,255,.55);font-size:14px;line-height:1.7;margin:0;}
.abt-vm-list{list-style:none;padding:0;margin:0;}
.abt-vm-list li{color:rgba(255,255,255,.65);font-size:13.5px;line-height:1.6;margin-bottom:10px;display:flex;align-items:flex-start;gap:10px;}
.abt-vm-list li i{color:#34D399;font-size:12px;margin-top:3px;flex-shrink:0;}

.abt-values{display:flex;flex-wrap:wrap;gap:10px;margin-top:4px;}
.abt-value-tag{background:rgba(37,99,235,.2);border:1px solid rgba(96,165,250,.2);color:#93C5FD;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:6px;}
.abt-value-tag i{font-size:11px;}

/* ---- TEAM ---- */
.abt-team{background:#F8FAFC;padding:100px 0;}
.abt-team-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px;}
.abt-team-grid-center{grid-template-columns:repeat(2,1fr);max-width:calc(66.66% + 14px);margin-left:auto;margin-right:auto;}

.abt-team-card{background:#fff;border:1px solid #E2E8F0;border-radius:20px;overflow:hidden;transition:all .28s;position:relative;}
.abt-team-card:hover{transform:translateY(-8px);box-shadow:0 24px 60px rgba(0,0,0,.1);border-color:#BFDBFE;}
.abt-team-img-wrap{position:relative;height:280px;overflow:hidden;background:#EFF6FF;}
.abt-team-img-wrap img{width:100%;height:100%;object-fit:cover;object-position:top center;transition:transform .5s ease;}
.abt-team-card:hover .abt-team-img-wrap img{transform:scale(1.05);}
.abt-team-exp{position:absolute;bottom:12px;right:12px;background:#fff;border-radius:50px;padding:5px 12px;font-size:12px;font-weight:700;color:#1E293B;display:flex;align-items:center;gap:5px;box-shadow:0 4px 16px rgba(0,0,0,.12);}
.abt-team-exp i{color:#F59E0B;font-size:11px;}
.abt-team-body{padding:24px;}
.abt-team-name{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:16px;font-weight:700;color:#1E293B;margin-bottom:4px;}
.abt-team-role{display:inline-block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#2563EB;margin-bottom:12px;}
.abt-team-desc{font-size:13px;color:#94A3B8;line-height:1.6;margin:0;}

/* Center last row (4th & 5th cards) */
.abt-team-grid::after{content:'';display:block;}

/* ---- CTA ---- */
.abt-cta{background:linear-gradient(135deg,#0F172A 0%,#1E3A8A 50%,#2563EB 100%);padding:100px 0;position:relative;overflow:hidden;}
.abt-cta-mesh{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:40px 40px;}
.abt-cta-icon{width:64px;height:64px;background:rgba(255,255,255,.1);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;font-size:26px;color:#fff;border:1px solid rgba(255,255,255,.15);}
.abt-cta-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:clamp(1.8rem,3.5vw,2.6rem);font-weight:800;color:#fff;margin-bottom:16px;}
.abt-cta-sub{max-width:540px;color:rgba(255,255,255,.65);font-size:.97rem;line-height:1.7;margin-bottom:36px;}
.abt-cta-btn{display:inline-flex;align-items:center;gap:10px;background:#fff;color:#2563EB;padding:15px 36px;border-radius:50px;font-weight:700;font-size:15px;text-decoration:none;box-shadow:0 8px 28px rgba(0,0,0,.2);transition:all .25s;}
.abt-cta-btn:hover{transform:translateY(-3px);box-shadow:0 16px 40px rgba(0,0,0,.3);color:#1D4ED8;}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:1024px){
  .abt-vm-grid{grid-template-columns:1fr 1fr;}
  .abt-vm-card:last-child{grid-column:1/-1;}
}

@media(max-width:991px){
  .abt-who-grid{grid-template-columns:1fr;gap:48px;}
  .abt-team-grid{grid-template-columns:1fr 1fr;}
  .abt-team-grid-center{grid-template-columns:1fr 1fr;max-width:100%;}
  .abt-who{padding:70px 0;}
  .abt-team{padding:70px 0;}
  .abt-vm{padding:70px 0;}
  .abt-cta{padding:70px 0;}
}

@media(max-width:640px){
  .abt-hero{padding:110px 0 60px;min-height:360px;}
  .abt-who-grid{gap:36px;}
  .abt-stats-row{flex-wrap:wrap;gap:20px;}
  .abt-stat-div{display:none;}
  .abt-vm-grid{grid-template-columns:1fr;}
  .abt-vm-card:last-child{grid-column:auto;}
  .abt-team-grid{grid-template-columns:1fr;}
  .abt-team-grid-center{grid-template-columns:1fr;max-width:100%;}
  .abt-img-badge{bottom:-12px;left:12px;font-size:12px;padding:8px 14px;}
}
</style>

@endsection
