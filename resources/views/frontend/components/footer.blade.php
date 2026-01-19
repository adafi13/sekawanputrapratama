@php
    // Load all settings at once to avoid multiple queries
    $footerSettings = \App\Models\Setting::getGroup('footer');
    $siteSettings = \App\Models\Setting::getGroup('site');
    $contactSettings = \App\Models\Setting::getGroup('contact');
    $socialSettings = \App\Models\Setting::getGroup('social');
    
    // Cache services query
    $footerServices = \Illuminate\Support\Facades\Cache::remember('footer_services', now()->addHours(24), function() {
        return \App\Models\Service::where('is_active', true)->orderBy('order')->limit(5)->get(['id', 'title', 'slug']);
    });
@endphp

<footer class="mb-24">
    <div class="blur">
        <div class="animate-1"></div>
        <div class="animate-3"></div>
    </div>
    <div class="container-fluid">
        <div class="row mb-48">
            <div class="col-lg-3 col-md-6 mb-32">
                <div class="footer-section">
                    <h5 class="white mb-24">Tentang Kami</h5>
                    <p class="medium-gray mb-24">{{ $footerSettings['footer.description'] ?? 'Sekawan Putra Pratama adalah tim konsultan IT dan pengembang perangkat lunak yang berfokus pada solusi digital terintegrasi untuk bisnis dan enterprise.' }}</p>
                    <div class="social-links d-flex gap-3">
                        @if(!empty($socialSettings['social.whatsapp_url']))
                            <a href="{{ $socialSettings['social.whatsapp_url'] }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif
                        @if(!empty($socialSettings['social.instagram_url']))
                            <a href="{{ $socialSettings['social.instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if(!empty($socialSettings['social.linkedin_url']))
                            <a href="{{ $socialSettings['social.linkedin_url'] }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="LinkedIn">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        @endif
                        @if(!empty($socialSettings['social.facebook_url']))
                            <a href="{{ $socialSettings['social.facebook_url'] }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-32">
                <div class="footer-section">
                    <h5 class="white mb-24">Tautan Cepat</h5>
                    <ul class="footer-links list-unstyled">
                        <li class="mb-16">
                            <a href="{{ route('home') }}" class="medium-gray">Beranda</a>
                        </li>
                        <li class="mb-16">
                            <a href="{{ route('about') }}" class="medium-gray">Tentang Kami</a>
                        </li>
                        <li class="mb-16">
                            <a href="{{ route('services.index') }}" class="medium-gray">Layanan</a>
                        </li>
                        <li class="mb-16">
                            <a href="{{ route('portfolio.index') }}" class="medium-gray">Portfolio</a>
                        </li>
                        <li class="mb-16">
                            <a href="{{ route('blog.index') }}" class="medium-gray">Blog</a>
                        </li>
                        <li class="mb-16">
                            <a href="{{ route('contact') }}" class="medium-gray">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-32">
                <div class="footer-section">
                    <h5 class="white mb-24">Layanan</h5>
                    <ul class="footer-links list-unstyled">
                        @foreach($footerServices as $service)
                            <li class="mb-16">
                                <a href="{{ route('services.show', $service->slug) }}" class="medium-gray">{{ $service->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-32">
                <div class="footer-section">
                    <h5 class="white mb-24">Hubungi Kami</h5>
                    <ul class="footer-contact list-unstyled">
                        <li class="mb-16 d-flex align-items-start">
                            <i class="fas fa-phone-alt color-sec me-3 mt-2"></i>
                            <a href="tel:{{ $contactSettings['contact.phone'] ?? '0851-5641-2702' }}" class="medium-gray">
                                {{ $contactSettings['contact.phone'] ?? '0851-5641-2702' }}
                            </a>
                        </li>
                        <li class="mb-16 d-flex align-items-start">
                            <i class="fas fa-envelope color-sec me-3 mt-2"></i>
                            <a href="mailto:{{ $contactSettings['contact.email'] ?? 'sekawanputrapratama@gmail.com' }}" class="medium-gray">
                                {{ $contactSettings['contact.email'] ?? 'sekawanputrapratama@gmail.com' }}
                            </a>
                        </li>
                        <li class="mb-16 d-flex align-items-start">
                            <i class="fas fa-map-marker-alt color-sec me-3 mt-2"></i>
                            <span class="medium-gray">{{ $contactSettings['contact.address'] ?? 'Sekawan Office - Bekasi, Jawa Barat' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="footer_bottom_bar text-center pt-32" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <p class="medium-gray mb-0">
                        © {{ date('Y') }} {{ $siteSettings['site.company_name'] ?? 'Sekawan Putra Pratama' }}. 
                        All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>


