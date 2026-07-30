@extends('frontend.layouts.app')

@section('title', 'Generator Script Hotspot MikroTik — Profile, User & Voucher Gratis - PT Sekawan Putra Pratama')
@section('meta_description', 'Buat script konfigurasi Hotspot MikroTik otomatis: Server Profile, User Profile, dan User (Voucher) secara massal. Cocok untuk warnet, hotel, RT-RW Net, kantor. RouterOS v6 & v7.')
@section('meta_keywords', 'script hotspot mikrotik, generator hotspot mikrotik, konfigurasi hotspot mikrotik, voucher hotspot mikrotik, user hotspot mikrotik, hotspot rtrwnet mikrotik, hotspot hotel mikrotik, script hotspot routeros gratis')
@section('og_title', 'Generator Script Hotspot MikroTik — Profile & Voucher User - PT Sekawan Putra Pratama')
@section('og_description', 'Buat script Hotspot MikroTik otomatis: Profile bandwidth, User login, dan Voucher massal. Untuk warnet, hotel, RT-RW Net. Gratis dan siap pakai.')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "SoftwareApplication",
  "name": "Generator Script Hotspot MikroTik",
  "applicationCategory": "NetworkingApplication",
  "operatingSystem": "Web Browser",
  "description": "Tool gratis untuk membuat script Hotspot MikroTik RouterOS v6 & v7. Generate Server Profile, User Profile, dan User/Voucher secara massal.",
  "url": "{{ route('tools.mikrotik.hotspot') }}",
  "offers": {"@@type": "Offer", "price": "0", "priceCurrency": "IDR"},
  "publisher": {"@@type": "Organization", "name": "PT Sekawan Putra Pratama", "url": "{{ route('home') }}"},
  "breadcrumb": {
    "@@type": "BreadcrumbList",
    "itemListElement": [
      {"@@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
      {"@@type":"ListItem","position":2,"name":"MikroTik Tools","item":"{{ route('tools.mikrotik.index') }}"},
      {"@@type":"ListItem","position":3,"name":"Hotspot Generator","item":"{{ route('tools.mikrotik.hotspot') }}"}
    ]
  }
}
</script>
@endpush

@section('content')

{{-- HERO HEADER --}}
<section class="py-5 bg-white border-bottom" style="padding-top: 135px !important; padding-bottom: 55px !important;">
  <div class="container text-center">
    <div class="text-uppercase fw-bold text-primary small mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
      • HOTSPOT MIKROTIK GENERATOR
    </div>
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Generator Script <span class="text-primary">Hotspot MikroTik</span>
    </h1>
    <p class="text-muted mx-auto mb-0" style="max-width: 680px; font-size: 1.05rem;">
      Buat script konfigurasi Hotspot MikroTik otomatis — User Profile (paket bandwidth), User (voucher login), dan Server Profile. Cocok untuk warnet, hotel, RT-RW Net, dan kantor.
    </p>
  </div>
</section>

{{-- PANDUAN --}}
<div class="container mt-4 mb-2">
  <div class="alert border-start border-4 border-warning bg-warning bg-opacity-10 rounded-3 py-3 px-4 small" role="alert">
    <strong><i class="fas fa-exclamation-triangle me-2 text-warning"></i>Prasyarat:</strong>
    Pastikan Hotspot Server sudah dikonfigurasi via Winbox (<strong>IP → Hotspot → Setup</strong>) sebelum menjalankan script ini. Script ini membuat <strong>User Profile</strong> dan <strong>User/Voucher</strong>, bukan setup server baru.
  </div>
</div>

