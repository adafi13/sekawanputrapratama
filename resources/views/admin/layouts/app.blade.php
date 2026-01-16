<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-xl font-bold">Admin Panel</h1>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.pages.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.pages.*') ? 'bg-gray-700' : '' }}">Pages</a>
                <a href="{{ route('admin.blog.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.blog.*') ? 'bg-gray-700' : '' }}">Blog</a>
                <a href="{{ route('admin.portfolio.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.portfolio.*') ? 'bg-gray-700' : '' }}">Portfolio</a>
                <a href="{{ route('admin.services.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.services.*') ? 'bg-gray-700' : '' }}">Services</a>
                <a href="{{ route('admin.team.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.team.*') ? 'bg-gray-700' : '' }}">Team</a>
                <a href="{{ route('admin.testimonials.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-700' : '' }}">Testimonials</a>
                <a href="{{ route('admin.contacts.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.contacts.*') ? 'bg-gray-700' : '' }}">Contacts</a>
                <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700' : '' }}">Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">@yield('page-title', 'Dashboard')</h2>
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6">
                @if(session('success'))
                    <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex justify-between items-center">
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900 ml-4">×</button>
                    </div>
                @endif

                @if(session('error'))
                    <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex justify-between items-center">
                        <span>{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900 ml-4">×</button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
    <script>
        // Auto-dismiss flash messages after 5 seconds
        setTimeout(function() {
            const successMsg = document.getElementById('success-message');
            const errorMsg = document.getElementById('error-message');
            if (successMsg) successMsg.style.transition = 'opacity 0.5s';
            if (errorMsg) errorMsg.style.transition = 'opacity 0.5s';
            setTimeout(function() {
                if (successMsg) {
                    successMsg.style.opacity = '0';
                    setTimeout(() => successMsg.remove(), 500);
                }
                if (errorMsg) {
                    errorMsg.style.opacity = '0';
                    setTimeout(() => errorMsg.remove(), 500);
                }
            }, 4500);
        }, 500);
    </script>
</body>
</html>

