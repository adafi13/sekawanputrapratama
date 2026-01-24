<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display blog listing
     */
    public function index(Request $request)
    {
        $query = BlogPost::query()
            ->where('status', 'published')
            ->with(['category', 'author']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $blogs = $query->orderBy('published_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $categories = BlogCategory::withCount('posts')->get();
        
        $recentPosts = BlogPost::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();
        
        $featuredPost = BlogPost::where('status', 'published')
            ->orderBy('views', 'desc')
            ->orderBy('published_at', 'desc')
            ->first();

        return view('frontend.blog.index', compact('blogs', 'categories', 'recentPosts', 'featuredPost'));
    }

    /**
     * Display single blog post
     */
    public function show($slug)
    {
        $blog = BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'author'])
            ->firstOrFail();
        
        // Increment views
        $blog->increment('views');

        $relatedPosts = BlogPost::where('status', 'published')
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->take(3)
            ->get();

        return view('frontend.blog.show', compact('blog', 'relatedPosts'));
    }
}
