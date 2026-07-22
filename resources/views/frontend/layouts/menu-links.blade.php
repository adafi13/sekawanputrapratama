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
    <a href="{{ route('about') }}#tech-stack-arsenal">
        Tools <i class="fas fa-chevron-down ms-1 nav-dropdown-icon"></i>
    </a>
    <ul class="nav-dropdown-menu" style="min-width: 270px;">
        <li>
            <a href="{{ route('about') }}#tech-stack-arsenal">
                <i class="fas fa-server me-2 text-primary"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 12px;">Backend Stack</strong>
                    <span class="text-muted" style="font-size: 11px;">Laravel, Node.js, Python, PHP 8.x</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('about') }}#tech-stack-arsenal">
                <i class="fas fa-mobile-alt me-2 text-info"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 12px;">Frontend &amp; Mobile</strong>
                    <span class="text-muted" style="font-size: 11px;">Flutter, React Native, Vue, Tailwind</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('about') }}#tech-stack-arsenal">
                <i class="fas fa-cloud me-2 text-warning"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 12px;">Cloud &amp; Network</strong>
                    <span class="text-muted" style="font-size: 11px;">AWS, GCP, Docker, Mikrotik</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('about') }}#tech-stack-arsenal">
                <i class="fas fa-database me-2 text-success"></i> 
                <div>
                    <strong class="d-block text-dark" style="font-size: 12px;">Database &amp; Cache</strong>
                    <span class="text-muted" style="font-size: 11px;">PostgreSQL, MySQL, Redis Cache</span>
                </div>
            </a>
        </li>
    </ul>
</li>
<li><a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfolio</a></li>
<li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
<li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
<li><a href="{{ route('client.login') }}" class="{{ request()->routeIs('client.*') ? 'active' : '' }} text-primary fw-bold"><i class="fas fa-user-lock me-1"></i> Portal Klien</a></li>