{{-- TABS --}}
<section class="py-4 bg-light">
  <div class="container py-2">
    <div class="row justify-content-center">
      <div class="col-lg-9">

        {{-- Tab Navigation --}}
        <ul class="nav nav-pills mb-4 gap-2" id="hotspotTab">
          <li class="nav-item">
            <button class="nav-link active fw-bold rounded-pill px-4" id="tab-profile" onclick="showTab('profile')">
              <i class="fas fa-layer-group me-1"></i> User Profile (Paket)
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link fw-bold rounded-pill px-4" id="tab-user" onclick="showTab('user')">
              <i class="fas fa-users me-1"></i> User / Voucher
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link fw-bold rounded-pill px-4" id="tab-server" onclick="showTab('server')">
              <i class="fas fa-server me-1"></i> Server Profile
            </button>
          </li>
        </ul>

        {{-- ===== TAB: USER PROFILE ===== --}}
        <div id="tab-content-profile">
          <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4 p-md-5">
              <h5 class="fw-bold text-dark mb-4"><i class="fas fa-layer-group me-2 text-primary"></i>Buat User Profile (Paket Bandwidth)</h5>
              <form id="profileForm" novalidate>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Nama Profile / Paket</label>
                    <input type="text" class="form-control rounded-3" id="profile_name" placeholder="Paket-10Mbps" value="Paket-10Mbps" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Hotspot Server Name</label>
                    <input type="text" class="form-control rounded-3" id="hs_server_name" placeholder="hotspot1" value="hotspot1">
                    <div class="form-text">Lihat di IP → Hotspot → Servers → Name</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Limit Download</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="prof_dl" placeholder="10" value="10" required>
                      <select class="form-select" id="prof_dl_unit" style="max-width:90px;">
                        <option value="M" selected>Mbps</option>
                        <option value="k">Kbps</option>
                        <option value="G">Gbps</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Limit Upload</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="prof_ul" placeholder="5" value="5" required>
                      <select class="form-select" id="prof_ul_unit" style="max-width:90px;">
                        <option value="M" selected>Mbps</option>
                        <option value="k">Kbps</option>
                        <option value="G">Gbps</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Session Timeout</label>
                    <input type="text" class="form-control rounded-3" id="prof_session" placeholder="1d (1 hari) / 8h / 0 (unlimited)" value="1d">
                    <div class="form-text">Format: 1d = 1 hari, 8h = 8 jam, 0 = unlimited</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Idle Timeout</label>
                    <input type="text" class="form-control rounded-3" id="prof_idle" placeholder="5m" value="5m">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Shared Users (per akun)</label>
                    <input type="number" class="form-control rounded-3" id="prof_shared" placeholder="1" value="1" min="1">
                    <div class="form-text">1 = tidak bisa login lebih dari 1 device</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Keepalive Timeout</label>
                    <input type="text" class="form-control rounded-3" id="prof_keepalive" placeholder="2m" value="2m">
                  </div>
                  <div class="col-12 pt-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                      <i class="fas fa-bolt me-2"></i>Generate Profile Script
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        {{-- ===== TAB: USER / VOUCHER ===== --}}
        <div id="tab-content-user" class="d-none">
          <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4 p-md-5">
              <h5 class="fw-bold text-dark mb-4"><i class="fas fa-users me-2 text-primary"></i>Buat User / Voucher Hotspot</h5>
              <form id="userForm" novalidate>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Mode</label>
                    <select class="form-select rounded-3" id="user_mode" onchange="toggleUserMode()">
                      <option value="single">Single User</option>
                      <option value="bulk" selected>Bulk / Voucher Massal</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Nama Hotspot Server</label>
                    <input type="text" class="form-control rounded-3" id="user_hs_server" placeholder="hotspot1" value="hotspot1">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Profile yang Digunakan</label>
                    <input type="text" class="form-control rounded-3" id="user_profile" placeholder="Paket-10Mbps" value="Paket-10Mbps">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Limit Uptime (per user)</label>
                    <input type="text" class="form-control rounded-3" id="user_uptime" placeholder="1d / 0 (unlimited)" value="1d">
                  </div>

                  {{-- Single --}}
                  <div id="user_single_fields" class="col-12">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label class="form-label fw-semibold small text-dark">Username</label>
                        <input type="text" class="form-control rounded-3" id="user_single_name" placeholder="user01">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label fw-semibold small text-dark">Password</label>
                        <input type="text" class="form-control rounded-3" id="user_single_pass" placeholder="user01">
                      </div>
                    </div>
                  </div>

                  {{-- Bulk --}}
                  <div id="user_bulk_fields" class="col-12 d-none">
                    <div class="row g-3">
                      <div class="col-md-4">
                        <label class="form-label fw-semibold small text-dark">Prefix Username</label>
                        <input type="text" class="form-control rounded-3" id="bulk_user_prefix" placeholder="voucher-" value="voucher-">
                      </div>
                      <div class="col-md-4">
                        <label class="form-label fw-semibold small text-dark">Nomor Mulai</label>
                        <input type="number" class="form-control rounded-3" id="bulk_user_start" placeholder="1" value="1">
                      </div>
                      <div class="col-md-4">
                        <label class="form-label fw-semibold small text-dark">Jumlah User</label>
                        <input type="number" class="form-control rounded-3" id="bulk_user_count" placeholder="20" value="20" max="200">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label fw-semibold small text-dark">Mode Password</label>
                        <select class="form-select rounded-3" id="bulk_pass_mode">
                          <option value="same">Sama dengan Username</option>
                          <option value="fixed">Password Tetap</option>
                          <option value="random">Acak 6 karakter</option>
                        </select>
                      </div>
                      <div class="col-md-6" id="fixed_pass_field" style="display:none;">
                        <label class="form-label fw-semibold small text-dark">Password Tetap</label>
                        <input type="text" class="form-control rounded-3" id="fixed_pass" placeholder="password123">
                      </div>
                    </div>
                  </div>

                  <div class="col-12 pt-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                      <i class="fas fa-bolt me-2"></i>Generate User Script
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        {{-- ===== TAB: SERVER PROFILE ===== --}}
        <div id="tab-content-server" class="d-none">
          <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4 p-md-5">
              <h5 class="fw-bold text-dark mb-4"><i class="fas fa-server me-2 text-primary"></i>Buat Server Profile Hotspot</h5>
              <form id="serverProfileForm" novalidate>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Nama Server Profile</label>
                    <input type="text" class="form-control rounded-3" id="srv_name" placeholder="hsprof-default" value="hsprof-default">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">DNS Name (Hotspot Login Page)</label>
                    <input type="text" class="form-control rounded-3" id="srv_dns" placeholder="hotspot.mynet.id">
                    <div class="form-text">Nama domain halaman login (opsional)</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">HTML Directory</label>
                    <input type="text" class="form-control rounded-3" id="srv_html" placeholder="hotspot" value="hotspot">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">HTTP Cookie Lifetime</label>
                    <input type="text" class="form-control rounded-3" id="srv_cookie" placeholder="3d" value="3d">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">SMTP Server (opsional)</label>
                    <input type="text" class="form-control rounded-3" id="srv_smtp" placeholder="0.0.0.0" value="0.0.0.0">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold small text-dark">Login By</label>
                    <select class="form-select rounded-3" id="srv_login_by">
                      <option value="cookie,http-chap" selected>Cookie + HTTP-CHAP (Rekomendasi)</option>
                      <option value="http-chap">HTTP-CHAP saja</option>
                      <option value="cookie,http-pap">Cookie + HTTP-PAP</option>
                      <option value="mac">MAC Address</option>
                    </select>
                  </div>
                  <div class="col-12 pt-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                      <i class="fas fa-bolt me-2"></i>Generate Server Profile Script
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        {{-- RESULT (shared) --}}
        <div id="resultSection" class="mt-4" style="display:none;">
          <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                <h6 class="fw-bold text-dark mb-0"><i class="fas fa-terminal me-2 text-primary"></i>Script Siap Pakai</h6>
                <button class="btn btn-dark rounded-pill px-4 fw-bold small" id="copyScriptBtn">
                  <i class="fas fa-copy me-1"></i> Salin Script
                </button>
              </div>
              <pre id="scriptOutput" class="bg-dark text-light rounded-3 p-4 small" style="white-space: pre-wrap; word-break: break-word; max-height: 520px; overflow-y: auto; font-size: 0.78rem; line-height: 1.6;"></pre>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  function showTab(tab) {
    ['profile','user','server'].forEach(t => {
      document.getElementById(`tab-content-${t}`).classList.toggle('d-none', t !== tab);
      document.getElementById(`tab-${t}`).classList.toggle('active', t === tab);
    });
    document.getElementById('resultSection').style.display = 'none';
  }

  function toggleUserMode() {
    const m = document.getElementById('user_mode').value;
    document.getElementById('user_single_fields').classList.toggle('d-none', m === 'bulk');
    document.getElementById('user_bulk_fields').classList.toggle('d-none', m === 'single');
  }

  // Initially set bulk mode active (default)
  toggleUserMode();

  document.getElementById('bulk_pass_mode').addEventListener('change', function() {
    document.getElementById('fixed_pass_field').style.display = this.value === 'fixed' ? '' : 'none';
  });

  function makeHeader(type) {
    const now = new Date();
    let s = "###############################################################\n";
    s += `# MIKROTIK HOTSPOT ${type.toUpperCase()} SCRIPT\n`;
    s += "# Generated by: PT Sekawan Putra Pratama (sekawanputrapratama.com)\n";
    s += `# Tanggal: ${now.toLocaleString('id-ID')}\n`;
    s += "#\n";
    s += "# PETUNJUK PENGGUNAAN:\n";
    s += "# 1. Buka Winbox > New Terminal, lalu Paste script ini.\n";
    s += "# 2. Pastikan Hotspot Server sudah dikonfigurasi via IP > Hotspot > Setup.\n";
    s += "# 3. Gunakan /ip hotspot user print untuk verifikasi.\n";
    s += "###############################################################\n\n";
    return s;
  }

  document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();
      if (!this.checkValidity()) {
        Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Mohon lengkapi semua kolom yang wajib diisi (*).', confirmButtonColor: '#0d6efd' });
        return;
      }
    const name     = document.getElementById('profile_name').value.trim();
    const server   = document.getElementById('hs_server_name').value.trim() || 'all';
    const dl       = document.getElementById('prof_dl').value;
    const dlU      = document.getElementById('prof_dl_unit').value;
    const ul       = document.getElementById('prof_ul').value;
    const ulU      = document.getElementById('prof_ul_unit').value;
    const session  = document.getElementById('prof_session').value.trim() || '0';
    const idle     = document.getElementById('prof_idle').value.trim() || '3m';
    const shared   = document.getElementById('prof_shared').value || '1';
    const keepalive= document.getElementById('prof_keepalive').value.trim() || '2m';

    let script = makeHeader('USER PROFILE');
    script += `/ip hotspot user profile\n`;
    // MikroTik rate-limit format: UPLOAD/DOWNLOAD
    let line = `add name="${name}" rate-limit="${ul}${ulU}/${dl}${dlU}" shared-users=${shared} comment="Hotspot Profile by Sekawan"`;
    if (session && session !== '0') line += ` session-timeout=${session}`;
    if (idle && idle !== '0') line += ` idle-timeout=${idle}`;
    if (keepalive && keepalive !== '0') line += ` keepalive-timeout=${keepalive}`;
    script += line + "\n";
    output(script);
  });

  document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
      if (!this.checkValidity()) {
        Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Mohon lengkapi semua kolom yang wajib diisi (*).', confirmButtonColor: '#0d6efd' });
        return;
      }
    const mode     = document.getElementById('user_mode').value;
    const server   = document.getElementById('user_hs_server').value.trim() || 'all';
    const profile  = document.getElementById('user_profile').value.trim() || 'default';
    const uptime   = document.getElementById('user_uptime').value.trim() || '0';

    let script = makeHeader('USER / VOUCHER');
    script += `/ip hotspot user\n`;

    const buildUserLine = (uname, upass) => {
      let l = `add name="${uname}" password="${upass}" profile="${profile}" server="${server}"`;
      if (uptime && uptime !== '0') l += ` limit-uptime=${uptime}`;
      l += ` comment="Hotspot Voucher by Sekawan"`;
      return l;
    };

    if (mode === 'single') {
      const uname = document.getElementById('user_single_name').value.trim() || 'user01';
      const upass = document.getElementById('user_single_pass').value.trim() || uname;
      script += buildUserLine(uname, upass) + "\n";
    } else {
      const prefix = document.getElementById('bulk_user_prefix').value.trim() || 'voucher-';
      const start  = parseInt(document.getElementById('bulk_user_start').value) || 1;
      const count  = Math.min(parseInt(document.getElementById('bulk_user_count').value) || 10, 200);
      const passMode = document.getElementById('bulk_pass_mode').value;
      const fixedPass = document.getElementById('fixed_pass').value.trim() || 'password123';

      const randStr = () => Math.random().toString(36).substring(2,8).toUpperCase();

      for (let i = 0; i < count; i++) {
        const uname = `${prefix}${start + i}`;
        let upass = uname;
        if (passMode === 'fixed') upass = fixedPass;
        else if (passMode === 'random') upass = randStr();
        script += buildUserLine(uname, upass) + "\n";
      }
    }
    output(script);
  });

  document.getElementById('serverProfileForm').addEventListener('submit', function(e) {
    e.preventDefault();
      if (!this.checkValidity()) {
        Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Mohon lengkapi semua kolom yang wajib diisi (*).', confirmButtonColor: '#0d6efd' });
        return;
      }
    const name    = document.getElementById('srv_name').value.trim() || 'hsprof-default';
    const dns     = document.getElementById('srv_dns').value.trim();
    const html    = document.getElementById('srv_html').value.trim() || 'hotspot';
    const cookie  = document.getElementById('srv_cookie').value.trim() || '3d';
    const smtp    = document.getElementById('srv_smtp').value.trim() || '0.0.0.0';
    const loginBy = document.getElementById('srv_login_by').value;

    let script = makeHeader('SERVER PROFILE');
    script += `/ip hotspot server profile\n`;
    let line = `add name="${name}" html-directory="${html}" http-cookie-lifetime=${cookie} smtp-server=${smtp} login-by=${loginBy}`;
    if (dns) line += ` dns-name="${dns}"`;
    line += ` comment="Hotspot Server Profile by Sekawan"`;
    script += line + "\n";
    output(script);
  });

  function output(script) {
    document.getElementById('scriptOutput').textContent = script;
    document.getElementById('resultSection').style.display = 'block';
    document.getElementById('resultSection').scrollIntoView({ behavior: 'smooth' });
  }

  document.getElementById('copyScriptBtn').addEventListener('click', function() {
    navigator.clipboard.writeText(document.getElementById('scriptOutput').textContent).then(() => {
      const btn = this;
      btn.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin!';
      btn.className = 'btn btn-success rounded-pill px-4 fw-bold small';
      setTimeout(() => {
        btn.innerHTML = '<i class="fas fa-copy me-1"></i> Salin Script';
        btn.className = 'btn btn-dark rounded-pill px-4 fw-bold small';
      }, 2000);
    });
  });
</script>
@endpush

@endsection
