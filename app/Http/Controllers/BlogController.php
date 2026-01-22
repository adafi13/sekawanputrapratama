<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    /**
     * Display blog listing
     */
    public function index()
    {
        $blogs = BlogPost::where('status', 'published')
            ->with('category')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = BlogCategory::withCount('posts')->get();
        $recentPosts = BlogPost::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return view('frontend.blog.index', compact('blogs', 'categories', 'recentPosts'));
    }

    /**
     * Display single blog post
     */
    public function show($slug)
    {
        $blog = BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->with('category')
            ->firstOrFail();

        $relatedPosts = BlogPost::where('status', 'published')
            ->where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->take(3)
            ->get();

        return view('frontend.blog.show', compact('blog', 'relatedPosts'));
    }
}
