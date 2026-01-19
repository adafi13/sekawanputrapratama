@extends('frontend.layouts.app')

@section('title', 'Layanan - Sekawan Putra Pratama')

@section('content')
<section class="banner-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-inner-block text-center">
                    <h1 class="banner-inner-title h-91 color-sec">Layanan Kami</h1>
                    <p class="banner-text medium-gray">
                        Solusi IT lengkap untuk mendukung perkembangan bisnis Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services mb-100">
    <div class="blur">
        <div class="animate-1"></div>
    </div>
    <div class="container-fluid">
        <div class="services-wrapper">
            
            @forelse($services as $index => $service)
                <div class="service-block mb-80">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="image-block">
                                <div class="text-box text-center">
                                    <h2 class="service-number mb-48">{{ $index + 1 }}</h2>
                                    <h4 class="white">{{ $service->title }}</h4>
                                    <div class="hover-block">
                                        @if($service->getFirstMediaUrl('images'))
                                            <img src="{{ $service->getFirstMediaUrl('images') }}" style="border-radius: 20px !important;" loading="lazy" alt="{{ $service->title }}">
                                        @else
                                            <img src="{{ asset('assets/media/images/app-development.png') }}" style="border-radius: 20px !important;" loading="lazy" alt="{{ $service->title }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="service-text text-center">
                                <h2 class="white mb-16">{{ $service->title }}</h2>
                                <p class="medium-gray mb-32">{{ $service->description }}</p>
                                <a class="cus-btn m-auto" href="{{ route('contact') }}">
                                    <span>Konsultasi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Default services jika belum ada data -->
                <div class="service-block mb-80">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="image-block">
                                <div class="text-box text-center">
                                    <h2 class="service-number mb-48">1</h2>
                                    <h4 class="white">App Development</h4>
                                    <div class="hover-block">
                                        <img src="{{ asset('assets/media/images/app-development.png') }}" style="border-radius: 20px !important;" loading="lazy" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="service-text text-center">
                                <h2 class="white mb-16">App Development</h2>
                                <p class="medium-gray mb-32">Pengembangan aplikasi mobile dan desktop yang stabil dan user-friendly.</p>
                                <a class="cus-btn m-auto" href="{{ route('contact') }}">
                                    <span>Konsultasi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection


