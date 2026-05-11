@extends('frontend.layouts.app')

@section('title', 'Blog & Artikel IT Terkini | Tips & Tutorial - PT Sekawan Putra Pratama')
@section('meta_description', 'Baca artikel terbaru seputar teknologi, tutorial programming, tips IT, dan tren digital. Update mingguan dari expert IT berpengalaman.')

@push('styles')
<style>
    /* Blog Specific Styles */
    .blog-hero {
        background-color: var(--navy-dark);
        padding: 120px 0 100px;
        position: relative;
        overflow: hidden;
    }

    .blog-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(37, 99, 235, 0.1) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.3;
    }

    .gradient-text {
        background: linear-gradient(135deg, #60A5FA 0%, #2563EB 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Filter Styles */
    .filter-wrapper {
        margin-top: -45px;
        position: relative;
        z-index: 10;
        display: flex;
        justify-content: center;
    }

    .filter-container {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        padding: 8px;
        border-radius: 100px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        display: inline-flex;
        gap: 5px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .btn-filter {
        border: none;
        background: transparent;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        color: var(--slate-600);
        transition: var(--transition);
    }

    .btn-filter:hover {
        color: var(--electric-blue);
        background: rgba(37, 99, 235, 0.05);
    }

    .btn-filter.active {
        background: var(--electric-blue);
        color: #fff;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }

    /* Featured Post Card */
    .featured-card {
        border: none;
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-card);
        margin-bottom: 60px;
        transition: var(--transition);
    }

    .featured-card:hover {
        transform: translateY(-5px);
    }

    .featured-img-wrapper {
        height: 100%;
        min-height: 400px;
        overflow: hidden;
    }

    .featured-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .featured-card:hover .featured-img-wrapper img {
        transform: scale(1.05);
    }

    /* Blog Grid Cards */
    .blog-card {
        border: 1px solid rgba(226, 232, 240, 0.8);
        background: #fff;
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-card);
        border-color: transparent;
    }

    .blog-img-wrapper {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .blog-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .blog-card:hover .blog-img-wrapper img {
        transform: scale(1.1);
    }

    .blog-content {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-meta {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        color: var(--electric-blue);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .blog-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--midnight-blue);
        margin-bottom: 12px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-excerpt {
        font-size: 14px;
        color: var(--slate-600);
        margin-bottom: 20px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .author-info {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .author-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--slate-100);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--electric-blue);
        font-size: 12px;
    }

    /* Animation */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .blog-hero { padding: 120px 0 80px; }
        .filter-container { border-radius: 25px; width: 100%; overflow-x: auto; flex-wrap: nowrap; justify-content: flex-start; padding: 6px; }
        .btn-filter { padding: 8px 18px; white-space: nowrap; }
        .featured-img-wrapper { min-height: 250px; }
    }
</style>
@endpush

@section('content')

{{-- Blog Hero --}}
<section class="blog-hero text-center">
    <div class="container position-relative z-1">
        <div class="reveal">
            <span class="d-inline-block px-3 py-1 rounded-pill mb-3" style="background: rgba(37,99,235,0.1); border: 1px solid rgba(37,99,235,0.2); color: #60A5FA; font-size: 12px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;">
                Insight & Tech Trends
            </span>
            <h1 class="display-4 fw-bold text-white mb-3">Wawasan & <span class="gradient-text">Inovasi Teknologi</span></h1>
            <p class="lead text-white-50 mx-auto mb-0" style="max-width: 700px;">
                Temukan tips, tutorial, dan berita terbaru seputar transformasi digital untuk membantu pertumbuhan bisnis Anda.
            </p>
        </div>
    </div>
</section>

{{-- Main Content --}}
<section class="pb-5 mb-5">
    <div class="container">
        
        {{-- Category Filter --}}
        <div class="filter-wrapper reveal">
            <div class="filter-container">
                <button class="btn-filter {{ !request('category') ? 'active' : '' }}" data-filter="">Semua Artikel</button>
                @foreach($categories as $cat)
                    <button class="btn-filter {{ request('category') == $cat->slug ? 'active' : '' }}" data-filter="{{ $cat->slug }}">{{ $cat->name }}</button>
                @endforeach
            </div>
        </div>

        {{-- Featured Post --}}
        @if($featuredPost && !request()->has('search') && !request()->has('category'))
        <div class="mt-5 pt-5 reveal">
            <div class="card featured-card">
                <div class="row g-0">
                    <div class="col-lg-7">
                        <div class="featured-img-wrapper">
                            @if($featuredPost->featured_image)
                                <img src="{{ Storage::url($featuredPost->featured_image) }}" alt="{{ $featuredPost->title }}">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                                    <i class="fas fa-newspaper fa-4x opacity-25"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="p-4 p-lg-5 d-flex flex-column h-100">
                            <div class="blog-meta">
                                <span>{{ $featuredPost->category->name ?? 'Uncategorized' }}</span>
                                <span class="text-slate-300">•</span>
                                <span>{{ $featuredPost->published_at->format('M d, Y') }}</span>
                            </div>
                            <h2 class="fw-bold mb-4" style="color: var(--midnight-blue); line-height: 1.3;">
                                <a href="{{ route('blog.show', $featuredPost->slug) }}" class="text-decoration-none text-dark hover-primary">
                                    {{ $featuredPost->title }}
                                </a>
                            </h2>
                            <p class="text-secondary mb-4" style="font-size: 1.1rem; line-height: 1.6;">
                                {{ Str::limit($featuredPost->excerpt, 160) }}
                            </p>
                            <div class="mt-auto pt-4 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="author-avatar"><i class="fas fa-user"></i></div>
                                    <span class="fw-bold text-dark small">{{ $featuredPost->author->name ?? 'Admin' }}</span>
                                </div>
                                <a href="{{ route('blog.show', $featuredPost->slug) }}" class="btn btn-primary rounded-pill px-4 fw-bold">
                                    Baca Artikel <i class="fas fa-arrow-right ms-2 small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Blog Grid --}}
        <div class="mt-4">
            <div class="row g-4" id="blog-grid">
                @forelse($blogs as $blog)
                    <div class="col-md-6 col-lg-4 blog-item reveal" data-category="{{ $blog->category ? $blog->category->slug : '' }}">
                        <div class="blog-card">
                            <div class="blog-img-wrapper">
                                @if($blog->featured_image)
                                    <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}">
                                @else
                                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-image fa-3x opacity-25"></i>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-white text-primary rounded-pill px-3 shadow-sm">{{ $blog->category->name ?? 'Tech' }}</span>
                                </div>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>{{ $blog->published_at->format('M d, Y') }}</span>
                                    <span class="ms-auto"><i class="far fa-eye me-1"></i> {{ $blog->views ?? 0 }}</span>
                                </div>
                                <h3 class="blog-title">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark hover-primary">
                                        {{ $blog->title }}
                                    </a>
                                </h3>
                                <p class="blog-excerpt">{{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 120) }}</p>
                                <div class="author-info">
                                    <div class="author-avatar"><i class="fas fa-user"></i></div>
                                    <span class="fw-bold text-dark small">{{ $blog->author->name ?? 'Admin' }}</span>
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="ms-auto text-primary fw-bold text-decoration-none small">
                                        Selengkapnya <i class="fas fa-chevron-right ms-1" style="font-size: 10px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 reveal">
                        <i class="fas fa-newspaper fa-4x text-light mb-4" style="color: #E2E8F0 !important;"></i>
                        <h4 class="text-muted">Belum ada artikel yang tersedia</h4>
                        <p class="text-secondary">Kami sedang menyusun konten berkualitas untuk Anda. Tunggu ya!</p>
                    </div>
                @endforelse
            </div>

            @if($blogs->hasPages())
            <div class="d-flex justify-content-center mt-5 pt-4 reveal">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</section>

