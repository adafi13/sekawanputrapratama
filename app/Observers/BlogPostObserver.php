<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Cache;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "saved" event.
     */
    public function saved(BlogPost $blogPost): void
    {
        $this->clearCache($blogPost);
    }

    /**
     * Handle the BlogPost "deleted" event.
     */
    public function deleted(BlogPost $blogPost): void
    {
        $this->clearCache($blogPost);
    }

    /**
     * Clear all related cache.
     */
    protected function clearCache(BlogPost $blogPost): void
    {
        // Clear specific post cache
        Cache::forget("blog_post_{$blogPost->slug}");

        // Clear blog listing cache (clear first 10 pages)
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget("blog_posts_page_{$i}");
        }
    }
}
