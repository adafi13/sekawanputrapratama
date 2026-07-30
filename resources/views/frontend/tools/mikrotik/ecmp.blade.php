@extends('frontend.layouts.app')

@section('title', 'Generator Script Load Balance ECMP MikroTik RouterOS v6 v7 Gratis - PT Sekawan Putra Pratama')
@section('meta_description', 'Buat script load balance MikroTik metode ECMP (Equal Cost Multi Path) otomatis untuk RouterOS v6 & v7 hingga 10 ISP. Gratis, akurat, siap paste di Winbox Terminal.')
@section('meta_keywords', 'script load balance ecmp mikrotik, ecmp routeros, load balance mikrotik 2 isp, load balance mikrotik v7, multi wan mikrotik, script ecmp routeros v6, generator script mikrotik gratis, equal cost multi path mikrotik')
@section('og_title', 'Generator Script Load Balance ECMP MikroTik - PT Sekawan Putra Pratama')
@section('og_description', 'Generator script ECMP (Equal Cost Multi Path) untuk MikroTik RouterOS v6 & v7. Isi form, klik generate, salin ke Winbox Terminal. Gratis dan akurat.')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "SoftwareApplication",
  "name": "Generator Script Load Balance ECMP MikroTik",
  "applicationCategory": "NetworkingApplication",
  "operatingSystem": "Web Browser",
  "description": "Tool gratis untuk membuat script Load Balance ECMP MikroTik RouterOS v6 dan v7 secara otomatis hingga 10 WAN/ISP.",
  "url": "{{ route('tools.mikrotik.ecmp') }}",
  "offers": {"@@type": "Offer", "price": "0", "priceCurrency": "IDR"},
  "publisher": {"@@type": "Organization", "name": "PT Sekawan Putra Pratama", "url": "{{ route('home') }}"},
  "breadcrumb": {
    "@@type": "BreadcrumbList",
    "itemListElement": [
      {"@@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
      {"@@type":"ListItem","position":2,"name":"MikroTik Tools","item":"{{ route('tools.mikrotik.index') }}"},
      {"@@type":"ListItem","position":3,"name":"Load Balance ECMP Generator","item":"{{ route('tools.mikrotik.ecmp') }}"}
    ]
  }
}
</script>
@endpush

@section('content')

