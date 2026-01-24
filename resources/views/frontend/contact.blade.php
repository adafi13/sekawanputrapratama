@extends('frontend.layouts.app')

@section('title', 'Hubungi Kami - Sekawan Putra Pratama')

@section('content')

<section class="position-relative py-5 overflow-hidden" style="background-color: #0F172A; border-bottom: 1px solid rgba(255,255,255,0.05);">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="opacity: 0.1; background-image: radial-gradient(#94a3b8 1px, transparent 1px); background-size: 40px 40px;">
    </div>

    <div class="container py-5 position-relative" style="z-index: 2;">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 col-md-10">
                
                <div class="mb-4">
                    <span class="d-inline-block py-2 px-4 rounded-pill bg-primary bg-opacity-10 text-white border border-primary border-opacity-25 small fw-bold text-uppercase spacing-1">
                        <i class="fas fa-circle text-success me-2 small"></i> Open for Projects
                    </span>
                </div>

                <h1 class="display-4 fw-bold text-white mb-4" style="line-height: 1.2;">
                    Mari Bangun Sesuatu yang <br>
                    <span style="color: #60A5FA;">Luar Biasa</span> Bersama Kami
                </h1>

                <div class="lead text-secondary mb-5 mx-auto d-flex justify-content-center align-items-center flex-wrap" 
                 style="max-width: 900px; min-height: 3.5rem; font-weight: 300; font-size: 1.25rem;">
                 <span class="fw-bold text-primary position-relative text-center" id="typewriter-text"></span>
                  <span class="typing-cursor">|</span>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    .spacing-1 {
        letter-spacing: 1px;
    }
</style>

