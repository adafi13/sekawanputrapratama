@extends('frontend.layouts.app')

{{-- Judul dinamis sesuai judul artikel --}}
@section('title', 'Pentingnya Migrasi ke Cloud Server untuk Bisnis 2026 - Sekawan Putra Pratama')

@section('content')

<section class="py-5 bg-light border-bottom">
    <div class="container py-4">
        <div class="row justify-content-center text-center">
            <div class="col-lg-9">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb justify-content-center bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-decoration-none">Blog</a></li>
                        <li class="breadcrumb-item active text-muted" aria-current="page">Teknologi</li>
                    </ol>
                </nav>
                
                <h1 class="display-5 fw-bold text-dark mb-4" style="line-height: 1.2;">
                    Pentingnya Migrasi ke Cloud Server untuk Bisnis 2026
                </h1>
                
                <div class="d-flex align-items-center justify-content-center gap-3 text-muted">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                            <i class="fas fa-user-nib small"></i>
                        </div>
                        <span class="fw-bold text-dark small">Admin Sekawan</span>
                    </div>
                    <span class="text-opacity-25">|</span>
                    <div class="small">
                        <i class="far fa-calendar-alt me-1"></i> 20 Januari 2026
                    </div>
                    <span class="text-opacity-25">|</span>
                    <div class="small">
                        <i class="far fa-clock me-1"></i> 5 Menit Baca
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-lg-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="rounded-4 overflow-hidden shadow-sm mb-5">
                    <img src="{{ asset('assets/media/images/blog-1.png') }}" class="img-fluid w-100" alt="Featured Image">
                </div>
                
                <div class="article-content text-dark" style="font-size: 1.15rem; line-height: 1.8; color: #334155 !important;">
                    <p>Dalam era transformasi digital yang bergerak sangat pesat, infrastruktur IT bukan lagi sekadar pendukung, melainkan jantung dari operasional bisnis. Salah satu perubahan paling signifikan di tahun 2026 adalah pergeseran total dari server fisik (on-premise) menuju <strong>Cloud Infrastructure</strong>.</p>
                    
                    <h3 class="fw-bold mt-5 mb-3 text-dark">Mengapa Skalabilitas adalah Kunci?</h3>
                    <p>Banyak pemilik bisnis bertanya-tanya, apakah investasi ini sepadan? Salah satu alasan utamanya adalah <strong>skalabilitas</strong>. Bayangkan saat bisnis Anda mendapatkan lonjakan traffic mendadak; dengan cloud, Anda bisa menambah kapasitas hanya dalam hitungan menit.</p>
                    
                    <div class="p-4 my-5 bg-light rounded-4 border-start border-primary border-4 shadow-sm">
                        <h5 class="fw-bold mb-2"><i class="fas fa-lightbulb text-warning me-2"></i> Insight Utama:</h5>
                        <p class="mb-0 italic text-muted">"Bisnis yang sukses di masa depan tidak lagi dibatasi oleh kapasitas hardware fisik, melainkan seberapa fleksibel mereka beradaptasi di ekosistem cloud."</p>
                    </div>

                    <h3 class="fw-bold mt-5 mb-3 text-dark">Keamanan yang Lebih Terjamin</h3>
                    <p>Berlawanan dengan mitos lama, penyedia layanan cloud saat ini menawarkan standar keamanan yang jauh lebih ketat dibandingkan server kantor biasa. Dengan enkripsi berlapis dan proteksi serangan DDoS yang canggih, data bisnis Anda jauh lebih aman dari ancaman siber.</p>
                    
                    <p class="mb-5">Dengan bermigrasi ke cloud, tim IT Anda bisa lebih fokus pada pengembangan inovasi aplikasi daripada pusing memikirkan pemeliharaan kabel atau perangkat keras yang rusak di ruang server.</p>
                </div>

                <div class="py-4 border-top border-bottom d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="tags">
                        <span class="small fw-bold text-muted me-2">Tags:</span>
                        <a href="#" class="badge bg-light text-muted border text-decoration-none px-3 py-2 rounded-pill">Cloud</a>
                        <a href="#" class="badge bg-light text-muted border text-decoration-none px-3 py-2 rounded-pill">Digital</a>
                    </div>
                    <div class="share-buttons d-flex align-items-center gap-3">
                        <span class="small fw-bold text-muted">Bagikan:</span>
                        <a href="#" class="text-secondary hover-primary"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-secondary hover-primary"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-secondary hover-primary"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="mt-5 p-4 rounded-4 bg-light d-flex align-items-center gap-4">
                    <div class="bg-white p-1 rounded-circle shadow-sm">
                        <img src="{{ asset('assets/media/user/admin-avatar.png') }}" class="rounded-circle" width="70" height="70" alt="Admin">
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Ditulis oleh Admin Sekawan</h6>
                        <p class="small text-muted mb-0">Berdedikasi untuk memberikan wawasan teknologi terbaru guna membantu UMKM dan Perusahaan di Indonesia bertransformasi digital.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-4">
        <h4 class="fw-bold text-center mb-5">Artikel Terkait</h4>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="{{ asset('assets/media/images/blog-2.png') }}" class="card-img-top" alt="Blog" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="fw-bold"><a href="#" class="text-dark text-decoration-none">Cara Mengamankan Jaringan Kantor</a></h6>
                        <small class="text-muted">18 Jan 2026</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="{{ asset('assets/media/images/blog-3.png') }}" class="card-img-top" alt="Blog" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="fw-bold"><a href="#" class="text-dark text-decoration-none">Tren Mobile App Development</a></h6>
                        <small class="text-muted">15 Jan 2026</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .article-content h3 { 
        font-size: 1.8rem; 
        margin-top: 2.5rem; 
        letter-spacing: -0.5px;
    }
    .hover-primary:hover { color: #0d6efd !important; }
    .italic { font-style: italic; }
    .breadcrumb-item + .breadcrumb-item::before { content: "›"; font-size: 1.2rem; line-height: 1; }
</style>

@endsection