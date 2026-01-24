<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kontrak Managed Service {{ $contract->contract_number }}</title>
    <style>
        @page { margin: 3cm 2.5cm; }
        body { 
            font-family: 'Times New Roman', serif; 
            font-size: 12pt; 
            line-height: 1.6; 
            color: #000; 
        }
        
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 3px solid #000; 
            padding-bottom: 15px; 
        }
        .logo { max-width: 80px; margin-bottom: 10px; }
        .title { 
            font-size: 14pt; 
            font-weight: bold; 
            text-transform: uppercase; 
            margin: 10px 0; 
        }
        
        table.info { width: 100%; margin: 20px 0; }
        table.info td { padding: 5px; vertical-align: top; }
        .label { width: 150px; font-weight: bold; }
        .colon { width: 20px; text-align: center; }
        
        .article { margin: 25px 0; }
        .article-title { 
            font-weight: bold; 
            text-transform: uppercase; 
            margin: 20px 0 10px 0; 
            text-align: center;
        }
        
        ol { padding-left: 25px; }
        li { margin-bottom: 8px; }
        
        .sig-table { width: 100%; margin-top: 50px; }
        .sig-space { height: 80px; }
        .sig-name { 
            font-weight: bold; 
            text-decoration: underline; 
        }
        
        .highlight { 
            background-color: #f9f9f9; 
            padding: 10px; 
            border-left: 3px solid #333; 
            margin: 15px 0; 
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('assets/media/logo.png') }}" alt="Logo" class="logo">
        <div class="title">PERJANJIAN LISENSI & MANAGED SERVICE</div>
        <div style="font-weight: bold;">Nomor: {{ $contract->contract_number }}</div>
    </div>

    @php
        \Carbon\Carbon::setLocale('id');
        $contractDate = \Carbon\Carbon::parse($contract->start_date);
    @endphp

    <p style="margin: 20px 0;">
        Pada hari ini, <strong>{{ $contractDate->translatedFormat('l') }}</strong>, 
        tanggal <strong>{{ $contractDate->translatedFormat('d F Y') }}</strong>, 
        bertempat di Bekasi, yang bertanda tangan di bawah ini:
    </p>

    <div style="margin: 20px 0;">
        <div style="font-weight: bold; margin-bottom: 10px;">I. PIHAK PERTAMA (PENYEDIA LAYANAN)</div>
        <table class="info">
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
                <td class="label">Diwakili oleh</td>
                <td class="colon">:</td>
                <td>Direktur Utama</td>
            </tr>
        </table>

        <div style="font-weight: bold; margin: 20px 0 10px 0;">II. PIHAK KEDUA (KLIEN)</div>
        <table class="info">
            <tr>
                <td class="label">Nama Perusahaan</td>
                <td class="colon">:</td>
                <td><strong>{{ $contract->customer->company_name }}</strong></td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="colon">:</td>
                <td>{{ $contract->customer->address ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Diwakili oleh</td>
                <td class="colon">:</td>
                <td>{{ $contract->customer->contact_person }}</td>
            </tr>
        </table>
    </div>

    <p>Kedua belah pihak telah sepakat untuk mengadakan <strong>Perjanjian Lisensi & Managed Service</strong> dengan ketentuan dan syarat-syarat sebagai berikut:</p>

    <div class="article">
        <div class="article-title">PASAL 1: RUANG LINGKUP LAYANAN</div>
        <ol>
            <li>PIHAK PERTAMA menyediakan aplikasi/sistem <strong>{{ $contract->project->name ?? 'sesuai spesifikasi' }}</strong> berbasis lisensi kepada PIHAK KEDUA.</li>
            <li>Sistem yang disediakan merupakan properti PIHAK PERTAMA dan PIHAK KEDUA memperoleh hak penggunaan (license to use) sesuai periode yang disepakati.</li>
            <li>Layanan mencakup:
                <ul>
                    <li>Akses penuh terhadap sistem/aplikasi</li>
                    <li>Pemeliharaan dan update rutin</li>
                    <li>Dukungan teknis (technical support)</li>
                    <li>Monitoring dan troubleshooting</li>
                    <li>Backup data berkala</li>
                    @if($contract->deliverables)
                        <li>{{ $contract->deliverables }}</li>
                    @endif
                </ul>
            </li>
            <li>PIHAK KEDUA <strong>tidak berhak</strong> atas source code aplikasi. Source code tetap menjadi milik PIHAK PERTAMA.</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 2: JANGKA WAKTU LISENSI</div>
        <ol>
            <li>Lisensi berlaku mulai tanggal <strong>{{ \Carbon\Carbon::parse($contract->start_date)->translatedFormat('d F Y') }}</strong> 
                hingga <strong>{{ \Carbon\Carbon::parse($contract->end_date)->translatedFormat('d F Y') }}</strong> 
                ({{ $contract->estimated_duration ?? 365 }} hari).</li>
            <li>Perpanjangan lisensi dapat dilakukan dengan kesepakatan terpisah sebelum masa berlaku berakhir.</li>
            <li>Jika tidak ada perpanjangan, akses PIHAK KEDUA terhadap sistem akan dinonaktifkan setelah periode berakhir.</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 3: BIAYA LISENSI & MAINTENANCE</div>
        <div class="highlight">
            <strong>Biaya Lisensi Awal:</strong> Rp {{ number_format($contract->contract_value, 0, ',', '.') }}<br>
            <strong>Biaya Maintenance {{ $contract->maintenance_cycle === 'monthly' ? 'Bulanan' : 'Tahunan' }}:</strong> 
            Rp {{ number_format($contract->maintenance_fee, 0, ',', '.') }}
        </div>
        
        <ol>
            <li>Pembayaran lisensi awal dilakukan sesuai termin berikut:
                <ul>
                    @foreach($calculations['payment_terms'] as $index => $term)
                        <li><strong>{{ $term['description'] }}</strong>: 
                            {{ $term['percentage'] }}% = Rp {{ number_format($term['amount'], 0, ',', '.') }}</li>
                    @endforeach
                </ul>
            </li>
            <li>Biaya maintenance dibayarkan {{ $contract->maintenance_cycle === 'monthly' ? 'setiap bulan' : 'setiap tahun' }} 
                untuk menjamin kelancaran layanan.</li>
            <li>Pembayaran dilakukan melalui transfer bank ke rekening yang ditentukan PIHAK PERTAMA.</li>
            <li>Keterlambatan pembayaran maintenance lebih dari 7 hari dapat mengakibatkan penangguhan layanan.</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 4: SERVICE LEVEL AGREEMENT (SLA)</div>
        <ol>
            <li><strong>Response Time:</strong> Maksimal 4 jam kerja untuk critical issues, 24 jam untuk non-critical.</li>
            <li><strong>Uptime:</strong> PIHAK PERTAMA menargetkan uptime 99% (tidak termasuk scheduled maintenance).</li>
            <li><strong>Support Hours:</strong> Senin - Jumat, 09:00 - 17:00 WIB (di luar jam dapat melalui email/ticket).</li>
            <li><strong>Scheduled Maintenance:</strong> Dilakukan di luar jam kerja dengan pemberitahuan 24 jam sebelumnya.</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 5: HAK KEKAYAAN INTELEKTUAL (HAKI)</div>
        <ol>
            <li>Seluruh hak cipta, paten, dan hak kekayaan intelektual atas sistem/aplikasi tetap menjadi milik PIHAK PERTAMA.</li>
            <li>PIHAK KEDUA dilarang melakukan:
                <ul>
                    <li>Reverse engineering, decompiling, atau membongkar source code</li>
                    <li>Menjual, menyewakan, atau mendistribusikan lisensi kepada pihak ketiga</li>
                    <li>Memodifikasi atau membuat karya turunan tanpa izin tertulis</li>
                </ul>
            </li>
            <li>Pelanggaran terhadap klausul ini dapat mengakibatkan pemutusan lisensi dan tuntutan hukum.</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 6: KERAHASIAAN DATA</div>
        <ol>
            <li>PIHAK PERTAMA wajib menjaga kerahasiaan data dan informasi PIHAK KEDUA yang tersimpan dalam sistem.</li>
            <li>Data tidak akan digunakan untuk kepentingan lain tanpa izin tertulis PIHAK KEDUA.</li>
            <li>Kewajiban kerahasiaan ini tetap berlaku setelah perjanjian berakhir.</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 7: GARANSI & BATASAN TANGGUNG JAWAB</div>
        <ol>
            <li>PIHAK PERTAMA memberikan garansi teknis selama <strong>{{ $contract->warranty_period }} hari</strong> 
                setelah go-live untuk bug fixing dan perbaikan sistem.</li>
            <li>Garansi tidak mencakup:
                <ul>
                    <li>Kesalahan pengguna (human error)</li>
                    <li>Modifikasi sistem oleh pihak ketiga</li>
                    <li>Force majeure (bencana alam, perang, dll)</li>
                    <li>Gangguan infrastruktur di luar kendali PIHAK PERTAMA</li>
                </ul>
            </li>
            <li>PIHAK PERTAMA tidak bertanggung jawab atas kehilangan data akibat kesalahan PIHAK KEDUA atau force majeure.</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 8: PERUBAHAN LAYANAN (CHANGE REQUEST)</div>
        <ol>
            <li>Setiap perubahan fitur atau penambahan layanan di luar ruang lingkup awal dikenakan biaya tambahan.</li>
            <li>Change request harus diajukan secara tertulis dan disepakati oleh kedua belah pihak.</li>
            <li>Biaya change request akan dihitung berdasarkan kompleksitas dan waktu pengerjaan.</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 9: PEMUTUSAN PERJANJIAN</div>
        <ol>
            <li>Perjanjian dapat diakhiri oleh salah satu pihak dengan pemberitahuan tertulis 30 hari sebelumnya.</li>
            <li>PIHAK PERTAMA berhak memutus perjanjian jika PIHAK KEDUA:
                <ul>
                    <li>Melakukan pelanggaran HAKI (Pasal 5)</li>
                    <li>Menunggak pembayaran maintenance lebih dari 30 hari</li>
                </ul>
            </li>
            <li>Dalam hal pemutusan, PIHAK KEDUA wajib menghentikan penggunaan sistem dan menghapus semua data.</li>
            <li>Biaya yang telah dibayarkan tidak dapat dikembalikan (non-refundable).</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 10: PENYELESAIAN PERSELISIHAN</div>
        <ol>
            <li>Setiap perselisihan yang timbul dari perjanjian ini akan diselesaikan secara musyawarah.</li>
            <li>Apabila musyawarah tidak mencapai kesepakatan, akan diselesaikan melalui jalur hukum di Pengadilan Negeri Bekasi.</li>
        </ol>
    </div>

    <div class="article">
        <div class="article-title">PASAL 11: KETENTUAN PENUTUP</div>
        <ol>
            <li>Perjanjian ini dibuat dalam 2 (dua) rangkap bermaterai cukup, masing-masing memiliki kekuatan hukum yang sama.</li>
            <li>Perjanjian ini berlaku sejak ditandatangani oleh kedua belah pihak.</li>
        </ol>
    </div>

    <table class="sig-table">
        <tr>
            <td style="width: 50%; text-align: center;">
                <div><strong>PIHAK PERTAMA</strong></div>
                <div><strong>{{ $company['name'] }}</strong></div>
                <div class="sig-space"></div>
                <div class="sig-name">_____________________</div>
                <div>Direktur Utama</div>
            </td>
            <td style="width: 50%; text-align: center;">
                <div><strong>PIHAK KEDUA</strong></div>
                <div><strong>{{ $contract->customer->company_name }}</strong></div>
                <div class="sig-space"></div>
                <div class="sig-name">{{ $contract->customer->contact_person }}</div>
                <div>{{ $contract->customer->position ?? 'Direktur/Pimpinan' }}</div>
            </td>
        </tr>
    </table>

</body>
</html>
