<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
        <div class="logo-box">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/media/logo.png') }}" alt="Logo"></a>
        </div>
        <div class="mobile-nav__container"></div>
        <ul class="mobile-nav__contact list-unstyled">
            <li><i class="fas fa-envelope"></i> <a href="mailto:{{ \App\Models\Setting::get('contact.email', 'sekawanputrapratama@gmail.com') }}">{{ \App\Models\Setting::get('contact.email', 'sekawanputrapratama@gmail.com') }}</a></li>
            <li><i class="fa fa-phone-alt"></i> <a href="tel:{{ str_replace(['-', ' ', '(', ')'], '', \App\Models\Setting::get('contact.phone', '0851-5641-2702')) }}">{{ \App\Models\Setting::get('contact.phone', '0851-5641-2702') }}</a></li>
        </ul>
    </div>
</div>


