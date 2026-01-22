@extends('frontend.layouts.app')

@section('title', 'Blog - ' . config('app.name'))

@section('content')
{{-- Page Header --}}
<section class="page-banner bg-dark-blue pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="white mb-16">Our Blog</h1>
                <p class="light-gray fs-18">Insights, tutorials, and updates from our team</p>
            </div>
        </div>
    </div>
</section>

{{-- Blog Categories Filter --}}
@if($categories->count() > 0)
<section class="blog-filter pt-60 pb-30 bg-dark-blue-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-buttons text-center mb-30">
                    <a href="{{ route('blog.index') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">
                        All Posts
                    </a>
                    @foreach($categories as $category)
                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}" 
                       class="filter-btn {{ request('category') == $category->slug ? 'active' : '' }}">
                        {{ $category->name }}
                        @if($category->posts_count > 0)
                        <span>({{ $category->posts_count }})</span>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Blog Grid --}}
<section class="blog-grid pt-80 pb-120 bg-dark-blue-2">
    <div class="container">
        @if($blogs->count() > 0)
        <div class="row">
            @foreach($blogs as $post)
            <div class="col-lg-4 col-md-6 mb-40">
                <article class="blog-card">
                    <a href="{{ route('blog.show', $post->slug) }}" class="blog-image-wrapper">
                        @if($post->hasMedia('featured_image'))
                        <img src="{{ $post->getFirstMediaUrl('featured_image', 'thumb') }}" 
                             alt="{{ $post->title }}" 
                             class="blog-image"
                             loading="lazy">
                        @else
                        <img src="{{ asset('assets/media/placeholder-blog.jpg') }}" 
                             alt="{{ $post->title }}"
                             class="blog-image"
                             loading="lazy">
                        @endif
                    </a>
                    <div class="blog-content">
                        @if($post->category)
                        <span class="blog-category">{{ $post->category->name }}</span>
                        @endif
                        <h4 class="white mb-16">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h4>
                        @if($post->excerpt)
                        <p class="medium-gray">{{ Str::limit($post->excerpt, 120) }}</p>
                        @else
                        <p class="medium-gray">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                        @endif
                        <div class="blog-meta">
                            <span class="light-gray">
                                <i class="far fa-calendar"></i>
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                            </span>
                            @if($post->read_time)
                            <span class="light-gray">
                                <i class="far fa-clock"></i>
                                {{ $post->read_time }} min read
                            </span>
                            @endif
                        </div>
                        <a href="{{ route('blog.show', $post->slug) }}" class="read-more">
                            Read More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($blogs->hasPages())
        <div class="row mt-40">
            <div class="col-lg-12">
                <div class="pagination-wrapper text-center">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
        @endif
        @else
        <div class="row">
            <div class="col-lg-12">
                <div class="no-results text-center pt-60 pb-60">
                    <i class="fas fa-file-alt fs-64 medium-gray mb-24"></i>
                    <h3 class="white mb-16">No Posts Found</h3>
                    <p class="light-gray">We're working on new content. Check back soon!</p>
                    @if(request('category'))
                    <a href="{{ route('blog.index') }}" class="btn btn-blue mt-24">View All Posts</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- Newsletter CTA --}}
<section class="newsletter-section pt-80 pb-80 bg-blue">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-lg-0 mb-30">
                <h2 class="white mb-16">Stay Updated</h2>
                <p class="light-gray fs-18 mb-0">Subscribe to our newsletter for the latest insights and updates</p>
            </div>
            <div class="col-lg-6">
                <form action="#" method="POST" class="newsletter-form">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        <button type="submit" class="btn btn-white">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.blog-filter {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.filter-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
}
.filter-btn {
    padding: 12px 24px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.filter-btn:hover,
.filter-btn.active {
    background: var(--blue);
    border-color: var(--blue);
    color: #fff;
}
.blog-card {
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.3);
}
.blog-image-wrapper {
    display: block;
    position: relative;
    overflow: hidden;
    padding-top: 60%; /* 5:3 aspect ratio */
}
.blog-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.blog-card:hover .blog-image {
    transform: scale(1.1);
}
.blog-content {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.blog-category {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(79, 172, 254, 0.1);
    color: var(--blue);
    border-radius: 4px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 12px;
}
.blog-content h4 {
    margin-bottom: 16px;
}
.blog-content h4 a {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s ease;
}
.blog-content h4 a:hover {
    color: var(--blue);
}
.blog-meta {
    display: flex;
    gap: 20px;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid rgba(255,255,255,0.1);
    font-size: 14px;
}
.blog-meta i {
    margin-right: 6px;
    color: var(--blue);
}
.read-more {
    display: inline-block;
    color: var(--blue);
    font-weight: 600;
    margin-top: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.read-more:hover {
    color: #fff;
    transform: translateX(4px);
}
.newsletter-form {
    position: relative;
}
.newsletter-form .input-group {
    display: flex;
    gap: 12px;
}
.newsletter-form .form-control {
    flex: 1;
    padding: 16px 24px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    color: #fff;
    border-radius: 8px;
}
.newsletter-form .form-control::placeholder {
    color: rgba(255,255,255,0.5);
}
.newsletter-form .btn {
    padding: 16px 32px;
    white-space: nowrap;
}
.no-results i {
    opacity: 0.3;
}
</style>
@endpush
