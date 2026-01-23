@extends('frontend.layouts.app')

@section('content')
<section class="py-5 text-center position-relative overflow-hidden">
    <div class="container py-5">
        <span class="badge rounded-pill bg-primary mb-3 px-3 py-2">#1 IT Solution Partner</span>
        <h1 class="display-3 fw-bold mb-4">Hentikan Masalah IT, <br> <span class="text-primary">Fokuslah Pada Pertumbuhan Bisnis Anda.</span></h1>
        <p class="lead text-secondary mb-5 mx-auto" style="max-width: 800px;">
            Kami membangun sistem digital yang bekerja untuk Anda. Mulai dari Website Premium, Aplikasi Mobile yang Stabil, hingga Infrastruktur Server yang Tidak Pernah Tidur.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('/contact') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow">Mulai Konsultasi Gratis</a>
            <a href="#services" class="btn btn-outline-light btn-lg px-5 rounded-pill">Lihat Layanan Kami</a>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="h1 fw-bold">Mengapa Bisnis Besar Mempercayakan IT Mereka Kepada Kami?</h2>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-6 mb-4">
                        <h4 class="text-primary fw-bold mb-1">Keamanan Prioritas</h4>
                        <p class="small text-secondary text-justify">Data Anda adalah aset paling berharga. Kami melindunginya dengan enkripsi standar industri.</p>
                    </div>
                    <div class="col-6 mb-4">
                        <h4 class="text-primary fw-bold mb-1">Dukungan 24/7</h4>
                        <p class="small text-secondary text-justify">Tim ahli kami selalu siaga memastikan operasional bisnis Anda tidak terganggu semenit pun.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="py-5">
    <div class="container text-center mb-5">
        <h2 class="fw-bold">Solusi yang Kami Tawarkan</h2>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card bg-secondary bg-opacity-10 border-0 h-100 p-4 rounded-4">
                <img src="{{ asset('assets/media/images/web-development.png') }}" class="mb-4 rounded" alt="Web">
                <h3>Web Development</h3>
                <p class="text-secondary small">Website bukan sekadar pajangan. Kami buatkan mesin penjual otomatis untuk bisnis Anda.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary bg-opacity-10 border-0 h-100 p-4 rounded-4 shadow-sm" style="transform: scale(1.05); border: 1px solid #0d6efd !important;">
                <img src="{{ asset('assets/media/images/app-development.png') }}" class="mb-4 rounded" alt="App">
                <h3>App Development</h3>
                <p class="text-secondary small">Android & iOS. Aplikasi yang ringan, cepat, dan membuat pelanggan betah bertransaksi.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary bg-opacity-10 border-0 h-100 p-4 rounded-4 text-justify">
                <img src="{{ asset('assets/media/images/office-server.png') }}" class="mb-4 rounded" alt="Server">
                <h3>Office Server</h3>
                <p class="text-secondary small">Optimalkan kolaborasi tim dengan infrastruktur server lokal atau cloud yang super aman.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="bg-primary rounded-5 p-5 text-center">
            <h2 class="fw-bold mb-3">Siap Untuk Membuat Perubahan?</h2>
            <p class="mb-4">Jangan biarkan kompetitor mendahului Anda. Konsultasikan ide Anda sekarang.</p>
            <a href="https://wa.me/6285156412702" class="btn btn-light btn-lg px-5 rounded-pill fw-bold text-primary">Chat Via WhatsApp</a>
        </div>
    </div>
</section>
@endsection