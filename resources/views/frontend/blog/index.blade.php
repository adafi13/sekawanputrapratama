@extends('frontend.layouts.app')

@section('title', 'Blog & Berita - Sekawan Putra Pratama')

@section('content')
<section class="banner-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-inner-block text-center">
                    <h1 class="banner-inner-title h-91 color-sec">Blog & Insight</h1>
                    <p class="banner-text medium-gray">Berita terbaru, tips teknologi, dan wawasan seputar transformasi digital.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-listing mb-100">
    <div class="container-fluid">
        <div class="row">
            @php
                $posts = \App\Models\BlogPost::where('status', 'published')
                    ->where('published_at', '<=', now())
                    ->orderBy('published_at', 'desc')
                    ->paginate(9);
            @endphp
            
            @forelse($posts as $post)
                <div class="col-lg-4 col-md-6 mb-32">
                    <div class="blog-block">
                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-image mb-24 d-block">
                            @if($post->getFirstMediaUrl('featured_image'))
                                <img src="{{ $post->getFirstMediaUrl('featured_image') }}" loading="lazy" alt="{{ $post->title }}" class="w-100" style="border-radius: 16px;">
                            @else
                                <img src="{{ asset('assets/media/images/blog-image-1.png') }}" loading="lazy" alt="{{ $post->title }}" class="w-100" style="border-radius: 16px;">
                            @endif
                        </a>
                        <div class="blog-content">
                            <p class="date medium-gray mb-8">
                                {{ $post->published_at->format('d M Y') }} 
                                @if($post->category)
                                    • {{ $post->category->name }}
                                @endif
                            </p>
                            <h4 class="white mb-16">
                                <a href="{{ route('blog.show', $post->slug) }}" class="white">{{ $post->title }}</a>
                            </h4>
                            <p class="medium-gray mb-24">{{ Str::limit($post->excerpt ?? $post->content, 100) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="color-primary fw-bold">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="medium-gray">Belum ada artikel blog.</p>
                </div>
            @endforelse
        </div>
        
        @if($posts->hasPages())
            <div class="row">
                <div class="col-12">
                    {{ $posts->links() }}
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

