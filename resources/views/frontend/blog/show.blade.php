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
                
                <div class="blog-content">
                    {!! $post->content !!}
                </div>
                
                <div class="blog-meta mt-48 pt-32" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="medium-gray mb-0">
                                <strong>Penulis:</strong> {{ $post->author->name }}
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

