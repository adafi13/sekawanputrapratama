@extends('frontend.layouts.app')

@section('title', 'Cek IP & DNS Lookup Domain - Tool Diagnostik IT - PT Sekawan Putra Pratama')
@section('meta_description', 'Lakukan pengecekan DNS Record (A, MX, TXT, NS, CNAME) dan Geolocation Alamat IP domain secara real-time dengan tool gratis PT Sekawan Putra Pratama.')

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Tools', 'url' => route('tools.speedtest')],
    ['name' => 'DNS Lookup & Cek IP', 'url' => route('tools.dns-lookup')],
]])

@section('content')

<style>
  .dns-page { background: #0a0a0a; min-height: 100vh; padding-top: 100px; color: #fff; }

  /* Search bar */
  .dns-search { max-width: 680px; margin: 0 auto; }
  .dns-input-wrap {
    display: flex; gap: 0; background: #141414; border: 1px solid #222; border-radius: 12px;
    overflow: hidden; transition: border-color 0.2s;
  }
  .dns-input-wrap:focus-within { border-color: #3b82f6; }
  .dns-input {
    flex: 1; background: transparent; border: none; color: #fff; padding: 16px 20px;
    font-family: 'Inter', monospace; font-size: 15px; font-weight: 500; outline: none;
  }
  .dns-input::placeholder { color: #444; }
  .dns-select {
    background: #1a1a1a; border: none; border-left: 1px solid #222; color: #888;
    font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 600; padding: 0 16px;
    outline: none; cursor: pointer; -webkit-appearance: none; min-width: 100px; text-align: center;
  }
  .dns-select option { background: #1a1a1a; color: #ccc; }
  .dns-go {
    background: #fff; color: #000; border: none; padding: 0 28px; font-family: 'Inter', sans-serif;
    font-size: 13px; font-weight: 700; letter-spacing: 0.5px; cursor: pointer; transition: opacity 0.2s;
    white-space: nowrap;
  }
  .dns-go:hover { opacity: 0.8; }
  .dns-go:disabled { opacity: 0.3; cursor: not-allowed; }

  /* Results */
  .dns-results { max-width: 680px; margin: 0 auto; }
  .dns-result-header {
    display: flex; align-items: baseline; justify-content: space-between;
    padding-bottom: 16px; border-bottom: 1px solid #1a1a1a; margin-bottom: 0;
  }
  .dns-domain { font-family: 'Inter', monospace; font-size: 28px; font-weight: 800; color: #fff; letter-spacing: -1px; }
  .dns-type-tag {
    font-family: 'Inter', monospace; font-size: 11px; font-weight: 700; color: #3b82f6;
    background: rgba(59,130,246,0.1); padding: 4px 12px; border-radius: 4px; letter-spacing: 1px;
  }

  /* Table */
  .dns-table { width: 100%; border-collapse: collapse; }
  .dns-table th {
    font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 600; color: #444;
    text-transform: uppercase; letter-spacing: 1.5px; padding: 14px 0; border-bottom: 1px solid #1a1a1a;
    text-align: left;
  }
  .dns-table td {
    font-family: 'Inter', monospace; font-size: 13px; color: #999; padding: 14px 0;
    border-bottom: 1px solid #111;
  }
  .dns-table td:last-child { color: #3b82f6; font-weight: 600; }
  .dns-table tr:last-child td { border-bottom: none; }

  .dns-empty {
    text-align: center; padding: 48px 0; color: #333;
    font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 500;
  }

  @media (max-width: 576px) {
    .dns-input-wrap { flex-wrap: wrap; }
    .dns-input { width: 100%; }
    .dns-select { border-left: none; border-top: 1px solid #222; padding: 12px 16px; flex: 1; }
    .dns-go { padding: 14px 20px; flex: 1; }
    .dns-domain { font-size: 20px; }
    .dns-result-header { flex-direction: column; gap: 8px; }
  }
</style>

<div class="dns-page">
  <div class="container">

    {{-- Top label --}}
    <div class="text-center mb-5 pt-4">
      <a href="{{ route('home') }}" class="text-decoration-none" style="font-size: 12px; color: #333; font-weight: 600; letter-spacing: 1px;">
        SEKAWAN PUTRA PRATAMA
      </a>
      <span style="color: #222; margin: 0 8px;">·</span>
      <span style="font-size: 12px; color: #555; font-weight: 500; letter-spacing: 1px;">DNS LOOKUP</span>
    </div>

    {{-- Title --}}
    <div class="text-center mb-5">
      <h1 style="font-family: 'Inter', sans-serif; font-size: clamp(28px, 5vw, 42px); font-weight: 800; color: #fff; letter-spacing: -1.5px; margin-bottom: 12px;">
        Cek DNS Record
      </h1>
      <p style="font-family: 'Inter', sans-serif; font-size: 14px; color: #444; max-width: 480px; margin: 0 auto; line-height: 1.6;">
        Periksa A, MX, NS, TXT, CNAME, atau AAAA record dari domain mana pun melalui resolver DNS publik Google.
      </p>
    </div>

    {{-- Search --}}
    <div class="dns-search mb-5">
      <form id="dnsForm" onsubmit="dnsLookup(event)">
        <div class="dns-input-wrap">
          <input type="text" id="domainInput" class="dns-input" placeholder="ketik domain, misal: sekawanputrapratama.com" required>
          <select id="recordType" class="dns-select">
            <option value="A">A</option>
            <option value="MX">MX</option>
            <option value="NS">NS</option>
            <option value="TXT">TXT</option>
            <option value="AAAA">AAAA</option>
            <option value="CNAME">CNAME</option>
          </select>
          <button type="submit" class="dns-go" id="btnLookup">Lookup</button>
        </div>
      </form>
    </div>

    {{-- Results --}}
    <div class="dns-results mb-5 pb-5 d-none" id="resultsWrap">
      <div class="dns-result-header mb-3">
        <span class="dns-domain" id="resDomain">—</span>
        <span class="dns-type-tag" id="resType">A</span>
      </div>

      <table class="dns-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Type</th>
            <th>TTL</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody id="dnsBody">
        </tbody>
      </table>

      <div class="dns-empty d-none" id="dnsEmpty">
        Tidak ditemukan record untuk domain ini.
      </div>
    </div>

  </div>
</div>

@push('scripts')
<script>
function dnsLookup(e) {
  e.preventDefault();
  const domain = document.getElementById('domainInput').value.trim().replace(/^https?:\/\//, '').replace(/\/.*$/, '');
  const type = document.getElementById('recordType').value;
  const btn = document.getElementById('btnLookup');
  const wrap = document.getElementById('resultsWrap');
  const body = document.getElementById('dnsBody');
  const empty = document.getElementById('dnsEmpty');

  if (!domain) return;

  btn.disabled = true;
  btn.textContent = '...';

  fetch(`https://dns.google/resolve?name=${encodeURIComponent(domain)}&type=${type}`)
    .then(r => r.json())
    .then(data => {
      btn.disabled = false;
      btn.textContent = 'Lookup';

      document.getElementById('resDomain').textContent = domain;
      document.getElementById('resType').textContent = type;
      wrap.classList.remove('d-none');
      body.innerHTML = '';

      if (data.Answer && data.Answer.length > 0) {
        empty.classList.add('d-none');
        data.Answer.forEach(ans => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${ans.name || domain}</td>
            <td>${type}</td>
            <td>${ans.TTL}s</td>
            <td>${ans.data}</td>
          `;
          body.appendChild(tr);
        });
      } else {
        empty.classList.remove('d-none');
      }
    })
    .catch(() => {
      btn.disabled = false;
      btn.textContent = 'Lookup';
      alert('Gagal mengambil data DNS. Pastikan domain benar.');
    });
}
</script>
@endpush

@endsection
