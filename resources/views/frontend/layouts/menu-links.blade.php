<li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}" onclick="open_preloader()">Home</a></li>
<li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}" onclick="open_preloader()">About Us</a></li>
<li><a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}" onclick="open_preloader()">Services</a></li>
<li><a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}" onclick="open_preloader()">Portfolio</a></li>
<li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}" onclick="open_preloader()">Blog</a></li>
<li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}" onclick="open_preloader()">Contact</a></li>
