@extends('frontend.layouts.app')

@section('title', 'Hubungi Kami - Sekawan Putra Pratama')

@section('content')
<section class="banner-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-inner-block text-center">
                    <h1 class="banner-inner-title h-91 color-sec">Hubungi Kami</h1>
                    <p class="banner-text medium-gray">Tim kami siap berdiskusi dengan Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-us mb-100">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-2"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="info-box mb-24" style="background: #1A1A1A; padding: 30px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05);">
                        <h4 class="white mb-24">Informasi Kontak</h4>
                        <div class="d-flex align-items-center mb-16">
                            <i class="fas fa-phone-alt color-sec me-3"></i>
                            <a href="tel:{{ \App\Models\Setting::get('contact.phone', '0851-5641-2702') }}" class="white mb-0">{{ \App\Models\Setting::get('contact.phone', '0851-5641-2702') }}</a>
                        </div>
                        <div class="d-flex align-items-center mb-16">
                            <i class="fas fa-envelope color-sec me-3"></i>
                            <a href="mailto:{{ \App\Models\Setting::get('contact.email', 'sekawanputrapratama@gmail.com') }}" class="mb-0 text-white">{{ \App\Models\Setting::get('contact.email', 'sekawanputrapratama@gmail.com') }}</a>
                        </div>
                        <div class="d-flex align-items-center mb-32">
                            <i class="fas fa-map-marker-alt color-sec me-3"></i>
                            <p class="white mb-0">{{ \App\Models\Setting::get('contact.address', 'Sekawan Office - Bekasi, Jawa Barat') }}</p>
                        </div>
                        @if(\App\Models\Setting::get('social.whatsapp_url') || \App\Models\Setting::get('social.instagram_url') || \App\Models\Setting::get('social.linkedin_url') || \App\Models\Setting::get('social.facebook_url'))
                        <h6 class="color-sec mb-16">Sosial Media:</h6>
                        <div class="d-flex gap-3">
                            @if(\App\Models\Setting::get('social.whatsapp_url'))
                                <a href="{{ \App\Models\Setting::get('social.whatsapp_url') }}" target="_blank" rel="noopener noreferrer" class="cus-btn-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; padding: 0; border-radius: 50%;">
                                    <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
                                </a>
                            @endif
                            @if(\App\Models\Setting::get('social.instagram_url'))
                                <a href="{{ \App\Models\Setting::get('social.instagram_url') }}" target="_blank" rel="noopener noreferrer" class="cus-btn-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; padding: 0; border-radius: 50%;">
                                    <i class="fab fa-instagram" style="font-size: 24px;"></i>
                                </a>
                            @endif
                            @if(\App\Models\Setting::get('social.linkedin_url'))
                                <a href="{{ \App\Models\Setting::get('social.linkedin_url') }}" target="_blank" rel="noopener noreferrer" class="cus-btn-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; padding: 0; border-radius: 50%;">
                                    <i class="fab fa-linkedin" style="font-size: 24px;"></i>
                                </a>
                            @endif
                            @if(\App\Models\Setting::get('social.facebook_url'))
                                <a href="{{ \App\Models\Setting::get('social.facebook_url') }}" target="_blank" rel="noopener noreferrer" class="cus-btn-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; padding: 0; border-radius: 50%;">
                                    <i class="fab fa-facebook" style="font-size: 24px;"></i>
                                </a>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="map-box" style="border-radius: 20px; overflow: hidden; height: 350px;">
                        <iframe src="https://www.google.com/maps?q=-6.3776515,107.1246921&z=18&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-block">
                        <h3 class="white mb-32">Kirim Pesan</h3>
                        @if(session('success'))
                            <div class="alert alert-success mb-4" style="background: #10b981; color: white; padding: 15px; border-radius: 10px;">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-24">
                                        <label class="mb-8">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-24">
                                        <label class="mb-8">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-24">
                                        <label class="mb-8">No. Telepon / WA</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-24">
                                        <label class="mb-8">Jenis Layanan</label>
                                        <select name="service_type" class="has-nice-select form-control">
                                            <option value="wd">Web Development</option>
                                            <option value="ad">App Development</option>
                                            <option value="os">Office Server</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-24">
                                        <label class="mb-8">Pesan Anda</label>
                                        <textarea name="message" class="form-control" rows="8" required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="cus-btn">
                                        <span>Kirim Pesan</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