{{-- HERO HEADER --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 55px !important;">
  <div class="container text-center position-relative z-2">
    <div class="text-uppercase fw-bold text-primary small mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
      • MIKROTIK MULTI-WAN GENERATOR
    </div>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Load Balance <span class="text-primary">ECMP Generator</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      <strong>Equal Cost Multi Path (ECMP)</strong> membagi lalu lintas ke beberapa link ISP secara otomatis. Cocok untuk distribusi bandwidth dan failover cepat.
    </p>
  </div>
</section>

{{-- MAIN GENERATOR FORM --}}
<section class="py-5 bg-light position-relative">
  <div class="container py-4">
    <div class="row justify-content-center g-4">
      
      <div class="col-lg-10">
        <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm" style="border-color: #e2e8f0 !important;">
          
          <h4 class="fw-bold text-dark mb-4 pb-2 border-bottom d-flex align-items-center gap-2">
            <i class="fas fa-random text-primary"></i> Parameter Konfigurasi ECMP
          </h4>

          <form id="ecmpForm" autocomplete="off">
            <div class="row g-3 mb-4">
              
              <div class="col-md-4">
                <label for="mikrotik_version" class="form-label font-monospace fw-bold small text-muted">VERSI ROUTEROS *</label>
                <select class="form-select bg-light p-3 border-0" id="mikrotik_version" name="mikrotik_version" required style="font-size: 0.95rem;">
                  <option value="7" selected>MikroTik RouterOS v7 (Rekomendasi)</option>
                  <option value="6">MikroTik RouterOS v6</option>
                </select>
              </div>

              <div class="col-md-8">
                <label for="ip_block" class="form-label font-monospace fw-bold small text-muted">SUBNET IP LOKAL / LAN *</label>
                <input type="text" class="form-control bg-light p-3 border-0" id="ip_block" name="ip_block" value="10.0.0.0/8,172.16.0.0/12,192.168.0.0/16" placeholder="192.168.10.0/24" required style="font-size: 0.95rem;">
                <span class="text-muted small mt-1 d-block" style="font-size: 11px;">
                  Pisahkan dengan koma jika lebih dari satu subnet (contoh: <code>192.168.1.0/24,192.168.10.0/24</code>).
                </span>
              </div>

            </div>

            <h5 class="fw-bold text-dark mb-3 pt-2 d-flex align-items-center justify-content-between">
              <span><i class="fas fa-network-wired text-primary me-2"></i>Daftar Interface WAN / ISP</span>
              <span class="badge bg-primary bg-opacity-10 text-primary small fw-normal font-monospace" id="ispCounterBadge">2 ISP Aktif</span>
            </h5>

            <div id="ispInputs" class="mb-3">
              {{-- Dynamic rows injected via JS --}}
            </div>

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-3 border-top">
              <button type="button" class="btn btn-outline-primary rounded-pill px-4 fw-bold" id="addIspBtn">
                <i class="fas fa-plus me-1"></i> Tambah Interface ISP
              </button>

              <button type="submit" class="btn btn-primary rounded-pill px-5 py-2.5 fw-bold shadow-sm">
                <i class="fas fa-magic me-2"></i> Generate Script ECMP
              </button>
            </div>
          </form>

        </div>
      </div>

      {{-- SCRIPT OUTPUT SECTION --}}
      <div class="col-lg-10" id="resultSection" style="display: none;">
        <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm position-relative" style="border-color: #e2e8f0 !important;">
          
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="fw-bold text-success mb-0 d-flex align-items-center gap-2">
              <i class="fas fa-terminal text-success"></i> Hasil Script ECMP RouterOS
            </h4>

            <button type="button" class="btn btn-dark rounded-pill px-4 fw-bold small" id="copyScriptBtn" title="Salin Script">
              <i class="fas fa-copy me-1"></i> Salin Script
            </button>
          </div>

          <p class="text-muted small mb-3" style="font-size: 0.9rem;">
            Salin seluruh script di bawah dan buka <strong>Winbox &gt; Terminal</strong> pada MikroTik Anda, lalu lakukan paste.
          </p>

          <div class="position-relative overflow-hidden rounded-3 bg-dark p-4">
            <pre class="text-light font-monospace mb-0" id="scriptOutput" style="font-size: 0.85rem; line-height: 1.6; white-space: pre-wrap; word-break: break-all; max-height: 480px; overflow-y: auto;"></pre>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

@push('scripts')
<script>
  let ispCount = 2;

  function renderIspInputs() {
    let html = '';
    for (let i = 0; i < ispCount; i++) {
      html += `
      <div class="p-3 rounded-3 bg-light border mb-3 isp-row" style="border-color: #e2e8f0 !important;">
        <div class="row g-3 align-items-end">
          <div class="col-md-5">
            <label class="form-label font-monospace fw-bold small text-muted">INTERFACE ETHER (WAN ${i + 1}) *</label>
            <input type="text" class="form-control bg-white p-2.5 border" name="ether[]" value="ether${i + 1}" placeholder="ether${i + 1}" required style="font-size: 0.9rem;">
          </div>
          <div class="col-md-5">
            <label class="form-label font-monospace fw-bold small text-muted">IP GATEWAY ISP ${i + 1} *</label>
            <input type="text" class="form-control bg-white p-2.5 border" name="gateway[]" placeholder="Contoh: 192.168.${i + 1}.1" required style="font-size: 0.9rem;">
          </div>
          <div class="col-md-2 text-end">
            ${ispCount > 1 ? `<button type="button" class="btn btn-outline-danger w-100 remove-isp" title="Hapus ISP"><i class="fas fa-trash me-1"></i> Hapus</button>` : ''}
          </div>
        </div>
      </div>`;
    }
    document.getElementById('ispInputs').innerHTML = html;
    document.getElementById('ispCounterBadge').textContent = ispCount + ' ISP Aktif';
  }

  document.addEventListener('DOMContentLoaded', function() {
    renderIspInputs();

    document.getElementById('addIspBtn').addEventListener('click', function() {
      if (ispCount < 10) {
        ispCount++;
        renderIspInputs();
      } else {
        alert('Maksimal 10 ISP.');
      }
    });

    document.getElementById('ispInputs').addEventListener('click', function(e) {
      if (e.target.closest('.remove-isp')) {
        if (ispCount > 1) {
          ispCount--;
          renderIspInputs();
        }
      }
    });

    document.getElementById('ecmpForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const version = document.getElementById('mikrotik_version').value;
      const ipBlock = document.getElementById('ip_block').value.trim();
      
      const ethers = Array.from(document.querySelectorAll("input[name='ether[]']")).map(el => el.value.trim());
      const gateways = Array.from(document.querySelectorAll("input[name='gateway[]']")).map(el => el.value.trim());

      if (ethers.length < 1 || gateways.length < 1 || !ipBlock) {
        alert('Mohon lengkapi seluruh data interface dan gateway!');
        return;
      }

      const script = generateEcmpScript(version, ipBlock, ethers, gateways);
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

  function generateEcmpScript(version, ipBlock, ethers, gateways) {
    const n = ethers.length;
    const now = new Date();
    const dateStr = now.toLocaleString('id-ID');

    let script = "###############################################################\n";
    script += "# MIKROTIK LOAD BALANCE ECMP SCRIPT\n";
    script += "# Generated by: PT Sekawan Putra Pratama (sekawanputrapratama.com)\n";
    script += "# Tanggal: " + dateStr + "\n";
    script += "# RouterOS: Version " + version + "\n";
    script += "# Jumlah ISP: " + n + " WAN Link\n";
    script += "#\n";
    script += "# PETUNJUK PENGGUNAAN:\n";
    script += "# 1. Salin script ini dan buka Winbox > New Terminal, lalu Paste.\n";
    script += "# 2. Jika WAN memakai DHCP Client, set 'Add Default Route' = no di IP > DHCP Client.\n";
    script += "# 3. Pastikan nama interface Ether WAN di MikroTik sudah sesuai.\n";
    script += "###############################################################\n\n";

    // Address List
    const ipBlocks = ipBlock.split(',').map(s => s.trim()).filter(Boolean);
    script += "/ip firewall address-list\n";
    ipBlocks.forEach(block => {
      script += `add address=${block} list=ip-local comment="LB ECMP by Sekawan"\n`;
    });
    script += "\n";

    // NAT Masquerade
    script += "/ip firewall nat\n";
    for (let i = 0; i < n; i++) {
      script += `add chain=srcnat out-interface="${ethers[i]}" action=masquerade comment="LB ECMP WAN ${i + 1} by Sekawan"\n`;
    }
    script += "\n";

    // Routing Tables & Routes
    if (version === "7") {
      script += "/routing table\n";
      for (let i = 0; i < n; i++) {
        script += `add name="to-${ethers[i]}" fib comment="LB ECMP Table by Sekawan"\n`;
      }
      script += "\n/ip route\n";
      // Main ECMP route — pisahkan per gateway, bukan gabung, karena ROS v7 ECMP lewat multiple route distance=1
      for (let i = 0; i < n; i++) {
        script += `add dst-address=0.0.0.0/0 check-gateway=ping distance=1 gateway="${gateways[i]}" routing-table=main comment="LB ECMP Main WAN ${i+1} by Sekawan"\n`;
      }
      // Individual per-WAN routing table routes
      for (let i = 0; i < n; i++) {
        script += `add dst-address=0.0.0.0/0 check-gateway=ping distance=1 gateway="${gateways[i]}" routing-table="to-${ethers[i]}" comment="LB ECMP Static ${ethers[i]} by Sekawan"\n`;
      }
    } else {
      script += "/ip route\n";
      // Main ECMP route v6 — buat satu route per gateway dengan distance=1 (ECMP)
      for (let i = 0; i < n; i++) {
        script += `add dst-address=0.0.0.0/0 check-gateway=ping distance=1 gateway=${gateways[i]} comment="LB ECMP Main WAN ${i+1} by Sekawan"\n`;
      }
      // Individual per-WAN routing-mark routes
      for (let i = 0; i < n; i++) {
        script += `add dst-address=0.0.0.0/0 check-gateway=ping distance=1 gateway=${gateways[i]} routing-mark="to-${ethers[i]}" comment="LB ECMP Static ${ethers[i]} by Sekawan"\n`;
      }
    }
    script += "\n";

    // Mangle Accept Local
    script += "/ip firewall mangle\n";
    ["prerouting", "postrouting", "forward", "input", "output"].forEach(chain => {
      script += `add action=accept chain=${chain} dst-address-list=ip-local src-address-list=ip-local comment="LB ECMP Bypass Local Traffic"\n`;
    });

    // Mark Connection & Routing
    for (let i = 0; i < n; i++) {
      script += `add action=mark-connection chain=input in-interface="${ethers[i]}" new-connection-mark="cm-${ethers[i]}" passthrough=yes comment="LB ECMP Mark Connection ${ethers[i]}"\n`;
      script += `add action=mark-routing chain=output connection-mark="cm-${ethers[i]}" new-routing-mark="to-${ethers[i]}" passthrough=yes comment="LB ECMP Mark Routing Output ${ethers[i]}"\n`;
      script += `add action=mark-routing chain=prerouting connection-mark="cm-${ethers[i]}" dst-address-list=!ip-local new-routing-mark="to-${ethers[i]}" passthrough=yes src-address-list=ip-local comment="LB ECMP Mark Routing Prerouting ${ethers[i]}"\n`;
    }

    return script;
  }
</script>
@endpush

@endsection
