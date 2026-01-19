<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    @php
        // Load settings once to avoid multiple queries
        $siteSettings = \App\Models\Setting::getGroup('site');
        $socialSettings = \App\Models\Setting::getGroup('social');
        $siteName = $siteSettings['site.company_name'] ?? 'Sekawan Putra Pratama';
        $siteDescription = $siteSettings['site.description'] ?? 'Jasa Pembuatan Website, Aplikasi Android/iOS, dan Instalasi Server Kantor Terpercaya. Solusi IT Terintegrasi untuk bisnis Anda.';
        $twitterHandle = $socialSettings['social.twitter_handle'] ?? null;
    @endphp
    
    {{-- Basic Meta Tags --}}
    <title>@yield('title', $siteName . ' - IT Consultant & Software House')</title>
    <meta name="description" content="@yield('meta_description', $siteDescription)">
    <meta name="keywords" content="@yield('meta_keywords', 'Jasa Web Bekasi, App Developer, IT Consultant, Server Kantor, Sekawan Putra Pratama')">
    <meta name="author" content="{{ $siteName }}">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    
    {{-- Open Graph Meta Tags --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', $siteName . ' - IT Consultant & Software House')">
    <meta property="og:description" content="@yield('og_description', $siteDescription)">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/media/logo.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="id_ID">
    
    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', $siteName . ' - IT Consultant & Software House')">
    <meta name="twitter:description" content="@yield('twitter_description', $siteDescription)">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/media/logo.png'))">
    @if($twitterHandle)
        <meta name="twitter:site" content="@{{ $twitterHandle }}">
    @endif
    
    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/media/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/media/favicon.png') }}">
    
    {{-- Preload critical CSS --}}
    <link rel="preload" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets/css/app.css') }}" as="style">
    
    {{-- Load CSS with media="print" then switch to "all" for faster rendering --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-slider.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/nice-select.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-slider.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/vendor/nice-select.css') }}">
    </noscript>
    
    @stack('styles')
    
    {{-- Structured Data (JSON-LD) --}}
    @include('frontend.components.json-ld')
</head>
<body class="tt-smooth-scroll">
    @include('frontend.components.preloader')
    
    <div id="scroll-container">
        @include('frontend.components.header')
        @include('frontend.components.breadcrumbs')
        
        @yield('content')
        
        @include('frontend.components.footer')
        <div class="wrap bg-noise"></div>
    </div>

    @include('frontend.components.mobile-nav')
    @include('frontend.components.whatsapp-float')
    @include('frontend.components.back-to-top')

    {{-- Load jQuery first (required by other scripts) --}}
    <script src="{{ asset('assets/js/vendor/jquery-3.6.3.min.js') }}"></script>
    
    {{-- Load other scripts with defer (they depend on jQuery, but jQuery loads first) --}}
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/vendor/jquery-validator.js') }}" defer></script>
    <script src="{{ asset('assets/js/vendor/smooth-scrollbar.js') }}" defer></script>
    <script src="{{ asset('assets/js/vendor/video.js') }}" defer></script>
    <script src="{{ asset('assets/js/vendor/jquery.nice-select.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    
    @stack('scripts')
</body>
</html>


