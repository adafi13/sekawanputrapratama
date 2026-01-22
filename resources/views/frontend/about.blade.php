@extends('frontend.layouts.app')

@section('content')

<section class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="white mb-16">About Us</h1>
                <p class="medium-gray">Mengenal lebih dekat Sekawan Putra Pratama</p>
            </div>
        </div>
    </div>
</section>

<section class="about-content">
    <div class="container-fluid">
        <div class="row align-items-center mb-80">
            <div class="col-lg-6">
                <h2 class="white mb-24">Siapa Kami?</h2>
                <p class="medium-gray mb-16">
                    Sekawan Putra Pratama adalah perusahaan IT consultant dan software house yang berdedikasi 
                    untuk memberikan solusi teknologi terbaik bagi bisnis Anda.
                </p>
                <p class="medium-gray mb-16">
                    Dengan tim profesional berpengalaman, kami telah membantu berbagai perusahaan dalam 
                    transformasi digital mereka melalui layanan web development, app development, dan 
                    infrastruktur server yang handal.
                </p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/media/images/about-image.png') }}" alt="About Us" class="w-100">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-32">
                <div class="feature-box text-center">
                    <h3 class="white mb-16">7+ Years</h3>
                    <p class="medium-gray">Pengalaman di Industri IT</p>
                </div>
            </div>
            <div class="col-md-4 mb-32">
                <div class="feature-box text-center">
                    <h3 class="white mb-16">100+ Projects</h3>
                    <p class="medium-gray">Proyek Berhasil Diselesaikan</p>
                </div>
            </div>
            <div class="col-md-4 mb-32">
                <div class="feature-box text-center">
                    <h3 class="white mb-16">50+ Clients</h3>
                    <p class="medium-gray">Klien Puas & Terpercaya</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="white mb-24">Siap Berkolaborasi?</h2>
                <p class="medium-gray mb-32">Mari wujudkan ide digital Anda bersama kami</p>
                <a href="{{ route('contact') }}" class="cus-btn m-auto">
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
