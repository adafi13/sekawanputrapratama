@extends('frontend.layouts.app')

@section('title', 'Generator Script MikroTik Failover Recursive Gateway - PT Sekawan Putra Pratama')
@section('meta_description', 'Buat script failover otomatis MikroTik dengan metode Recursive Gateway (Check-Gateway Ping via DNS Google/Cloudflare) untuk RouterOS v6 dan v7.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'MikroTik Tools', 'url' => route('tools.mikrotik.index')],
    ['name' => 'Failover Recursive', 'url' => route('tools.mikrotik.failover')],
]])

@section('content')

{{-- HERO HEADER --}}
<section class="py-5 bg-white border-bottom position-relative overflow-hidden" style="padding-top: 135px !important; padding-bottom: 55px !important;">
  <div class="container text-center position-relative z-2">
    <div class="text-uppercase fw-bold text-warning small mb-2" style="letter-spacing: 1.5px; font-size: 11px;">
      • MIKROTIK HIGH AVAILABILITY GENERATOR
    </div>
    
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Failover <span class="text-warning">Recursive Gateway</span>
    </h1>
    
    <p class="text-muted mx-auto leading-relaxed mb-0" style="max-width: 720px; font-size: 1.05rem;">
      Sistem pengalihan otomatis ke ISP cadangan saat ISP utama mengalami gangguan internet (bukan sekadar kabel terputus), menggunakan teknik <strong>Recursive Routing Ping</strong> ke IP Publik (Google / Cloudflare).
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
            <i class="fas fa-shield-alt text-warning"></i> Parameter Failover Recursive 2 ISP
          </h4>

          <form id="failoverForm" autocomplete="off">
            <div class="row g-3 mb-4">
              
              <div class="col-md-6">
                <label for="mikrotik_version" class="form-label font-monospace fw-bold small text-muted">VERSI ROUTEROS *</label>
                <select class="form-select bg-light p-3 border-0" id="mikrotik_version" name="mikrotik_version" required style="font-size: 0.95rem;">
                  <option value="7" selected>MikroTik RouterOS v7 (Rekomendasi)</option>
                  <option value="6">MikroTik RouterOS v6</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="check_host" class="form-label font-monospace fw-bold small text-muted">IP PUB PING TARGET (PRIMARY RECURSIVE) *</label>
                <input type="text" class="form-control bg-light p-3 border-0" id="check_host" name="check_host" value="8.8.8.8" placeholder="8.8.8.8" required style="font-size: 0.95rem;">
                <span class="text-muted small mt-1 d-block" style="font-size: 11px;">
                  IP Publik yang akan terus di-ping untuk memastikan ISP Utama memiliki internet asli (default: 8.8.8.8 Google DNS).
                </span>
              </div>

            </div>

            <div class="row g-3 mb-4">
              
              {{-- ISP UTAMA (PRIMARY) --}}
              <div class="col-md-6">
                <div class="p-3 rounded-3 bg-light border h-100" style="border-color: #e2e8f0 !important;">
                  <h6 class="fw-bold text-primary mb-3"><i class="fas fa-network-wired me-2"></i>ISP Utama (Primary WAN 1)</h6>
                  
                  <div class="mb-3">
                    <label class="form-label font-monospace fw-bold small text-muted">INTERFACE ETHER WAN 1 *</label>
                    <input type="text" class="form-control bg-white p-2.5 border" id="ether1" name="ether1" value="ether1" required style="font-size: 0.9rem;">
                  </div>

                  <div>
                    <label class="form-label font-monospace fw-bold small text-muted">IP GATEWAY ISP 1 *</label>
                    <input type="text" class="form-control bg-white p-2.5 border" id="gateway1" name="gateway1" placeholder="Contoh: 192.168.1.1" required style="font-size: 0.9rem;">
                  </div>
                </div>
              </div>

              {{-- ISP CADANGAN (BACKUP) --}}
              <div class="col-md-6">
                <div class="p-3 rounded-3 bg-light border h-100" style="border-color: #e2e8f0 !important;">
                  <h6 class="fw-bold text-warning mb-3"><i class="fas fa-shield-alt me-2"></i>ISP Cadangan (Backup WAN 2)</h6>
                  
                  <div class="mb-3">
                    <label class="form-label font-monospace fw-bold small text-muted">INTERFACE ETHER WAN 2 *</label>
                    <input type="text" class="form-control bg-white p-2.5 border" id="ether2" name="ether2" value="ether2" required style="font-size: 0.9rem;">
                  </div>

                  <div>
                    <label class="form-label font-monospace fw-bold small text-muted">IP GATEWAY ISP 2 *</label>
                    <input type="text" class="form-control bg-white p-2.5 border" id="gateway2" name="gateway2" placeholder="Contoh: 192.168.2.1" required style="font-size: 0.9rem;">
                  </div>
                </div>
              </div>

            </div>

            <div class="d-flex align-items-center justify-content-end pt-3 border-top">
              <button type="submit" class="btn btn-warning text-dark rounded-pill px-5 py-2.5 fw-bold shadow-sm">
                <i class="fas fa-magic me-2"></i> Generate Script Failover
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
              <i class="fas fa-terminal text-success"></i> Hasil Script Failover Recursive
            </h4>

            <button type="button" class="btn btn-dark rounded-pill px-4 fw-bold small" id="copyScriptBtn" title="Salin Script">
              <i class="fas fa-copy me-1"></i> Salin Script
            </button>
          </div>

          <p class="text-muted small mb-3" style="font-size: 0.9rem;">
            Salin seluruh script di bawah dan paste ke **Winbox &gt; Terminal** MikroTik Anda.
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
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('failoverForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const version = document.getElementById('mikrotik_version').value;
      const checkHost = document.getElementById('check_host').value.trim();
      const ether1 = document.getElementById('ether1').value.trim();
      const gateway1 = document.getElementById('gateway1').value.trim();
      const ether2 = document.getElementById('ether2').value.trim();
      const gateway2 = document.getElementById('gateway2').value.trim();

      if (!gateway1 || !gateway2 || !ether1 || !ether2) {
        alert('Mohon lengkapi seluruh data interface dan gateway!');
        return;
      }

      const script = generateFailoverScript(version, checkHost, ether1, gateway1, ether2, gateway2);
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

  function generateFailoverScript(version, checkHost, ether1, gateway1, ether2, gateway2) {
    const now = new Date();
    const dateStr = now.toLocaleString('id-ID');

    let script = "###############################################################\n";
    script += "# MIKROTIK FAILOVER RECURSIVE ROUTING SCRIPT\n";
    script += "# Generated by: PT Sekawan Putra Pratama (sekawanputrapratama.com)\n";
    script += "# Tanggal: " + dateStr + "\n";
    script += "# RouterOS: Version " + version + "\n";
    script += "# ISP Primary: " + ether1 + " (Gateway: " + gateway1 + ")\n";
    script += "# ISP Backup: " + ether2 + " (Gateway: " + gateway2 + ")\n";
    script += "# Recursive Target: " + checkHost + "\n";
    script += "#\n";
    script += "# PETUNJUK PENGGUNAAN:\n";
    script += "# 1. Salin script ini dan buka Winbox > New Terminal, lalu Paste.\n";
    script += "# 2. Jika WAN memakai DHCP Client, set 'Add Default Route' = no di IP > DHCP Client.\n";
    script += "# 3. Pastikan nama interface Ether WAN di MikroTik sudah sesuai.\n";
    script += "###############################################################\n\n";

    // NAT Masquerade
    script += "/ip firewall nat\n";
    script += `add chain=srcnat out-interface="${ether1}" action=masquerade comment="NAT Primary WAN1 by Sekawan"\n`;
    script += `add chain=srcnat out-interface="${ether2}" action=masquerade comment="NAT Backup WAN2 by Sekawan"\n\n`;

    // Recursive Routes
    script += "/ip route\n";
    
    if (version === "7") {
      // RouterOS v7 Recursive Routing
      script += `# [LANGKAH 1] Rute statis ke IP target ping via Gateway ISP Utama\n`;
      script += `# scope=10 agar route ini tidak dijadikan gateway rekursif oleh route lain\n`;
      script += `add dst-address=${checkHost}/32 gateway="${gateway1}" scope=10 comment="Recursive Ping Target via Primary by Sekawan"\n\n`;

      script += `# [LANGKAH 2] Default route rekursif ke IP target (distance=1 = utama)\n`;
      script += `# Jika ping ke ${checkHost} gagal, route ini otomatis non-aktif -> failover ke backup\n`;
      script += `add dst-address=0.0.0.0/0 gateway="${checkHost}" target-scope=11 distance=1 comment="Primary Default Recursive Route by Sekawan"\n\n`;

      script += `# [LANGKAH 3] Default route backup via ISP 2 (distance=2 = hanya aktif bila ISP 1 mati)\n`;
      script += `add dst-address=0.0.0.0/0 gateway="${gateway2}" distance=2 comment="Backup Default Route WAN2 by Sekawan"\n`;
    } else {
      // RouterOS v6 Recursive Routing
      script += `# [LANGKAH 1] Rute statis ke IP target ping via Gateway ISP Utama\n`;
      script += `# scope=10 agar route ini tidak dijadikan gateway rekursif oleh route lain\n`;
      script += `add dst-address=${checkHost}/32 gateway="${gateway1}" scope=10 comment="Recursive Ping Target via Primary by Sekawan"\n\n`;

      script += `# [LANGKAH 2] Default route rekursif ke IP target (distance=1 = utama)\n`;
      script += `# Jika ping ke ${checkHost} gagal, route ini otomatis non-aktif -> failover ke backup\n`;
      script += `add dst-address=0.0.0.0/0 gateway="${checkHost}" target-scope=11 distance=1 comment="Primary Default Recursive Route by Sekawan"\n\n`;

      script += `# [LANGKAH 3] Default route backup via ISP 2 (distance=2 = hanya aktif bila ISP 1 mati)\n`;
      script += `add dst-address=0.0.0.0/0 gateway="${gateway2}" distance=2 comment="Backup Default Route WAN2 by Sekawan"\n`;
    }

    return script;
  }
</script>
@endpush

@endsection
