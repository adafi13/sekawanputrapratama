<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kontrak {{ $contract->contract_number }}</title>
    <style>
        /* --- PAGE SETTINGS (A4 RESMI) --- */
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
            border-bottom: 3px double #000; 
            padding-bottom: 15px; 
        }
        .logo { 
            height: 60px; 
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

        /* --- PARTIES TABLE --- */
        .parties-wrapper { margin-top: 20px; margin-bottom: 20px; }
        table.parties { width: 100%; margin-bottom: 15px; }
        table.parties td { vertical-align: top; padding: 2px 0; }
        .party-role { font-weight: bold; font-style: italic; margin-bottom: 5px; margin-top: 15px; }
        .label { width: 120px; }
        .colon { width: 20px; text-align: center; }

        /* --- ARTICLES / PASAL --- */
        .article { margin-bottom: 15px; }
        .article-title { 
            font-weight: bold; 
            text-transform: uppercase; 
            margin-bottom: 5px; 
            display: block; 
            text-align: center; /* Pasal ditengah untuk kesan formal */
            margin-top: 25px;
        }
        ol { padding-left: 25px; margin: 0; }
        li { margin-bottom: 5px; padding-left: 5px; }
        ul { margin-top: 5px; padding-left: 20px; list-style-type: circle; }

        /* --- SIGNATURES --- */
        .sig-table { width: 100%; margin-top: 50px; text-align: center; page-break-inside: avoid; }
        .sig-role { font-size: 9pt; margin-bottom: 80px; } /* Space Tanda Tangan */
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
        
        <div class="title">PERJANJIAN KERJASAMA PENGEMBANGAN SISTEM</div>
        <div class="subtitle">NOMOR: {{ $contract->contract_number }}</div>
    </div>

    @php
        \Carbon\Carbon::setLocale('id');
        $contractDate = \Carbon\Carbon::parse($contract->start_date);
    @endphp

    <p>Pada hari ini, <strong>{{ $contractDate->translatedFormat('l') }}</strong>, tanggal <strong>{{ $contractDate->translatedFormat('d F Y') }}</strong>, bertempat di {{ $company['city'] ?? 'Jakarta' }}, yang bertanda tangan di bawah ini:</p>

    <div class="parties-wrapper">
        <div class="party-role">I. PIHAK PERTAMA (PENGEMBANG)</div>
        <table class="parties">
            <tr>
                <td class="label">Nama Perusahaan</td>
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

        <div class="party-role">II. PIHAK KEDUA (KLIEN)</div>
        <table class="parties">
            <tr>
                <td class="label">Nama Instansi</td>
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
    </div>

    <p>PIHAK PERTAMA dan PIHAK KEDUA secara bersama-sama disebut sebagai "PARA PIHAK". PARA PIHAK sepakat untuk mengikatkan diri dalam Perjanjian Kerjasama dengan ketentuan sebagai berikut:</p>

    <div class="article">
        <span class="article-title">PASAL 1: RUANG LINGKUP PEKERJAAN</span>
        <ol>
            <li>PIHAK PERTAMA berkewajiban melaksanakan pekerjaan pengembangan perangkat lunak untuk proyek: <strong>{{ $contract->project->name ?? 'Custom Software' }}</strong>.</li>
            <li>Spesifikasi teknis, fitur, dan modul yang dikerjakan merujuk sepenuhnya pada dokumen <strong>Quotation No. #{{ $quotation->quotation_number ?? 'Terlampir' }}</strong> yang telah disetujui PIHAK KEDUA.</li>
            <li>Pekerjaan di luar spesifikasi tersebut akan dianggap sebagai permintaan tambahan (<em>Change Request</em>) dan diatur dalam pasal terpisah.</li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 2: JANGKA WAKTU</span>
        <ol>
            <li>Jangka waktu pelaksanaan pekerjaan adalah <strong>{{ $contract->estimated_duration ?? ($contract->start_date && $contract->end_date ? \Carbon\Carbon::parse($contract->start_date)->diffInDays(\Carbon\Carbon::parse($contract->end_date)) : 90) }} Hari Kerja</strong>.</li>
            <li>Waktu tersebut terhitung sejak PIHAK PERTAMA menerima pembayaran tahap pertama (<em>Down Payment</em>) dan data pendukung lengkap dari PIHAK KEDUA.</li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 3: BIAYA DAN TATA CARA PEMBAYARAN</span>
        <ol>
            <li>Total nilai kontrak pekerjaan yang disepakati adalah sebesar <strong>Rp {{ number_format($calculations['grand_total'], 0, ',', '.') }}</strong>.</li>
            <li>Pembayaran dilakukan secara bertahap (termin) melalui transfer ke rekening Bank resmi milik PIHAK PERTAMA dengan jadwal sebagai berikut:
                <ul>
                    @foreach($calculations['payment_terms'] as $term)
                        <li><strong>{{ $term['description'] }} ({{ $term['percentage'] }}%)</strong> sebesar Rp {{ number_format($term['amount'], 0, ',', '.') }}</li>
                    @endforeach
                </ul>
            </li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 4: PERUBAHAN LINGKUP KERJA (CHANGE REQUEST)</span>
        <ol>
            <li>Apabila dalam masa pengerjaan PIHAK KEDUA menghendaki adanya penambahan fitur, perubahan alur, atau revisi desain di luar lingkup Pasal 1, maka wajib dituangkan dalam formulir <em>Change Request</em>.</li>
            <li>PIHAK PERTAMA berhak mengajukan biaya tambahan dan penambahan waktu pengerjaan atas permintaan tersebut.</li>
            <li>Pekerjaan tambahan hanya akan dilaksanakan setelah adanya kesepakatan biaya secara tertulis (Adendum).</li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 5: HAK KEKAYAAN INTELEKTUAL & SOURCE CODE</span>
        <ol>
            <li>Hak kepemilikan atas <em>Source Code</em> aplikasi sepenuhnya beralih menjadi milik PIHAK KEDUA setelah seluruh kewajiban pembayaran (100%) lunas.</li>
            <li>Selama pembayaran belum lunas, PIHAK PERTAMA berhak membatasi akses, menahan source code, atau menutup akses server sementara.</li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 6: KERAHASIAAN INFORMASI (NDA)</span>
        <ol>
            <li>PARA PIHAK sepakat untuk menjaga kerahasiaan seluruh data perusahaan, database pelanggan, dan strategi bisnis yang dipertukarkan selama proyek berlangsung.</li>
            <li>Kewajiban kerahasiaan ini tetap berlaku meskipun perjanjian kerjasama ini telah berakhir.</li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 7: GARANSI & PEMELIHARAAN</span>
        <ol>
            <li>PIHAK PERTAMA memberikan masa garansi (Retensi) perbaikan <em>bug/error</em> selama <strong>{{ $contract->warranty_period ?? 30 }} hari</strong> kalender setelah Berita Acara Serah Terima (BAST).</li>
            <li>Garansi tidak mencakup kerusakan yang diakibatkan oleh: kelalaian pengguna (human error), virus/malware, kegagalan server pihak ketiga, atau modifikasi kode yang dilakukan oleh pihak lain selain PIHAK PERTAMA.</li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 8: PEMUTUSAN PERJANJIAN</span>
        <ol>
            <li>PIHAK KEDUA berhak membatalkan proyek secara sepihak sebelum proyek selesai.</li>
            <li>Apabila terjadi pembatalan sepihak oleh PIHAK KEDUA, maka dana yang telah dibayarkan (DP/Termin berjalan) <strong>tidak dapat dikembalikan (Non-Refundable)</strong> sebagai kompensasi atas waktu dan sumber daya yang telah dialokasikan PIHAK PERTAMA.</li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 9: KEADAAN KAHAR (FORCE MAJEURE)</span>
        <ol>
            <li>Yang dimaksud dengan Force Majeure adalah kejadian di luar kendali PARA PIHAK seperti bencana alam, huru-hara, kebakaran, atau gangguan infrastruktur global yang menghalangi pelaksanaan proyek.</li>
            <li>Jika terjadi Force Majeure, pihak yang terdampak wajib memberitahukan secara tertulis maksimal 7 hari setelah kejadian untuk musyawarah penyesuaian jadwal.</li>
        </ol>
    </div>

    <div class="article">
        <span class="article-title">PASAL 10: PENYELESAIAN PERSELISIHAN</span>
        <p>Segala perselisihan yang timbul akan diselesaikan secara musyawarah untuk mufakat. Apabila tidak tercapai kata sepakat, maka akan diselesaikan melalui jalur hukum yang berlaku di wilayah hukum Panitera Pengadilan Negeri domisili PIHAK PERTAMA.</p>
    </div>

    <div class="sig-table">
        <p style="margin-bottom: 30px; font-style: italic;">Demikian Perjanjian ini dibuat rangkap 2 (dua) bermaterai cukup yang memiliki kekuatan hukum sama.</p>
        <table style="width: 100%;">
            <tr>
                <td width="50%">
                    <div class="sig-role">PIHAK PERTAMA (Pengembang)</div>
                    <div class="sig-name">{{ strtoupper($contract->vendor_signer_name ?? 'DIREKTUR UTAMA') }}</div>
                </td>
                <td width="50%">
                    <div class="sig-role">PIHAK KEDUA (Klien)</div>
                    <div class="sig-name">{{ strtoupper($contract->customer->contact_person ?? $contract->customer->contact_name ?? 'PIMPINAN') }}</div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>