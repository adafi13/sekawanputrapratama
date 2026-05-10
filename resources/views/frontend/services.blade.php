@extends('frontend.layouts.app')

@section('title', 'Layanan Kami - Sekawan Putra Pratama')
@section('meta_description', 'Layanan IT profesional: Web Development, App Development, dan Infrastruktur Server & Jaringan untuk bisnis Anda.')

@section('content')

{{-- ===== HERO ===== --}}
<section class="svc-hero">
  <div class="svc-hero-glow g1"></div>
  <div class="svc-hero-glow g2"></div>
  <div class="svc-hero-grid"></div>
  <div class="container position-relative z-2 text-center">
    <span class="svc-pill mb-4 d-inline-block"><i class="fas fa-layer-group me-2"></i>Layanan &amp; Spesialisasi</span>
    <h1 class="svc-hero-title">Solusi Digital<br><span class="svc-grad">Tanpa Batas</span></h1>
    <p class="svc-hero-sub mx-auto">Kami mengintegrasikan strategi bisnis dengan <strong>rekayasa teknologi mutakhir</strong> untuk menciptakan ekosistem digital yang skalabel, aman, dan inovatif.</p>
    <div class="svc-scroll-hint"><div class="svc-scroll-line"></div></div>
  </div>
</section>

{{-- ===== SERVICES ===== --}}
<section class="svc-body">
  <div class="container">

    {{-- Web Development --}}
    <div class="svc-row">
      <div class="svc-img-col">
        <div class="svc-img-wrap">
          <img src="{{ asset('assets/media/images/web-development.png') }}" alt="Web Development" class="svc-img">
          <div class="svc-img-badge svc-badge-blue"><i class="fas fa-globe"></i></div>
        </div>
      </div>
      <div class="svc-text-col">
        <span class="svc-label svc-label-blue">01 &mdash; Web</span>
        <h2 class="svc-title">Web Development</h2>
        <p class="svc-desc">Kami menciptakan pengalaman digital yang menarik melalui website yang cepat, aman, dan mudah dikelola — dari company profile hingga sistem enterprise.</p>
        <div class="svc-features">
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon blue"></i><div><strong>Company Profile</strong><span>Branding digital profesional untuk kredibilitas bisnis.</span></div></div>
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon blue"></i><div><strong>E-Commerce</strong><span>Toko online dengan sistem pembayaran &amp; manajemen stok.</span></div></div>
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon blue"></i><div><strong>Web Application</strong><span>Sistem internal ERP/CRM berbasis cloud.</span></div></div>
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon blue"></i><div><strong>SEO Optimized</strong><span>Struktur ramah mesin pencari untuk traffic maksimal.</span></div></div>
        </div>
        <a href="{{ route('contact') }}" class="svc-btn svc-btn-blue">Konsultasi Web <i class="fas fa-arrow-right ms-2"></i></a>
      </div>
    </div>

    <div class="svc-divider"></div>

    {{-- App Development --}}
    <div class="svc-row svc-row-rev">
      <div class="svc-img-col">
        <div class="svc-img-wrap">
          <img src="{{ asset('assets/media/images/app-development.png') }}" alt="App Development" class="svc-img">
          <div class="svc-img-badge svc-badge-indigo"><i class="fas fa-mobile-alt"></i></div>
        </div>
      </div>
      <div class="svc-text-col">
        <span class="svc-label svc-label-indigo">02 &mdash; Mobile</span>
        <h2 class="svc-title">App Development</h2>
        <p class="svc-desc">Hadirkan bisnis Anda ke genggaman pelanggan dengan aplikasi mobile yang intuitif dan berperforma tinggi di platform Android maupun iOS.</p>
        <div class="svc-features">
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon indigo"></i><div><strong>Android &amp; iOS</strong><span>Native maupun Hybrid (Flutter/React Native).</span></div></div>
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon indigo"></i><div><strong>UX Focused</strong><span>Desain antarmuka intuitif &amp; mudah digunakan.</span></div></div>
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon indigo"></i><div><strong>API Integration</strong><span>Sinkronisasi data real-time dengan sistem pusat.</span></div></div>
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon indigo"></i><div><strong>Maintenance</strong><span>Dukungan pembaruan &amp; perbaikan bug pasca rilis.</span></div></div>
        </div>
        <a href="{{ route('contact') }}" class="svc-btn svc-btn-indigo">Buat Aplikasi <i class="fas fa-arrow-right ms-2"></i></a>
      </div>
    </div>

    <div class="svc-divider"></div>

    {{-- Infrastructure --}}
    <div class="svc-row">
      <div class="svc-img-col">
        <div class="svc-img-wrap">
          <img src="{{ asset('assets/media/images/office-server.png') }}" alt="Infrastruktur IT" class="svc-img">
          <div class="svc-img-badge svc-badge-sky"><i class="fas fa-server"></i></div>
        </div>
      </div>
      <div class="svc-text-col">
        <span class="svc-label svc-label-sky">03 &mdash; Infrastruktur</span>
        <h2 class="svc-title">Infrastructure &amp; Server</h2>
        <p class="svc-desc">Bangun pondasi IT yang kokoh untuk menjamin keamanan data, stabilitas jaringan, dan kelancaran kolaborasi tim Anda setiap hari.</p>
        <div class="svc-features">
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon sky"></i><div><strong>Server Setup</strong><span>Instalasi Linux/Windows Server untuk data center internal.</span></div></div>
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon sky"></i><div><strong>Networking</strong><span>Konfigurasi Mikrotik, VPN, dan Load Balancing stabil.</span></div></div>
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon sky"></i><div><strong>Fiber Optic</strong><span>Instalasi FTTH berkecepatan tinggi &amp; minim gangguan.</span></div></div>
          <div class="svc-feat"><i class="fas fa-check-circle svc-feat-icon sky"></i><div><strong>CCTV &amp; Security</strong><span>Monitoring real-time dari smartphone Anda.</span></div></div>
        </div>
        <a href="{{ route('contact') }}" class="svc-btn svc-btn-sky">Konsultasi Server <i class="fas fa-arrow-right ms-2"></i></a>
      </div>
    </div>

  </div>
