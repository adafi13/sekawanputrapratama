@extends('frontend.layouts.app')

@section('title', 'Generator Script DHCP Server MikroTik RouterOS v6 v7 Gratis - PT Sekawan Putra Pratama')
@section('meta_description', 'Buat script konfigurasi DHCP Server MikroTik otomatis: IP Pool, DHCP Server, DHCP Network, DNS, Gateway, dan Static Lease Binding (MAC IP). Untuk RouterOS v6 & v7. Gratis.')
@section('meta_keywords', 'script dhcp server mikrotik, generator dhcp server mikrotik, setup dhcp server mikrotik, dhcp pool mikrotik, static lease mac address mikrotik, dhcp network mikrotik, script routeros gratis')
@section('og_title', 'Generator Script DHCP Server MikroTik RouterOS v6 & v7 - PT Sekawan Putra Pratama')
@section('og_description', 'Buat script DHCP Server MikroTik lengkap: IP Pool, Subnet Network, Gateway, DNS Server, dan Static Lease (MAC Binding). Siap paste di Winbox Terminal.')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "SoftwareApplication",
  "name": "Generator Script DHCP Server MikroTik",
  "applicationCategory": "NetworkingApplication",
  "operatingSystem": "Web Browser",
  "description": "Tool gratis untuk membuat script DHCP Server, IP Pool, DHCP Network, DNS, dan Static Leases (MAC Address Binding) MikroTik RouterOS v6 & v7.",
  "url": "{{ route('tools.mikrotik.dhcp-server') }}",
  "offers": {"@@type": "Offer", "price": "0", "priceCurrency": "IDR"},
  "publisher": {"@@type": "Organization", "name": "PT Sekawan Putra Pratama", "url": "{{ route('home') }}"},
  "breadcrumb": {
    "@@type": "BreadcrumbList",
    "itemListElement": [
      {"@@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
      {"@@type":"ListItem","position":2,"name":"MikroTik Tools","item":"{{ route('tools.mikrotik.index') }}"},
      {"@@type":"ListItem","position":3,"name":"DHCP Server Generator","item":"{{ route('tools.mikrotik.dhcp-server') }}"}
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
      • OTOMATISASI ALOKASI IP ADDRESS
    </div>
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Generator Script <span class="text-primary">DHCP Server</span> MikroTik
    </h1>
    <p class="text-muted mx-auto mb-0" style="max-width: 680px; font-size: 1.05rem;">
      Buat script lengkap DHCP Server, IP Pool, DHCP Network (Gateway/DNS), dan Static IP Binding (MAC Address) untuk RouterOS v6 & v7.
    </p>
  </div>
</section>

{{-- PANDUAN --}}
<div class="container mt-4 mb-2">
  <div class="alert border-start border-4 border-primary bg-primary bg-opacity-10 rounded-3 py-3 px-4 small" role="alert">
    <strong><i class="fas fa-info-circle me-2 text-primary"></i>Panduan Engineer:</strong>
    Pastikan interface (misal: <code>bridge-lan</code> atau <code>ether2</code>) sudah dipasang IP Address (gateway) via <strong>IP → Addresses</strong> sebelum mengaktifkan DHCP Server.
  </div>
</div>

{{-- FORM GENERATOR --}}
<section class="py-4 bg-light">
  <div class="container py-2">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="card border-0 rounded-4 shadow-sm">
          <div class="card-body p-4 p-md-5">
            <h5 class="fw-bold text-dark mb-4"><i class="fas fa-network-wired me-2 text-primary"></i>Konfigurasi DHCP Server</h5>
            <form id="dhcpForm" novalidate>
              <div class="row g-3">

                {{-- RouterOS Version --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Versi RouterOS</label>
                  <select class="form-select rounded-3" id="dhcp_version">
                    <option value="6">RouterOS v6</option>
                    <option value="7" selected>RouterOS v7</option>
                  </select>
                </div>

                {{-- Interface Name --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Interface LAN</label>
                  <input type="text" class="form-control rounded-3" id="dhcp_iface" placeholder="bridge-lan" value="bridge-lan">
                  <div class="form-text">Contoh: bridge-lan, ether2-lan, vlan10</div>
                </div>

                {{-- Server Name --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Nama DHCP Server</label>
                  <input type="text" class="form-control rounded-3" id="dhcp_srv_name" placeholder="dhcp-lan" value="dhcp-lan">
                </div>

                {{-- Network Subnet --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Subnet Network</label>
                  <input type="text" class="form-control rounded-3" id="dhcp_network" placeholder="192.168.10.0/24" value="192.168.10.0/24">
                </div>

                {{-- Gateway --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Gateway IP (Default Router)</label>
                  <input type="text" class="form-control rounded-3" id="dhcp_gateway" placeholder="192.168.10.1" value="192.168.10.1">
                </div>

                {{-- Lease Time --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Lease Time</label>
                  <input type="text" class="form-control rounded-3" id="dhcp_lease_time" placeholder="1d (1 hari) / 8h / 30m" value="1d">
                  <div class="form-text">Format: 1d = 1 hari, 12h = 12 jam, 30m = 30 menit</div>
                </div>

                {{-- Pool IP Range --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">IP Pool Mulai</label>
                  <input type="text" class="form-control rounded-3" id="dhcp_pool_start" placeholder="192.168.10.10" value="192.168.10.10">
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">IP Pool Akhir</label>
                  <input type="text" class="form-control rounded-3" id="dhcp_pool_end" placeholder="192.168.10.254" value="192.168.10.254">
                </div>

                {{-- DNS Servers --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">DNS Server Utama & Cadangan</label>
                  <input type="text" class="form-control rounded-3" id="dhcp_dns" placeholder="1.1.1.1,8.8.8.8" value="1.1.1.1,8.8.8.8">
                  <div class="form-text">Pisahkan dengan koma jika lebih dari satu DNS</div>
                </div>

                {{-- Domain Name --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Domain Name (opsional)</label>
                  <input type="text" class="form-control rounded-3" id="dhcp_domain" placeholder="lan.local" value="">
                </div>

                {{-- Static Leases (MAC Reservation) --}}
                <div class="col-12 border-top pt-3 mt-2">
                  <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="dhcp_enable_static" onchange="toggleStaticLease()">
                    <label class="form-check-label fw-semibold small text-dark" for="dhcp_enable_static">
                      Tambahkan Static IP Reservation (MAC Address Binding untuk Printer/Server)
                    </label>
                  </div>

                  <div id="static_lease_area" class="d-none">
                    <div class="row g-3">
                      <div class="col-md-4">
                        <label class="form-label fw-semibold small text-dark">MAC Address Client</label>
                        <input type="text" class="form-control rounded-3" id="static_mac" placeholder="AA:BB:CC:DD:EE:FF">
                      </div>
                      <div class="col-md-4">
                        <label class="form-label fw-semibold small text-dark">IP Static Khusus</label>
                        <input type="text" class="form-control rounded-3" id="static_ip" placeholder="192.168.10.5">
                      </div>
                      <div class="col-md-4">
                        <label class="form-label fw-semibold small text-dark">Keterangan / Hostname</label>
                        <input type="text" class="form-control rounded-3" id="static_comment" placeholder="Printer Office / Server NAS">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 pt-2">
                  <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                    <i class="fas fa-bolt me-2"></i>Generate DHCP Script
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
  function toggleStaticLease() {
    const en = document.getElementById('dhcp_enable_static').checked;
    document.getElementById('static_lease_area').classList.toggle('d-none', !en);
  }

  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('dhcpForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const version   = document.getElementById('dhcp_version').value;
      const iface     = document.getElementById('dhcp_iface').value.trim() || 'bridge-lan';
      const srvName   = document.getElementById('dhcp_srv_name').value.trim() || 'dhcp-lan';
      const network   = document.getElementById('dhcp_network').value.trim() || '192.168.10.0/24';
      const gateway   = document.getElementById('dhcp_gateway').value.trim() || '192.168.10.1';
      const lease     = document.getElementById('dhcp_lease_time').value.trim() || '1d';
      const poolStart = document.getElementById('dhcp_pool_start').value.trim();
      const poolEnd   = document.getElementById('dhcp_pool_end').value.trim();
      const dns       = document.getElementById('dhcp_dns').value.trim() || '1.1.1.1,8.8.8.8';
      const domain    = document.getElementById('dhcp_domain').value.trim();
      const enableStatic = document.getElementById('dhcp_enable_static').checked;

      if (!poolStart || !poolEnd) {
        alert('Masukkan IP Pool Mulai dan IP Pool Akhir!');
        return;
      }

      const poolName = `pool-${srvName}`;
      const now = new Date();
      const dateStr = now.toLocaleString('id-ID');

      let script = "###############################################################\n";
      script += "# MIKROTIK DHCP SERVER CONFIGURATION SCRIPT\n";
      script += "# Generated by: PT Sekawan Putra Pratama (sekawanputrapratama.com)\n";
      script += `# Tanggal: ${dateStr}\n`;
      script += `# RouterOS: Version ${version}\n`;
      script += `# Interface: ${iface} | Network: ${network} | Gateway: ${gateway}\n`;
      script += `# Pool: ${poolStart} - ${poolEnd} | Lease: ${lease}\n`;
      script += "#\n";
      script += "# PETUNJUK PENGGUNAAN:\n";
      script += "# 1. Buka Winbox > New Terminal, lalu Paste script ini.\n";
      script += "# 2. Pastikan interface LAN sudah dipasang IP Gateway (" + gateway + ").\n";
      script += "# 3. Gunakan /ip dhcp-server print untuk memverifikasi server aktif.\n";
      script += "###############################################################\n\n";

      script += "# [1] Buat IP Address Pool\n";
      script += `/ip pool add name="${poolName}" ranges=${poolStart}-${poolEnd} comment="DHCP Pool by Sekawan"\n\n`;

      script += "# [2] Buat DHCP Server\n";
      script += `/ip dhcp-server add name="${srvName}" interface="${iface}" address-pool="${poolName}" lease-time=${lease} disabled=no comment="DHCP Server by Sekawan"\n\n`;

      script += "# [3] Buat DHCP Network (Gateway & DNS)\n";
      let netLine = `/ip dhcp-server network add address=${network} gateway=${gateway} dns-server="${dns}"`;
      if (domain) netLine += ` domain="${domain}"`;
      netLine += ` comment="DHCP Subnet by Sekawan"`;
      script += netLine + "\n\n";

      if (enableStatic) {
        const mac = document.getElementById('static_mac').value.trim();
        const staticIp = document.getElementById('static_ip').value.trim();
        const comment = document.getElementById('static_comment').value.trim() || 'Static IP Reservation';

        if (mac && staticIp) {
          script += "# [4] Static IP Reservation (MAC Address Binding)\n";
          script += `/ip dhcp-server lease add address=${staticIp} mac-address="${mac}" server="${srvName}" comment="${comment} by Sekawan"\n\n`;
        }
      }

      document.getElementById('scriptOutput').textContent = script;
      document.getElementById('resultSection').style.display = 'block';
      document.getElementById('resultSection').scrollIntoView({ behavior: 'smooth' });
    });

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
  });
</script>
@endpush
