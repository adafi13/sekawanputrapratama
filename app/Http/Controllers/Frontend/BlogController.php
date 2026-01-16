<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')
            ->where('status', 'published')
            ->where(function($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('frontend.blog.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->where(function($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->firstOrFail();

        // Increment views
        $post->increment('views');

        return view('frontend.blog.show', compact('post'));
    }
}
