<li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
<li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
<li class="nav-item-dropdown">
    <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
        Services <i class="fas fa-chevron-down ms-1 nav-dropdown-icon"></i>
    </a>
    <ul class="nav-dropdown-menu">
        <li>
            <a href="{{ route('services.index') }}" class="fw-bold text-primary border-bottom pb-2 mb-1">
                <i class="fas fa-th-large me-2"></i> Lihat Semua Layanan
            </a>
        </li>
        @if(isset($navServices) && $navServices->count() > 0)
            @foreach($navServices as $navSvc)
                <li>
                    <a href="{{ route('services.show', $navSvc->slug) }}">
                        <i class="{{ $navSvc->icon_class }} me-2 text-primary"></i> {{ $navSvc->title }}
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</li>
<li class="nav-item-dropdown">
    <a href="{{ route('tools.speedtest') }}" class="{{ request()->routeIs('tools.*') ? 'active' : '' }}">
        Tools <i class="fas fa-chevron-down ms-1 nav-dropdown-icon"></i>
    </a>
    <ul class="nav-dropdown-menu" style="min-width: 280px; padding: 12px;">
        <li>
            <a href="{{ route('tools.speedtest') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.speedtest') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-tachometer-alt me-3 text-primary fs-5"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 13px;">SpeedTest Internet</strong>
                    <span class="text-muted d-block" style="font-size: 11px;">Uji Kecepatan &amp; Latensi Real-time</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('tools.dns-lookup') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.dns-lookup') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-search-location me-3 text-info fs-5"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 13px;">Cek IP &amp; DNS Lookup</strong>
                    <span class="text-muted d-block" style="font-size: 11px;">Analisa Record DNS &amp; ISP Domain</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('calculator.index') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('calculator.*') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-calculator me-3 text-success fs-5"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 13px;">Kalkulator Biaya IT</strong>
                    <span class="text-muted d-block" style="font-size: 11px;">Estimasi Budget Web, App &amp; Server</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('tools.ssl-checker') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.ssl-checker') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-shield-alt me-3 text-warning fs-5"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 13px;">Cek Masa Aktif SSL &amp; Health</strong>
                    <span class="text-muted d-block" style="font-size: 11px;">Pemeriksa Sertifikat SSL &amp; Status Website</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('tools.port-checker') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.port-checker') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-network-wired me-3 text-danger fs-5"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 13px;">Ping &amp; Port Checker</strong>
                    <span class="text-muted d-block" style="font-size: 11px;">Cek Status Port Server (80, 443, 22)</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('tools.ip-lookup') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.ip-lookup') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-map-marked-alt me-3 text-purple fs-5" style="color: #8b5cf6;"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 13px;">IP Geolokasi &amp; Server WHOIS</strong>
                    <span class="text-muted d-block" style="font-size: 11px;">Lokasi Fisik Server, ISP &amp; Provider Hosting</span>
                </div>
            </a>
        </li>
    </ul>
</li>
<li><a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfolio</a></li>
<li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
<li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
<li><a href="{{ route('client.login') }}" class="{{ request()->routeIs('client.*') ? 'active' : '' }} text-primary fw-bold"><i class="fas fa-user-lock me-1"></i> Portal Klien</a></li>
