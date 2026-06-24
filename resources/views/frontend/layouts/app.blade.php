<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- SEO & Meta Tags --}}
    <title>@yield('title', 'PT Sekawan Putra Pratama - Jasa IT Terpercaya | Software House & IT Consultant')</title>
    <meta name="description" content="@yield('meta_description', 'Jasa pembuatan website profesional, aplikasi mobile Android/iOS, instalasi server & jaringan kantor. Software house terpercaya sejak 2015. Konsultasi GRATIS!')">
    <meta name="keywords" content="@yield('meta_keywords', 'jasa pembuatan website, software house, jasa IT, pembuatan aplikasi android, pembuatan aplikasi iOS, instalasi server, instalasi jaringan kantor, IT consultant, jasa IT terpercaya, web developer Indonesia')">
    <meta name="author" content="PT Sekawan Putra Pratama">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="google-site-verification" content="QA19JgfEL-FvNWKVq9ZEq3fxNp8iNpedmgrrMpUGuGM">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'PT Sekawan Putra Pratama - Solusi IT Terintegrasi & Terpercaya')">
    <meta property="og:description" content="@yield('og_description', 'Software house & IT consultant terpercaya. Jasa pembuatan website, aplikasi mobile, instalasi server & jaringan kantor. Konsultasi GRATIS!')">
    <meta property="og:image" content="@yield('og_image', asset('assets/media/logo.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="PT Sekawan Putra Pratama - Software House & IT Consultant">
    <meta property="og:site_name" content="PT Sekawan Putra Pratama">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('twitter_title', 'PT Sekawan Putra Pratama - Software House & IT Consultant')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Jasa IT terpercaya: Website, Aplikasi Mobile, Server & Jaringan. Konsultasi GRATIS!')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/media/logo.png'))">
    <meta name="twitter:image:alt" content="PT Sekawan Putra Pratama Logo">

    <script type="application/ld+json">
    @php
    echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'PT Sekawan Putra Pratama',
        'image' => asset('assets/media/logo.png'),
        '@id' => route('home'),
        'url' => route('home'),
        'telephone' => '+62-851-5641-2702',
        'priceRange' => 'Rp 5.000.000 - Rp 100.000.000',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Perumahan Mega Regency, Blk. L5, No 23',
            'addressLocality' => 'Bekasi',
            'postalCode' => '17156',
            'addressCountry' => 'ID'
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => -6.2088,
            'longitude' => 106.8456
        ],
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens' => '09:00',
            'closes' => '17:00'
        ],
        'sameAs' => [
            'https://www.facebook.com/sekawanputrapratama',
            'https://www.instagram.com/sekawanputrapratama',
            'https://www.linkedin.com/company/sekawanputrapratama'
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    @endphp
    </script>

    @stack('schema')

    {{-- Icons & Favicons --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/media/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/media/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/media/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/media/favicon.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/media/logo.png') }}">
    <meta name="msapplication-TileColor" content="#0F172A">

    {{-- Google Fonts: Poppins + Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
        /* ============================================================
           SPP ENTERPRISE DESIGN SYSTEM — v2.0
        ============================================================ */
        :root {
            /* Palette - Midnight Premium */
            --midnight-blue:    #030712; /* Deep Slate 950 */
            --navy-dark:        #0F172A; /* Slate 900 */
            --electric-blue:    #3B82F6; /* Blue 500 */
            --electric-hover:   #2563EB; /* Blue 600 */
            --accent-cyan:      #22D3EE; /* Cyan 400 */
            --glass-bg:         rgba(255, 255, 255, 0.03);
            --glass-border:     rgba(255, 255, 255, 0.08);
            --glass-blur:       blur(16px);
            
            /* Typography */
            --font-heading:     'Poppins', sans-serif;
            --font-body:        'Inter', sans-serif;
            
            /* Spacing & Radii */
            --radius-lg:        16px;
            --radius-xl:        24px;
            --radius-full:      9999px;
            --container-max:    1280px;
            
            /* Animations */
            --transition:       all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            --shadow-card:      0 20px 40px rgba(0, 0, 0, 0.4);
            --shadow-glow:      0 0 50px rgba(59, 130, 246, 0.2);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            background: var(--off-white);
            color: var(--midnight-blue);
            -webkit-font-smoothing: antialiased;
        }

        h1,h2,h3,h4,h5,h6 { font-family: var(--font-heading); }

        /* ---- NAVBAR CLEAN ENTERPRISE ---- */
        #main-header {
            position: fixed !important;
            top: 0; left: 0; right: 0;
            z-index: 9000;
            height: 80px !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        #main-header .container-fluid {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        #main-header.scrolled {
            height: 70px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        /* Transparent Header on Homepage */
        #main-header.header-transparent {
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        #main-header.header-transparent .main-menu__list > li > a {
            color: #ffffff !important;
        }
        #main-header.header-transparent .header-logo {
            /* Logo dibiarkan aslinya karena sudah cocok untuk background gelap */
        }
        #main-header.header-transparent .mobile-nav__toggler {
            color: #ffffff !important;
        }

        /* Scrolled state for transparent header (Dark Mode) */
        #main-header.header-transparent.scrolled {
            background: rgba(5, 11, 20, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        #main-header.header-transparent.scrolled .main-menu__list > li > a {
            color: #ffffff !important;
        }
        #main-header.header-transparent.scrolled .mobile-nav__toggler {
            color: #ffffff !important;
        }
        
        /* Logo Switching Logic */
        .header-logo.logo-light { display: none; }
        .header-logo.logo-dark { display: block; }
        
        #main-header.header-transparent .header-logo.logo-dark { display: none; }
        #main-header.header-transparent .header-logo.logo-light { display: block; }
        .main-menu__list { display: flex; align-items: center; margin: 0; padding: 0; gap: 24px; }
        .main-menu__list > li > a {
            color: #475569 !important; /* Slate 600 */
            font-family: var(--font-body);
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.2px;
            transition: color 0.2s ease;
            padding: 10px 0 !important;
            text-decoration: none;
            position: relative;
        }
        /* Override border/lines from legacy css */
        .main-menu__list > li > a::before, .main-menu__list > li > a::after { display: none !important; }
        .main-menu__list > li.current > a,
        .main-menu__list > li > a:hover {
            color: var(--electric-blue) !important;
        }
        .header-logo { height: 45px; width: auto; }

        /* ---- NAV CTA BUTTON ---- */
        .header-btn {
            background: var(--electric-blue);
            color: #fff !important;
            padding: 10px 22px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            font-family: var(--font-body);
            text-decoration: none;
            transition: var(--transition);
            white-space: nowrap;
            border: none;
            box-shadow: 0 4px 20px rgba(37,99,235,0.4);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .header-btn:hover {
            background: var(--electric-hover);
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(37,99,235,0.5);
            text-decoration: none;
        }

        /* Push content below fixed nav */
        #scroll-container > main:first-child section:first-child,
        #scroll-container > main section:first-child {
            padding-top: 0;
        }

        /* ---- FOOTER ---- */
        .footer-modern {
            background: #020617 !important;
            color: rgba(255,255,255,0.7);
            padding: 100px 0 0;
            font-family: var(--font-body);
            position: relative;
            overflow: hidden;
        }
        .footer-modern::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 80%; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        }
        .footer-modern p { color: rgba(255,255,255,0.5); font-size: 14px; line-height: 1.8; }
        .footer-widget h5 {
            color: #fff;
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 24px;
        }
        .footer-links li { margin-bottom: 12px; }
        .footer-links li a {
            color: rgba(255,255,255,0.5);
            font-size: 14px;
            text-decoration: none;
            transition: var(--transition);
        }
        .footer-links li a:hover { color: var(--electric-blue); transform: translateX(5px); display: inline-block; }
        .footer-bottom {
            margin-top: 80px;
            padding: 30px 0;
            border-top: 1px solid rgba(255,255,255,0.05);
            color: rgba(255,255,255,0.3);
            font-size: 12px;
        }

        /* ---- GALLERY ---- */
        .gallery-item { cursor: pointer; transition: var(--transition); position: relative; overflow: hidden; }
        .gallery-item:hover { transform: scale(1.04); }
        .gallery-item:hover img { filter: brightness(0.7); }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 576px) {
            #main-header { height: 68px !important; }
            .header-logo { height: 34px !important; }
            .header-btn { padding: 8px 14px !important; font-size: 12px !important; }
            .footer-widget h5 { font-size: 14px; }
        }
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
        <header id="main-header" class="{{ request()->routeIs('home') ? 'header-transparent' : '' }}">
            <div class="container-fluid">
                <div class="main-menu__logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/media/logo.png') }}" alt="PT Sekawan Putra Pratama" class="header-logo logo-dark">
                        <img src="{{ asset('assets/media/logo1.png') }}" alt="PT Sekawan Putra Pratama" class="header-logo logo-light">
                    </a>
                </div>

                <div class="menu-button-right d-flex align-items-center">
                    {{-- Menu Desktop --}}
                    <div class="main-menu__nav d-none d-lg-block me-4">
                        <ul class="main-menu__list list-unstyled mb-0 d-flex">
                            @include('frontend.layouts.menu-links')
                        </ul>
                    </div>

                    <div class="main-menu__right d-flex align-items-center gap-3">
                        <a class="header-btn d-none d-sm-inline-flex" href="{{ route('contact') }}">
                            <span>Hubungi Kami</span>
                        </a>
                        <a href="#" class="main-menu__toggler mobile-nav__toggler d-lg-none" style="color:#0f172a; font-size:24px;">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
            </div>
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
                            PT Sekawan Putra Pratama adalah mitra teknologi terpercaya Anda. Kami mengubah ide kompleks menjadi solusi digital yang sederhana.
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
                                    <a href="mailto:support@sekawanputrapratama.com">support@sekawanputrapratama.com</a>
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
                    <p class="mb-0 small">&copy; {{ date('Y') }} <strong>PT Sekawan Putra Pratama</strong>. All rights reserved.</p>
                </div>
            </div>
        </footer>

    </div>

    {{-- Mobile Navigation --}}
    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <div class="mobile-nav__header">
                <div class="logo-box">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/media/logo.png') }}" width="120" alt="Logo"></a>
                </div>
                <span class="mobile-nav__close mobile-nav__toggler">
                    <i class="fa fa-times"></i>
                </span>
            </div>

            <div class="mobile-nav__body">
                <div class="mobile-nav__container">
                    <ul class="main-menu__list">
                        @include('frontend.layouts.menu-links')
                    </ul>
                </div>

                <div class="mobile-nav__divider"></div>

                <ul class="mobile-nav__contact list-unstyled">
                    <li>
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-info">
                            <span class="contact-label">Email</span>
                            <a href="mailto:support@sekawanputrapratama.com">support@sekawanputrapratama.com</a>
                        </div>
                    </li>
                    <li>
                        <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                        <div class="contact-info">
                            <span class="contact-label">WhatsApp</span>
                            <a href="https://wa.me/6285156412702" target="_blank">+62 851-5641-2702</a>
                        </div>
                    </li>
                </ul>

                <div class="mobile-nav__divider"></div>

                <div class="mobile-nav__social">
                    <p class="social-title">Follow Us</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/sekawanputrapratama?igsh=MTUxbjJiaXRsMHh6"
                           class="social-link" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mobile-nav__footer">
                <p class="mb-0">&copy; {{ date('Y') }} PT Sekawan Putra Pratama</p>
            </div>
        </div>
    </div>

    <style>
        /* Modern Mobile Navigation Styles */
        .mobile-nav__wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            pointer-events: none;
            transition: pointer-events 0s linear 0.3s;
        }

        .mobile-nav__wrapper.active {
            pointer-events: auto;
            transition-delay: 0s;
        }

        .mobile-nav__overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            opacity: 0;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1;
            pointer-events: auto;
            cursor: pointer;
        }

        .mobile-nav__wrapper.active .mobile-nav__overlay {
            opacity: 1;
        }

        .mobile-nav__content {
            position: absolute;
            top: 0;
            right: 0;
            width: 280px;
            max-width: 80vw;
            height: 100%;
            background: #ffffff;
            box-shadow: -2px 0 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 2;
            pointer-events: auto;
        }

        .mobile-nav__wrapper.active .mobile-nav__content {
            transform: translateX(0);
        }

        /* Header */
        .mobile-nav__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            flex-shrink: 0;
        }

        .mobile-nav__close {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            border-radius: 6px;
            color: #475569;
            cursor: pointer;
            transition: background 0.2s ease;
            flex-shrink: 0;
        }

        .mobile-nav__close:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        /* Body */
        .mobile-nav__body {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 15px;
            -webkit-overflow-scrolling: touch;
        }

        .mobile-nav__body::-webkit-scrollbar {
            width: 3px;
        }

        .mobile-nav__body::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        /* Menu Items */
        .mobile-nav__container .main-menu__list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-nav__container .main-menu__list > li {
            margin-bottom: 3px;
        }

        .mobile-nav__container .main-menu__list > li > a {
            display: block;
            padding: 10px 12px;
            color: #1f2937;
            font-weight: 600;
            font-size: 14px;
            border-radius: 6px;
            transition: all 0.2s ease;
            text-decoration: none;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .mobile-nav__container .main-menu__list > li > a:hover,
        .mobile-nav__container .main-menu__list > li > a.active {
            background: #f3f4f6;
            color: #0F172A;
        }

        /* Divider */
        .mobile-nav__divider {
            height: 1px;
            background: #e5e7eb;
            margin: 15px 0;
        }

        /* Contact */
        .mobile-nav__contact {
            padding: 0;
            margin: 0;
        }

        .mobile-nav__contact li {
            display: flex;
            align-items: flex-start;
            padding: 10px 0;
            gap: 10px;
        }

        .mobile-nav__contact .contact-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border-radius: 8px;
            color: #0F172A;
            font-size: 18px;
            flex-shrink: 0;
        }

        .mobile-nav__contact .contact-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .mobile-nav__contact .contact-label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
            font-weight: 600;
        }

        .mobile-nav__contact .contact-info a {
            color: #1f2937;
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            transition: color 0.2s ease;
            word-wrap: break-word;
            overflow-wrap: break-word;
            line-height: 1.4;
        }

        .mobile-nav__contact .contact-info a:hover {
            color: #0F172A;
        }

        /* Social */
        .mobile-nav__social {
            margin-top: 5px;
        }

        .mobile-nav__social .social-title {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .mobile-nav__social .social-links {
            display: flex;
            gap: 8px;
        }

        .mobile-nav__social .social-link {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            color: #0F172A;
            font-size: 20px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .mobile-nav__social .social-link:hover {
            color: #6b7280;
        }

        /* Footer */
        .mobile-nav__footer {
            padding: 12px 15px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            flex-shrink: 0;
        }

        .mobile-nav__footer p {
            font-size: 10px;
            color: #6b7280;
            font-weight: 500;
        }

        /* Smooth Entrance Animation for Menu Items */
        .mobile-nav__wrapper.active .mobile-nav__container .main-menu__list > li {
            animation: fadeInUp 0.3s ease forwards;
            opacity: 0;
        }

        .mobile-nav__wrapper.active .mobile-nav__container .main-menu__list > li:nth-child(1) { animation-delay: 0.05s; }
        .mobile-nav__wrapper.active .mobile-nav__container .main-menu__list > li:nth-child(2) { animation-delay: 0.1s; }
        .mobile-nav__wrapper.active .mobile-nav__container .main-menu__list > li:nth-child(3) { animation-delay: 0.15s; }
        .mobile-nav__wrapper.active .mobile-nav__container .main-menu__list > li:nth-child(4) { animation-delay: 0.2s; }
        .mobile-nav__wrapper.active .mobile-nav__container .main-menu__list > li:nth-child(5) { animation-delay: 0.25s; }
        .mobile-nav__wrapper.active .mobile-nav__container .main-menu__list > li:nth-child(6) { animation-delay: 0.3s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    {{-- WA Float --}}
    <div class="wa-float-menu" id="wa-float-menu">
        <ul class="wa-menu-list">
            <li class="wa-menu-item">
                <span class="wa-tooltip">Jasa IT & Server</span>
                <a href="https://wa.me/6285156412702?text=Halo%20Tim%20Sekawan%2C%20saya%20tertarik%20dengan%20layanan%20*Jasa%20IT%20%26%20Server*.%0A%0ADetail%20kebutuhan%20infrastruktur%20kami%3A%0A-%20Setup%20%26%20Maintenance%20Server%0A-%20Instalasi%20Jaringan%20%2F%20Network%0A-%20Managed%20IT%20Services%0A%0AMohon%20info%20untuk%20jadwal%20diskusi%20atau%20penawarannya."
                class="wa-submenu-btn" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-server"></i>
                </a>
            </li>

            <li class="wa-menu-item">
                <span class="wa-tooltip">Pembuatan Website</span>
                <a href="https://wa.me/6285156412702?text=Halo%20Tim%20Sekawan%2C%20saya%20berencana%20melakukan%20*Pengembangan%20Website%2FAplikasi%20Web*.%0A%0AGambaran%20singkat%20kebutuhan%20saya%3A%0A-%20Jenis%3A%20(Company%20Profile%20%2F%20Toko%20Online%20%2F%20Sistem%20Custom)%0A-%20Target%3A%20(Segera%20%2F%20Konsultasi%20Dulu)%0A%0ABoleh%20minta%20info%20portofolio%20dan%20penawarannya%3F"
                class="wa-submenu-btn" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-globe"></i>
                </a>
            </li>

            <li class="wa-menu-item">
                <span class="wa-tooltip">Konsultasi Umum</span>
                <a href="https://wa.me/6285156412702?text=Halo%2C%20saya%20ingin%20berkonsultasi%20dengan%20IT%20Consultant%20mengenai%20*Transformasi%20Digital*%20di%20perusahaan%20saya.%20Mohon%20dijadwalkan%20untuk%20diskusi%20solusinya."
                class="wa-submenu-btn" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-comments"></i>
                </a>
            </li>
        </ul>

        <div class="wa-main-btn" onclick="toggleWAMenu()">
            <i class="fab fa-whatsapp my-float-icon"></i>
            <i class="fas fa-times my-close-icon"></i>
        </div>
    </div>

    <script>
        function toggleWAMenu() {
            var menu = document.getElementById('wa-float-menu');
            menu.classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            var menu = document.getElementById('wa-float-menu');
            var isClickInside = menu.contains(event.target);

            if (menu.classList.contains('active') && !isClickInside) {
                menu.classList.remove('active');
            }
        });
    </script>

    {{-- Scripts --}}
    <script src="{{ asset('assets/js/vendor/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-validator.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/video.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    <script>
        // Ensure navbar gets 'scrolled' class
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 50) {
                $('#main-header').addClass('scrolled');
            } else {
                $('#main-header').removeClass('scrolled');
            }
        });
    </script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        lightbox.option({ 'resizeDuration': 200, 'wrapAround': true });
        /* Scroll-aware navbar */
        (function(){
            var hdr = document.getElementById('main-header');
            if(!hdr) return;
            function onScroll(){
                if(window.scrollY > 50){ hdr.classList.add('scrolled'); }
                else { hdr.classList.remove('scrolled'); }
            }
            window.addEventListener('scroll', onScroll, {passive:true});
            onScroll();
        })();
    </script>

    <script>
        /* Reveal on Scroll */
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
            observer.observe(el);
        });
    </script>
    <style>
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-left.active { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-right.active { opacity: 1; transform: translateX(0); }
        .delay-100 { transition-delay: 0.1s; }
        .delay-200 { transition-delay: 0.2s; }
        .delay-300 { transition-delay: 0.3s; }
        .delay-400 { transition-delay: 0.4s; }
    </style>
    @stack('scripts')

    {{-- Google Analytics - Uncomment dan ganti G-XXXXXXXXXX dengan ID Anda --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y8530X1QEN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-Y8530X1QEN');
    </script>


</body>
</html>