{{-- Newsletter Section --}}
<section class="py-5">
    <div class="container reveal">
        <div class="rounded-4 p-5 text-center position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #2563EB 0%, #1E3A8A 100%);">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 20px 20px; opacity: 0.5;"></div>
            <div class="position-relative z-1 text-white">
                <h2 class="fw-bold mb-3">Dapatkan Update Tech Terkini</h2>
                <p class="text-white-50 mb-4 mx-auto" style="max-width: 600px;">Berlangganan newsletter kami untuk mendapatkan artikel eksklusif dan tren teknologi terbaru langsung di email Anda.</p>
                
                @if(session('success'))
                    <div class="alert alert-success d-inline-block mb-4 px-4 py-2 rounded-pill">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('newsletter.store') }}" method="POST" class="mx-auto" style="max-width: 500px;">
                    @csrf
                    <div class="input-group mb-2 p-1 bg-white rounded-pill shadow-lg">
                        <input type="email" name="email" class="form-control border-0 px-4 rounded-pill shadow-none" placeholder="Masukkan alamat email Anda" required>
                        <button class="btn btn-dark rounded-pill px-4 fw-bold" type="submit">
                            Subscribe <i class="fas fa-paper-plane ms-2 small"></i>
                        </button>
                    </div>
                    @error('email')
                        <small class="text-warning fw-bold">{{ $message }}</small>
                    @enderror
                </form>
                <p class="small text-white-50 mt-3"><i class="fas fa-shield-alt me-1"></i> Tenang, kami tidak akan menyepam email Anda.</p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Filtering Logic with Animation ---
        const filters = document.querySelectorAll('.btn-filter');
        const items = document.querySelectorAll('.blog-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();
                
                filters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                const category = this.getAttribute('data-filter');

                items.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    
                    if (category === '' || itemCategory === category) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0) scale(1)';
                        }, 50);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px) scale(0.95)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 400);
                    }
                });
            });
        });

        // --- Reveal Animation on Scroll ---
        const reveal = () => {
            const reveals = document.querySelectorAll('.reveal');
            reveals.forEach(el => {
                const windowHeight = window.innerHeight;
                const elementTop = el.getBoundingClientRect().top;
                const elementVisible = 100;
                if (elementTop < windowHeight - elementVisible) {
                    el.classList.add('active');
                }
            });
        };

        window.addEventListener('scroll', reveal);
        reveal();
    });
</script>
@endpush