</section>

{{-- ===== WORKFLOW ===== --}}
<section class="svc-workflow">
  <div class="container">
    <div class="text-center mb-5">
      <span class="svc-pill svc-pill-light mb-3 d-inline-block">Cara Kerja Kami</span>
      <h2 class="svc-wf-title">Bagaimana Kami <span class="svc-grad">Bekerja?</span></h2>
    </div>
    <div class="svc-wf-grid">
      <div class="svc-wf-card">
        <div class="svc-wf-num">01</div>
        <div class="svc-wf-icon"><i class="fas fa-comments"></i></div>
        <h5 class="svc-wf-name">Konsultasi</h5>
        <p class="svc-wf-desc">Kami mendengar kebutuhan bisnis Anda dan memberikan rekomendasi terbaik.</p>
      </div>
      <div class="svc-wf-arrow"><i class="fas fa-chevron-right"></i></div>
      <div class="svc-wf-card">
        <div class="svc-wf-num">02</div>
        <div class="svc-wf-icon"><i class="fas fa-pencil-ruler"></i></div>
        <h5 class="svc-wf-name">Perencanaan</h5>
        <p class="svc-wf-desc">Penyusunan alur kerja, desain UI/UX, dan arsitektur sistem secara detail.</p>
      </div>
      <div class="svc-wf-arrow"><i class="fas fa-chevron-right"></i></div>
      <div class="svc-wf-card">
        <div class="svc-wf-num">03</div>
        <div class="svc-wf-icon"><i class="fas fa-code"></i></div>
        <h5 class="svc-wf-name">Pengembangan</h5>
        <p class="svc-wf-desc">Tim ahli kami membangun solusi Anda menggunakan teknologi terkini.</p>
      </div>
      <div class="svc-wf-arrow"><i class="fas fa-chevron-right"></i></div>
      <div class="svc-wf-card">
        <div class="svc-wf-num">04</div>
        <div class="svc-wf-icon"><i class="fas fa-rocket"></i></div>
        <h5 class="svc-wf-name">Launch &amp; Support</h5>
        <p class="svc-wf-desc">Uji coba final, go-live, dan dukungan pemeliharaan rutin pasca-peluncuran.</p>
      </div>
    </div>
  </div>
</section>

{{-- ===== CTA ===== --}}
<section class="svc-cta">
  <div class="svc-cta-grid"></div>
  <div class="container text-center position-relative z-2">
    <h2 class="svc-cta-title">Butuh Solusi IT Kustom?</h2>
    <p class="svc-cta-sub mx-auto">Setiap bisnis unik. Kami siap mendengarkan kebutuhan spesifik Anda dan memberikan penawaran terbaik tanpa biaya konsultasi.</p>
    <a href="{{ route('contact') }}" class="svc-cta-btn">Diskusikan Proyek Anda <i class="fas fa-paper-plane ms-2"></i></a>
  </div>
