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
        $this->moveFromTempUploads($blogPost);
        $this->processImages($blogPost);
    }

    /**
     * Move files from temp-uploads to final directory after create.
     */
    protected function moveFromTempUploads(BlogPost $blogPost): void
    {
        $disk = Storage::disk('public');
        
        // Move featured image from temp-uploads
        if ($blogPost->featured_image && str_starts_with($blogPost->featured_image, 'temp-uploads/')) {
            $oldPath = $blogPost->featured_image;
            $filename = basename($oldPath);
            $newPath = "blog/{$blogPost->id}/{$filename}";
            
            // Ensure directory exists
            $directory = dirname($newPath);
            if (!$disk->exists($directory)) {
                $disk->makeDirectory($directory);
            }
            
            // Move file
            if ($disk->exists($oldPath)) {
                $disk->move($oldPath, $newPath);
                $blogPost->updateQuietly(['featured_image' => $newPath]);
                \Log::info("Moved blog featured image from temp: {$oldPath} -> {$newPath}");
            }
        }
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
        $disk = Storage::disk('public');
        
        // Delete the featured image file
        if ($blogPost->featured_image && $disk->exists($blogPost->featured_image)) {
            $disk->delete($blogPost->featured_image);
        }
        
        // Delete the entire blog folder and all contents
        $blogFolder = "blog/{$blogPost->id}";
        if ($disk->exists($blogFolder)) {
            $disk->deleteDirectory($blogFolder);
            \Log::info("Deleted blog folder with all contents: {$blogFolder}");
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
