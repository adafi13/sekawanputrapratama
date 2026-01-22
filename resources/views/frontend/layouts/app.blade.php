<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>{{ $title ?? 'Sekawan Putra Pratama - IT Consultant & Software House' }}</title>
    <meta name="description" content="{{ $description ?? 'Jasa Pembuatan Website, Aplikasi Android/iOS, dan Instalasi Server Kantor Terpercaya. Solusi IT Terintegrasi untuk bisnis Anda.' }}">
    <meta name="keywords" content="{{ $keywords ?? 'Jasa Web Bekasi, App Developer, IT Consultant, Server Kantor, Sekawan Putra Pratama' }}">
    <meta name="author" content="Sekawan Putra Pratama">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Sekawan Putra Pratama - Solusi IT Terintegrasi' }}">
    <meta property="og:description" content="{{ $description ?? 'Konsultasikan kebutuhan digital Anda: Web, Apps, & Server.' }}">
    <meta property="og:image" content="{{ asset('assets/media/logo.png') }}">
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/media/favicon.png') }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/video-js.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    
    <style>
        .float-wa {
            position: fixed; width: 60px; height: 60px; bottom: 30px; right: 30px;
            background-color: #25d366; color: #FFF; border-radius: 50px;
            text-align: center; font-size: 30px; box-shadow: 2px 2px 3px #999;
            z-index: 9999; display: flex; align-items: center; justify-content: center;
            text-decoration: none; transition: all 0.3s ease;
        }
        .float-wa:hover { background-color: #128C7E; transform: scale(1.1); color: #FFF; }
        #preloader {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background-color: #000; z-index: 99999;
            display: flex; align-items: center; justify-content: center;
        }
        @media (max-width: 767px) {
            .float-wa { width: 50px; height: 50px; bottom: 20px; right: 20px; font-size: 24px; }
        }
    </style>
    @stack('styles')
</head>

<body class="tt-smooth-scroll">
    
    {{-- Preloader --}}
    <div id="preloader">
        <div class="darksoul-layout">
            <div class="darksoul-grid">
                <div class="item1"></div>
                <div class="item3"></div>
            </div>
            <h3 class="darksoul-loader-h">Sekawan Putra Pratama</h3>
        </div>
    </div>

    <div id="scroll-container">
        
        {{-- Header Navigation --}}
        <header>
            <nav class="main-menu">
                <div class="container-fluid">
                    <div class="main-menu__block">
                        <div class="main-menu__logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/media/logo.png') }}" alt="Sekawan Putra Pratama" class="header-logo">
                            </a>
                        </div>
                        <div class="menu-button-right">
                            <div class="main-menu__nav">
                                <ul class="main-menu__list">
                                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                                    <li><a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfolio</a></li>
                                    <li><a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a></li>
                                    <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                                </ul>
                            </div>
                            <div class="main-menu__right">
                                <a class="cus-btn d-sm-flex d-none" href="{{ route('contact') }}">
                                    <span>Hubungi Kami</span>
                                </a>
                                <a href="#" class="main-menu__toggler mobile-nav__toggler">
                                    <img src="{{ asset('assets/media/vector/menu.png') }}" alt="Menu">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        {{-- Main Content --}}
        @yield('content')

        {{-- Footer --}}
        <footer class="mb-24">
            <div class="blur">
                <div class="animate-1"></div>
                <div class="animate-3"></div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer_bottom_bar text-center">
                            <p class="white">© {{ date('Y') }}. All rights reserved by Sekawan Putra Pratama</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <div class="wrap bg-noise"></div>
    </div>

    {{-- Mobile Navigation --}}
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
                    <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
                    <li><a href="{{ route('services.index') }}">Services</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <ul class="mobile-nav__contact list-unstyled">
                <li><i class="fas fa-envelope"></i> <a href="mailto:info@sekawanputrapratama.com">info@sekawanputrapratama.com</a></li>
                <li><i class="fa fa-phone-alt"></i> <a href="tel:+6285156412702">+62 851-5641-2702</a></li>
            </ul>
        </div>
    </div>

    {{-- WhatsApp Float Button --}}
    <a href="https://wa.me/6285156412702?text=Halo%20Sekawan%20Putra%20Pratama,%20saya%20tertarik%20untuk%20konsultasi%20proyek." 
       class="float-wa" target="_blank" aria-label="Chat WhatsApp">
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

    {{-- Preloader Handler --}}
    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if(preloader) {
                setTimeout(() => {
                    preloader.style.transition = 'opacity 0.5s ease';
                    preloader.style.opacity = '0';
                    setTimeout(() => preloader.style.display = 'none', 500);
                }, 1500);
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
