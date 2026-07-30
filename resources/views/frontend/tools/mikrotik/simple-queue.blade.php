@extends('frontend.layouts.app')

@section('title', 'Generator Script Simple Queue MikroTik Limit Bandwidth per User Gratis - PT Sekawan Putra Pratama')
@section('meta_description', 'Buat script Simple Queue MikroTik untuk limit bandwidth per user, per subnet, atau per interface secara otomatis. Support RouterOS v6 & v7. Gratis, akurat, siap paste di Winbox.')
@section('meta_keywords', 'simple queue mikrotik, script limit bandwidth mikrotik, queue mikrotik per user, limit kecepatan internet mikrotik, script simple queue routeros, generator queue mikrotik gratis, bandwidth management mikrotik')
@section('og_title', 'Generator Script Simple Queue MikroTik - Limit Bandwidth per User')
@section('og_description', 'Generator script Simple Queue MikroTik untuk limit bandwidth per IP, per subnet, atau bulk user. Gratis, akurat, RouterOS v6 & v7.')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "SoftwareApplication",
  "name": "Generator Script Simple Queue MikroTik",
  "applicationCategory": "NetworkingApplication",
  "operatingSystem": "Web Browser",
  "description": "Tool gratis untuk membuat script Simple Queue MikroTik RouterOS v6 & v7. Limit bandwidth per user/IP secara otomatis.",
  "url": "{{ route('tools.mikrotik.simple-queue') }}",
  "offers": {"@@type": "Offer", "price": "0", "priceCurrency": "IDR"},
  "publisher": {"@@type": "Organization", "name": "PT Sekawan Putra Pratama", "url": "{{ route('home') }}"},
  "breadcrumb": {
    "@@type": "BreadcrumbList",
    "itemListElement": [
      {"@@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
      {"@@type":"ListItem","position":2,"name":"MikroTik Tools","item":"{{ route('tools.mikrotik.index') }}"},
      {"@@type":"ListItem","position":3,"name":"Simple Queue Generator","item":"{{ route('tools.mikrotik.simple-queue') }}"}
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
      • MANAJEMEN BANDWIDTH MIKROTIK
    </div>
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Generator Script <span class="text-primary">Simple Queue</span> MikroTik
    </h1>
    <p class="text-muted mx-auto mb-0" style="max-width: 680px; font-size: 1.05rem;">
      Buat script limit bandwidth per user, per IP, atau per subnet secara otomatis untuk RouterOS v6 & v7. Isi form → Generate → Paste di Winbox Terminal.
    </p>
  </div>
</section>

{{-- PANDUAN ENGINEER --}}
<div class="container mt-4 mb-2">
  <div class="alert border-start border-4 border-primary bg-primary bg-opacity-10 rounded-3 py-3 px-4 small" role="alert">
    <strong><i class="fas fa-info-circle me-2 text-primary"></i>Panduan Engineer:</strong>
    Simple Queue membatasi kecepatan upload/download per target (IP/subnet). Gunakan mode <strong>Bulk</strong> untuk generate queue banyak user sekaligus dari range IP. Mode <strong>Single</strong> untuk 1 entri spesifik.
  </div>
</div>

{{-- FORM GENERATOR --}}
<section class="py-4 bg-light">
  <div class="container py-2">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="card border-0 rounded-4 shadow-sm">
          <div class="card-body p-4 p-md-5">
            <h5 class="fw-bold text-dark mb-4"><i class="fas fa-sliders-h me-2 text-primary"></i>Konfigurasi Simple Queue</h5>
            <form id="simpleQueueForm" novalidate>
              <div class="row g-3">

                {{-- RouterOS Version --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Versi RouterOS</label>
                  <select class="form-select rounded-3" id="mikrotik_version">
                    <option value="6" selected>RouterOS v6</option>
                    <option value="7">RouterOS v7</option>
                  </select>
                </div>

                {{-- Mode --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Mode Pembuatan Queue</label>
                  <select class="form-select rounded-3" id="queue_mode" onchange="toggleMode()">
                    <option value="single" selected>Single — 1 Target (IP / Subnet)</option>
                    <option value="bulk">Bulk — Range IP Otomatis</option>
                  </select>
                </div>

                {{-- Interface (opsional) --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Interface Asal (opsional)</label>
                  <input type="text" class="form-control rounded-3" id="interface_name" placeholder="Contoh: bridge-lan" value="">
                  <div class="form-text">Kosongkan jika tidak dibatasi per interface.</div>
                </div>

                {{-- Burst Mode --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Burst (opsional)</label>
                  <select class="form-select rounded-3" id="burst_enabled">
                    <option value="no" selected>Tidak pakai Burst</option>
                    <option value="yes">Aktifkan Burst</option>
                  </select>
                </div>

                {{-- Download Limit --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Limit Download (Max)</label>
                  <div class="input-group">
                    <input type="number" class="form-control rounded-start-3" id="max_download" placeholder="10" value="10" min="1" required>
                    <select class="form-select" id="dl_unit" style="max-width:90px;">
                      <option value="M" selected>Mbps</option>
                      <option value="k">Kbps</option>
                      <option value="G">Gbps</option>
                    </select>
                  </div>
                </div>

                {{-- Upload Limit --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Limit Upload (Max)</label>
                  <div class="input-group">
                    <input type="number" class="form-control rounded-start-3" id="max_upload" placeholder="5" value="5" min="1" required>
                    <select class="form-select" id="ul_unit" style="max-width:90px;">
                      <option value="M" selected>Mbps</option>
                      <option value="k">Kbps</option>
                      <option value="G">Gbps</option>
                    </select>
                  </div>
                </div>

                {{-- SINGLE MODE --}}
                <div id="single_mode_fields" class="col-12">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label fw-semibold small text-dark">Target IP / Subnet</label>
                      <input type="text" class="form-control rounded-3" id="target_ip" placeholder="Contoh: 192.168.1.10 atau 192.168.1.0/24">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold small text-dark">Nama Queue</label>
                      <input type="text" class="form-control rounded-3" id="queue_name" placeholder="Contoh: user-lantai1">
                    </div>
                  </div>
                </div>

                {{-- BULK MODE --}}
                <div id="bulk_mode_fields" class="col-12 d-none">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label fw-semibold small text-dark">IP Mulai</label>
                      <input type="text" class="form-control rounded-3" id="bulk_start" placeholder="192.168.1.2">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label fw-semibold small text-dark">IP Akhir</label>
                      <input type="text" class="form-control rounded-3" id="bulk_end" placeholder="192.168.1.254">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label fw-semibold small text-dark">Prefix Nama</label>
                      <input type="text" class="form-control rounded-3" id="bulk_prefix" placeholder="client-">
                    </div>
                  </div>
                </div>

                {{-- Burst fields --}}
                <div id="burst_fields" class="col-12 d-none">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label fw-semibold small text-dark">Burst Limit Download</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="burst_dl" placeholder="20" value="20">
                        <span class="input-group-text">Mbps</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold small text-dark">Burst Limit Upload</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="burst_ul" placeholder="10" value="10">
                        <span class="input-group-text">Mbps</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold small text-dark">Burst Threshold Download</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="burst_thresh_dl" placeholder="8" value="8">
                        <span class="input-group-text">Mbps</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold small text-dark">Burst Threshold Upload</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="burst_thresh_ul" placeholder="4" value="4">
                        <span class="input-group-text">Mbps</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold small text-dark">Burst Time (detik)</label>
                      <input type="number" class="form-control rounded-3" id="burst_time" placeholder="8" value="8">
                    </div>
                  </div>
                </div>

                <div class="col-12 pt-2">
                  <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                    <i class="fas fa-bolt me-2"></i>Generate Script
                  </button>
                </div>

              </div>
            </form>
          </div>
        </div>

        {{-- RESULT --}}
        <div id="resultSection" class="mt-4" style="display:none;">
          <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                <h6 class="fw-bold text-dark mb-0"><i class="fas fa-terminal me-2 text-primary"></i>Script Siap Pakai</h6>
                <button class="btn btn-dark rounded-pill px-4 fw-bold small" id="copyScriptBtn">
                  <i class="fas fa-copy me-1"></i> Salin Script
                </button>
              </div>
              <pre id="scriptOutput" class="bg-dark text-light rounded-3 p-4 small" style="white-space: pre-wrap; word-break: break-word; max-height: 500px; overflow-y: auto; font-size: 0.78rem; line-height: 1.6;"></pre>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  function toggleMode() {
    const mode = document.getElementById('queue_mode').value;
    document.getElementById('single_mode_fields').classList.toggle('d-none', mode === 'bulk');
    document.getElementById('bulk_mode_fields').classList.toggle('d-none', mode === 'single');
  }

  document.getElementById('burst_enabled').addEventListener('change', function() {
    document.getElementById('burst_fields').classList.toggle('d-none', this.value === 'no');
  });

  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('simpleQueueForm').addEventListener('submit', function(e) {
      e.preventDefault();
      if (!this.checkValidity()) {
        Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Mohon lengkapi semua kolom yang wajib diisi (*).', confirmButtonColor: '#0d6efd' });
        return;
      }
      const version   = document.getElementById('mikrotik_version').value;
      const mode      = document.getElementById('queue_mode').value;
      const dlMax     = document.getElementById('max_download').value;
      const dlUnit    = document.getElementById('dl_unit').value;
      const ulMax     = document.getElementById('max_upload').value;
      const ulUnit    = document.getElementById('ul_unit').value;
      const iface     = document.getElementById('interface_name').value.trim();
      const burst     = document.getElementById('burst_enabled').value;

      const maxRateStr = `${ulMax}${ulUnit}/${dlMax}${dlUnit}`;
      let script = '';

      if (mode === 'single') {
        const target = document.getElementById('target_ip').value.trim();
        const qname  = document.getElementById('queue_name').value.trim() || 'user-1';
        if (!target) { Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Masukkan Target IP / Subnet!', confirmButtonColor: '#0d6efd' }); return; }
        script = generateSingleQueue(version, qname, target, maxRateStr, dlMax, dlUnit, ulMax, ulUnit, iface, burst);
      } else {
        const start  = document.getElementById('bulk_start').value.trim();
        const end    = document.getElementById('bulk_end').value.trim();
        const prefix = document.getElementById('bulk_prefix').value.trim() || 'client-';
        if (!start || !end) { Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Masukkan IP Mulai dan IP Akhir!', confirmButtonColor: '#0d6efd' }); return; }
        script = generateBulkQueue(version, start, end, prefix, maxRateStr, dlMax, dlUnit, ulMax, ulUnit, iface, burst);
      }

      document.getElementById('scriptOutput').textContent = script;
      document.getElementById('resultSection').style.display = 'block';
      document.getElementById('resultSection').scrollIntoView({ behavior: 'smooth' });
    });

    document.getElementById('copyScriptBtn').addEventListener('click', function() {
      const text = document.getElementById('scriptOutput').textContent;
      navigator.clipboard.writeText(text).then(() => {
        const btn = this;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin!';
        btn.className = 'btn btn-success rounded-pill px-4 fw-bold small';
        setTimeout(() => {
          btn.innerHTML = '<i class="fas fa-copy me-1"></i> Salin Script';
          btn.className = 'btn btn-dark rounded-pill px-4 fw-bold small';
        }, 2000);
      });
    });
  });

  function buildQueueLine(name, target, maxRate, dlMax, dlUnit, ulMax, ulUnit, iface, burst) {
    const burstEnabled = document.getElementById('burst_enabled').value === 'yes';
    // MikroTik RouterOS max-limit: UPLOAD/DOWNLOAD
    let line = `/queue simple add name="${name}" target="${target}" max-limit=${maxRate}`;
    if (iface) line += ` interface="${iface}"`;
    if (burstEnabled) {
      const bdl = document.getElementById('burst_dl').value;
      const bul = document.getElementById('burst_ul').value;
      const btdl = document.getElementById('burst_thresh_dl').value;
      const btul = document.getElementById('burst_thresh_ul').value;
      const btime = document.getElementById('burst_time').value;
      line += ` burst-limit=${bul}${ulUnit}/${bdl}${dlUnit}`;
      line += ` burst-threshold=${btul}${ulUnit}/${btdl}${dlUnit}`;
      line += ` burst-time=${btime}s/${btime}s`;
    }
    line += ` comment="LB Queue by Sekawan"`;
    return line;
  }

  function generateSingleQueue(version, name, target, maxRate, dlMax, dlUnit, ulMax, ulUnit, iface, burst) {
    const now = new Date();
    let script = "###############################################################\n";
    script += "# MIKROTIK SIMPLE QUEUE SCRIPT\n";
    script += "# Generated by: PT Sekawan Putra Pratama (sekawanputrapratama.com)\n";
    script += `# Tanggal: ${now.toLocaleString('id-ID')}\n`;
    script += `# RouterOS: Version ${version}\n`;
    script += `# Target: ${target} | Limit (Upload/Download): ${maxRate}\n`;
    script += "#\n";
    script += "# PETUNJUK PENGGUNAAN:\n";
    script += "# 1. Salin script ini dan buka Winbox > New Terminal, lalu Paste.\n";
    script += "# 2. Pastikan target IP sudah sesuai topologi jaringan Anda.\n";
    script += "# 3. Gunakan /queue simple print untuk verifikasi queue sudah masuk.\n";
    script += "###############################################################\n\n";
    script += buildQueueLine(name, target, maxRate, dlMax, dlUnit, ulMax, ulUnit, iface, burst) + "\n";
    return script;
  }

  function generateBulkQueue(version, startIp, endIp, prefix, maxRate, dlMax, dlUnit, ulMax, ulUnit, iface, burst) {
    const now = new Date();
    const startParts = startIp.split('.').map(Number);
    const endParts   = endIp.split('.').map(Number);

    if (startParts.length !== 4 || endParts.length !== 4) {
      Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Format IP tidak valid!', confirmButtonColor: '#0d6efd' }); return '';
    }

    const startNum = ((startParts[0]<<24)|(startParts[1]<<16)|(startParts[2]<<8)|startParts[3]) >>> 0;
    const endNum   = ((endParts[0]<<24)|(endParts[1]<<16)|(endParts[2]<<8)|endParts[3]) >>> 0;

    if (endNum < startNum) { Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'IP Akhir harus lebih besar dari IP Mulai!', confirmButtonColor: '#0d6efd' }); return ''; }
    if ((endNum - startNum) > 253) { Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Maksimal 254 IP sekaligus untuk performa yang baik!', confirmButtonColor: '#0d6efd' }); return ''; }

    let script = "###############################################################\n";
    script += "# MIKROTIK BULK SIMPLE QUEUE SCRIPT\n";
    script += "# Generated by: PT Sekawan Putra Pratama (sekawanputrapratama.com)\n";
    script += `# Tanggal: ${now.toLocaleString('id-ID')}\n`;
    script += `# RouterOS: Version ${version}\n`;
    script += `# Range: ${startIp} - ${endIp} | Limit (Upload/Download): ${maxRate}\n`;
    script += `# Total: ${endNum - startNum + 1} entri queue\n`;
    script += "#\n";
    script += "# PETUNJUK PENGGUNAAN:\n";
    script += "# 1. Salin script ini dan buka Winbox > New Terminal, lalu Paste.\n";
    script += "# 2. Tunggu hingga semua baris selesai diproses sebelum menutup terminal.\n";
    script += "# 3. Gunakan /queue simple print untuk verifikasi semua queue sudah masuk.\n";
    script += "###############################################################\n\n";

    for (let n = startNum; n <= endNum; n++) {
      const ip = [(n>>>24)&255,(n>>>16)&255,(n>>>8)&255,n&255].join('.');
      const idx = n - startNum + 1;
      const name = `${prefix}${idx}`;
      script += buildQueueLine(name, ip, maxRate, dlMax, dlUnit, ulMax, ulUnit, iface, burst) + "\n";
    }
    return script;
  }
</script>
@endpush

@endsection
