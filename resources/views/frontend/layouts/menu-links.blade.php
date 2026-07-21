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
<li><a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfolio</a></li>
<li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
<li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
