<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Client Portal - PT Sekawan Putra Pratama')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/media/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --navy-dark: #050b14;
            --navy-card: #0f172a;
            --electric-blue: #3B82F6;
            --cyan-accent: #22D3EE;
            --bg-light: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: #0f172a;
            margin: 0;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }

        /* SIDEBAR */
        .client-sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width);
            background-color: var(--navy-dark);
            color: #ffffff;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand img { max-height: 38px; }

        .sidebar-nav {
            padding: 20px 12px;
            list-style: none;
            margin: 0;
            flex: 1;
        }

        .sidebar-nav li { margin-bottom: 4px; }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #94a3b8;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(59, 130, 246, 0.15);
            color: var(--cyan-accent);
        }

        /* MAIN CONTENT AREA */
        .client-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .client-header {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .client-body { padding: 30px; flex: 1; }

        /* CARDS */
        .portal-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .portal-card:hover {
            box-shadow: 0 12px 24px -5px rgba(0, 0, 0, 0.06);
        }

        /* STATUS BADGES */
        .badge-status {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (max-width: 991px) {
            .client-sidebar { transform: translateX(-100%); }
            .client-sidebar.active { transform: translateX(0); }
            .client-main { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- SIDEBAR --}}
    <aside class="client-sidebar" id="clientSidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('assets/media/logo.png') }}" alt="Logo">
            <span class="badge bg-primary rounded-pill small">Client Portal</span>
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('client.dashboard') }}" class="{{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large w-20"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('client.projects.*') || request()->routeIs('client.projects*') ? 'active' : '' }}" href="{{ route('client.projects.index') }}">
                    <i class="fas fa-project-diagram w-20"></i> Proyek Saya
                </a>
            </li>
            <li>
                <a href="{{ route('client.contracts.index') }}" class="{{ request()->routeIs('client.contracts*') ? 'active' : '' }}">
                    <i class="fas fa-file-contract w-20"></i> Dokumen Kontrak
                </a>
            </li>
            <li>
                <a href="{{ route('client.invoices.index') }}" class="{{ request()->routeIs('client.invoices*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar w-20"></i> Invoice & Tagihan
                </a>
            </li>
            <li>
                <a href="{{ route('client.profile') }}" class="{{ request()->routeIs('client.profile*') ? 'active' : '' }}">
                    <i class="fas fa-user-cog w-20"></i> Pengaturan Profil
                </a>
            </li>
        </ul>

        <div class="p-3 border-top border-secondary opacity-75">
            <form action="{{ route('client.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 rounded-3 text-start px-3 py-2 small fw-bold">
                    <i class="fas fa-sign-out-alt me-2"></i> Keluar Portal
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN WRAPPER --}}
    <div class="client-main">
        {{-- HEADER --}}
        <header class="client-header">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="fw-bold mb-0 text-dark">@yield('page_title', 'Client Portal')</h5>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold small text-dark">{{ Auth::guard('customer')->user()->company_name }}</div>
                    <div class="text-muted small" style="font-size: 11px;">{{ Auth::guard('customer')->user()->contact_person }}</div>
                </div>
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                    {{ strtoupper(substr(Auth::guard('customer')->user()->company_name, 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- BODY CONTENT --}}
        <main class="client-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 rounded-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('assets/js/vendor/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script>
        $('#sidebarToggle').on('click', function() {
            $('#clientSidebar').toggleClass('active');
        });
    </script>
    @stack('scripts')
</body>
</html>
