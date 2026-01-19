@extends('frontend.layouts.app')

@section('title', $service->meta_title ?? ($service->title . ' - Sekawan Putra Pratama'))

@section('meta_description', $service->meta_description ?? $service->description)

@section('content')
<section class="banner-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-inner-block text-center">
                    <h1 class="banner-inner-title h-91 color-sec">{{ $service->title }}</h1>
                    <p class="banner-text medium-gray">
                        {{ $service->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="service-detail mb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="service-sidebar p-4 mb-32" style="background: #1a1a1a; border-radius: 16px;">
                    <h4 class="white mb-24">Daftar Layanan</h4>
                    <ul class="list-unstyled service-list">
                        @foreach($allServices as $s)
                            <li class="mb-16">
                                <a href="{{ route('services.show', $s->slug) }}" class="{{ $s->id === $service->id ? 'color-primary fw-bold' : 'medium-gray hover-white' }}">
                                    <i class="fas fa-angle-right me-2"></i> {{ $s->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="service-sidebar p-4" style="background: linear-gradient(45deg, #1a1a1a, #222); border-radius: 16px; border: 1px solid #333;">
                    <h4 class="white mb-16">Butuh Bantuan?</h4>
                    <p class="medium-gray mb-24">Konsultasikan kebutuhan spesifik proyek Anda dengan tim kami.</p>
                    <div class="d-flex align-items-center gap-3 mb-16">
                        <div class="icon-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 50%;">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="text">
                            <p class="medium-gray m-0" style="font-size: 12px;">Hubungi Kami</p>
                            <a href="tel:{{ \App\Models\Setting::get('contact.phone', '0851-5641-2702') }}" class="white m-0">{{ \App\Models\Setting::get('contact.phone', '0851-5641-2702') }}</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 50%;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="text">
                            <p class="medium-gray m-0" style="font-size: 12px;">Email Kami</p>
                            <a href="mailto:{{ \App\Models\Setting::get('contact.email', 'sekawanputrapratama@gmail.com') }}" class="white m-0">{{ \App\Models\Setting::get('contact.email', 'sekawanputrapratama@gmail.com') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="service-detail-content">
                    @if($service->getFirstMediaUrl('images'))
                        <div class="image-box mb-32">
                            <img src="{{ $service->getFirstMediaUrl('images') }}" loading="lazy" alt="{{ $service->title }}" class="w-100" style="border-radius: 16px;" width="800" height="450">
                        </div>
                    @endif
                    
                    <h2 class="white mb-24">{{ $service->title }}</h2>
                    
                    <div class="medium-gray mb-48">
                        {!! $service->content !!}
                    </div>

                    <div class="row mb-48">
                        <div class="col-md-12">
                            <a href="{{ route('contact') }}" class="cus-btn">
                                <span>Konsultasi Sekarang</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


