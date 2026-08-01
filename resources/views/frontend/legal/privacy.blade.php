@extends('frontend.layouts.app')

@section('title', 'Kebijakan Privasi (Privacy Policy) - PT Sekawan Putra Pratama')
@section('meta_description', 'Kebijakan Privasi resmi PT Sekawan Putra Pratama yang menjelaskan perlindungan data pribadi pengguna dan klien sesuai Undang-Undang Perlindungan Data Pribadi (UU PDP).')

@section('content')
<section class="text-white" style="background: linear-gradient(135deg, #050b14 0%, #0f172a 100%); padding-top: 135px !important; padding-bottom: 55px !important;">
    <div class="container py-4 text-center">
        <span class="badge bg-primary bg-opacity-20 text-info border border-info border-opacity-30 rounded-pill px-3 py-2 mb-3">
            <i class="fas fa-shield-alt me-1"></i> Legal & Compliance
        </span>
        <h1 class="display-5 fw-bold mb-2 text-white">Kebijakan Privasi (Privacy Policy)</h1>
        <p class="text-white-50 small mb-0">Terakhir diperbarui: 21 Juli 2026</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container" style="max-width: 900px;">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5 text-muted leading-relaxed" style="font-size: 15.5px; line-height: 1.8;">
                <p>PT Sekawan Putra Pratama ("Kami", "Perusahaan") berkomitmen penuh untuk melindungi privasi dan keamanan data pribadi pelanggan, calon klien, serta pengunjung website <strong class="text-dark">https://sekawanputrapratama.com</strong> sesuai dengan regulasi Undang-Undang Perlindungan Data Pribadi (UU PDP) yang berlaku di Indonesia.</p>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">1. Informasi yang Kami Kumpulkan</h5>
                <p>Kami mengumpulkan informasi pribadi yang Anda berikan secara sukarela saat menggunakan website atau layanan kami, meliputi:</p>
                <ul class="mb-0">
                    <li class="mb-2"><strong class="text-dark">Data Identitas & Kontak:</strong> Nama lengkap, alamat email, nomor telepon/WhatsApp, nama perusahaan, serta alamat kantor.</li>
                    <li class="mb-2"><strong class="text-dark">Data Kebutuhan Proyek:</strong> Informasi spesifikasi teknis, estimasi anggaran, serta berkas/dokumen proyek yang dikirimkan melalui formulir kontak atau kalkulator.</li>
                    <li><strong class="text-dark">Data Teknis & Penggunaan:</strong> Alamat IP, jenis browser, perangkat, lokasi geografis umum, serta aktivitas navigasi melalui cookie & Google Analytics.</li>
                </ul>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">2. Penggunaan Informasi</h5>
                <p>Data yang kami kumpulkan digunakan secara eksklusif untuk tujuan bisnis resmi:</p>
                <ul class="mb-0">
                    <li class="mb-2">Merespon permintaan konsultasi, penawaran harga (quotation), serta pertanyaan seputar layanan IT.</li>
                    <li class="mb-2">Mengelola komunikasi pengerjaan proyek, penagihan invoice, serta pemeliharaan sistem.</li>
                    <li class="mb-2">Mengirimkan pembaharuan produk, berita teknologi, atau newsletter (hanya jika Anda mendaftar).</li>
                    <li>Meningkatkan kualitas antarmuka, keamanan, dan performa website kami.</li>
                </ul>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">3. Perlindungan & Keamanan Data</h5>
                <p>Kami menerapkan standar keamanan teknis dan organisasi yang ketat, termasuk enkripsi SSL/TLS, proteksi firewall server, serta pembatasan akses data hanya kepada personel yang berwenang demi mencegah akses tidak sah, kebocoran, atau penyalahgunaan data.</p>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">4. Penggunaan Cookie & Teknologi Pelacakan (Cookie Policy)</h5>
                <p>Website kami menggunakan cookie dan teknologi serupa untuk meningkatkan pengalaman navigasi Anda. Cookie adalah file teks kecil yang disimpan di perangkat Anda saat mengunjungi situs web kami.</p>
                <p><strong class="text-dark">Jenis cookie yang kami gunakan:</strong></p>
                <ul>
                    <li class="mb-2"><strong class="text-dark">Cookie Esensial (Wajib):</strong> Diperlukan agar fungsi dasar website seperti keamanan SSL, navigasi halaman, dan perlindungan formulir bekerja dengan baik. Cookie ini tidak dapat dinonaktifkan.</li>
                    <li class="mb-2"><strong class="text-dark">Cookie Analitis & Performa:</strong> Membantu kami mengumpulkan informasi anonim mengenai statistik jumlah pengunjung dan halaman favorit menggunakan Google Analytics.</li>
                    <li><strong class="text-dark">Cookie Pemasaran & Preferensi:</strong> Digunakan untuk mengingat preferensi Anda serta menampilkan konten promo/iklan yang relevan.</li>
                </ul>
                <p>Anda dapat mengubah atau menarik persetujuan cookie Anda kapan saja melalui menu <a href="javascript:void(0)" onclick="openCookieSettings()" class="text-primary fw-bold">Pengaturan Cookie</a> di bagian bawah (footer) website ini.</p>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">5. Pengungkapan Kepada Pihak Ketiga</h5>
                <p>Kami <strong class="text-dark">TIDAK PERNAH menjual, menyewakan, atau memperdagangkan</strong> data pribadi Anda kepada pihak ketiga manapun untuk tujuan pemasaran. Pengungkapan data hanya dilakukan jika diwajibkan oleh hukum atau putusan pengadilan yang sah di Republik Indonesia.</p>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">6. Hak Pemilik Data</h5>
                <p>Sebagai pemilik data pribadi, Anda memiliki hak penuh untuk meminta akses, koreksi, atau penghapusan data pribadi Anda dari database kami kapan saja dengan menghubungi tim kami.</p>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">7. Hubungi Kami</h5>
                <p>Jika Anda memiliki pertanyaan seputar Kebijakan Privasi ini, silakan hubungi kami di:</p>
                <div class="p-4 bg-light rounded-4 border mt-3">
                    <div class="mb-2"><i class="fas fa-building text-primary me-2"></i><strong class="text-dark">PT Sekawan Putra Pratama</strong></div>
                    <div class="mb-2"><i class="fas fa-envelope text-primary me-2"></i>Email: admin@sekawanputrapratama.com</div>
                    <div class="mb-2"><i class="fab fa-whatsapp text-success me-2"></i>WhatsApp: +62 851-5641-2702</div>
                    <div><i class="fas fa-map-marker-alt text-danger me-2"></i>Alamat: Bekasi, Jawa Barat, Indonesia</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
