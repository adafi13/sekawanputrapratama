@extends('frontend.layouts.app')

@section('title', $post->meta_title ?? $post->title . ' - Sekawan Putra Pratama')
@section('meta_description', $post->meta_description ?? Str::limit($post->excerpt ?? $post->content, 160))

@section('content')
<section class="banner-inner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-inner-block text-center">
                    <h1 class="banner-inner-title h-91 color-sec">{{ $post->title }}</h1>
                    <p class="banner-text medium-gray">
                        {{ $post->published_at->format('d M Y') }} 
                        @if($post->category)
                            • {{ $post->category->name }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-detail mb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if($post->getFirstMediaUrl('featured_image'))
                    <div class="blog-featured-image mb-32">
                        <img src="{{ $post->getFirstMediaUrl('featured_image') }}" alt="{{ $post->title }}" class="w-100" style="border-radius: 16px;">
                    </div>
                @endif
                
                <div class="blog-text">
                    <div class="d-flex align-items-center gap-3 mb-24">
                        @if($post->category)
                            <span class="badge bg-primary">{{ $post->category->name }}</span>
                        @endif
                        <span class="medium-gray">{{ $post->published_at->format('d M Y') }}</span>
                    </div>
                    
                    <div class="blog-content">
                        {!! $post->content !!}
                    </div>
                    
                    <hr style="border-color: #333;" class="my-32">
                    
                    <div class="d-flex justify-content-between align-items-center mt-32">
                        <h5 class="white mb-0">Bagikan:</h5>
                        <div class="share-icons d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="cus-btn-2" style="width:40px; height:40px; padding:0; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="cus-btn-2" style="width:40px; height:40px; padding:0; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . request()->url()) }}" target="_blank" class="cus-btn-2" style="width:40px; height:40px; padding:0; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="blog-meta mt-48 pt-32" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="medium-gray mb-0">
                                <strong>Penulis:</strong> {{ $post->author->name ?? 'Admin' }}
                            </p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p class="medium-gray mb-0">
                                <strong>Dilihat:</strong> {{ number_format($post->views) }} kali
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


