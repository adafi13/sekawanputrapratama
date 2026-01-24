<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>SPK {{ $contract->contract_number }}</title>
    <style>
        /* --- SETTING HALAMAN (A4 RESMI) --- */
        @page { margin: 2.5cm 2cm; }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 10pt; 
            line-height: 1.5; 
            color: #000; 
            text-align: justify;
        }

        /* --- UTILITIES --- */
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        
        /* --- HEADER (OFFICIAL STYLE) --- */
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 3px double #000; /* Garis ganda standar surat resmi */
            padding-bottom: 15px; 
        }
        .logo { 
            height: 60px; /* Ukuran fix agar tidak gepeng */
            width: auto;
            margin-bottom: 10px; 
        }
        .title { 
            font-size: 14pt; 
            font-weight: bold; 
            text-transform: uppercase; 
            letter-spacing: 1px;
            margin-bottom: 5px;
            text-decoration: underline; 
        }
        .subtitle { font-size: 10pt; font-weight: bold; }

        /* --- PARTIES TABLE (RAPIH) --- */
        .parties-wrapper { margin-top: 20px; margin-bottom: 20px; }
        table.parties { width: 100%; margin-bottom: 15px; }
        table.parties td { vertical-align: top; padding: 2px 0; }
        .party-role { font-weight: bold; font-style: italic; margin-bottom: 5px; margin-top: 15px; }
        .label { width: 120px; } /* Lebar label yang pas */
        .colon { width: 20px; text-align: center; }

        /* --- ARTICLES / PASAL --- */
        .article { margin-bottom: 15px; }
        .article-title { 
            font-weight: bold; 
            text-transform: uppercase; 
            margin-bottom: 5px; 
            display: block; 
            text-decoration: underline; /* Sub-judul digarisbawahi */
        }
        ol { padding-left: 25px; margin: 0; }
        li { margin-bottom: 5px; padding-left: 5px; }
        ul { margin-top: 5px; padding-left: 20px; list-style-type: circle; }

        /* --- SIGNATURES (SEJAJAR) --- */
        .sig-table { width: 100%; margin-top: 50px; text-align: center; page-break-inside: avoid; }
        .sig-role { font-size: 9pt; margin-bottom: 70px; } /* Ruang tanda tangan */
        .sig-name { font-weight: bold; text-decoration: underline; text-transform: uppercase; }
    </style>
</head>
<body>

    <div class="header">
        @if(isset($company['logo']) && $company['logo'])
            <img src="{{ public_path('storage/' . $company['logo']) }}" alt="Logo" class="logo">
        @else
            <div style="font-size:16pt; font-weight:800; margin-bottom:5px;">{{ $company['name'] }}</div>
        @endif
        
        <div class="title">SURAT PERINTAH KERJA (SPK)</div>
        <div class="subtitle">NOMOR: {{ $contract->contract_number }}</div>
    </div>

    @php
        \Carbon\Carbon::setLocale('id');
        $contractDate = \Carbon\Carbon::parse($contract->start_date);
    @endphp

    <p>Pada hari ini, <strong>{{ $contractDate->translatedFormat('l') }}</strong>, tanggal <strong>{{ $contractDate->translatedFormat('d F Y') }}</strong>, yang bertanda tangan di bawah ini:</p>

    <div class="parties-wrapper">
        <div class="party-role">I. PIHAK PERTAMA (PEMBERI KERJA)</div>
        <table class="parties">
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td><strong>{{ $contract->customer->company_name }}</strong></td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="colon">:</td>
                <td>{{ $contract->customer->address ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Diwakili Oleh</td>
                <td class="colon">:</td>
                <td>{{ $contract->customer->contact_person ?? $contract->customer->contact_name ?? '-' }}</td>
            </tr>
        </table>

        <div class="party-role">II. PIHAK KEDUA (PELAKSANA)</div>
        <table class="parties">
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td><strong>{{ $company['name'] }}</strong></td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="colon">:</td>
                <td>{{ $company['address'] }}</td>
            </tr>
            <tr>
                <td class="label">Diwakili Oleh</td>
                <td class="colon">:</td>
                <td>{{ $contract->vendor_signer_name ?? 'Direktur Utama' }}</td>
            </tr>
        </table>
    </div>

    <p>Kedua belah pihak sepakat untuk mengikatkan diri dalam perjanjian kerjasama dengan ketentuan sebagai berikut:</p>

    <div class="article">
        <span class="article-title">PASAL 1: LINGKUP PEKERJAAN</span>
        <ol>
            <li>PIHAK PERTAMA memberikan tugas kepada PIHAK KEDUA untuk melaksanakan pekerjaan: <strong>{{ $contract->project->name ?? 'Pengembangan Sistem' }}</strong>.</li>
            <li>Spesifikasi teknis pekerjaan mengacu pada dokumen Penawaran (Quotation) No. <strong>#{{ $quotation->quotation_number ?? '-' }}</strong> yang merupakan bagian tidak terpisahkan dari perjanjian ini.</li>
            <li>Waktu penyelesaian pekerjaan adalah <strong>{{ $contract->estimated_duration ?? ($contract->start_date && $contract->end_date ? \Carbon\Carbon::parse($contract->start_date)->diffInDays(\Carbon\Carbon::parse($contract->end_date)) : 90) }} Hari Kerja</strong> terhitung sejak pembayaran uang muka (DP) diterima.</li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 2: NILAI PEKERJAAN & PEMBAYARAN</span>
        <ol>
            <li>Total nilai pekerjaan yang disepakati adalah sebesar <strong>Rp {{ number_format($calculations['grand_total'], 0, ',', '.') }}</strong>.</li>
            <li>Pembayaran dilakukan secara bertahap (termin) melalui transfer bank ke rekening PIHAK KEDUA dengan jadwal sebagai berikut:
                <ul>
                    @foreach($calculations['payment_terms'] as $term)
                        <li>{{ $term['description'] }} ({{ $term['percentage'] }}%): <strong>Rp {{ number_format($term['amount'], 0, ',', '.') }}</strong></li>
                    @endforeach
                </ul>
            </li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 3: KETENTUAN LAIN</span>
        <ol>
            <li>PIHAK KEDUA memberikan garansi perbaikan <em>error/bug</em> selama <strong>{{ $contract->warranty_period ?? 14 }} ({{ \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower((new \NumberFormatter('id', \NumberFormatter::SPELLOUT))->format($contract->warranty_period ?? 14))) }}) hari</strong> kalender setelah serah terima pekerjaan.</li>
            <li>Penambahan fitur atau revisi di luar kesepakatan awal akan dikenakan biaya tambahan (Addendum).</li>
            <li>Hak cipta <em>source code</em> akan diserahkan sepenuhnya kepada PIHAK PERTAMA setelah pelunasan pembayaran 100%.</li>
        </ol>
    </div>

    <p style="margin-top: 20px;">Demikian Surat Perintah Kerja ini dibuat untuk dilaksanakan dengan penuh tanggung jawab.</p>

    <table class="sig-table">
        <tr>
            <td width="50%">
                <div class="sig-role">PIHAK PERTAMA (Pemberi Kerja)</div>
                <div class="sig-name">{{ strtoupper($contract->customer->contact_person ?? $contract->customer->contact_name ?? 'PIMPINAN') }}</div>
            </td>
            <td width="50%">
                <div class="sig-role">PIHAK KEDUA (Pelaksana)</div>
                <div class="sig-name">{{ strtoupper($contract->vendor_signer_name ?? 'DIREKTUR UTAMA') }}</div>
            </td>
        </tr>
    </table>

</body>
</html>