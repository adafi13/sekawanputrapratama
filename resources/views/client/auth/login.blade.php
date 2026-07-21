<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Portal Login - PT Sekawan Putra Pratama</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/media/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy-dark: #050b14;
            --electric-blue: #3B82F6;
            --cyan-accent: #22D3EE;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--navy-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
            position: relative;
            overflow-x: hidden;
        }
        .bg-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
        }
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 28px;
            padding: 44px 36px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 10;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .login-logo {
            max-width: 180px;
            display: block;
            margin: 0 auto 24px;
        }
        .form-control {
            border-radius: 14px;
            padding: 12px 18px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
        }
        .form-control:focus {
            border-color: var(--electric-blue);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            background: #ffffff;
        }
        .btn-login {
            background: linear-gradient(135deg, #2563EB, #0891B2);
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 14px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(37, 99, 235, 0.4);
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="bg-grid"></div>

    <div class="login-card">
        <img src="{{ asset('assets/media/logo.png') }}" alt="PT Sekawan Putra Pratama" class="login-logo">
        <h4 class="fw-bold text-center text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Client Portal Login</h4>
        <p class="text-center text-muted small mb-4">Masuk untuk memantau progres proyek, kontrak, dan invoice Anda.</p>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-3 py-2 small" role="alert">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('client.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label small fw-bold text-dark">Alamat Email Klien</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" name="email" id="email" class="form-control border-start-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@perusahaan.com" required autofocus>
                </div>
                @error('email')
                    <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label small fw-bold text-dark">Password Portal</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" name="password" id="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="••••••••" required>
                </div>
                @error('password')
                    <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                </div>
                <a href="https://wa.me/6285156412702?text=Halo%20Admin%20Sekawan%2C%20saya%20lupa%20password%20Client%20Portal%20saya." target="_blank" class="small text-primary text-decoration-none fw-semibold">Lupa Password?</a>
            </div>

            <button type="submit" class="btn btn-login mb-3">
                <i class="fas fa-sign-in-alt me-2"></i> Masuk Ke Client Portal
            </button>
        </form>

        <div class="text-center mt-4 pt-3 border-top">
            <span class="text-muted small">Butuh Bantuan Buka Portal?</span>
            <a href="https://wa.me/6285156412702" target="_blank" class="d-block text-decoration-none fw-bold small text-success mt-1">
                <i class="fab fa-whatsapp me-1"></i> Hubungi Technical Support
            </a>
        </div>
    </div>
</body>
</html>
