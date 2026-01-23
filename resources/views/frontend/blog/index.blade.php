@extends('frontend.layouts.app')

@section('title', 'Blog & Artikel - Sekawan Putra Pratama')

@section('content')

<section class="position-relative py-5 overflow-hidden d-flex align-items-center" style="min-height: 400px; background-color: #0F172A;">
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <div class="position-absolute" style="bottom: -10%; right: -5%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, rgba(0,0,0,0) 70%); filter: blur(80px);"></div>
        <div class="position-absolute w-100 h-100" style="background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 30px 30px; opacity: 0.5;"></div>
    </div>

    <div class="container position-relative z-3 text-center">
        <span class="d-inline-flex align-items-center px-3 py-2 rounded-pill border border-white border-opacity-10 mb-4" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px);">
            <i class="fas fa-pen-nib text-primary me-2"></i>
            <span class="small fw-bold text-white-50 text-uppercase tracking-widest">Wawasan & Berita</span>
        </span>
        <h1 class="display-4 fw-bold text-white mb-3">Blog <span class="gradient-text">Teknologi</span></h1>
        <p class="lead text-secondary mx-auto" style="max-width: 600px; font-weight: 300;">
            Temukan artikel terbaru seputar pengembangan software, infrastruktur jaringan, dan tren digital masa depan.
        </p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-lg-5">
        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden blog-card h-100 featured">
                    <div class="row g-0 h-100">
                        <div class="col-md-6 position-relative">
                            <img src="{{ asset('assets/media/images/blog-1.jpg') }}" class="h-100 w-100 object-fit-cover transition-all" alt="Blog 1">
                            <div class="position-absolute top-0 start-0 p-3">
                                <span class="badge bg-primary rounded-pill">Trending</span>
                            </div>
                        </div>
                        <div class="col-md-6 p-4 p-lg-5 d-flex flex-column justify-content-center">
                            <small class="text-primary fw-bold text-uppercase mb-2">Technology</small>
                            <h2 class="fw-bold text-dark mb-3">
                                <a href="{{ route('blog.show', 1) }}" class="text-decoration-none text-dark hover-primary">Masa Depan AI dalam Pengembangan Website 2026</a>
                            </h2>
                            <p class="text-muted small mb-4">Bagaimana kecerdasan buatan mengubah cara kita berinteraksi dengan dunia digital...</p>
                            <div class="d-flex align-items-center mt-auto">
                                <div class="bg-light rounded-circle p-2 me-3"><i class="fas fa-user-circle text-secondary"></i></div>
                                <div>
                                    <p class="mb-0 fw-bold small text-dark">Admin Sekawan</p>
                                    <small class="text-muted">24 Jan 2026</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden blog-card h-100">
                    <div class="position-relative">
                        <img src="{{ asset('assets/media/images/blog-2.jpg') }}" class="card-img-top w-100 object-fit-cover" style="height: 200px;" alt="Blog 2">
                        <span class="position-absolute bottom-0 start-0 m-3 badge bg-white text-dark rounded-pill shadow-sm">Networking</span>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <a href="{{ route('blog.show', 2) }}" class="text-decoration-none text-dark hover-primary">Pentingnya Fiber Optic untuk Kecepatan Kantor</a>
                        </h5>
                        <p class="text-muted small mb-4">Stabilitas internet adalah kunci produktivitas tim di era hybrid working...</p>
                        <div class="d-flex align-items-center">
                            <div class="small text-muted me-3"><i class="far fa-clock me-1"></i> 5 min read</div>
                            <div class="small text-muted"><i class="far fa-calendar me-1"></i> Jan 20, 2026</div>
                        </div>
                    </div>
                </div>
            </div>

            </div>

        <nav class="mt-5 pt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link border-0 bg-light rounded-circle mx-1" href="#"><i class="fas fa-chevron-left"></i></a></li>
                <li class="page-item active"><a class="page-link border-0 rounded-circle mx-1" href="#">1</a></li>
                <li class="page-item"><a class="page-link border-0 bg-light text-dark rounded-circle mx-1" href="#">2</a></li>
                <li class="page-item"><a class="page-link border-0 bg-light text-dark rounded-circle mx-1" href="#"><i class="fas fa-chevron-right"></i></a></li>
            </ul>
        </nav>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 rounded-4 bg-primary p-4 p-lg-5 shadow-lg overflow-hidden position-relative">
            <div class="position-absolute top-0 end-0 opacity-10" style="font-size: 200px; transform: rotate(15deg) translate(20px, -50px);">
                <i class="fas fa-paper-plane text-white"></i>
            </div>
            <div class="row align-items-center position-relative z-2">
                <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                    <h3 class="text-white fw-bold mb-2">Langganan Newsletter Kami</h3>
                    <p class="text-white text-opacity-75 mb-0">Dapatkan update teknologi terbaru langsung di email Anda.</p>
                </div>
                <div class="col-lg-6">
                    <form class="d-flex gap-2 p-2 bg-white rounded-pill shadow-sm">
                        <input type="email" class="form-control border-0 bg-transparent ps-4" placeholder="Alamat email Anda..." required>
                        <button type="submit" class="btn btn-dark rounded-pill px-4">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .gradient-text {
        background: linear-gradient(135deg, #60A5FA 0%, #A78BFA 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .tracking-widest { letter-spacing: 3px; }
    
    .blog-card { transition: all 0.3s ease; }
    .blog-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important; }
    .blog-card img { transition: transform 0.5s ease; }
    .blog-card:hover img { transform: scale(1.05); }
    
    .hover-primary:hover { color: #0d6efd !important; }
    .page-link { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; }
</style>

@endsection