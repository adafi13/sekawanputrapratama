<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    {{-- SEO & Meta Tags --}}
    <title>{{ $title ?? 'Sekawan Putra Pratama - IT Consultant & Software House' }}</title>
    <meta name="description" content="{{ $description ?? 'Jasa Pembuatan Website, Aplikasi Android/iOS, dan Instalasi Server Kantor Terpercaya. Solusi IT Terintegrasi untuk bisnis Anda di Bekasi & Jakarta.' }}">
    <meta name="keywords" content="{{ $keywords ?? 'Jasa Web Bekasi, App Developer, IT Consultant, Server Kantor, Sekawan Putra Pratama, Software House Indonesia' }}">
    <meta name="author" content="Sekawan Putra Pratama">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Social Media Sharing --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Sekawan Putra Pratama - Solusi IT Terintegrasi' }}">
    <meta property="og:description" content="{{ $description ?? 'Konsultasikan kebutuhan digital Anda: Web, Apps, & Server.' }}">
    <meta property="og:image" content="{{ asset('assets/media/logo1.png') }}">
    <meta property="og:site_name" content="Sekawan Putra Pratama">

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
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    
    {{-- Custom Styles for Modern Layout --}}
    <style>
        /* =========================================
           1. MODERN PRELOADER (Logo Pulse)
           ========================================= */
        #preloader {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ffffff; z-index: 99999;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
        }
        
        .preloader-inner { position: relative; }
        
        /* Logo Animation */
        .preloader-logo {
            width: 100px; /* Ukuran Logo saat loading */
            animation: breathe 2s ease-in-out infinite;
        }

        /* Garis Loading di bawah logo */
        .loading-bar {
            width: 150px; height: 3px; background: #f0f0f0;
            margin-top: 20px; border-radius: 3px; overflow: hidden;
        }
        .loading-bar::after {
            content: ''; display: block; width: 40%; height: 100%;
            background: #0d6efd; /* Warna Primary */
            animation: loading-slide 1s infinite linear;
        }

        @keyframes breathe {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }

        @keyframes loading-slide {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(250%); }
        }

        /* =========================================
           2. MODERN NAVBAR / HEADER
           ========================================= */
        header {
            padding: 20px 0;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        /* Sticky State (Saat di-scroll) */
        header.sticky {
            padding: 10px 0;
            position: fixed; top: 0; width: 100%; z-index: 1000;
            background: rgba(255, 255, 255, 0.9); /* Lebih transparan dikit */
            backdrop-filter: blur(20px); /* Blur lebih kuat (Glassmorphism) */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Menu Links Animation */
        .main-menu__list li a {
            font-weight: 500;
            color: #333;
            position: relative;
            padding: 5px 0;
            transition: color 0.3s ease;
        }

        .main-menu__list li a:hover,
        .main-menu__list li a.active {
            color: #0d6efd; /* Warna Primary */
        }

        /* Garis bawah animasi saat hover */
        .main-menu__list li a::after {
            content: ''; position: absolute; width: 0; height: 2px;
            bottom: 0; left: 0; background-color: #0d6efd;
            transition: width 0.3s ease;
        }

        .main-menu__list li a:hover::after,
        .main-menu__list li a.active::after {
            width: 100%;
        }

        /* Button Header Style */
        .header-btn {
            background: #0d6efd; color: white;
            padding: 10px 25px; border-radius: 50px;
            font-weight: 600; font-size: 14px;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
            transition: all 0.3s ease;
            text-decoration: none !important;
        }
        .header-btn:hover {
            background: #0b5ed7; transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.4); color: white;
        }

        /* =========================================
           3. FLOATING WA & FOOTER
           ========================================= */
        .float-wa {
            position: fixed; width: 60px; height: 60px; bottom: 30px; right: 30px;
            background-color: #25d366; color: #FFF; border-radius: 50%;
            text-align: center; font-size: 30px; box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            z-index: 9999; display: flex; align-items: center; justify-content: center;
            text-decoration: none; transition: all 0.3s ease;
        }
        .float-wa:hover { background-color: #128C7E; transform: translateY(-5px); color: #FFF; }
        
        .pulse-animation { animation: pulse-green 2s infinite; }
        
        @keyframes pulse-green {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        /* Footer */
        .footer-modern { background-color: #0F172A; color: #94a3b8; padding-top: 80px; }
        .footer-widget h5 { color: #fff; font-weight: 700; margin-bottom: 25px; font-size: 1.2rem; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: #94a3b8; text-decoration: none; transition: 0.3s; }
        .footer-links a:hover { color: #60A5FA; padding-left: 5px; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding: 25px 0; margin-top: 50px; }

        @media (max-width: 767px) {
            .float-wa { width: 50px; height: 50px; bottom: 20px; right: 20px; font-size: 24px; }
            header { padding: 15px 0; }
        }
    </style>
    @stack('styles')
</head>

<body class="tt-smooth-scroll">
    
    {{-- 1. Modern Preloader --}}
    <div id="preloader">
        <div class="preloader-inner text-center">
            <img src="{{ asset('assets/media/logo.png') }}" alt="Sekawan Putra Pratama" class="preloader-logo">
            <div class="loading-bar"></div>
        </div>
    </div>

    <div id="scroll-container">
        
        {{-- 2. Header Navigation Modern --}}
        <header id="main-header">
            <nav class="main-menu">
                <div class="container-fluid px-lg-5">
                    <div class="main-menu__block d-flex align-items-center justify-content-between">
                        
                        <div class="main-menu__logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/media/logo.png') }}" alt="Sekawan Putra Pratama" class="header-logo" style="height: 50px;">
                            </a>
                        </div>
                        
                        <div class="menu-button-right d-flex align-items-center">
                            <div class="main-menu__nav d-none d-lg-block me-4">
                                <ul class="main-menu__list d-flex gap-4 list-unstyled mb-0">
                                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                                    <li><a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Layanan</a></li>
                                    <li><a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfolio</a></li>
                                    <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a></li>
                                </ul>
                            </div>
                            
                            <div class="main-menu__right d-flex align-items-center">
                                <a class="header-btn d-sm-flex d-none align-items-center" href="{{ route('contact') }}">
                                    <span>Konsultasi Gratis</span>
                                    <i class="fas fa-arrow-right ms-2 small"></i>
                                </a>
                                
                                <a href="#" class="main-menu__toggler mobile-nav__toggler ms-3 d-lg-none">
                                    <img src="{{ asset('assets/media/vector/menu.png') }}" alt="Menu" style="width: 24px;">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </nav>
        </header>

        {{-- Main Content --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer Modern --}}
        <footer class="footer-modern">
            <div class="container">
                <div class="row">
                    {{-- Kolom 1: Tentang Perusahaan --}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="{{ route('home') }}" class="d-block mb-4">
                             {{-- Logo Footer --}}
                            <img src="{{ asset('assets/media/ft-logo.png') }}" alt="Logo Footer" style="height: 50px;">
                        </a>
                        <p class="mb-4">
                            Sekawan Putra Pratama adalah mitra teknologi terpercaya Anda. Kami mengubah ide kompleks menjadi solusi digital yang sederhana, efisien, dan berdampak bagi pertumbuhan bisnis.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>

                    {{-- Kolom 2: Layanan --}}
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="footer-widget">
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

                    {{-- Kolom 3: Link Cepat --}}
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="footer-widget">
                            <h5>Tautan Cepat</h5>
                            <ul class="list-unstyled footer-links">
                                <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                                <li><a href="{{ route('portfolio.index') }}">Portfolio Proyek</a></li>
                                <li><a href="{{ route('blog.index') }}">Artikel & Berita</a></li>
                                <li><a href="{{ route('contact') }}">Hubungi Kami</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Kolom 4: Info Kontak --}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-widget">
                            <h5>Hubungi Kami</h5>
                            <ul class="list-unstyled footer-links">
                                <li class="d-flex align-items-start gap-2">
                                    <i class="fas fa-map-marker-alt mt-1 text-primary"></i>
                                    <span>Perumahan Mega Regency, Blk. L5, No 23, Sukaragam, Bekasi, Jawa Barat 17330</span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
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

                {{-- Copyright --}}
                <div class="footer-bottom text-center">
                    <p class="mb-0 small">&copy; {{ date('Y') }} <strong>Sekawan Putra Pratama</strong>. All rights reserved.</p>
                </div>
            </div>
        </footer>

    </div>

    {{-- Mobile Navigation (Offcanvas) --}}
    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
            <div class="logo-box">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/media/logo.png') }}" alt="Logo"></a>
            </div>
            <div class="mobile-nav__container">
                <ul class="main-menu__list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('services.index') }}">Services</a></li>
                    <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <ul class="mobile-nav__contact list-unstyled">
                <li><i class="fas fa-envelope"></i> <a href="mailto:sekawanputrapratama@gmail.com">sekawanputrapratama@gmail.com</a></li>
                <li><i class="fa fa-phone-alt"></i> <a href="tel:+6285156412702">+62 851-5641-2702</a></li>
            </ul>
            <div class="mobile-nav__social mt-4">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin-in"></a>
            </div>
        </div>
    </div>

    {{-- WhatsApp Float Button --}}
    <a href="https://wa.me/6285156412702?text=Halo%20Sekawan%20Putra%20Pratama,%20saya%20tertarik%20untuk%20konsultasi%20proyek." 
       class="float-wa pulse-animation" target="_blank" aria-label="Chat WhatsApp" title="Hubungi Kami via WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    {{-- JavaScript --}}
    <script src="{{ asset('assets/js/vendor/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-validator.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/video.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{-- Scripts Tambahan --}}
    <script>
        // Preloader Handler with Fade Out Effect
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if(preloader) {
                setTimeout(() => {
                    preloader.style.transition = 'opacity 0.6s ease';
                    preloader.style.opacity = '0';
                    setTimeout(() => preloader.style.display = 'none', 600);
                }, 1000); // Tahan loading sedikit biar logo terlihat
            }
        });

        // Sticky Header Script
        $(window).scroll(function() {
            if ($(this).scrollTop() > 30) {
                $('#main-header').addClass('sticky');
            } else {
                $('#main-header').removeClass('sticky');
            }
        });
    </script>

    @stack('scripts')

</body>
</html>