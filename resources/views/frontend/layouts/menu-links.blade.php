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
    <a href="{{ route('tools.mikrotik.index') }}" class="{{ request()->routeIs('tools.*') || request()->routeIs('calculator.*') || request()->routeIs('speedtest') ? 'active' : '' }}">
        Tools <i class="fas fa-chevron-down ms-1 nav-dropdown-icon"></i>
    </a>
    <ul class="nav-dropdown-menu nav-dropdown-tools" style="min-width: 320px;">
        
        {{-- MIKROTIK & NETWORK GENERATORS --}}
        <li class="px-2 pt-2 pb-1 text-uppercase font-monospace fw-bold text-primary" style="font-size: 10px; letter-spacing: 1px;">
            • MIKROTIK &amp; NETWORK TOOLS
        </li>
        <li>
            <a href="{{ route('tools.mikrotik.index') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.mikrotik.index') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-microchip me-3 text-primary fs-5"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 13px;">Hub Generator MikroTik &amp; ISP</strong>
                    <span class="text-muted d-block" style="font-size: 11px;">Indeks Lengkap Script Otomatisasi RouterOS</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('tools.mikrotik.ecmp') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.mikrotik.ecmp') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-random me-3 text-primary fs-6"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 12px;">Load Balance ECMP Generator</strong>
                    <span class="text-muted d-block" style="font-size: 10px;">Equal Cost Multi Path RouterOS v6 &amp; v7</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('tools.mikrotik.nth') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.mikrotik.nth') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-exchange-alt me-3 text-info fs-6"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 12px;">Load Balance NTH Generator</strong>
                    <span class="text-muted d-block" style="font-size: 10px;">Every-Packet Round Robin RouterOS v6 &amp; v7</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('tools.mikrotik.pcc') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.mikrotik.pcc') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-project-diagram me-3 text-success fs-6"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 12px;">Load Balance PCC Generator</strong>
                    <span class="text-muted d-block" style="font-size: 10px;">Per Connection Classifier Hash Sessions</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('tools.mikrotik.failover') }}" class="d-flex align-items-center p-2 rounded mb-1 {{ request()->routeIs('tools.mikrotik.failover') ? 'bg-primary bg-opacity-10 text-primary' : '' }}">
                <i class="fas fa-shield-alt me-3 text-warning fs-6"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 12px;">Failover Recursive Gateway</strong>
                    <span class="text-muted d-block" style="font-size: 10px;">Check-Gateway Ping DNS Cloudflare/Google</span>
                </div>
            </a>
        </li>

        <li class="my-2 border-bottom"></li>

        {{-- UTILITAS WEB & SECURITY --}}
        <li class="px-2 pb-1 text-uppercase font-monospace fw-bold text-muted" style="font-size: 10px; letter-spacing: 1px;">
            • UTILITAS WEB &amp; SYSTEM
        </li>
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
