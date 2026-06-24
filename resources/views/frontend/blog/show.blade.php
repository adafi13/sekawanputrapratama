@extends('frontend.layouts.app')

@section('title', ($blog->meta_title ?? $blog->title) . ' - PT Sekawan Putra Pratama')
@section('meta_description', $blog->meta_description ?? Str::limit($blog->excerpt, 160))

@include('frontend.partials.breadcrumb-schema', ['crumbs' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Blog', 'url' => route('blog.index')],
    ['name' => $blog->title, 'url' => route('blog.show', $blog->slug)],
]])

@push('styles')
<style>
    .blog-detail-hero {
        background-color: var(--navy-dark);
        padding: 140px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .blog-detail-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(37, 99, 235, 0.1) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.2;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.3);
    }

    .article-container {
        margin-top: -60px;
        position: relative;
        z-index: 10;
    }

    .article-card {
        background: #fff;
        border-radius: 24px;
        padding: 50px;
        box-shadow: var(--shadow-card);
        border: 1px solid rgba(226, 232, 240, 0.5);
    }

    .article-content {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #334155;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .article-content h2, .article-content h3 {
        color: var(--midnight-blue);
        font-weight: 700;
        margin-top: 2.5rem;
        margin-bottom: 1.25rem;
    }

    .article-content img {
        border-radius: 16px;
        margin: 2rem 0;
        max-width: 100%;
        height: auto;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .author-box-modern {
        background: #F8FAFC;
        border-radius: 20px;
        padding: 30px;
        display: flex;
        align-items: center;
        gap: 25px;
        margin-top: 50px;
        border: 1px solid #E2E8F0;
    }

    .author-avatar-lg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--electric-blue);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        flex-shrink: 0;
    }

    .share-pill {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 8px 20px;
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 100px;
        color: var(--slate-600);
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: var(--transition);
    }

    .share-pill:hover {
        background: var(--slate-100);
        color: var(--electric-blue);
        border-color: var(--electric-blue);
    }

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
        .blog-detail-hero { padding: 120px 0 100px; }
        .article-card { padding: 25px; }
        .author-box-modern { flex-direction: column; text-align: center; }
    }
</style>
@endpush

@section('content')

{{-- Blog Hero --}}
<section class="blog-detail-hero">
    <div class="container position-relative z-1 text-center">
        <nav aria-label="breadcrumb" class="mb-4 d-flex justify-content-center reveal">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-white-50 text-decoration-none">Blog</a></li>
                @if($blog->category)
                    <li class="breadcrumb-item"><a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="text-white-50 text-decoration-none">{{ $blog->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active text-white" aria-current="page">Artikel</li>
            </ol>
        </nav>
        <div class="reveal">
            <h1 class="display-5 fw-bold text-white mb-4" style="max-width: 900px; margin-left: auto; margin-right: auto; line-height: 1.3;">
                {{ $blog->title }}
            </h1>
            <div class="d-flex align-items-center justify-content-center gap-4 text-white-50 small fw-medium">
                <span class="d-flex align-items-center gap-2">
                    <i class="far fa-calendar-alt text-primary"></i> {{ $blog->published_at->format('M d, Y') }}
                </span>
                <span class="d-flex align-items-center gap-2">
                    <i class="far fa-user text-primary"></i> {{ $blog->author->name ?? 'Admin' }}
                </span>
                <span class="d-flex align-items-center gap-2">
                    <i class="far fa-eye text-primary"></i> {{ $blog->views }} Views
                </span>
            </div>
        </div>
    </div>
</section>

{{-- Article Content --}}
<section class="pb-5 mb-5 bg-white">
    <div class="container article-container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="article-card reveal">
                    @if($blog->featured_image)
                        <div class="rounded-4 overflow-hidden mb-5 shadow-lg">
                            <img src="{{ Storage::url($blog->featured_image) }}" class="w-100" alt="{{ $blog->title }}">
                        </div>
                    @endif

                    <div class="article-content">
                        {!! $blog->content !!}
                    </div>

                    {{-- Tags & Share --}}
                    <div class="mt-5 pt-5 border-top d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="fw-bold text-dark small">Bagikan:</span>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="share-pill">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="share-pill">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . url()->current()) }}" target="_blank" class="share-pill">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Author Box --}}
                    @if($blog->author)
                    <div class="author-box-modern">
                        <div class="author-avatar-lg">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <span class="text-primary fw-bold text-uppercase small tracking-widest d-block mb-1">Penulis</span>
                            <h4 class="fw-bold text-dark mb-2">{{ $blog->author->name }}</h4>
                            <p class="text-secondary mb-0 small">Expert IT di PT Sekawan Putra Pratama yang berfokus pada pengembangan solusi digital yang inovatif dan terukur untuk membantu transformasi bisnis.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Posts --}}
@if(isset($relatedPosts) && $relatedPosts->count() > 0)
<section class="py-5 bg-light border-top">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-5 reveal">
            <h3 class="fw-bold m-0" style="color: var(--midnight-blue);">Artikel Terkait</h3>
            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary rounded-pill px-4">Lihat Semua</a>
        </div>
        <div class="row g-4 reveal">
            @foreach($relatedPosts as $related)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white" style="transition: var(--transition);">
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                            @if($related->featured_image)
                                <img src="{{ Storage::url($related->featured_image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $related->title }}" loading="lazy">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                                    <i class="fas fa-newspaper fa-2x opacity-25"></i>
                                </div>
                            @endif
                            <a href="{{ route('blog.show', $related->slug) }}" class="stretched-link"></a>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-primary fw-bold text-uppercase mb-2" style="font-size: 10px; letter-spacing: 1px;">
                                {{ $related->category->name ?? 'General' }}
                            </div>
                            <h5 class="fw-bold text-dark mb-2">{{ Str::limit($related->title, 50) }}</h5>
                            <p class="text-muted small mb-0">{{ Str::limit($related->excerpt ?? strip_tags($related->content), 80) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Final CTA --}}
<section class="py-5 bg-white">
    <div class="container reveal">
        <div class="rounded-4 p-5 text-center bg-light border">
            <h2 class="fw-bold mb-3" style="color: var(--midnight-blue);">Ingin Diskusi Lebih Lanjut?</h2>
            <p class="text-secondary mb-4 mx-auto" style="max-width: 600px;">Tim ahli kami siap membantu Anda mengimplementasikan solusi teknologi yang dibahas dalam artikel ini.</p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow">Hubungi Kami</a>
                <a href="https://wa.me/6285156412702" class="btn btn-outline-success rounded-pill px-5 py-3 fw-bold">
                    <i class="fab fa-whatsapp me-2"></i> Konsultasi WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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