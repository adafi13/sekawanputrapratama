@extends('frontend.layouts.app')

@section('title', 'Generator Script WireGuard VPN MikroTik RouterOS v7 Gratis - PT Sekawan Putra Pratama')
@section('meta_description', 'Buat script WireGuard VPN Server & Peers MikroTik RouterOS v7 otomatis. Dilengkapi template konfigurasi client (.conf) untuk Android, iOS, Windows, Mac. Gratis, akurat, siap paste di Winbox.')
@section('meta_keywords', 'wireguard mikrotik v7, script wireguard mikrotik, generator vpn wireguard, wireguard peer mikrotik, setup wireguard mikrotik, vpn tunnel mikrotik, wireguard client conf mikrotik, wireguard routeros v7 gratis')
@section('og_title', 'Generator Script WireGuard VPN MikroTik RouterOS v7 - PT Sekawan Putra Pratama')
@section('og_description', 'Generator script WireGuard VPN Server & Peers untuk MikroTik RouterOS v7. Dapatkan script Winbox + file .conf client otomatis. Gratis dan akurat.')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "SoftwareApplication",
  "name": "Generator Script WireGuard VPN MikroTik RouterOS v7",
  "applicationCategory": "NetworkingApplication",
  "operatingSystem": "Web Browser",
  "description": "Tool gratis untuk membuat script WireGuard VPN Server, Peer, dan Client Configuration (.conf) MikroTik RouterOS v7.",
  "url": "{{ route('tools.mikrotik.wireguard') }}",
  "offers": {"@@type": "Offer", "price": "0", "priceCurrency": "IDR"},
  "publisher": {"@@type": "Organization", "name": "PT Sekawan Putra Pratama", "url": "{{ route('home') }}"},
  "breadcrumb": {
    "@@type": "BreadcrumbList",
    "itemListElement": [
      {"@@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
      {"@@type":"ListItem","position":2,"name":"MikroTik Tools","item":"{{ route('tools.mikrotik.index') }}"},
      {"@@type":"ListItem","position":3,"name":"WireGuard VPN Generator","item":"{{ route('tools.mikrotik.wireguard') }}"}
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
      • VPN INTER-BRANCH & REMOTE ACCESS
    </div>
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Generator Script <span class="text-primary">WireGuard VPN</span> MikroTik ROS v7
    </h1>
    <p class="text-muted mx-auto mb-0" style="max-width: 680px; font-size: 1.05rem;">
      Buat script WireGuard VPN Server & Peers untuk MikroTik RouterOS v7 secara otomatis. Dilengkapi template file client <code>.conf</code> untuk Windows, Android, iOS, dan Mac.
    </p>
  </div>
</section>

{{-- PANDUAN ENGINEER --}}
<div class="container mt-4 mb-2">
  <div class="alert border-start border-4 border-info bg-info bg-opacity-10 rounded-3 py-3 px-4 small" role="alert">
    <strong><i class="fas fa-info-circle me-2 text-info"></i>Persyaratan RouterOS:</strong>
    WireGuard secara bawaan (built-in) didukung pada <strong>MikroTik RouterOS v7</strong> ke atas. Pastikan router Anda sudah di-upgrade ke v7 sebelum menjalankan script ini.
  </div>
</div>

{{-- FORM GENERATOR --}}
<section class="py-4 bg-light">
  <div class="container py-2">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="card border-0 rounded-4 shadow-sm">
          <div class="card-body p-4 p-md-5">
            <h5 class="fw-bold text-dark mb-4"><i class="fas fa-lock me-2 text-primary"></i>Konfigurasi WireGuard VPN</h5>
            <form id="wireguardForm" novalidate>
              <div class="row g-3">

                {{-- Interface Name --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Nama Interface WireGuard</label>
                  <input type="text" class="form-control rounded-3" id="wg_iface" placeholder="wg-vpn0" value="wg-vpn0">
                </div>

                {{-- Listen Port --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Listen Port (UDP)</label>
                  <input type="number" class="form-control rounded-3" id="wg_port" placeholder="51820" value="51820" min="1" max="65535">
                </div>

                {{-- VPN Subnet IP --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">IP Subnet VPN (Router / Gateway)</label>
                  <input type="text" class="form-control rounded-3" id="wg_tunnel_ip" placeholder="10.10.10.1/24" value="10.10.10.1/24">
                  <div class="form-text">IP lokal untuk interface WireGuard router</div>
                </div>

                {{-- Public Endpoint --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Public Endpoint (IP / Domain Router)</label>
                  <input type="text" class="form-control rounded-3" id="wg_public_endpoint" placeholder="203.0.113.1 atau vpn.domain.com">
                  <div class="form-text">IP Publik WAN atau DDNS Router untuk koneksi dari client</div>
                </div>

                {{-- Number of Clients --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Jumlah Peer / Client Remote</label>
                  <input type="number" class="form-control rounded-3" id="wg_client_count" placeholder="3" value="3" min="1" max="50">
                  <div class="form-text">Maksimal 50 client per generator</div>
                </div>

                {{-- Client IP Starting --}}
                <div class="col-md-6">
                  <label class="form-label fw-semibold small text-dark">Client IP Mulai</label>
                  <input type="text" class="form-control rounded-3" id="wg_client_start_ip" placeholder="10.10.10.2" value="10.10.10.2">
                  <div class="form-text">Client 1 akan dapat 10.10.10.2, Client 2 10.10.10.3, dst.</div>
                </div>

                {{-- Allow Access to LAN --}}
                <div class="col-md-12">
                  <div class="form-check form-switch pt-2">
                    <input class="form-check-input" type="checkbox" id="wg_allow_lan" checked>
                    <label class="form-check-label fw-semibold small text-dark" for="wg_allow_lan">
                      Izinkan Client VPN mengakses LAN Lokal Router (NAT / Forwarding)
                    </label>
                  </div>
                </div>

                <div class="col-12 pt-2">
                  <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                    <i class="fas fa-bolt me-2"></i>Generate WireGuard Script
                  </button>
                </div>

              </div>
            </form>
          </div>
        </div>

        {{-- RESULT --}}
        <div id="resultSection" class="mt-4" style="display:none;">

          {{-- Result Card 1: RouterOS Command --}}
          <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                <h6 class="fw-bold text-dark mb-0"><i class="fas fa-terminal me-2 text-primary"></i>[1] Script MikroTik RouterOS v6/v7 (Paste di Winbox Terminal)</h6>
                <button class="btn btn-dark rounded-pill px-4 fw-bold small" id="copyRouterScriptBtn">
                  <i class="fas fa-copy me-1"></i> Salin Script Router
                </button>
              </div>
              <pre id="routerScriptOutput" class="bg-dark text-light rounded-3 p-4 small" style="white-space: pre-wrap; word-break: break-word; max-height: 450px; overflow-y: auto; font-size: 0.78rem; line-height: 1.6;"></pre>
            </div>
          </div>

          {{-- Result Card 2: Client Config Template --}}
          <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                <h6 class="fw-bold text-dark mb-0"><i class="fas fa-mobile-alt me-2 text-success"></i>[2] Template Client Config (.conf) untuk App WireGuard</h6>
                <button class="btn btn-outline-dark rounded-pill px-4 fw-bold small" id="copyClientConfigBtn">
                  <i class="fas fa-copy me-1"></i> Salin Config Client
                </button>
              </div>
              <pre id="clientConfigOutput" class="bg-dark text-success rounded-3 p-4 small" style="white-space: pre-wrap; word-break: break-word; max-height: 450px; overflow-y: auto; font-size: 0.78rem; line-height: 1.6;"></pre>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('wireguardForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const iface      = document.getElementById('wg_iface').value.trim() || 'wg-vpn0';
      const port       = document.getElementById('wg_port').value.trim() || '51820';
      const tunnelIp   = document.getElementById('wg_tunnel_ip').value.trim() || '10.10.10.1/24';
      const endpoint   = document.getElementById('wg_public_endpoint').value.trim();
      const count      = Math.min(parseInt(document.getElementById('wg_client_count').value) || 1, 50);
      const startIpStr = document.getElementById('wg_client_start_ip').value.trim() || '10.10.10.2';
      const allowLan   = document.getElementById('wg_allow_lan').checked;

      if (!endpoint) {
        alert('Masukkan Public Endpoint (IP Publik / Domain DDNS Router)!');
        return;
      }

      // Convert start IP to integer
      const ipParts = startIpStr.split('.').map(Number);
      if (ipParts.length !== 4 || ipParts.some(p => isNaN(p) || p < 0 || p > 255)) {
        alert('Format Client IP Mulai tidak valid!');
        return;
      }
      const startNum = ((ipParts[0]<<24)|(ipParts[1]<<16)|(ipParts[2]<<8)|ipParts[3]) >>> 0;

      const now = new Date();
      const dateStr = now.toLocaleString('id-ID');

      // 1. ROUTEROS SCRIPT
      let rScript = "###############################################################\n";
      rScript += "# MIKROTIK WIREGUARD VPN SERVER SCRIPT (RouterOS v7)\n";
      rScript += "# Generated by: PT Sekawan Putra Pratama (sekawanputrapratama.com)\n";
      rScript += `# Tanggal: ${dateStr}\n`;
      rScript += `# Interface: ${iface} | Port: ${port} | IP: ${tunnelIp}\n`;
      rScript += `# Total Peers: ${count} Client Remote\n`;
      rScript += "#\n";
      rScript += "# PETUNJUK PENGGUNAAN:\n";
      rScript += "# 1. Buka Winbox > New Terminal, lalu Paste script ini.\n";
      rScript += "# 2. Salin Public Key yang dihasilkan router di WireGuard > Interfaces > Public Key.\n";
      rScript += "# 3. Ganti 'INSERT_SERVER_PUBLIC_KEY_HERE' di config client dengan Public Key tersebut.\n";
      rScript += "###############################################################\n\n";

      rScript += "# [1] Buat Interface WireGuard Server\n";
      rScript += `/interface wireguard add name="${iface}" listen-port=${port} comment="WireGuard Server by Sekawan"\n\n`;

      rScript += "# [2] Pasang IP Address pada Interface WireGuard\n";
      rScript += `/ip address add address=${tunnelIp} interface="${iface}" comment="WireGuard Gateway IP"\n\n`;

      rScript += "# [3] Buka Port Firewall UDP di Input Chain\n";
      rScript += `/ip firewall filter add chain=input dst-port=${port} protocol=udp action=accept comment="Allow WireGuard VPN Port ${port}"\n\n`;

      if (allowLan) {
        rScript += "# [4] Izinkan Forward & NAT untuk Client WireGuard ke LAN / Internet\n";
        rScript += `/ip firewall nat add chain=srcnat src-address=${tunnelIp.split('/')[0].split('.').slice(0,3).join('.')}.0/24 action=masquerade comment="NAT WireGuard Clients"\n\n`;
      }

      rScript += "# [5] Tambahkan Peer / Client List (Ganti Public Key Client masing-masing)\n";
      rScript += `/interface wireguard peers\n`;

      let cConfig = `;; =========================================================\n`;
      cConfig += `;; TEMPLATE CONFIG CLIENT WIREGUARD (.conf)\n`;
      cConfig += `;; Impor file ini ke aplikasi WireGuard di Windows/Mac/Android/iOS\n`;
      cConfig += `;; =========================================================\n\n`;

      for (let i = 0; i < count; i++) {
        const clientIpNum = startNum + i;
        const clientIp = [(clientIpNum>>>24)&255, (clientIpNum>>>16)&255, (clientIpNum>>>8)&255, clientIpNum&255].join('.');
        const clientName = `client-${i + 1}`;

        // Router script line for peer
        rScript += `add interface="${iface}" allowed-address=${clientIp}/32 comment="Peer ${clientName}" public-key="CLIENT_${i+1}_PUBLIC_KEY_PLACEHOLDER"\n`;

        // Client config template
        cConfig += `;; --- CLIENT CONFIG ${i+1}: ${clientName} (${clientIp}) ---\n`;
        cConfig += `[Interface]\n`;
        cConfig += `PrivateKey = CLIENT_${i+1}_PRIVATE_KEY_PLACEHOLDER\n`;
        cConfig += `Address = ${clientIp}/32\n`;
        cConfig += `DNS = 1.1.1.1, 8.8.8.8\n\n`;
        cConfig += `[Peer]\n`;
        cConfig += `PublicKey = INSERT_SERVER_PUBLIC_KEY_HERE\n`;
        cConfig += `Endpoint = ${endpoint}:${port}\n`;
        cConfig += `AllowedIPs = 0.0.0.0/0\n`;
        cConfig += `PersistentKeepalive = 25\n\n`;
      }

      document.getElementById('routerScriptOutput').textContent = rScript;
      document.getElementById('clientConfigOutput').textContent = cConfig;
      document.getElementById('resultSection').style.display = 'block';
      document.getElementById('resultSection').scrollIntoView({ behavior: 'smooth' });
    });

    document.getElementById('copyRouterScriptBtn').addEventListener('click', function() {
      navigator.clipboard.writeText(document.getElementById('routerScriptOutput').textContent).then(() => {
        const btn = this;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin!';
        btn.className = 'btn btn-success rounded-pill px-4 fw-bold small';
        setTimeout(() => {
          btn.innerHTML = '<i class="fas fa-copy me-1"></i> Salin Script Router';
          btn.className = 'btn btn-dark rounded-pill px-4 fw-bold small';
        }, 2000);
      });
    });

    document.getElementById('copyClientConfigBtn').addEventListener('click', function() {
      navigator.clipboard.writeText(document.getElementById('clientConfigOutput').textContent).then(() => {
        const btn = this;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin!';
        btn.className = 'btn btn-success rounded-pill px-4 fw-bold small';
        setTimeout(() => {
          btn.innerHTML = '<i class="fas fa-copy me-1"></i> Salin Config Client';
          btn.className = 'btn btn-outline-dark rounded-pill px-4 fw-bold small';
        }, 2000);
      });
    });
  });
</script>
@endpush
