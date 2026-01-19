<header>
    <nav class="main-menu">
        <div class="container-fluid">
            <div class="main-menu__block">
                <div class="main-menu__logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/media/logo.png') }}" alt="Sekawan Putra Pratama" class="header-logo" width="150" height="50" loading="eager">
                    </a>
                </div>
                <div class="menu-button-right">
                    <div class="main-menu__nav">
                        <ul class="main-menu__list">
                            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                            <li><a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfolio</a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);">Services</a>
                                <ul>
                                    <li><a href="{{ route('services.index') }}">Services</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="main-menu__right">
                        <a class="cus-btn d-sm-flex d-none" href="{{ route('contact') }}">
                            <span>Hubungi Kami</span>
                        </a>
                        <a href="#" class="main-menu__toggler mobile-nav__toggler" aria-label="Toggle Menu">
                            <img src="{{ asset('assets/media/vector/menu.png') }}" alt="Menu" width="24" height="24" loading="eager">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>


