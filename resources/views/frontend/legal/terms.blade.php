@extends('frontend.layouts.app')

@section('title', 'Syarat & Ketentuan Layanan (Terms of Service) - PT Sekawan Putra Pratama')
@section('meta_description', 'Syarat dan Ketentuan Layanan resmi PT Sekawan Putra Pratama untuk layanan pembuatan website, aplikasi mobile, dan konsultan IT.')

@section('content')
<section class="py-5 text-white" style="background: linear-gradient(135deg, #050b14 0%, #0f172a 100%);">
    <div class="container py-4 text-center">
        <span class="badge bg-primary bg-opacity-20 text-info border border-info border-opacity-30 rounded-pill px-3 py-2 mb-3">
            <i class="fas fa-file-contract me-1"></i> Terms of Service
        </span>
        <h1 class="display-5 fw-bold mb-2">Syarat & Ketentuan Layanan</h1>
        <p class="text-white-50 small mb-0">Terakhir diperbarui: 21 Juli 2026</p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container" style="max-width: 860px;">
        <div class="content-body text-muted leading-relaxed" style="font-size: 15px; line-height: 1.8;">
            <p>Selamat datang di <strong>PT Sekawan Putra Pratama</strong>. Dengan mengakses website ini atau menggunakan layanan pengembangan software dan konsultan IT kami, Anda setuju untuk terikat oleh Syarat dan Ketentuan berikut:</p>

            <h4 class="fw-bold text-dark mt-4 mb-3">1. Ruang Lingkup Layanan</h4>
            <p>PT Sekawan Putra Pratama menyediakan layanan jasa teknologi meliputi pembuatan website profesional, aplikasi mobile (Android/iOS), instalasi server & jaringan kantor, digital marketing, serta konsultasi IT enterprise.</p>

            <h4 class="fw-bold text-dark mt-4 mb-3">2. Perjanjian Kerja Sama & Pembayaran</h4>
            <ul>
                <li>Setiap proyek pekerjaan akan diatur secara mendetail melalui Surat Penawaran Resmi (Quotation) dan Kontrak Perjanjian (MoU) yang disepakati kedua belah pihak.</li>
                <li>Pembayaran dilakukan secara bertahap sesuai termin yang disepakati (Down Payment/DP, Termin Progress, dan Pelunasan).</li>
                <li>Pekerjaan akan dimulai setelah pembayaran DP awal diterima secara resmi.</li>
            </ul>

            <h4 class="fw-bold text-dark mt-4 mb-3">3. Hak Kekayaan Intelektual (IP Rights)</h4>
            <p>Setelah pelunasan pembayaran dilakukan secara penuh, seluruh hak cipta dan kepemilikan kode sumber (*source code*) serta aset desain proyek akan dialihkan sepenuhnya kepada Klien, kecuali modul lisensi pihak ketiga yang telah ditentukan.</p>

            <h4 class="fw-bold text-dark mt-4 mb-3">4. Garansi & Pemeliharaan (SLA)</h4>
            <p>Kami memberikan garansi bebas bug (*bug-free guarantee*) secara gratis untuk jangka waktu tertentu setelah tanggal serah terima proyek (BAST). Layanan dukungan teknis tambahan di luar masa garansi diatur dalam paket Service Level Agreement (SLA).</p>

            <h4 class="fw-bold text-dark mt-4 mb-3">5. Perubahan Ketentuan</h4>
            <p>Kami berhak untuk mengubah atau memperbarui Syarat dan Ketentuan ini sewaktu-waktu. Perubahan akan berlaku secara efektif setelah dipublikasikan di halaman ini.</p>
        </div>
    </div>
</section>
@endsection