</section>

<style>
/* ====== HERO ====== */
.svc-hero{background:var(--midnight-blue,#0F172A);min-height:420px;display:flex;align-items:center;position:relative;overflow:hidden;padding:120px 0 80px;}
.svc-hero-glow{position:absolute;border-radius:50%;filter:blur(100px);pointer-events:none;}
.svc-hero-glow.g1{width:500px;height:500px;top:-20%;right:-10%;background:radial-gradient(circle,rgba(96,165,250,.18),transparent 70%);animation:svcDrift 10s infinite alternate;}
.svc-hero-glow.g2{width:400px;height:400px;bottom:-20%;left:-10%;background:radial-gradient(circle,rgba(167,139,250,.12),transparent 70%);animation:svcDrift 8s infinite alternate-reverse;}
.svc-hero-grid{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.025) 1px,transparent 1px);background-size:44px 44px;}
@keyframes svcDrift{from{transform:translate(0,0);}to{transform:translate(30px,30px);}}
.svc-pill{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.75);padding:8px 20px;border-radius:50px;font-size:12px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;}
.svc-pill-light{background:rgba(37,99,235,.12);border:1px solid rgba(37,99,235,.25);color:#60A5FA;}
.svc-hero-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:clamp(2.4rem,5vw,4rem);font-weight:800;color:#fff;line-height:1.1;letter-spacing:-2px;margin-bottom:20px;}
.svc-grad{background:linear-gradient(135deg,#60A5FA,#A78BFA);-webkit-background-clip:text;-webkit-text-fill-color:transparent;font-style:italic;}
.svc-hero-sub{max-width:620px;color:rgba(255,255,255,.55);font-size:1.05rem;line-height:1.8;font-weight:300;}
.svc-hero-sub strong{color:rgba(255,255,255,.9);font-weight:600;}
.svc-scroll-hint{margin-top:48px;display:inline-block;}
.svc-scroll-line{width:2px;height:44px;margin:0 auto;background:linear-gradient(to bottom,#2563EB,transparent);border-radius:2px;animation:svcBounce 2.5s infinite;}
@keyframes svcBounce{0%,100%{opacity:1;transform:translateY(0);}50%{opacity:.4;transform:translateY(8px);}}

/* ====== BODY ====== */
.svc-body{background:#fff;padding:100px 0;}
.svc-row{display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:80px;margin-bottom:0;}
.svc-row-rev .svc-img-col{order:2;}
.svc-row-rev .svc-text-col{order:1;}
.svc-divider{height:1px;background:linear-gradient(90deg,transparent,#E2E8F0,transparent);margin:80px 0;}
.svc-img-wrap{position:relative;border-radius:20px;overflow:visible;}
.svc-img{width:100%;border-radius:20px;box-shadow:0 24px 60px rgba(0,0,0,.12);display:block;transition:transform .4s ease;}
.svc-img-wrap:hover .svc-img{transform:scale(1.025);}
.svc-img-badge{position:absolute;top:-16px;right:-16px;width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#fff;box-shadow:0 8px 24px rgba(0,0,0,.2);}
.svc-badge-blue{background:linear-gradient(135deg,#2563EB,#3B82F6);}
.svc-badge-indigo{background:linear-gradient(135deg,#6366F1,#818CF8);}
.svc-badge-sky{background:linear-gradient(135deg,#0EA5E9,#38BDF8);}
.svc-label{font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:2px;margin-bottom:12px;display:block;}
.svc-label-blue{color:#2563EB;}
.svc-label-indigo{color:#6366F1;}
.svc-label-sky{color:#0EA5E9;}
.svc-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:clamp(1.8rem,3vw,2.5rem);font-weight:800;color:#0F172A;line-height:1.15;margin-bottom:16px;letter-spacing:-1px;}
.svc-desc{color:#64748B;font-size:.98rem;line-height:1.8;margin-bottom:28px;}
.svc-features{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:32px;}
.svc-feat{display:flex;align-items:flex-start;gap:12px;}
.svc-feat-icon{font-size:15px;margin-top:3px;flex-shrink:0;}
.svc-feat-icon.blue{color:#2563EB;}
.svc-feat-icon.indigo{color:#6366F1;}
.svc-feat-icon.sky{color:#0EA5E9;}
.svc-feat strong{display:block;font-size:13px;font-weight:700;color:#1E293B;margin-bottom:3px;}
.svc-feat span{font-size:12px;color:#94A3B8;line-height:1.5;}
.svc-btn{display:inline-flex;align-items:center;padding:13px 30px;border-radius:50px;font-weight:700;font-size:14px;text-decoration:none;transition:all .25s;}
.svc-btn-blue{background:#2563EB;color:#fff;box-shadow:0 8px 24px rgba(37,99,235,.35);}
.svc-btn-blue:hover{background:#1D4ED8;color:#fff;transform:translateY(-2px);box-shadow:0 14px 32px rgba(37,99,235,.5);}
.svc-btn-indigo{background:#6366F1;color:#fff;box-shadow:0 8px 24px rgba(99,102,241,.35);}
.svc-btn-indigo:hover{background:#4F46E5;color:#fff;transform:translateY(-2px);box-shadow:0 14px 32px rgba(99,102,241,.5);}
.svc-btn-sky{background:#0EA5E9;color:#fff;box-shadow:0 8px 24px rgba(14,165,233,.35);}
.svc-btn-sky:hover{background:#0284C7;color:#fff;transform:translateY(-2px);box-shadow:0 14px 32px rgba(14,165,233,.5);}

/* ====== WORKFLOW ====== */
.svc-workflow{background:#F8FAFC;padding:100px 0;}
.svc-wf-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:clamp(1.8rem,3vw,2.5rem);font-weight:800;color:#0F172A;margin-top:12px;}
.svc-wf-grid{display:flex;align-items:center;gap:0;justify-content:center;}
.svc-wf-card{background:#fff;border:1px solid #E2E8F0;border-radius:20px;padding:36px 28px;text-align:center;flex:1;max-width:220px;position:relative;transition:all .25s;}
.svc-wf-card:hover{transform:translateY(-6px);box-shadow:0 20px 48px rgba(0,0,0,.1);border-color:#BFDBFE;}
.svc-wf-num{position:absolute;top:-16px;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#2563EB,#6366F1);color:#fff;font-size:11px;font-weight:800;padding:4px 14px;border-radius:50px;letter-spacing:1px;}
.svc-wf-icon{width:56px;height:56px;background:linear-gradient(135deg,rgba(37,99,235,.1),rgba(99,102,241,.1));border-radius:16px;display:flex;align-items:center;justify-content:center;margin:12px auto 16px;color:#2563EB;font-size:22px;}
.svc-wf-name{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:15px;font-weight:700;color:#1E293B;margin-bottom:8px;}
.svc-wf-desc{font-size:12px;color:#94A3B8;line-height:1.6;margin:0;}
.svc-wf-arrow{color:#CBD5E1;font-size:20px;padding:0 12px;flex-shrink:0;}

/* ====== CTA ====== */
.svc-cta{background:linear-gradient(135deg,#0F172A 0%,#1E3A8A 50%,#2563EB 100%);padding:100px 0;position:relative;overflow:hidden;}
.svc-cta-grid{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:40px 40px;}
.svc-cta-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:clamp(1.8rem,3.5vw,2.8rem);font-weight:800;color:#fff;margin-bottom:16px;}
.svc-cta-sub{max-width:560px;color:rgba(255,255,255,.65);font-size:1rem;line-height:1.7;margin-bottom:36px;}
.svc-cta-btn{display:inline-flex;align-items:center;background:#fff;color:#2563EB;padding:15px 36px;border-radius:50px;font-weight:700;font-size:15px;text-decoration:none;box-shadow:0 8px 28px rgba(0,0,0,.2);transition:all .25s;}
.svc-cta-btn:hover{transform:translateY(-3px);box-shadow:0 16px 40px rgba(0,0,0,.3);color:#1D4ED8;}

/* ====== RESPONSIVE ====== */
@media(max-width:991px){
  .svc-row{grid-template-columns:1fr;gap:40px;}
  .svc-row-rev .svc-img-col{order:1;}
  .svc-row-rev .svc-text-col{order:2;}
  .svc-wf-grid{flex-wrap:wrap;gap:24px;}
  .svc-wf-arrow{display:none;}
  .svc-wf-card{max-width:48%;flex:1 1 45%;}
  .svc-body{padding:70px 0;}
}
@media(max-width:600px){
  .svc-features{grid-template-columns:1fr;}
  .svc-wf-card{max-width:100%;flex:1 1 100%;}
  .svc-workflow,.svc-cta{padding:70px 0;}
}
</style>

@endsection
