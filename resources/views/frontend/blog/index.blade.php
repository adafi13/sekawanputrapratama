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
    <div class="container py-lg-4">
        
        {{-- Category Filter Pills --}}
        <div class="d-flex justify-content-center mb-5 animate-up">
            <div class="p-2 bg-light rounded-pill d-inline-flex gap-1 border shadow-sm">
                <button class="btn btn-filter {{ !request('category') ? 'active' : '' }} rounded-pill px-4 py-2 fw-bold small" data-filter="">Semua Artikel</button>
                @foreach($categories as $cat)
                    <button class="btn btn-filter {{ request('category') == $cat->slug ? 'active' : '' }} rounded-pill px-4 py-2 fw-bold small" data-filter="{{ $cat->slug }}">{{ $cat->name }}</button>
                @endforeach
            </div>
        </div>

        @if($featuredPost && !request()->has('search') && !request()->has('category'))
        <div class="row g-4 mb-5">
            <div class="col-12 blog-item" data-category="{{ $featuredPost->category ? $featuredPost->category->slug : '' }}" style="opacity: 1; transition: opacity 0.3s ease;">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden blog-card featured">
                    <div class="row g-0">
                        <div class="col-md-6 position-relative">
                            @if($featuredPost->featured_image)
                                <img src="{{ Storage::url($featuredPost->featured_image) }}" class="h-100 w-100 object-fit-cover" alt="{{ $featuredPost->title }}">
                            @else
                                <div class="h-100 w-100 bg-gradient d-flex align-items-center justify-content-center" style="min-height: 400px;">
                                    <i class="fas fa-newspaper fa-5x text-white opacity-25"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 start-0 p-3">
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    <i class="fas fa-fire me-1"></i> Featured
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 p-4 p-lg-5 d-flex flex-column justify-content-center">
                            @if($featuredPost->category)
                                <small class="text-primary fw-bold text-uppercase mb-2">{{ $featuredPost->category->name }}</small>
                            @endif
                            <h2 class="fw-bold text-dark mb-3">
                                <a href="{{ route('blog.show', $featuredPost->slug) }}" class="text-decoration-none text-dark hover-primary">
                                    {{ $featuredPost->title }}
                                </a>
                            </h2>
                            <p class="text-muted mb-4">{{ Str::limit($featuredPost->excerpt, 150) }}</p>
                            <div class="d-flex align-items-center mt-auto">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold small text-dark">{{ $featuredPost->author->name ?? 'Admin' }}</p>
                                    <small class="text-muted">
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $featuredPost->published_at->format('d M Y') }}
                                        <span class="mx-2">•</span>
                                        <i class="far fa-eye me-1"></i>
                                        {{ $featuredPost->views }} views
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row g-3">
            @forelse($blogs as $blog)
                <div class="col-12 blog-item" data-category="{{ $blog->category ? $blog->category->slug : '' }}" style="opacity: 1; transition: opacity 0.3s ease;">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden blog-card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="position-relative overflow-hidden h-100" style="min-height: 200px;">
                                    @if($blog->featured_image)
                                        <img src="{{ Storage::url($blog->featured_image) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $blog->title }}">
                                    @else
                                        <div class="w-100 h-100 bg-gradient d-flex align-items-center justify-content-center">
                                            <i class="fas fa-newspaper fa-3x text-white opacity-25"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-2">
                                        @if($blog->category)
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 me-2">{{ $blog->category->name }}</span>
                                        @endif
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i> {{ $blog->published_at->format('d M Y') }}
                                        </small>
                                        <small class="text-muted ms-auto">
                                            <i class="far fa-eye me-1"></i> {{ $blog->views ?? 0 }} views
                                        </small>
                                    </div>
                                    <h5 class="fw-bold mb-2">
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark hover-primary">
                                            {{ $blog->title }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-3">{{ Str::limit($blog->excerpt, 150) }}</p>
                                    <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                <i class="fas fa-user small text-primary"></i>
                                            </div>
                                            <small class="text-muted fw-medium">{{ $blog->author->name ?? 'Admin' }}</small>
                                        </div>
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            Baca Selengkapnya <i class="fas fa-arrow-right ms-1 small"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada artikel tersedia</h4>
                        <p class="text-muted">Artikel akan muncul di sini setelah dipublikasikan</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($blogs->hasPages())
        <nav class="mt-5 pt-4">
            {{ $blogs->links('pagination::bootstrap-5') }}
        </nav>
        @endif
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
    .blog-card:hover { transform: translateX(5px); box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important; }
    .blog-card img { transition: transform 0.5s ease; }
    .blog-card:hover img { transform: scale(1.05); }
    
    .hover-primary:hover { color: #0d6efd !important; }
    .page-link { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; }
    
    /* Filter Button */
    .btn-filter { color: #64748b; border: none; background: transparent; }
    .btn-filter:hover { background: rgba(13, 110, 253, 0.05); color: #0d6efd; }
    .btn-filter.active { background: #0d6efd !important; color: white !important; box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3); }
</style>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('.btn-filter');
        const items = document.querySelectorAll('.blog-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Update Active Button
                filters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                const category = this.getAttribute('data-filter');

                // Filter items with smooth animation
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