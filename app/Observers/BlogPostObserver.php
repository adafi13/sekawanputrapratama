<?php

namespace App\Observers;

use App\Models\BlogPost;
use App\Services\ImageCompressionService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "saved" event.
     */
    public function saved(BlogPost $blogPost): void
    {
        $this->clearCache($blogPost);
        $this->processImages($blogPost);
    }

    /**
     * Handle the BlogPost "deleted" event.
     */
    public function deleted(BlogPost $blogPost): void
    {
        $this->clearCache($blogPost);
        $this->deleteImages($blogPost);
    }

    /**
     * Process and convert images to WebP format.
     */
    protected function processImages(BlogPost $blogPost): void
    {
        // Process featured image if exists and not already WebP
        if ($blogPost->featured_image && !str_ends_with($blogPost->featured_image, '.webp')) {
            try {
                $webpPath = ImageCompressionService::convertToWebP($blogPost->featured_image, 85, 1920);
                $blogPost->updateQuietly(['featured_image' => $webpPath]);
            } catch (\Exception $e) {
                \Log::error("Failed to convert blog featured image to WebP: {$blogPost->id}", ['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Delete associated images when blog post is deleted.
     */
    protected function deleteImages(BlogPost $blogPost): void
    {
        if ($blogPost->featured_image) {
            $disk = Storage::disk('public');
            
            // Delete the image file
            if ($disk->exists($blogPost->featured_image)) {
                $disk->delete($blogPost->featured_image);
            }
            
            // Delete the entire blog folder if it exists and is empty
            $blogFolder = "blog/{$blogPost->id}";
            if ($disk->exists($blogFolder)) {
                $files = $disk->files($blogFolder);
                if (empty($files)) {
                    $disk->deleteDirectory($blogFolder);
                    \Log::info("Deleted empty blog folder: {$blogFolder}");
                }
            }
        }
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
