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
                                <a href="https://maps.app.goo.gl/CWZgdJDPenuBYPXi9" target="_blank" class="text-primary fw-bold small mt-2 d-inline-block text-decoration-none">
                                    Buka di Google Maps <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm overflow-hidden rounded-4">
                        <iframe 
                            src="https://www.google.com/maps?q=-6.3776515,107.1246921&z=18&output=embed"
                            width="100%" height="280" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

            {{-- Contact Form (Right Side) --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-5 px-5 pb-2 position-relative">
                        <div class="position-absolute top-0 start-0 bg-primary" style="width: 5px; height: 100%;"></div>
                        <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -1px;">Kirim Pesan</h3>
                        <p class="text-muted small">Konsultasikan kebutuhan proyek Anda secara <span class="text-primary fw-bold">Gratis</span>.</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5 pt-3">
                        {{-- Alert Messages --}}
                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center border-0 shadow-sm rounded-4 mb-4 animate-fade-in" role="alert" style="background: #ecfdf5; color: #065f46;">
                                <i class="fas fa-check-circle fs-4 me-3"></i>
                                <div class="small fw-medium">{{ session('success') }}</div>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger d-flex align-items-center border-0 shadow-sm rounded-4 mb-4 animate-fade-in" role="alert" style="background: #fef2f2; color: #991b1b;">
                                <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
                                <div class="small fw-medium">{{ session('error') }}</div>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                {{-- Nama Perusahaan --}}
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="company_name" class="form-label-small">Nama Perusahaan</label>
                                        <div class="input-group-modern">
                                            <span class="input-icon"><i class="far fa-building"></i></span>
                                            <input type="text" name="company_name" id="company_name" class="form-control-modern" placeholder="PT. Maju Jaya" value="{{ old('company_name') }}" required>
                                        </div>
                                        @error('company_name')<small class="text-danger mt-1 d-block small">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                {{-- Nama Lengkap --}}
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="name" class="form-label-small">Nama Lengkap</label>
                                        <div class="input-group-modern">
                                            <span class="input-icon"><i class="far fa-user"></i></span>
                                            <input type="text" name="name" id="name" class="form-control-modern" placeholder="Nama Anda" value="{{ old('name') }}" required>
                                        </div>
                                        @error('name')<small class="text-danger mt-1 d-block small">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="email" class="form-label-small">Alamat Email</label>
                                        <div class="input-group-modern">
                                            <span class="input-icon"><i class="far fa-envelope"></i></span>
                                            <input type="email" name="email" id="email" class="form-control-modern" placeholder="email@perusahaan.com" value="{{ old('email') }}" required>
                                        </div>
                                        @error('email')<small class="text-danger mt-1 d-block small">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                {{-- WhatsApp --}}
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="phone" class="form-label-small">Nomor WhatsApp</label>
                                        <div class="input-group-modern">
                                            <span class="input-icon"><i class="fab fa-whatsapp"></i></span>
                                            <input type="text" name="phone" id="phone" class="form-control-modern" placeholder="0812xxxx" value="{{ old('phone') }}" required>
                                        </div>
                                        @error('phone')<small class="text-danger mt-1 d-block small">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                {{-- Layanan --}}
                                <div class="col-12">
                                    <div class="form-group-custom">
                                        <label for="service" class="form-label-small">Layanan Yang Diminati</label>
                                        <select class="form-select-modern" name="service" id="service" required>
                                            <option value="" selected disabled>Pilih salah satu layanan...</option>
                                            <option value="Web Development" {{ old('service') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                            <option value="App Development" {{ old('service') == 'App Development' ? 'selected' : '' }}>App Development</option>
                                            <option value="Office Server" {{ old('service') == 'Office Server' ? 'selected' : '' }}>Office Server</option>
                                            <option value="Konsultasi" {{ old('service') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi IT</option>
                                        </select>
                                        @error('service')<small class="text-danger mt-1 d-block small">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                {{-- Pesan --}}
                                <div class="col-12">
                                    <div class="form-group-custom">
                                        <label for="message" class="form-label-small">Detail Kebutuhan</label>
                                        <textarea class="form-control-modern" name="message" id="message" placeholder="Ceritakan proyek Anda..." style="height: 120px" required>{{ old('message') }}</textarea>
                                        @error('message')<small class="text-danger mt-1 d-block small">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-glow hover-up transition-all">
                                        Kirim Pesan Sekarang <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                    <p class="text-center text-muted mt-3 small mb-0">
                                        <i class="fas fa-lock me-1"></i> Privasi Anda terjamin aman. Tim kami membalas dalam <span class="text-dark fw-bold">1x24 Jam</span>.
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
    /* Styling Dasar & Utilities */
    .spacing-1 { letter-spacing: 1px; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08); }
    .rounded-5 { border-radius: 2rem !important; }
    .transition-all { transition: all 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
    .hover-up:hover { transform: translateY(-3px); }
    .shadow-glow:hover { box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4) !important; }

    /* Custom Form Styling */
    .form-group-custom { margin-bottom: 0.5rem; }
    .form-label-small {
        font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
        color: #64748b; letter-spacing: 0.5px; margin-left: 0.5rem; margin-bottom: 0.4rem; display: block;
    }
    .input-group-modern { position: relative; display: flex; align-items: center; }
    .input-icon { position: absolute; left: 1.25rem; color: #94a3b8; z-index: 10; font-size: 0.9rem; }
    .form-control-modern, .form-select-modern {
        width: 100%; padding: 0.8rem 1rem 0.8rem 3rem; background-color: #f8fafc;
        border: 1.5px solid #f1f5f9; border-radius: 1rem; color: #1e293b; font-size: 0.95rem; transition: all 0.3s ease;
    }
    .form-select-modern { padding-left: 1.25rem; cursor: pointer; }
    .form-control-modern:focus, .form-select-modern:focus {
        background-color: #fff; border-color: #3b82f6; outline: none; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    /* Typewriter & Cursor Animation */
    .typing-cursor { display: inline-block; width: 3px; height: 1.2em; background-color: #60A5FA; animation: blink 1s infinite; margin-left: 8px; vertical-align: middle; }
    #typewriter-text { color: #e2e8f0; text-shadow: 0 0 15px rgba(96, 165, 250, 0.4); }
    @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.5s ease-in-out; }
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
            
            let typeSpeed = isDeleting ? 30 : 70; 
            if (!isDeleting && charIndex === currentPhrase.length) {
                isDeleting = true;
                typeSpeed = 2000;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                phraseIndex = (phraseIndex + 1) % phrases.length;
                typeSpeed = 500;
            }
            setTimeout(typeEffect, typeSpeed);
        }
        typeEffect();
    });
</script>

@endsection