<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- SEO & Meta Tags --}}
    <title>{{ $title ?? 'Sekawan Putra Pratama - IT Consultant & Software House' }}</title>
    <meta name="description" content="{{ $description ?? 'Jasa Pembuatan Website, Aplikasi Android/iOS, dan Instalasi Server Kantor Terpercaya.' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Icons --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/media/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/media/favicon.png') }}">

    {{-- CSS Libraries --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/video-js.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/nice-select.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <style>
        /* --- CSS KHUSUS AGAR RAPI DI HP --- */
        
        /* 1. Header Responsif */
        .header-logo { height: 60px; width: auto; } /* Default Desktop */
        
        @media (max-width: 576px) {
            #main-header { height: 70px !important; padding: 0 10px; }
            .header-logo { height: 32px !important; } /* Perkecil logo di HP */
            
            /* Agar tombol Consult Now muat di HP */
            .header-btn {
                padding: 6px 12px !important;
                font-size: 11px !important; 
                margin-right: 8px;
            }
            .header-btn i { display: none; } /* Sembunyikan panah di tombol saat di HP */
            
            /* Jarak antar elemen footer di HP */
            .footer-widget h5 { font-size: 16px; margin-bottom: 15px; }
            .footer-links li a { font-size: 14px; }
        }

        /* 2. Tombol WA Floating */
        .float-wa {
            position: fixed; bottom: 25px; right: 25px;
            width: 55px; height: 55px;
            background-color: #25d366; color: #fff;
            border-radius: 50%; text-align: center;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            z-index: 9999; text-decoration: none;
        }

        /* 3. Perbaikan Gallery & Hover (Bawaan) */
        .gallery-item { cursor: pointer; transition: transform 0.3s ease; position: relative; overflow: hidden; }
        .gallery-item:hover { transform: scale(1.05); }
        .gallery-item:hover img { filter: brightness(0.7); }
    </style>

    @stack('styles')
</head>

<body class="tt-smooth-scroll">

    {{-- Preloader --}}
    <div id="preloader">
        <div class="preloader-inner text-center">
            <img src="{{ asset('assets/media/logo_loading.png') }}" alt="Loading" class="preloader-logo" style="max-width: 150px;">
            <div class="loading-bar"></div>
        </div>
    </div>

    <div id="scroll-container">

        {{-- Header Navigation --}}
        <header id="main-header" style="height: 80px; display: flex; align-items: center;">
            <nav class="main-menu w-100">
                <div class="container-fluid px-lg-5 px-3">
                    <div class="main-menu__block d-flex align-items-center justify-content-between">

                        <div class="main-menu__logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/media/logo.png') }}" alt="Sekawan Putra Pratama" class="header-logo">
                            </a>
                        </div>

                        <div class="menu-button-right d-flex align-items-center">
                            {{-- Menu Desktop --}}
                            <div class="main-menu__nav d-none d-lg-block me-4">
                                <ul class="main-menu__list list-unstyled mb-0">
                                    @include('frontend.layouts.menu-links')
                                </ul>
                            </div>

                            <div class="main-menu__right d-flex align-items-center">
                                {{-- Tombol Consult Now (Dibuat Visible di HP: d-flex) --}}
                                <a class="header-btn d-flex align-items-center" href="{{ route('contact') }}">
                                    <span>Consult Now!</span>
                                    <i class="fas fa-arrow-right ms-2 small d-none d-sm-inline"></i>
                                </a>

                                {{-- Burger Menu --}}
                                <a href="#" class="main-menu__toggler mobile-nav__toggler ms-2 d-lg-none text-dark">
                                    <i class="fas fa-bars" style="font-size: 24px;"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="footer-modern">
            <div class="container">
                <div class="row">
                    {{-- Kolom 1: Logo & Info --}}
                    <div class="col-lg-4 col-md-12 mb-4">
                        <a href="{{ route('home') }}" class="d-block mb-4">
                            {{-- Fix: Logo diberi max-width agar tidak raksasa di HP --}}
                            <img src="{{ asset('assets/media/logo.png') }}" alt="Logo Footer" style="max-width: 200px; width: 100%;">
                        </a>
                        <p class="mb-4">
                            Sekawan Putra Pratama adalah mitra teknologi terpercaya Anda. Kami mengubah ide kompleks menjadi solusi digital yang sederhana.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="https://www.instagram.com/sekawanputrapratama?igsh=MTUxbjJiaXRsMHh6" 
                               class="text-white" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                        </div>
                    </div>

                    {{-- 
                       FIX RAPIH: Menggunakan 'col-6' pada Layanan & Tautan.
                       Ini membuat menu footer menjadi 2 kolom (kiri-kanan) di layar HP.
                    --}}
                    <div class="col-6 col-md-6 col-lg-2 mb-4">
                        <div class="footer-widget">
                            {{-- Text tetap 'Layanan Kami' --}}
                            <h5>Layanan Kami</h5>
                            <ul class="list-unstyled footer-links">
                                <li><a href="{{ route('services.index') }}">Web Development</a></li>
                                <li><a href="{{ route('services.index') }}">Mobile Apps (Android/iOS)</a></li>
                                <li><a href="{{ route('services.index') }}">Jaringan & Server</a></li>
                                <li><a href="{{ route('services.index') }}">Digital Marketing</a></li>
                                <li><a href="{{ route('services.index') }}">IT Consultant</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 col-lg-2 mb-4">
                        <div class="footer-widget">
                            <h5>Tautan Cepat</h5>
                            <ul class="list-unstyled footer-links">
                                <li><a href="{{ route('about') }}">Tentang</a></li>
                                <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
                                <li><a href="{{ route('blog.index') }}">Artikel</a></li>
                                <li><a href="{{ route('contact') }}">Kontak</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Kolom 4: Hubungi Kami --}}
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="footer-widget">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled footer-links">
                                <li class="d-flex align-items-start gap-2 mb-2">
                                    <i class="fas fa-map-marker-alt mt-1 text-primary"></i>
                                    <span>Perumahan Mega Regency, Blk. L5, No 23, Sukaragam, Bekasi</span>
                                </li>
                                <li class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-envelope text-primary"></i>
                                    <a href="mailto:sekawanputrapratama@gmail.com">sekawanputrapratama@gmail.com</a>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="fab fa-whatsapp text-primary"></i>
                                    <a href="https://wa.me/6285156412702">+62 851-5641-2702</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom text-center">
                    <p class="mb-0 small">&copy; {{ date('Y') }} <strong>Sekawan Putra Pratama</strong>. All rights reserved.</p>
                </div>
            </div>
        </footer>

    </div>

    {{-- Mobile Navigation --}}
    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
            <div class="logo-box">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/media/logo.png') }}" width="150" alt="Logo"></a>
            </div>
            <div class="mobile-nav__container">
                <ul class="main-menu__list">
                    @include('frontend.layouts.menu-links')
                </ul>
            </div>
            <ul class="mobile-nav__contact list-unstyled mt-4">
                 <li>
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <a href="mailto:sekawanputrapratama@gmail.com">Email Kami</a>
                </li>
                <li>
                    {{-- FIXED: Icon jadi WA, Link jadi WA.ME (bukan tel:) --}}
                    <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                    <a href="https://wa.me/6285156412702" target="_blank">WhatsApp Kami</a>
                </li>
            </ul>
            <div class="mobile-nav__social mt-4">
                <a href="https://www.instagram.com/sekawanputrapratama?igsh=MTUxbjJiaXRsMHh6" 
                   class="fab fa-instagram" target="_blank" rel="noopener noreferrer"></a>
            </div>
        </div>
    </div>

    {{-- WA Float --}}
    <a href="https://wa.me/6285156412702?text=Halo..." class="float-wa pulse-animation" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    {{-- Scripts --}}
    <script src="{{ asset('assets/js/vendor/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-validator.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/video.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        lightbox.option({ 'resizeDuration': 200, 'wrapAround': true });
    </script>
    @stack('scripts')
</body>
</html>