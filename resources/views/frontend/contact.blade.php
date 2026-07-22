@extends('frontend.layouts.app')

@section('title', 'Hubungi Kami - Sekawan Putra Pratama')
@section('meta_description', 'Konsultasikan kebutuhan IT Anda secara gratis. Tim Sekawan Putra Pratama siap membantu dalam 24 jam.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Kontak', 'url' => route('contact')],
]])

@section('content')

{{-- ===== HERO BANNER (Clean Light Corporate Theme) ===== --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 65px !important;">
  <div class="container text-center position-relative z-2">
    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-pill px-4 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 11px;">
      <i class="fas fa-headset me-2"></i> KONSULTASI PROYEK &amp; SUPPORT IT
    </span>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Hubungi Tim Konsultan <span class="text-primary">PT Sekawan Putra Pratama</span>
    </h1>

    <p class="text-muted mx-auto mb-4" style="max-width: 680px; font-size: 1.05rem; line-height: 1.7;">
      Diskusikan kebutuhan perancangan sistem custom, penginstalan jaringan server kantor/pabrik, atau konsultasi IT Anda bersama tim insinyur berpengalaman kami.
    </p>
    
    {{-- Clean Typewriter Status Bar --}}
    <div class="d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill bg-light border shadow-sm" style="border-color: #e2e8f0 !important; font-size: 0.95rem;">
      <i class="fas fa-bullhorn text-primary me-1" style="font-size: 13px;"></i>
      <span id="typewriter-text" class="fw-bold text-dark"></span><span class="ctc-cursor" style="color: #2563eb;">|</span>
    </div>
  </div>
</section>

{{-- ===== MAIN CONTACT SECTION ===== --}}
<section class="ctc-main">
  <div class="container">
    <div class="ctc-grid">

      {{-- ===== LEFT: Info Sidebar ===== --}}
      <div class="ctc-sidebar reveal-left">

        <div class="ctc-sidebar-header">
          <h3 class="ctc-sidebar-title">Informasi Kontak</h3>
          <p class="ctc-sidebar-sub">Hubungi kami melalui saluran berikut. Kami merespons dalam kurang dari <strong>24 jam</strong>.</p>
        </div>

        <div class="ctc-info-cards">
          <a href="mailto:sekawanputrapratama@gmail.com" class="ctc-info-card reveal-left delay-100">
            <div class="ctc-info-icon ctc-blue">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="ctc-info-body">
              <span class="ctc-info-label">Email</span>
              <span class="ctc-info-value">sekawanputrapratama@gmail.com</span>
            </div>
            <i class="fas fa-arrow-right ctc-info-arrow"></i>
          </a>

          <a href="https://wa.me/6285156412702" target="_blank" class="ctc-info-card reveal-left delay-200">
            <div class="ctc-info-icon ctc-green">
              <i class="fab fa-whatsapp"></i>
            </div>
            <div class="ctc-info-body">
              <span class="ctc-info-label">WhatsApp</span>
              <span class="ctc-info-value">+62 851-5641-2702</span>
            </div>
            <i class="fas fa-arrow-right ctc-info-arrow"></i>
          </a>

          <div class="ctc-info-card ctc-info-card-addr reveal-left delay-300">
            <div class="ctc-info-icon ctc-red">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="ctc-info-body">
              <span class="ctc-info-label">Lokasi Kantor</span>
              <span class="ctc-info-value">{{ \App\Models\Setting::get('contact.address', 'Perum Mega Regency Blok G3 No. 38, RT 002 / RW 020, Sukaragam, Kec. Serang Baru, Kab. Bekasi, Jawa Barat 17330') }}</span>
              <a href="https://maps.app.goo.gl/CWZgdJDPenuBYPXi9" target="_blank" class="ctc-maps-link">
                Buka Google Maps <i class="fas fa-external-link-alt"></i>
              </a>
            </div>
          </div>

          {{-- Legal & Operating Hours Card --}}
          <div class="ctc-info-card reveal-left delay-350" style="background: #f8fafc; border-color: #e2e8f0;">
            <div class="ctc-info-icon ctc-blue" style="background: rgba(37,99,235,.1); color: #2563EB;">
              <i class="fas fa-file-contract"></i>
            </div>
            <div class="ctc-info-body">
              <span class="ctc-info-label">Verifikasi Legalitas PT &amp; Jam Operasional</span>
              <span class="ctc-info-value" style="font-size: 12px; font-family: monospace;">NIB: 0505260088735 | NPWP: 1000 0000 0948 6824</span>
              <span class="d-block text-muted mt-1" style="font-size: 11.5px; line-height: 1.4;"><i class="fas fa-clock text-info me-1"></i> Senin - Sabtu: 08:00 - 17:00 WIB (On-Call SLA 24/7)</span>
            </div>
          </div>
        </div>

        {{-- Map --}}
        <div class="ctc-map-wrap reveal-left delay-400">
          <iframe
            src="https://www.google.com/maps?q=-6.3776515,107.1246921&z=18&output=embed"
            width="100%" height="220" style="border:0;" allowfullscreen="" loading="lazy">
          </iframe>
        </div>

        {{-- Social / Response Badge --}}
        <div class="ctc-response-badge reveal-left delay-400">
          <div class="ctc-response-icon"><i class="fas fa-clock"></i></div>
          <div>
            <span class="ctc-response-title">Waktu Respons</span>
            <span class="ctc-response-val">Rata-rata &lt; 2 jam di hari kerja</span>
          </div>
        </div>

      </div>

      {{-- ===== RIGHT: Form ===== --}}
      <div class="ctc-form-wrap reveal-right">
        <div class="ctc-form-card">

          <div class="ctc-form-header">
            <div class="ctc-form-header-icon"><i class="fas fa-paper-plane"></i></div>
            <div>
              <h3 class="ctc-form-title">Kirim Pesan</h3>
              <p class="ctc-form-sub">Konsultasikan kebutuhan proyek Anda secara <span class="ctc-free">Gratis</span>.</p>
            </div>
          </div>

          {{-- Alerts --}}
          @if(session('success'))
            <div class="ctc-alert ctc-alert-success">
              <i class="fas fa-check-circle"></i>
              <span>{{ session('success') }}</span>
              <button onclick="this.parentElement.remove()" class="ctc-alert-close">&times;</button>
            </div>
          @endif
          @if(session('error'))
            <div class="ctc-alert ctc-alert-error">
              <i class="fas fa-exclamation-triangle"></i>
              <span>{{ session('error') }}</span>
              <button onclick="this.parentElement.remove()" class="ctc-alert-close">&times;</button>
            </div>
          @endif

          <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
            @csrf
            <input type="text" name="website" class="ctc-honeypot" tabindex="-1" autocomplete="off" value="">
            <div class="ctc-form-grid">

              {{-- Nama Perusahaan --}}
              <div class="ctc-field">
                <label for="company_name" class="ctc-label">Nama Perusahaan</label>
                <div class="ctc-input-wrap">
                  <i class="far fa-building ctc-field-icon"></i>
                  <input type="text" name="company_name" id="company_name"
                    class="ctc-input @error('company_name') ctc-input-error @enderror"
                    placeholder="PT. Maju Jaya" value="{{ old('company_name') }}" required>
                </div>
                @error('company_name')<span class="ctc-error">{{ $message }}</span>@enderror
              </div>

              {{-- Nama Lengkap --}}
              <div class="ctc-field">
                <label for="name" class="ctc-label">Nama Lengkap</label>
                <div class="ctc-input-wrap">
                  <i class="far fa-user ctc-field-icon"></i>
                  <input type="text" name="name" id="name"
                    class="ctc-input @error('name') ctc-input-error @enderror"
                    placeholder="Nama Anda" value="{{ old('name') }}" required>
                </div>
                @error('name')<span class="ctc-error">{{ $message }}</span>@enderror
              </div>

              {{-- Email --}}
              <div class="ctc-field">
                <label for="email" class="ctc-label">Alamat Email</label>
                <div class="ctc-input-wrap">
                  <i class="far fa-envelope ctc-field-icon"></i>
                  <input type="email" name="email" id="email"
                    class="ctc-input @error('email') ctc-input-error @enderror"
                    placeholder="email@perusahaan.com" value="{{ old('email') }}" required>
                </div>
                @error('email')<span class="ctc-error">{{ $message }}</span>@enderror
              </div>

              {{-- WhatsApp --}}
              <div class="ctc-field">
                <label for="phone" class="ctc-label">Nomor WhatsApp</label>
                <div class="ctc-input-wrap">
                  <i class="fab fa-whatsapp ctc-field-icon"></i>
                  <input type="text" name="phone" id="phone"
                    class="ctc-input @error('phone') ctc-input-error @enderror"
                    placeholder="0812xxxx" value="{{ old('phone') }}" required>
                </div>
                @error('phone')<span class="ctc-error">{{ $message }}</span>@enderror
              </div>

              {{-- Layanan --}}
              <div class="ctc-field ctc-field-full">
                <label for="service" class="ctc-label">Layanan yang Diminati</label>
                <div class="ctc-input-wrap">
                  <i class="fas fa-layer-group ctc-field-icon"></i>
                  <select name="service" id="service"
                    class="ctc-select @error('service') ctc-input-error @enderror" required>
                    <option value="" disabled selected>Pilih salah satu layanan...</option>
                    <option value="Web Development" {{ old('service')=='Web Development'?'selected':'' }}>🌐 Web Development</option>
                    <option value="App Development" {{ old('service')=='App Development'?'selected':'' }}>📱 App Development</option>
                    <option value="Office Server" {{ old('service')=='Office Server'?'selected':'' }}>🖥️ Office Server & Jaringan</option>
                    <option value="Konsultasi" {{ old('service')=='Konsultasi'?'selected':'' }}>💡 Konsultasi IT</option>
                  </select>
                </div>
                @error('service')<span class="ctc-error">{{ $message }}</span>@enderror
              </div>

              {{-- Pesan --}}
              <div class="ctc-field ctc-field-full">
                <label for="message" class="ctc-label">Detail Kebutuhan</label>
                <div class="ctc-input-wrap ctc-textarea-wrap">
                  <i class="fas fa-comment-dots ctc-field-icon ctc-field-icon-top"></i>
                  <textarea name="message" id="message" rows="4"
                    class="ctc-textarea @error('message') ctc-input-error @enderror"
                    placeholder="Ceritakan proyek Anda secara singkat...">{{ old('message') }}</textarea>
                </div>
                @error('message')<span class="ctc-error">{{ $message }}</span>@enderror
              </div>

              {{-- Submit --}}
              <div class="ctc-field ctc-field-full">
                <button type="submit" id="submitBtn" class="ctc-submit-btn">
                  <span class="ctc-btn-text"><i class="fas fa-paper-plane me-2"></i>Kirim Pesan Sekarang</span>
                  <span class="ctc-btn-loading d-none">
                    <span class="ctc-spinner"></span> Mengirim...
                  </span>
                </button>
                <p class="ctc-privacy"><i class="fas fa-shield-alt text-success me-1"></i> Privasi Anda terjamin 100% aman &amp; dilindungi NDA. Respons dalam <strong>1×24 Jam Kerja</strong>.</p>
              </div>

            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
/* ============================================================
   CONTACT PAGE — Enterprise Midnight Blue
   ============================================================ */

/* ---- HERO ---- */
.ctc-hero{background:#050b14;min-height:360px;display:flex;align-items:center;position:relative;overflow:hidden;padding:120px 0 70px;}
.ctc-hero-orb{position:absolute;border-radius:50%;filter:blur(90px);pointer-events:none;}
.ctc-hero-orb.o1{width:500px;height:500px;top:-20%;left:-10%;background:radial-gradient(circle,rgba(37,99,235,.45),transparent 65%);animation:ctcOrb 14s ease-in-out infinite alternate;}
.ctc-hero-orb.o2{width:380px;height:380px;bottom:-15%;right:-8%;background:radial-gradient(circle,rgba(99,102,241,.35),transparent 65%);animation:ctcOrb 10s ease-in-out infinite alternate-reverse;}
@keyframes ctcOrb{from{transform:translate(0,0);}to{transform:translate(30px,20px);}}
.ctc-hero-mesh{position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.025) 1px,transparent 1px);background-size:48px 48px;mask-image:radial-gradient(ellipse 80% 80% at 50% 50%,black 30%,transparent 100%);}

.ctc-pill{display:inline-flex;align-items:center;gap:10px;background:rgba(37,99,235,.15);border:1px solid rgba(96,165,250,.25);color:#93C5FD;padding:8px 20px;border-radius:50px;font-size:12px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:24px;}
.ctc-dot{width:8px;height:8px;background:#22D3EE;border-radius:50%;box-shadow:0 0 10px #22D3EE;animation:ctcPulse 2s infinite;}
@keyframes ctcPulse{0%,100%{box-shadow:0 0 0 0 rgba(34,211,238,.6);}50%{box-shadow:0 0 0 8px rgba(34,211,238,0);}}

.ctc-hero-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:clamp(1.9rem,4vw,3rem);font-weight:800;color:#fff;line-height:1.12;letter-spacing:-1.5px;margin-bottom:20px;}
.ctc-grad{background:linear-gradient(90deg,#60A5FA,#A78BFA 60%,#22D3EE);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}

.ctc-typewriter-wrap{display:flex;align-items:center;justify-content:center;gap:4px;min-height:44px;}
#typewriter-text{font-family:var(--font-body);font-size:1.15rem;font-weight:600;color:#E2E8F0;text-shadow:0 0 20px rgba(96,165,250,.3);}
.ctc-cursor{display:inline-block;width:2px;height:1.2em;background:#60A5FA;animation:ctcBlink 1s infinite;vertical-align:middle;}
@keyframes ctcBlink{0%,100%{opacity:1;}50%{opacity:0;}}

/* ---- MAIN LAYOUT ---- */
.ctc-main{background:#f8fafc;padding:60px 0 100px;}
.ctc-grid{display:grid;grid-template-columns:400px 1fr;gap:36px;margin-top:-40px;position:relative;z-index:3;}

/* ---- SIDEBAR ---- */
.ctc-sidebar{display:flex;flex-direction:column;gap:20px;}
.ctc-sidebar-header{}
.ctc-sidebar-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:20px;font-weight:700;color:#0F172A;margin-bottom:8px;}
.ctc-sidebar-sub{color:#64748B;font-size:14px;line-height:1.6;}
.ctc-sidebar-sub strong{color:#1E293B;}

.ctc-info-cards{display:flex;flex-direction:column;gap:12px;}
.ctc-info-card{display:flex;align-items:center;gap:14px;background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:16px 18px;text-decoration:none;transition:all .22s;cursor:default;}
a.ctc-info-card{cursor:pointer;}
a.ctc-info-card:hover{border-color:#BFDBFE;box-shadow:0 8px 24px rgba(37,99,235,.1);transform:translateY(-2px);}
a.ctc-info-card:hover .ctc-info-arrow{opacity:1;transform:translateX(2px);}
.ctc-info-card-addr{align-items:flex-start;}

.ctc-info-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;}
.ctc-blue{background:rgba(37,99,235,.1);color:#2563EB;}
.ctc-green{background:rgba(34,197,94,.1);color:#16A34A;}
.ctc-red{background:rgba(239,68,68,.1);color:#DC2626;}

.ctc-info-body{flex:1;min-width:0;}
.ctc-info-label{display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#94A3B8;margin-bottom:3px;}
.ctc-info-value{display:block;font-size:13.5px;font-weight:600;color:#1E293B;line-height:1.4;word-break:break-all;}
.ctc-maps-link{display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:700;color:#2563EB;text-decoration:none;margin-top:6px;transition:gap .2s;}
.ctc-maps-link:hover{gap:8px;}
.ctc-info-arrow{color:#CBD5E1;font-size:12px;opacity:0;transition:all .2s;flex-shrink:0;}

.ctc-map-wrap{border-radius:16px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 4px 20px rgba(0,0,0,.06);}
.ctc-map-wrap iframe{display:block;}

.ctc-response-badge{display:flex;align-items:center;gap:14px;background:linear-gradient(135deg,#0F172A,#1E3A8A);border-radius:16px;padding:16px 20px;}
.ctc-response-icon{width:40px;height:40px;background:rgba(255,255,255,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#60A5FA;font-size:16px;flex-shrink:0;}
.ctc-response-title{display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,.5);margin-bottom:2px;}
.ctc-response-val{display:block;font-size:13px;font-weight:600;color:#fff;}

/* ---- FORM CARD ---- */
.ctc-form-wrap{}
.ctc-form-card{background:#fff;border:1px solid #E2E8F0;border-radius:24px;padding:40px;box-shadow:0 20px 60px rgba(0,0,0,.07);}

.ctc-form-header{display:flex;align-items:center;gap:16px;margin-bottom:28px;padding-bottom:24px;border-bottom:1px solid #F1F5F9;}
.ctc-form-header-icon{width:52px;height:52px;background:linear-gradient(135deg,#1E3A8A,#2563EB);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#fff;flex-shrink:0;box-shadow:0 8px 20px rgba(37,99,235,.3);}
.ctc-form-title{font-family:var(--font-heading,'Poppins'),sans-serif;font-size:20px;font-weight:700;color:#0F172A;margin-bottom:3px;}
.ctc-form-sub{font-size:13px;color:#94A3B8;margin:0;}
.ctc-free{color:#2563EB;font-weight:700;}

/* Alerts */
.ctc-alert{display:flex;align-items:center;gap:12px;padding:14px 18px;border-radius:12px;margin-bottom:20px;font-size:14px;font-weight:500;}
.ctc-alert-success{background:#ECFDF5;color:#065F46;border:1px solid #A7F3D0;}
.ctc-alert-error{background:#FEF2F2;color:#991B1B;border:1px solid #FECACA;}
.ctc-alert i{font-size:16px;flex-shrink:0;}
.ctc-alert span{flex:1;}
.ctc-alert-close{background:none;border:none;cursor:pointer;font-size:18px;color:inherit;opacity:.6;margin-left:auto;padding:0;line-height:1;}
.ctc-alert-close:hover{opacity:1;}

/* Honeypot - hidden from real users, catches bots */
.ctc-honeypot{position:absolute;left:-9999px;width:1px;height:1px;opacity:0;pointer-events:none;}

/* Form Grid */
.ctc-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.ctc-field{display:flex;flex-direction:column;gap:6px;}
.ctc-field-full{grid-column:1/-1;}
.ctc-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#64748B;}

.ctc-input-wrap{position:relative;display:flex;align-items:center;}
.ctc-textarea-wrap{align-items:flex-start;}
.ctc-field-icon{position:absolute;left:14px;color:#94A3B8;font-size:14px;pointer-events:none;z-index:1;}
.ctc-field-icon-top{top:14px;}

.ctc-input,.ctc-select,.ctc-textarea{width:100%;padding:12px 14px 12px 40px;border:1.5px solid #E2E8F0;border-radius:12px;font-family:var(--font-body,'Inter'),sans-serif;font-size:14px;color:#1E293B;background:#F8FAFC;transition:all .2s;-webkit-appearance:none;appearance:none;}
.ctc-textarea{resize:vertical;min-height:110px;padding-top:12px;}
.ctc-select{cursor:pointer;}
.ctc-input:focus,.ctc-select:focus,.ctc-textarea:focus{outline:none;border-color:#3B82F6;background:#fff;box-shadow:0 0 0 4px rgba(59,130,246,.1);}
.ctc-input::placeholder,.ctc-textarea::placeholder{color:#CBD5E1;}
.ctc-input-error{border-color:#EF4444 !important;}
.ctc-error{font-size:11.5px;color:#DC2626;font-weight:500;}

/* Submit */
.ctc-submit-btn{width:100%;padding:15px 24px;background:linear-gradient(135deg,#2563EB,#1D4ED8);border:none;border-radius:12px;color:#fff;font-family:var(--font-body,'Inter'),sans-serif;font-size:15px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 8px 24px rgba(37,99,235,.35);transition:all .25s;}
.ctc-submit-btn:hover{transform:translateY(-2px);box-shadow:0 14px 32px rgba(37,99,235,.5);}
.ctc-submit-btn:disabled{opacity:.7;cursor:not-allowed;transform:none;}
.ctc-spinner{width:16px;height:16px;border:2px solid rgba(255,255,255,.3);border-top-color:#fff;border-radius:50%;animation:ctcSpin .7s linear infinite;display:inline-block;}
@keyframes ctcSpin{to{transform:rotate(360deg);}}
.ctc-privacy{text-align:center;font-size:12px;color:#94A3B8;margin-top:12px;margin-bottom:0;}
.ctc-privacy i{color:#10B981;margin-right:4px;}
.ctc-privacy strong{color:#1E293B;}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:1100px){
  .ctc-grid{grid-template-columns:340px 1fr;}
}
@media(max-width:900px){
  .ctc-grid{grid-template-columns:1fr;gap:28px;margin-top:-24px;}
  .ctc-form-card{padding:28px 22px;}
}
@media(max-width:640px){
  .ctc-hero{padding:110px 0 60px;min-height:320px;}
  .ctc-hero-title{letter-spacing:-1px;}
  .ctc-main{padding:40px 0 70px;}
  .ctc-form-grid{grid-template-columns:1fr;}
  .ctc-form-card{padding:22px 16px;}
  .ctc-grid{margin-top:-16px;}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Typewriter
  const el = document.getElementById('typewriter-text');
  const phrases = [
    'Mitra Strategis Transformasi Digital Anda.',
    'Menghadirkan Solusi Teknologi yang Presisi.',
    'Wujudkan Ide Bisnis Menjadi Nyata Hari Ini.'
  ];
  let pi = 0, ci = 0, del = false;
  function type() {
    const cur = phrases[pi];
    el.textContent = del ? cur.slice(0, ci - 1) : cur.slice(0, ci + 1);
    del ? ci-- : ci++;
    let speed = del ? 30 : 65;
    if (!del && ci === cur.length) { del = true; speed = 2000; }
    else if (del && ci === 0) { del = false; pi = (pi + 1) % phrases.length; speed = 400; }
    setTimeout(type, speed);
  }
  type();

  // Form loading state
  const form = document.getElementById('contactForm');
  const btn  = document.getElementById('submitBtn');
  if (form && btn) {
    form.addEventListener('submit', function () {
      btn.disabled = true;
      btn.querySelector('.ctc-btn-text').classList.add('d-none');
      btn.querySelector('.ctc-btn-loading').classList.remove('d-none');
    });
  }
  // Reset if error exists
  if (document.querySelector('.ctc-alert-error') && btn) {
    btn.disabled = false;
    btn.querySelector('.ctc-btn-text').classList.remove('d-none');
    btn.querySelector('.ctc-btn-loading').classList.add('d-none');
  }
});
</script>

@endsection