@extends('frontend.layouts.app')

@section('title', 'Subnet Calculator & IP Address Calculator Online Gratis - PT Sekawan Putra Pratama')
@section('meta_description', 'Hitung subnet IP address secara otomatis: Network Address, Broadcast, Range IP, Jumlah Host, Wildcard Mask, Prefix Length. Support IPv4 CIDR. Gratis dan instan.')
@section('meta_keywords', 'subnet calculator, ip address calculator, cidr calculator, network address calculator, wildcard mask calculator, subnet mask calculator online, hitung subnet ip, kalkulator subnet indonesia, ip calculator gratis')
@section('og_title', 'Subnet Calculator & IP Address Calculator Online Gratis - PT Sekawan Putra Pratama')
@section('og_description', 'Hitung subnet IPv4 secara instan: Network Address, Broadcast, Range Host, Total Host, Wildcard Mask. Tool gratis untuk network engineer Indonesia.')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "SoftwareApplication",
  "name": "Subnet & IP Address Calculator",
  "applicationCategory": "NetworkingApplication",
  "operatingSystem": "Web Browser",
  "description": "Tool kalkulator subnet IPv4 online gratis. Hitung Network Address, Broadcast, Range Host, Wildcard Mask, dan Total Host dari CIDR notation.",
  "url": "{{ route('tools.mikrotik.subnet-calculator') }}",
  "offers": {"@@type": "Offer", "price": "0", "priceCurrency": "IDR"},
  "publisher": {"@@type": "Organization", "name": "PT Sekawan Putra Pratama", "url": "{{ route('home') }}"},
  "breadcrumb": {
    "@@type": "BreadcrumbList",
    "itemListElement": [
      {"@@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
      {"@@type":"ListItem","position":2,"name":"MikroTik Tools","item":"{{ route('tools.mikrotik.index') }}"},
      {"@@type":"ListItem","position":3,"name":"Subnet Calculator","item":"{{ route('tools.mikrotik.subnet-calculator') }}"}
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
      • KALKULATOR JARINGAN
    </div>
    <h1 class="fw-black text-dark display-5 mb-3" style="letter-spacing: -1.2px; font-weight: 900;">
      Subnet & IP Address <span class="text-primary">Calculator</span>
    </h1>
    <p class="text-muted mx-auto mb-0" style="max-width: 680px; font-size: 1.05rem;">
      Hitung Network Address, Broadcast, Range IP, Jumlah Host, Wildcard Mask, dan Class IP secara instan. Masukkan IP/CIDR atau IP + Subnet Mask.
    </p>
  </div>
</section>

{{-- CALCULATOR --}}
<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center g-4">

      {{-- INPUT PANEL --}}
      <div class="col-lg-5">
        <div class="card border-0 rounded-4 shadow-sm h-100">
          <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-4"><i class="fas fa-calculator me-2 text-primary"></i>Input</h5>

            <div class="mb-3">
              <label class="form-label fw-semibold small text-dark">Mode Input</label>
              <select class="form-select rounded-3" id="input_mode" onchange="toggleInputMode()">
                <option value="cidr" selected>IP / CIDR Notation (contoh: 192.168.1.0/24)</option>
                <option value="mask">IP + Subnet Mask (contoh: 192.168.1.0 + 255.255.255.0)</option>
              </select>
            </div>

            {{-- CIDR mode --}}
            <div id="cidr_input">
              <div class="mb-3">
                <label class="form-label fw-semibold small text-dark">IP Address / CIDR</label>
                <input type="text" class="form-control rounded-3 font-monospace" id="cidr_value" placeholder="192.168.1.0/24" oninput="autoCalculate()">
                <div class="form-text">Format: x.x.x.x/prefix (contoh: 10.0.0.0/8)</div>
              </div>
            </div>

            {{-- MASK mode --}}
            <div id="mask_input" class="d-none">
              <div class="mb-3">
                <label class="form-label fw-semibold small text-dark">IP Address</label>
                <input type="text" class="form-control rounded-3 font-monospace" id="ip_value" placeholder="192.168.1.0" oninput="autoCalculate()">
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold small text-dark">Subnet Mask</label>
                <input type="text" class="form-control rounded-3 font-monospace" id="mask_value" placeholder="255.255.255.0" oninput="autoCalculate()">
              </div>
            </div>

            <button class="btn btn-primary rounded-pill px-5 fw-bold w-100 mt-2" onclick="calculate()">
              <i class="fas fa-bolt me-2"></i>Hitung Subnet
            </button>

            {{-- Quick Presets --}}
            <div class="mt-4">
              <p class="small fw-semibold text-muted mb-2">Quick Presets:</p>
              <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-outline-secondary btn-sm rounded-pill" onclick="setPreset('192.168.1.0/24')">192.168.1.0/24</button>
                <button class="btn btn-outline-secondary btn-sm rounded-pill" onclick="setPreset('10.0.0.0/8')">10.0.0.0/8</button>
                <button class="btn btn-outline-secondary btn-sm rounded-pill" onclick="setPreset('172.16.0.0/12')">172.16.0.0/12</button>
                <button class="btn btn-outline-secondary btn-sm rounded-pill" onclick="setPreset('192.168.0.0/16')">192.168.0.0/16</button>
                <button class="btn btn-outline-secondary btn-sm rounded-pill" onclick="setPreset('10.10.0.0/22')">10.10.0.0/22</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- RESULT PANEL --}}
      <div class="col-lg-7">
        <div class="card border-0 rounded-4 shadow-sm h-100">
          <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-4"><i class="fas fa-network-wired me-2 text-primary"></i>Hasil Kalkulasi</h5>
            <div id="error_msg" class="alert alert-danger rounded-3 small d-none" role="alert"></div>

            <div id="result_area">
              <div class="text-center text-muted py-4">
                <i class="fas fa-network-wired fa-2x mb-3 opacity-25"></i>
                <p class="small">Masukkan IP Address di sebelah kiri, hasil akan muncul di sini secara otomatis.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    {{-- CIDR REFERENCE TABLE --}}
    <div class="row justify-content-center mt-5">
      <div class="col-lg-12">
        <div class="card border-0 rounded-4 shadow-sm">
          <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-4"><i class="fas fa-table me-2 text-primary"></i>Tabel Referensi CIDR IPv4</h5>
            <div class="table-responsive">
              <table class="table table-sm table-hover small align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Prefix</th>
                    <th>Subnet Mask</th>
                    <th>Wildcard</th>
                    <th>Total IP</th>
                    <th>Host Tersedia</th>
                    <th>Kegunaan Umum</th>
                  </tr>
                </thead>
                <tbody id="cidr_table"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

@push('scripts')
<script>
  // Build CIDR reference table
  const cidrData = [
    [32,'255.255.255.255',1,0,'Host Route (1 IP)'],
    [31,'255.255.255.254',2,0,'Point-to-Point Link'],
    [30,'255.255.255.252',4,2,'Point-to-Point (Router-Router)'],
    [29,'255.255.255.248',8,6,'Subnet kecil (6 host)'],
    [28,'255.255.255.240',16,14,'Subnet kecil (14 host)'],
    [27,'255.255.255.224',32,30,'Subnet sedang (30 host)'],
    [26,'255.255.255.192',64,62,'Subnet kantor kecil'],
    [25,'255.255.255.128',128,126,'Subnet sedang'],
    [24,'255.255.255.0',256,254,'Jaringan LAN standar (Class C)'],
    [23,'255.255.254.0',512,510,'2 x /24 subnet'],
    [22,'255.255.252.0',1024,1022,'RT-RW Net medium'],
    [21,'255.255.248.0',2048,2046,'ISP blok kecil'],
    [20,'255.255.240.0',4096,4094,'ISP blok medium'],
    [16,'255.255.0.0',65536,65534,'Jaringan besar (Class B)'],
    [12,'255.240.0.0',1048576,1048574,'APIPA / RFC1918 172.16/12'],
    [8,'255.0.0.0',16777216,16777214,'Jaringan sangat besar (Class A)'],
  ];

  window.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('cidr_table');
    cidrData.forEach(([prefix, mask, total, hosts, usage]) => {
      const wild = mask.split('.').map(o => 255 - parseInt(o)).join('.');
      tbody.innerHTML += `<tr>
        <td><code class="text-primary fw-bold">/${prefix}</code></td>
        <td><code>${mask}</code></td>
        <td><code>${wild}</code></td>
        <td class="text-center">${total.toLocaleString('id-ID')}</td>
        <td class="text-center fw-semibold text-success">${hosts.toLocaleString('id-ID')}</td>
        <td class="text-muted">${usage}</td>
      </tr>`;
    });
  });

  function toggleInputMode() {
    const m = document.getElementById('input_mode').value;
    document.getElementById('cidr_input').classList.toggle('d-none', m !== 'cidr');
    document.getElementById('mask_input').classList.toggle('d-none', m !== 'mask');
  }

  function setPreset(val) {
    document.getElementById('input_mode').value = 'cidr';
    toggleInputMode();
    document.getElementById('cidr_value').value = val;
    calculate();
  }

  function autoCalculate() {
    const mode = document.getElementById('input_mode').value;
    if (mode === 'cidr') {
      const v = document.getElementById('cidr_value').value;
      if (v.includes('/') && v.split('/')[0].split('.').length === 4) calculate();
    } else {
      const ip = document.getElementById('ip_value').value;
      const mask = document.getElementById('mask_value').value;
      if (ip.split('.').length === 4 && mask.split('.').length === 4) calculate();
    }
  }

  function ipToNum(ip) {
    const parts = ip.split('.').map(Number);
    if (parts.length !== 4 || parts.some(p => isNaN(p) || p < 0 || p > 255)) return null;
    return (parts[0]<<24|parts[1]<<16|parts[2]<<8|parts[3]) >>> 0;
  }

  function numToIp(n) {
    return [(n>>>24)&255,(n>>>16)&255,(n>>>8)&255,n&255].join('.');
  }

  function prefixToMask(prefix) {
    return prefix === 0 ? 0 : (0xFFFFFFFF << (32 - prefix)) >>> 0;
  }

  function maskToPrefix(maskNum) {
    let n = maskNum, count = 0;
    while (n) { count += n & 1; n >>>= 1; }
    return count;
  }

  function ipClass(firstOctet) {
    if (firstOctet < 128) return 'A';
    if (firstOctet < 192) return 'B';
    if (firstOctet < 224) return 'C';
    if (firstOctet < 240) return 'D (Multicast)';
    return 'E (Reserved)';
  }

  function isPrivate(ip) {
    if (ip.startsWith('10.')) return true;
    if (ip.startsWith('192.168.')) return true;
    const p = ip.split('.').map(Number);
    if (p[0] === 172 && p[1] >= 16 && p[1] <= 31) return true;
    return false;
  }

  function calculate() {
    const errorEl = document.getElementById('error_msg');
    const resultEl = document.getElementById('result_area');
    errorEl.classList.add('d-none');

    try {
      const mode = document.getElementById('input_mode').value;
      let ipNum, prefix, maskNum;

      if (mode === 'cidr') {
        const raw = document.getElementById('cidr_value').value.trim();
        if (!raw.includes('/')) throw new Error('Format salah. Gunakan notasi CIDR, contoh: 192.168.1.0/24');
        const [ipStr, prefStr] = raw.split('/');
        prefix = parseInt(prefStr);
        if (isNaN(prefix) || prefix < 0 || prefix > 32) throw new Error('Prefix harus antara 0 dan 32.');
        ipNum = ipToNum(ipStr);
        if (ipNum === null) throw new Error('Format IP Address tidak valid.');
        maskNum = prefixToMask(prefix);
      } else {
        const ipStr   = document.getElementById('ip_value').value.trim();
        const maskStr = document.getElementById('mask_value').value.trim();
        ipNum   = ipToNum(ipStr);
        maskNum = ipToNum(maskStr);
        if (ipNum === null) throw new Error('Format IP Address tidak valid.');
        if (maskNum === null) throw new Error('Format Subnet Mask tidak valid.');

        // Validasi subnet mask harus berupa bit kontigu (111...000)
        const inverted = (~maskNum) >>> 0;
        if ((inverted & (inverted + 1)) !== 0) {
          throw new Error('Subnet Mask tidak valid (bit 1 harus kontigu, contoh: 255.255.255.0).');
        }
        prefix = maskToPrefix(maskNum);
      }

      const networkNum   = (ipNum & maskNum) >>> 0;
      const broadcastNum = (networkNum | (~maskNum >>> 0)) >>> 0;
      const wildNum      = (~maskNum >>> 0);
      const totalHosts   = prefix === 32 ? 1 : prefix === 31 ? 2 : Math.pow(2, 32 - prefix);
      const usableHosts  = prefix >= 31 ? totalHosts : totalHosts - 2;
      const firstHost    = prefix >= 31 ? networkNum : networkNum + 1;
      const lastHost     = prefix >= 31 ? broadcastNum : broadcastNum - 1;

      const networkIp   = numToIp(networkNum);
      const broadcastIp = numToIp(broadcastNum);
      const maskIp      = numToIp(maskNum);
      const wildcardIp  = numToIp(wildNum);
      const firstIp     = numToIp(firstHost);
      const lastIp      = numToIp(lastHost);
      const inputIp     = numToIp(ipNum);
      const ipCls       = ipClass(networkNum >>> 24);
      const priv        = isPrivate(networkIp);

      const rows = [
        ['IP Address Input', `<code class="text-primary">${inputIp}</code>`],
        ['Network Address', `<code class="fw-bold text-dark">${networkIp}</code>`],
        ['Subnet Mask', `<code>${maskIp}</code>`],
        ['Prefix Length', `<code class="text-success fw-bold">/${prefix}</code>`],
        ['Wildcard Mask', `<code>${wildcardIp}</code>`],
        ['Broadcast Address', `<code class="text-danger">${broadcastIp}</code>`],
        ['First Host', `<code class="text-success">${firstIp}</code>`],
        ['Last Host', `<code class="text-success">${lastIp}</code>`],
        ['Total IP', `<strong>${totalHosts.toLocaleString('id-ID')}</strong>`],
        ['Host Tersedia', `<strong class="text-success">${usableHosts.toLocaleString('id-ID')}</strong>`],
        ['Class IP', `<span class="badge bg-info text-dark">${ipCls}</span>`],
        ['Tipe', `<span class="badge ${priv ? 'bg-warning text-dark' : 'bg-secondary'}">${priv ? 'Private (RFC 1918)' : 'Public'}</span>`],
        ['CIDR', `<code class="fw-bold text-primary">${networkIp}/${prefix}</code>`],
      ];

      let html = '<div class="table-responsive"><table class="table table-sm table-bordered align-middle small mb-0">';
      rows.forEach(([label, val]) => {
        html += `<tr><td class="fw-semibold text-muted bg-light" style="width:40%">${label}</td><td>${val}</td></tr>`;
      });
      html += '</table></div>';

      // Binary representation
      const toBin = n => n.toString(2).padStart(8,'0');
      const ipParts = ipNum ? [(ipNum>>>24)&255,(ipNum>>>16)&255,(ipNum>>>8)&255,ipNum&255] : [0,0,0,0];
      const maskParts = [(maskNum>>>24)&255,(maskNum>>>16)&255,(maskNum>>>8)&255,maskNum&255];
      html += `<div class="mt-3 p-3 bg-dark rounded-3">
        <p class="text-white-50 small mb-1 fw-semibold">Binary Representation:</p>
        <code class="text-success" style="font-size:0.72rem;word-break:break-all">
          IP:   ${ipParts.map(toBin).join('.')}<br>
          Mask: ${maskParts.map(toBin).join('.')}<br>
          Net:  ${[(networkNum>>>24)&255,(networkNum>>>16)&255,(networkNum>>>8)&255,networkNum&255].map(toBin).join('.')}
        </code>
      </div>`;

      resultEl.innerHTML = html;

    } catch(err) {
      errorEl.textContent = err.message;
      errorEl.classList.remove('d-none');
      document.getElementById('result_area').innerHTML = `<div class="text-center text-muted py-4"><i class="fas fa-exclamation-circle fa-2x mb-3 text-danger opacity-50"></i><p class="small">Perbaiki input terlebih dahulu.</p></div>`;
    }
  }
</script>
@endpush

@endsection
