@extends('frontend.layouts.app')

@section('title', 'Syarat & Ketentuan Layanan (Terms of Service) - PT Sekawan Putra Pratama')
@section('meta_description', 'Syarat dan Ketentuan Layanan resmi PT Sekawan Putra Pratama untuk layanan pembuatan website, aplikasi mobile, dan konsultan IT.')

@section('content')
<section class="py-5 text-white" style="background: linear-gradient(135deg, #050b14 0%, #0f172a 100%);">
    <div class="container py-4 text-center">
        <span class="badge bg-primary bg-opacity-20 text-info border border-info border-opacity-30 rounded-pill px-3 py-2 mb-3">
            <i class="fas fa-file-contract me-1"></i> Terms of Service
        </span>
        <h1 class="display-5 fw-bold mb-2 text-white">Syarat & Ketentuan Layanan</h1>
        <p class="text-white-50 small mb-0">Terakhir diperbarui: 21 Juli 2026</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container" style="max-width: 900px;">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5 text-muted leading-relaxed" style="font-size: 15.5px; line-height: 1.8;">
                <p>Selamat datang di <strong class="text-dark">PT Sekawan Putra Pratama</strong>. Dengan mengakses website ini atau menggunakan layanan pengembangan software dan konsultan IT kami, Anda setuju untuk terikat oleh Syarat dan Ketentuan berikut:</p>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">1. Ruang Lingkup Layanan</h5>
                <p>PT Sekawan Putra Pratama menyediakan layanan jasa teknologi meliputi pembuatan website profesional, aplikasi mobile (Android/iOS), instalasi server & jaringan kantor, digital marketing, serta konsultasi IT enterprise.</p>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">2. Perjanjian Kerja Sama & Pembayaran</h5>
                <ul class="mb-0">
                    <li class="mb-2">Setiap proyek pekerjaan akan diatur secara mendetail melalui Surat Penawaran Resmi (Quotation) dan Kontrak Perjanjian (MoU) yang disepakati kedua belah pihak.</li>
                    <li class="mb-2">Pembayaran dilakukan secara bertahap sesuai termin yang disepakati (Down Payment/DP, Termin Progress, dan Pelunasan).</li>
                    <li>Pekerjaan akan dimulai setelah pembayaran DP awal diterima secara resmi.</li>
                </ul>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">3. Hak Kekayaan Intelektual (IP Rights)</h5>
                <p>Setelah pelunasan pembayaran dilakukan secara penuh, seluruh hak cipta dan kepemilikan kode sumber (*source code*) serta aset desain proyek akan dialihkan sepenuhnya kepada Klien, kecuali modul lisensi pihak ketiga yang telah ditentukan.</p>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">4. Garansi & Pemeliharaan (SLA)</h5>
                <p>Kami memberikan garansi bebas bug (*bug-free guarantee*) secara gratis untuk jangka waktu tertentu setelah tanggal serah terima proyek (BAST). Layanan dukungan teknis tambahan di luar masa garansi diatur dalam paket Service Level Agreement (SLA).</p>

                <h5 class="fw-bold text-dark mt-5 mb-3 border-bottom pb-2">5. Perubahan Ketentuan</h5>
                <p>Kami berhak untuk mengubah atau memperbarui Syarat dan Ketentuan ini sewaktu-waktu. Perubahan akan berlaku secara efektif setelah dipublikasikan di halaman ini.</p>
            </div>
        </div>
    </div>
</section>
@endsection
