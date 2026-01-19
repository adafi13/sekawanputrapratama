<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = "blog_posts_page_{$page}";

        $posts = Cache::remember($cacheKey, now()->addMinutes(30), function () {
            return BlogPost::with(['category:id,name,slug', 'media'])
                ->where('status', 'published')
                ->where(function ($query) {
                    $query->whereNull('published_at')
                        ->orWhere('published_at', '<=', now());
                })
                ->orderBy('published_at', 'desc')
                ->select(['id', 'title', 'slug', 'excerpt', 'category_id', 'published_at', 'views'])
                ->paginate(9);
        });

        return view('frontend.blog.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $cacheKey = "blog_post_{$slug}";

        $post = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($slug) {
            return BlogPost::with(['category:id,name,slug', 'author:id,name', 'media'])
                ->where('slug', $slug)
                ->where('status', 'published')
                ->where(function ($query) {
                    $query->whereNull('published_at')
                        ->orWhere('published_at', '<=', now());
                })
                ->firstOrFail();
        });

        // Increment views (non-blocking, doesn't affect cache)
        // Using update instead of increment to avoid race conditions
        BlogPost::where('id', $post->id)->increment('views', 1, [
            'updated_at' => now(),
        ]);

        return view('frontend.blog.show', compact('post'));
    }
}
