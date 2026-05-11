@extends('frontend.layouts.app')

@section('title', 'Blog & Artikel IT Terkini | Tips & Tutorial - PT Sekawan Putra Pratama')
@section('meta_description', 'Baca artikel terbaru seputar teknologi, tutorial programming, tips IT, dan tren digital. Update mingguan dari expert IT berpengalaman.')
@section('meta_keywords', 'blog IT, artikel teknologi, tutorial programming, tips website, tutorial aplikasi mobile, berita IT terkini')

@push('styles')
<style>
    /* ===== HERO ===== */
    .blog-hero {
        background-color: #0F172A;
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
    }
    .blog-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(37, 99, 235, 0.08) 1px, transparent 1px);
        background-size: 32px 32px;
    }
    .blog-hero::after {
        content: '';
        position: absolute;
        top: -30%; right: -10%;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
        filter: blur(80px);
    }

    /* ===== FILTER ===== */
    .filter-bar {
        margin-top: -28px;
        position: relative;
        z-index: 10;
    }
    .filter-pills {
        background: #fff;
        border: 1px solid #E2E8F0;
        padding: 6px;
        border-radius: 100px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        display: inline-flex;
        gap: 4px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .btn-filter {
        border: none;
        background: transparent;
        padding: 9px 22px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 13px;
        color: #64748B;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .btn-filter:hover { color: #2563EB; background: rgba(37,99,235,0.06); }
    .btn-filter.active {
        background: #2563EB;
        color: #fff;
        box-shadow: 0 4px 14px rgba(37,99,235,0.3);
    }

    /* ===== FEATURED CARD ===== */
    .featured-card {
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .featured-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    }
    .featured-card .featured-img {
        height: 100%;
        min-height: 340px;
        object-fit: cover;
    }
    .featured-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: linear-gradient(135deg, #2563EB, #1D4ED8);
        color: #fff;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 12px rgba(37,99,235,0.35);
    }

    /* ===== BLOG GRID CARDS ===== */
    .blog-grid-card {
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .blog-grid-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.08);
    }
    .blog-grid-card .card-img-top-wrapper {
        position: relative;
        height: 220px;
        overflow: hidden;
    }
    .blog-grid-card .card-img-top-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .blog-grid-card:hover .card-img-top-wrapper img {
        transform: scale(1.06);
    }
    .category-overlay {
        position: absolute;
        top: 14px;
        left: 14px;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        box-shadow: 0 2px 8px rgba(37,99,235,0.3);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .blog-grid-card .card-body {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .blog-meta {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 12px;
        font-size: 12px;
        color: #94A3B8;
        font-weight: 500;
    }
    .blog-meta i { margin-right: 4px; }
    .blog-grid-card .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.4;
        margin-bottom: 10px;
    }
    .blog-grid-card .card-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .blog-grid-card .card-title a:hover { color: #2563EB; }
    .blog-grid-card .card-text {
        font-size: 14px;
        color: #64748B;
        line-height: 1.7;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .card-footer-custom {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid #F1F5F9;
    }
    .author-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .author-avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        background: rgba(37,99,235,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2563EB;
        font-size: 13px;
    }
    .author-name {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
    }
    .read-more-link {
        font-size: 13px;
        font-weight: 600;
        color: #2563EB;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .read-more-link:hover {
        color: #1D4ED8;
        gap: 8px;
    }
    .read-more-link i { transition: transform 0.2s ease; }
    .read-more-link:hover i { transform: translateX(3px); }

    /* ===== PLACEHOLDER ===== */
    .img-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #E2E8F0 0%, #CBD5E1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .blog-hero { padding: 100px 0 70px; }
        .blog-hero h1 { font-size: 2rem; }
        .filter-pills { width: 100%; overflow-x: auto; flex-wrap: nowrap; justify-content: flex-start; padding: 5px; }
        .btn-filter { white-space: nowrap; padding: 8px 16px; }
        .featured-card .featured-img { min-height: 220px; }
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="blog-hero text-center">
    <div class="container position-relative" style="z-index: 2;">
        <span class="d-inline-flex align-items-center px-3 py-2 rounded-pill mb-3" style="background: rgba(37,99,235,0.1); border: 1px solid rgba(37,99,235,0.15);">
            <i class="fas fa-pen-nib me-2" style="color: #60A5FA;"></i>
            <span class="small fw-bold text-uppercase" style="color: #60A5FA; letter-spacing: 1.5px;">Insight & Tech Trends</span>
        </span>
        <h1 class="display-4 fw-bold text-white mb-3">Wawasan & <span class="gradient-text">Inovasi Teknologi</span></h1>
        <p class="lead mx-auto mb-0" style="max-width: 620px; color: #94A3B8; font-weight: 400;">
            Temukan tips, tutorial, dan berita terbaru seputar transformasi digital untuk membantu pertumbuhan bisnis Anda.
        </p>
    </div>
</section>

{{-- Filter --}}
<div class="filter-bar">
    <div class="container text-center">
        <div class="filter-pills">
            <button class="btn-filter {{ !request('category') ? 'active' : '' }}" data-filter="">Semua Artikel</button>
            @foreach($categories as $cat)
                <button class="btn-filter {{ request('category') == $cat->slug ? 'active' : '' }}" data-filter="{{ $cat->slug }}">{{ $cat->name }}</button>
            @endforeach
        </div>
    </div>
</div>

{{-- Content --}}
<section class="py-5" style="background: #F8FAFC;">
    <div class="container py-lg-3">

        {{-- Featured Post --}}
        @if($featuredPost && !request()->has('search') && !request()->has('category'))
        <div class="mb-5 blog-item" data-category="{{ $featuredPost->category ? $featuredPost->category->slug : '' }}" style="opacity: 1; transition: opacity 0.3s ease;">
            <div class="featured-card">
                <div class="row g-0">
                    <div class="col-lg-6 position-relative">
                        @if($featuredPost->featured_image)
                            <img src="{{ Storage::url($featuredPost->featured_image) }}" class="featured-img w-100" alt="{{ $featuredPost->title }}">
                        @else
                            <div class="featured-img w-100 img-placeholder" style="min-height: 340px;">
                                <i class="fas fa-newspaper fa-4x" style="color: #CBD5E1;"></i>
                            </div>
                        @endif
                        <span class="featured-badge"><i class="fas fa-fire me-1"></i> Featured</span>
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center p-4 p-lg-5">
                        @if($featuredPost->category)
                            <span class="d-inline-block mb-2" style="color: #2563EB; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">{{ $featuredPost->category->name }}</span>
                        @endif
                        <h2 class="fw-bold mb-3" style="color: #0F172A; font-size: 1.6rem; line-height: 1.35;">
                            <a href="{{ route('blog.show', $featuredPost->slug) }}" class="text-decoration-none text-dark">{{ $featuredPost->title }}</a>
                        </h2>
                        <p style="color: #64748B; line-height: 1.7; margin-bottom: 24px;">{{ Str::limit($featuredPost->excerpt, 180) }}</p>
                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <div class="d-flex align-items-center gap-3">
                                <div class="author-avatar"><i class="fas fa-user"></i></div>
                                <div>
                                    <div class="author-name">{{ $featuredPost->author->name ?? 'Admin' }}</div>
                                    <small style="color: #94A3B8; font-size: 12px;">
                                        <i class="far fa-calendar me-1"></i>{{ $featuredPost->published_at->format('d M Y') }}
                                        <span class="mx-1">·</span>
                                        <i class="far fa-eye me-1"></i>{{ $featuredPost->views }} views
                                    </small>
                                </div>
                            </div>
                            <a href="{{ route('blog.show', $featuredPost->slug) }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold d-none d-md-inline-block" style="font-size: 14px;">
                                Baca Artikel <i class="fas fa-arrow-right ms-2 small"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Blog Grid --}}
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4 blog-item" data-category="{{ $blog->category ? $blog->category->slug : '' }}" style="opacity: 1; transition: opacity 0.3s ease;">
                    <div class="blog-grid-card">
                        <div class="card-img-top-wrapper">
                            @if($blog->featured_image)
                                <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}">
                            @else
                                <div class="img-placeholder">
                                    <i class="fas fa-newspaper fa-3x" style="color: #CBD5E1;"></i>
                                </div>
                            @endif
                            @if($blog->category)
                                <span class="category-overlay">{{ $blog->category->name }}</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="blog-meta">
                                <span><i class="far fa-calendar-alt"></i> {{ $blog->published_at->format('d M Y') }}</span>
                                <span><i class="far fa-eye"></i> {{ $blog->views ?? 0 }}</span>
                            </div>
                            <h5 class="card-title">
                                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                            </h5>
                            <p class="card-text">{{ Str::limit($blog->excerpt, 120) }}</p>
                            <div class="card-footer-custom">
                                <div class="author-info">
                                    <div class="author-avatar"><i class="fas fa-user"></i></div>
                                    <span class="author-name">{{ $blog->author->name ?? 'Admin' }}</span>
                                </div>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="read-more-link">
                                    Selengkapnya <i class="fas fa-arrow-right ms-1 small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x mb-3" style="color: #CBD5E1;"></i>
                        <h4 style="color: #64748B;">Belum ada artikel tersedia</h4>
                        <p style="color: #94A3B8;">Artikel akan muncul di sini setelah dipublikasikan</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($blogs->hasPages())
        <nav class="mt-5 pt-3 d-flex justify-content-center">
            {{ $blogs->links('pagination::bootstrap-5') }}
        </nav>
        @endif
    </div>
</section>

{{-- Newsletter --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="position-relative overflow-hidden rounded-4 p-4 p-lg-5" style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);">
            <div class="position-absolute w-100 h-100 top-0 start-0" style="background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">
                    <span class="d-inline-flex align-items-center px-3 py-1 rounded-pill mb-3" style="background: rgba(37,99,235,0.15); border: 1px solid rgba(37,99,235,0.2);">
                        <i class="fas fa-paper-plane me-2" style="color: #60A5FA;"></i>
                        <span class="small fw-bold text-uppercase" style="color: #60A5FA; letter-spacing: 1px;">Newsletter</span>
                    </span>
                    <h2 class="fw-bold text-white mb-3" style="font-size: 1.75rem;">Tetap Update dengan Tren Teknologi</h2>
                    <p class="mb-0" style="color: #94A3B8; line-height: 1.7;">
                        Dapatkan kurasi berita teknologi dan update project terbaru dari <span class="text-white fw-semibold">PT Sekawan Putra Pratama</span> langsung di inbox Anda.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-3 py-2 fs-6 rounded-3" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form class="d-flex gap-2 flex-column flex-md-row" action="{{ route('newsletter.store') }}" method="POST">
                            @csrf
                            <div class="flex-grow-1">
                                <input type="email"
                                       name="email"
                                       class="form-control border-0 rounded-3 py-3 px-4 @error('email') is-invalid @enderror"
                                       placeholder="Masukkan email Anda..."
                                       value="{{ old('email') }}"
                                       pattern="[^@\s]+@[^@\s]+\.[^@\s]+"
                                       title="Email harus menyertakan simbol '@' dan tanda titik '.'"
                                       required
                                       style="background: rgba(255,255,255,0.08); color: #fff;">
                                @error('email')
                                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary rounded-3 px-4 py-3 fw-bold text-nowrap" style="min-width: 140px;">
                                Subscribe
                            </button>
                        </form>
                    </div>
                    <p class="small mt-3 text-center text-lg-start mb-0" style="color: #64748B;">
                        <i class="fas fa-lock me-1 opacity-50"></i> Kami menghargai privasi Anda sepenuhnya.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                        setTimeout(() => item.style.opacity = '1', 10);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => item.style.display = 'none', 300);
                    }
                });
            });
        });
    });
</script>
@endpush