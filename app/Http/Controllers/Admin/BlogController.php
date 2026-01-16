<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::with(['category', 'author'])->latest()->paginate(15);
        return view('admin.blog.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = BlogCategory::orderBy('name')->get();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(StoreBlogRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['author_id'] = auth()->id();
        if ($request->input('status') === 'published' && !isset($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post = BlogPost::create($data);

        if ($request->hasFile('featured_image')) {
            $post->addMediaFromRequest('featured_image')
                ->toMediaCollection('featured_image');
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function show(BlogPost $blog): View
    {
        $blog->load(['category', 'author']);
        return view('admin.blog.show', compact('blog'));
    }

    public function edit(BlogPost $blog): View
    {
        $categories = BlogCategory::orderBy('name')->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(UpdateBlogRequest $request, BlogPost $blog): RedirectResponse
    {
        $data = $request->validated();
        if ($request->input('status') === 'published' && !isset($data['published_at'])) {
            $data['published_at'] = now();
        }
        $blog->update($data);

        if ($request->hasFile('featured_image')) {
            $blog->clearMediaCollection('featured_image');
            $blog->addMediaFromRequest('featured_image')
                ->toMediaCollection('featured_image');
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}
