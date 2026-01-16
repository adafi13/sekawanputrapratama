<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Sekawan Putra Pratama - IT Consultant & Software House')</title>
    <meta name="description" content="@yield('meta_description', 'Jasa Pembuatan Website, Aplikasi Android/iOS, dan Instalasi Server Kantor Terpercaya. Solusi IT Terintegrasi untuk bisnis Anda.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Jasa Web Bekasi, App Developer, IT Consultant, Server Kantor, Sekawan Putra Pratama')">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/media/favicon.png') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    
    @stack('styles')
</head>
<body class="tt-smooth-scroll">
    @include('frontend.components.preloader')
    
    <div id="scroll-container">
        @include('frontend.components.header')
        
        @yield('content')
        
        @include('frontend.components.footer')
        <div class="wrap bg-noise"></div>
    </div>

    @include('frontend.components.mobile-nav')
    @include('frontend.components.whatsapp-float')

    <script src="{{ asset('assets/js/vendor/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-validator.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/video.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html>

