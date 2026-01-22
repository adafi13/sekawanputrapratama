@extends('frontend.layouts.app')

@section('content')

<section class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="white mb-16">Our Services</h1>
                <p class="medium-gray">Layanan profesional untuk mendukung bisnis digital Anda</p>
            </div>
        </div>
    </div>
</section>

<section class="services-detail">
    <div class="container-fluid">
        
        {{-- Service 1: Web Development --}}
        <div class="service-block mb-80">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-32">
                    <img src="{{ asset('assets/media/images/web-development.png') }}" 
                         alt="Web Development" 
                         class="w-100" 
                         style="border-radius: 20px;">
                </div>
                <div class="col-lg-6">
                    <h2 class="white mb-24">Web Development</h2>
                    <p class="medium-gray mb-24">
                        Kami mengembangkan website profesional yang cepat, responsif, dan SEO-friendly 
                        untuk meningkatkan presence online bisnis Anda.
                    </p>
                    <ul class="service-features mb-32">
                        <li class="medium-gray mb-16">✓ Company Profile</li>
                        <li class="medium-gray mb-16">✓ E-Commerce / Online Store</li>
                        <li class="medium-gray mb-16">✓ Web Application</li>
                        <li class="medium-gray mb-16">✓ CMS & Admin Panel</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="cus-btn">
                        <span>Konsultasi Sekarang</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Service 2: App Development --}}
        <div class="service-block mb-80">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2 mb-32">
                    <img src="{{ asset('assets/media/images/app-development.png') }}" 
                         alt="App Development" 
                         class="w-100" 
                         style="border-radius: 20px;">
                </div>
                <div class="col-lg-6 order-lg-1">
                    <h2 class="white mb-24">App Development</h2>
                    <p class="medium-gray mb-24">
                        Membangun aplikasi mobile dan desktop yang stabil, user-friendly, dan 
                        sesuai dengan kebutuhan bisnis Anda.
                    </p>
                    <ul class="service-features mb-32">
                        <li class="medium-gray mb-16">✓ Android App Development</li>
                        <li class="medium-gray mb-16">✓ iOS App Development</li>
                        <li class="medium-gray mb-16">✓ Cross-Platform App</li>
                        <li class="medium-gray mb-16">✓ Desktop Application</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="cus-btn">
                        <span>Konsultasi Sekarang</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Service 3: Office Server --}}
        <div class="service-block mb-80">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-32">
                    <img src="{{ asset('assets/media/images/office-server.png') }}" 
                         alt="Office Server" 
                         class="w-100" 
                         style="border-radius: 20px;">
                </div>
                <div class="col-lg-6">
                    <h2 class="white mb-24">Office Server Infrastructure</h2>
                    <p class="medium-gray mb-24">
                        Instalasi dan manajemen server kantor untuk mendukung operasional bisnis 
                        yang lebih efisien dan aman.
                    </p>
                    <ul class="service-features mb-32">
                        <li class="medium-gray mb-16">✓ Server Installation & Setup</li>
                        <li class="medium-gray mb-16">✓ Network Configuration</li>
                        <li class="medium-gray mb-16">✓ Data Backup & Security</li>
                        <li class="medium-gray mb-16">✓ IT Infrastructure Consulting</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="cus-btn">
                        <span>Konsultasi Sekarang</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- CTA Section --}}
<section class="cta-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="white mb-24">Butuh Solusi IT Lainnya?</h2>
                <p class="medium-gray mb-32">
                    Kami siap membantu berbagai kebutuhan teknologi bisnis Anda
                </p>
                <a href="{{ route('contact') }}" class="cus-btn m-auto">
                    <span>Diskusikan Proyek Anda</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