<section class="contact-section py-5 bg-light">
    <div class="container mt-n5 position-relative z-3">
        <div class="row g-4 g-lg-5">
            
            {{-- Contact Info Cards (Left Side) --}}
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="pe-lg-3">
                    <div class="mb-5">
                        <h4 class="fw-bold mb-3 text-dark">Informasi Kontak</h4>
                        <p class="text-muted">Hubungi kami melalui saluran berikut. Kami akan merespons dalam waktu kurang dari 24 jam.</p>
                    </div>

                    <div class="card border-0 shadow-sm mb-3 hover-lift transition-all">
                        <div class="card-body p-4 d-flex align-items-center">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-envelope fa-lg"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-1 text-dark">Email</h6>
                                <a href="mailto:sekawanputrapratama@gmail.com" class="text-decoration-none text-secondary stretched-link">sekawanputrapratama@gmail.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-3 hover-lift transition-all">
                        <div class="card-body p-4 d-flex align-items-center">
                            <div class="flex-shrink-0 bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fab fa-whatsapp fa-lg"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-1 text-dark">WhatsApp / Telepon</h6>
                                <a href="https://wa.me/6285156412702" class="text-decoration-none text-secondary stretched-link">+62 851-5641-2702</a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4 hover-lift transition-all">
            <div class="card-body p-4 d-flex align-items-start">
                <div class="flex-shrink-0 bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center mt-1" style="width: 50px; height: 50px;">
                    <i class="fas fa-map-marker-alt fa-lg"></i>
                </div>
                <div class="ms-3">
                    <h6 class="fw-bold mb-1 text-dark">Lokasi Kantor</h6>
                    <p class="text-secondary mb-0 small">Perumahan Mega Regency, Blk. L5, No 23, Sukaragam, Kec. Serang Baru, Kabupaten Bekasi, Jawa Barat 17330</p>
                    
                    <a href="https://maps.app.goo.gl/CWZgdJDPenuBYPXi9" 
                       target="_blank" 
                       class="text-primary fw-bold small mt-2 d-inline-block text-decoration-none">
                        Buka di Google Maps <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

                    <div class="card border-0 shadow-sm overflow-hidden rounded-4">
                        <iframe 
                            src="https://www.google.com/maps?q=-6.3776515,107.1246921&z=18&output=embed"
                            width="100%" 
                            height="280" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            {{-- Contact Form (Right Side) --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-5 px-5 pb-0">
                        <h3 class="fw-bold text-dark">Kirim Pesan</h3>
                        <p class="text-muted small">Konsultasikan kebutuhan proyek Anda secara gratis.</p>
                    </div>
                    <div class="card-body p-5">
                        
                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center shadow-sm border-0 rounded-3 mb-4" role="alert">
                                <i class="fas fa-check-circle fs-4 me-3"></i>
                                <div>{{ session('success') }}</div>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger d-flex align-items-center shadow-sm border-0 rounded-3 mb-4" role="alert">
                                <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
                                <div>{{ session('error') }}</div>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-light border-0" name="company_name" id="company_name" placeholder="Nama Perusahaan" value="{{ old('company_name') }}" required>
                                        <label for="company_name" class="text-secondary">Nama Perusahaan</label>
                                    </div>
                                    @error('company_name')<small class="text-danger ps-2">{{ $message }}</small>@enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-light border-0" name="name" id="name" placeholder="Nama" value="{{ old('name') }}" required>
                                        <label for="name" class="text-secondary">Nama Lengkap (Kontak Person)</label>
                                    </div>
                                    @error('name')<small class="text-danger ps-2">{{ $message }}</small>@enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-light border-0" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                                        <label for="email" class="text-secondary">Alamat Email</label>
                                    </div>
                                    @error('email')<small class="text-danger ps-2">{{ $message }}</small>@enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-light border-0" name="phone" id="phone" placeholder="Telepon" value="{{ old('phone') }}" required>
                                        <label for="phone" class="text-secondary">Nomor WhatsApp</label>
                                    </div>
                                    @error('phone')<small class="text-danger ps-2">{{ $message }}</small>@enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-light border-0" name="service" id="service">
                                            <option value="" selected disabled>Pilih Layanan</option>
                                            <option value="Web Development" {{ old('service') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                            <option value="App Development" {{ old('service') == 'App Development' ? 'selected' : '' }}>App Development</option>
                                            <option value="Office Server" {{ old('service') == 'Office Server' ? 'selected' : '' }}>Office Server</option>
                                            <option value="Konsultasi" {{ old('service') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi IT</option>
                                        </select>
                                        <label for="service" class="text-secondary">Layanan Diminati</label>
                                    </div>
                                    @error('service')<small class="text-danger ps-2">{{ $message }}</small>@enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-light border-0" name="message" id="message" placeholder="Pesan" style="height: 150px" required>{{ old('message') }}</textarea>
                                        <label for="message" class="text-secondary">Ceritakan kebutuhan proyek Anda...</label>
                                    </div>
                                    @error('message')<small class="text-danger ps-2">{{ $message }}</small>@enderror
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-lg transition-all btn-hover-scale">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Pesan Sekarang
                                    </button>
                                    <p class="text-center text-muted mt-3" style="font-size: 0.8rem;">
                                        <i class="fas fa-lock me-1"></i> Privasi Anda terjamin aman.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Efek Hover Mengangkat Kartu */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }

    /* Input Focus Effect */
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        border: 1px solid #0d6efd !important;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1) !important;
    }

    /* Button Hover Effect */
    .btn-hover-scale:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px rgba(13, 110, 253, 0.25) !important;
    }
    
    .letter-spacing-1 {
        letter-spacing: 1px;
    }
</style>

<style>
    .typing-cursor {
        display: inline-block;
        width: 3px;
        height: 1.2em;
        background-color: #60A5FA;
        animation: blink 1s infinite;
        margin-left: 8px;
        vertical-align: middle;
    }
    #typewriter-text {
        color: #e2e8f0; /* Warna teks putih agak abu */
        text-shadow: 0 0 15px rgba(96, 165, 250, 0.4); /* Efek glow biru */
    }
    @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textElement = document.getElementById('typewriter-text');
        const phrases = [
        "Mitra Strategis Transformasi Digital Anda.",
        "Menghadirkan Solusi Teknologi yang Presisi.",
        "Wujudkan Ide Bisnis Menjadi Nyata Hari Ini."
        ];
        
        let phraseIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        
        function typeEffect() {
            const currentPhrase = phrases[phraseIndex];
            
            if (isDeleting) {
                textElement.textContent = currentPhrase.substring(0, charIndex - 1);
                charIndex--;
            } else {
                textElement.textContent = currentPhrase.substring(0, charIndex + 1);
                charIndex++;
            }
            
            // Kecepatan mengetik
            let typeSpeed = isDeleting ? 30 : 70; 

            if (!isDeleting && charIndex === currentPhrase.length) {
                isDeleting = true;
                typeSpeed = 2000; // Jeda 2 detik setelah kalimat selesai
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                phraseIndex = (phraseIndex + 1) % phrases.length;
                typeSpeed = 500; // Jeda sebentar sebelum ganti kalimat
            }
            
            setTimeout(typeEffect, typeSpeed);
        }
        
        typeEffect();
    });
</script>

@endsection