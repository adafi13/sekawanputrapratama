@extends('frontend.layouts.app')

@section('title', $post->meta_title ?: $post->title . ' - Blog - ' . config('app.name'))
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->content), 160))

@section('content')
{{-- Blog Header --}}
<section class="blog-header pt-120 pb-80 bg-dark-blue">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                @if($post->category)
                <span class="blog-category mb-16">{{ $post->category->name }}</span>
                @endif
                <h1 class="white mb-24">{{ $post->title }}</h1>
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
                    @if($post->author)
                    <span class="light-gray">
                        <i class="far fa-user"></i>
                        {{ $post->author }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Featured Image --}}
@if($post->hasMedia('featured_image'))
<section class="blog-featured-image pt-0 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <img src="{{ $post->getFirstMediaUrl('featured_image') }}" 
                     alt="{{ $post->title }}" 
                     class="w-100 rounded">
            </div>
        </div>
    </div>
</section>
@endif

{{-- Blog Content --}}
<section class="blog-content pt-80 pb-80 bg-dark-blue-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if($post->excerpt)
                <div class="excerpt mb-40">
                    <p class="fs-20 light-gray">{{ $post->excerpt }}</p>
                </div>
                @endif
                
                <div class="content light-gray">
                    {!! $post->content !!}
                </div>

                {{-- Tags --}}
                @if($post->tags && count($post->tags) > 0)
                <div class="tags-section mt-60 pt-40" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <h5 class="white mb-24">Tags</h5>
                    <div class="tags">
                        @foreach($post->tags as $tag)
                        <a href="{{ route('blog.index', ['tag' => $tag]) }}" class="tag">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Share Buttons --}}
                <div class="share-section mt-40 pt-40" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <h5 class="white mb-24">Share this post</h5>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" 
                           target="_blank" 
                           class="share-btn facebook">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" 
                           target="_blank" 
                           class="share-btn twitter">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}" 
                           target="_blank" 
                           class="share-btn linkedin">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . route('blog.show', $post->slug)) }}" 
                           target="_blank" 
                           class="share-btn whatsapp">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Posts --}}
@if($relatedPosts->count() > 0)
<section class="related-posts pt-80 pb-120 bg-dark-blue">
    <div class="container">
        <div class="row mb-60">
            <div class="col-lg-12 text-center">
                <h2 class="white">Related Articles</h2>
            </div>
        </div>
        <div class="row">
            @foreach($relatedPosts as $related)
            <div class="col-lg-4 mb-30">
                <article class="blog-card">
                    <a href="{{ route('blog.show', $related->slug) }}" class="blog-image-wrapper">
                        @if($related->hasMedia('featured_image'))
                        <img src="{{ $related->getFirstMediaUrl('featured_image', 'thumb') }}" 
                             alt="{{ $related->title }}"
                             class="blog-image"
                             loading="lazy">
                        @else
                        <img src="{{ asset('assets/media/placeholder-blog.jpg') }}" 
                             alt="{{ $related->title }}"
                             class="blog-image"
                             loading="lazy">
                        @endif
                    </a>
                    <div class="blog-content">
                        @if($related->category)
                        <span class="blog-category">{{ $related->category->name }}</span>
                        @endif
                        <h4 class="white mb-16">
                            <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                        </h4>
                        <div class="blog-meta">
                            <span class="light-gray">
                                <i class="far fa-calendar"></i>
                                {{ $related->published_at ? $related->published_at->format('M d, Y') : $related->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA Section --}}
<section class="cta-section pt-80 pb-80 bg-blue">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="white mb-16">Have a Project in Mind?</h2>
                <p class="light-gray fs-18 mb-0">Let's discuss how we can help you achieve your goals</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-white btn-lg">Contact Us</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.blog-category {
    display: inline-block;
    padding: 6px 16px;
    background: rgba(79, 172, 254, 0.1);
    color: var(--blue);
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
}
.blog-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    justify-content: center;
    font-size: 15px;
}
.blog-meta i {
    margin-right: 8px;
    color: var(--blue);
}
.excerpt p {
    font-weight: 500;
    line-height: 1.7;
}
.content {
    font-size: 16px;
    line-height: 1.8;
}
.content p {
    margin-bottom: 20px;
}
.content h2,
.content h3,
.content h4 {
    color: #fff;
    margin-top: 40px;
    margin-bottom: 20px;
}
.content h2 {
    font-size: 32px;
}
.content h3 {
    font-size: 26px;
}
.content h4 {
    font-size: 22px;
}
.content ul,
.content ol {
    margin-bottom: 20px;
    padding-left: 24px;
}
.content li {
    margin-bottom: 12px;
}
.content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 30px 0;
}
.content blockquote {
    padding: 20px 24px;
    background: rgba(79, 172, 254, 0.1);
    border-left: 4px solid var(--blue);
    margin: 30px 0;
    font-style: italic;
}
.content code {
    padding: 2px 6px;
    background: rgba(255,255,255,0.1);
    color: var(--blue);
    border-radius: 4px;
    font-size: 14px;
}
.content pre {
    padding: 20px;
    background: rgba(0,0,0,0.3);
    border-radius: 8px;
    overflow-x: auto;
    margin: 20px 0;
}
.tags {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}
.tag {
    display: inline-block;
    padding: 8px 16px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.tag:hover {
    background: var(--blue);
    border-color: var(--blue);
    color: #fff;
}
.share-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}
.share-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}
.share-btn.facebook {
    background: #1877f2;
    color: #fff;
}
.share-btn.twitter {
    background: #1da1f2;
    color: #fff;
}
.share-btn.linkedin {
    background: #0077b5;
    color: #fff;
}
.share-btn.whatsapp {
    background: #25d366;
    color: #fff;
}
.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    color: #fff;
}
.blog-card {
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.blog-card:hover {
    transform: translateY(-8px);
}
.blog-image-wrapper {
    display: block;
    position: relative;
    overflow: hidden;
    padding-top: 60%;
}
.blog-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.blog-content {
    padding: 24px;
    flex: 1;
}
.blog-content h4 a {
    color: #fff;
    text-decoration: none;
}
.blog-content h4 a:hover {
    color: var(--blue);
}
</style>
@endpush
