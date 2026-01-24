@extends('frontend.layouts.app')

@section('title', $blog->meta_title ?? $blog->title . ' - Sekawan Putra Pratama')
@section('meta_description', $blog->meta_description ?? Str::limit($blog->excerpt, 160))
@section('meta_keywords', $blog->meta_keywords)

@section('content')

<section class="py-5 bg-light border-bottom">
    <div class="container py-4">
        <div class="row justify-content-center text-center">
            <div class="col-lg-9">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb justify-content-center bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-decoration-none">Blog</a></li>
                        @if($blog->category)
                            <li class="breadcrumb-item active text-muted" aria-current="page">{{ $blog->category->name }}</li>
                        @endif
                    </ol>
                </nav>
                
                <h1 class="display-5 fw-bold text-dark mb-4" style="line-height: 1.2;">
                    {{ $blog->title }}
                </h1>
                
                <div class="d-flex align-items-center justify-content-center gap-3 text-muted flex-wrap">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                            <i class="fas fa-user small"></i>
                        </div>
                        <span class="fw-bold text-dark small">{{ $blog->author->name ?? 'Admin' }}</span>
                    </div>
                    <span class="text-opacity-25">|</span>
                    <div class="small">
                        <i class="far fa-calendar-alt me-1"></i> {{ $blog->published_at->format('d F Y') }}
                    </div>
                    <span class="text-opacity-25">|</span>
                    <div class="small">
                        <i class="far fa-eye me-1"></i> {{ $blog->views }} views
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
                
                @if($blog->featured_image)
                <div class="rounded-4 overflow-hidden shadow-sm mb-5">
                    <img src="{{ Storage::url($blog->featured_image) }}" class="img-fluid w-100" alt="{{ $blog->title }}">
                </div>
                @endif
                
                <div class="article-content text-dark" style="font-size: 1.15rem; line-height: 1.8; color: #334155 !important;">
                    {!! $blog->content !!}
                </div>

                <div class="py-4 border-top border-bottom d-flex flex-wrap justify-content-between align-items-center gap-3 mt-5">
                    @if($blog->category)
                    <div class="tags">
                        <span class="small fw-bold text-muted me-2">Kategori:</span>
                        <a href="{{ route('blog.index') }}?category={{ $blog->category->slug }}" class="badge bg-light text-muted border text-decoration-none px-3 py-2 rounded-pill">
                            {{ $blog->category->name }}
                        </a>
                    </div>
                    @endif
                    <div class="share-buttons d-flex align-items-center gap-3">
                        <span class="small fw-bold text-muted">Bagikan:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $blog->slug)) }}" target="_blank" class="text-secondary hover-primary">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $blog->slug)) }}&text={{ urlencode($blog->title) }}" target="_blank" class="text-secondary hover-primary">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . route('blog.show', $blog->slug)) }}" target="_blank" class="text-secondary hover-primary">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                @if($blog->author)
                <div class="mt-5 p-4 rounded-4 bg-light d-flex align-items-center gap-4">
                    <div class="bg-white p-1 rounded-circle shadow-sm">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Ditulis oleh {{ $blog->author->name }}</h6>
                        <p class="small text-muted mb-0">Berdedikasi untuk memberikan wawasan teknologi terbaru guna membantu UMKM dan Perusahaan di Indonesia bertransformasi digital.</p>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

@if(isset($relatedPosts) && $relatedPosts->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-4">
        <h4 class="fw-bold text-center mb-5">Artikel Terkait</h4>
        <div class="row g-4">
            @foreach($relatedPosts as $related)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden blog-card">
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                            @if($related->featured_image)
                                <img src="{{ Storage::url($related->featured_image) }}" class="card-img-top w-100 h-100 object-fit-cover" alt="{{ $related->title }}">
                            @else
                                <div class="w-100 h-100 bg-gradient d-flex align-items-center justify-content-center">
                                    <i class="fas fa-newspaper fa-3x text-white opacity-25"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            @if($related->category)
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 mb-2">
                                    {{ $related->category->name }}
                                </span>
                            @endif
                            <h6 class="fw-bold mb-2">
                                <a href="{{ route('blog.show', $related->slug) }}" class="text-dark text-decoration-none hover-primary">
                                    {{ Str::limit($related->title, 50) }}
                                </a>
                            </h6>
                            <p class="text-muted small mb-3">{{ Str::limit($related->excerpt, 80) }}</p>
                            <small class="text-muted">
                                <i class="far fa-calendar me-1"></i> {{ $related->published_at->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    .article-content h3 { 
        font-size: 1.8rem; 
        margin-top: 2.5rem; 
        letter-spacing: -0.5px;
    }
    .article-content h2 {
        font-size: 2rem;
        margin-top: 3rem;
        letter-spacing: -0.5px;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }
    .article-content p {
        margin-bottom: 1.2rem;
    }
    .article-content ul, .article-content ol {
        margin: 1.5rem 0;
        padding-left: 2rem;
    }
    .article-content li {
        margin-bottom: 0.5rem;
    }
    .hover-primary:hover { color: #0d6efd !important; }
    .blog-card { transition: all 0.3s ease; }
    .blog-card:hover { transform: translateY(-5px); }
    .italic { font-style: italic; }
    .breadcrumb-item + .breadcrumb-item::before { content: "›"; font-size: 1.2rem; line-height: 1; }
</style>

@endsection