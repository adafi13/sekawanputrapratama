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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    {{-- Custom Styles for Modern Layout --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <style>
        /* Gallery hover effect */
        .gallery-item {
            cursor: pointer;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .gallery-item:hover {
            transform: scale(1.05);
        }
        .gallery-item::after {
            content: '\f002';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .gallery-item:hover::after {
            opacity: 1;
        }
        .gallery-item:hover img {
            filter: brightness(0.7);
        }

        /* Blog hover effects */
        .blog-card { transition: all 0.3s ease; }
        .blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important; }
        .hover-primary:hover { color: #0d6efd !important; }
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Portfolio gallery grid */
        .portfolio-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .portfolio-gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="tt-smooth-scroll">

    {{-- 1. Modern Preloader --}}
    <div id="preloader">
        <div class="preloader-inner text-center">
            <img src="{{ asset('assets/media/logo_loading.png') }}" alt="Sekawan Putra Pratama" class="preloader-logo">
            <div class="loading-bar"></div>
        </div>
    </div>

    <div id="scroll-container">

        {{-- 2. Header Navigation Modern --}}
        <header id="main-header" style="height: 80px; display: flex; align-items: center;">
            <nav class="main-menu">
                <div class="container-fluid px-lg-5">
                    <div class="main-menu__block d-flex align-items-center justify-content-between">

                        <div class="main-menu__logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/media/logo.png') }}" alt="Sekawan Putra Pratama" class="header-logo" style="height: 60px;">
                            </a>
                        </div>

                        <div class="menu-button-right d-flex align-items-center">
                            <div class="main-menu__nav d-none d-lg-block me-4">
                                <ul class="main-menu__list list-unstyled mb-0">
                                    @include('frontend.layouts.menu-links')
                                </ul>
                            </div>

                            <div class="main-menu__right d-flex align-items-center">
                                <a class="header-btn d-sm-flex d-none align-items-center" href="{{ route('contact') }}">
                                    <span>Consult Now!</span>
                                    <i class="fas fa-arrow-right ms-2 small"></i>
                                </a>

                                <a href="#" class="main-menu__toggler mobile-nav__toggler ms-3 d-lg-none text-dark">
                                    <i class="fas fa-bars" style="font-size: 24px;"></i>
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
                            <img src="{{ asset('assets/media/logo.png') }}" alt="Logo Footer" width="100%">
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
                    @include('frontend.layouts.menu-links')
                </ul>
            </div>
            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <a href="mailto:sekawanputrapratama@gmail.com">sekawanputrapratama@gmail.com</a>
                </li>
                <li>
                    <div class="contact-icon"><i class="fa fa-phone-alt"></i></div>
                    <a href="tel:+6285156412702">+62 851-5641-2702</a>
                </li>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{-- Scripts Tambahan --}}
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        // Lightbox configuration
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Image %1 of %2"
        });
    </script>

    @stack('scripts')

</body>
</html>
