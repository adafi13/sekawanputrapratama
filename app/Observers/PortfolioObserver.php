<?php

namespace App\Observers;

use App\Models\Portfolio;
use App\Services\ImageCompressionService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PortfolioObserver
{
    /**
     * Handle the Portfolio "saved" event.
     */
    public function saved(Portfolio $portfolio): void
    {
        $this->clearCache($portfolio);
        $this->moveFromTempUploads($portfolio);
        $this->processImages($portfolio);
    }

    /**
     * Handle the Portfolio "deleted" event.
     */
    public function deleted(Portfolio $portfolio): void
    {
        $this->clearCache($portfolio);
        $this->deleteImages($portfolio);
    }

    /**
     * Move files from temp-uploads to final directory after create.
     */
    protected function moveFromTempUploads(Portfolio $portfolio): void
    {
        $disk = Storage::disk('public');
        
        // Move featured image from temp-uploads
        if ($portfolio->featured_image && str_starts_with($portfolio->featured_image, 'temp-uploads/')) {
            $oldPath = $portfolio->featured_image;
            $filename = basename($oldPath);
            $newPath = "portfolios/{$portfolio->id}/featured.webp";
            
            // Ensure directory exists
            $directory = dirname($newPath);
            if (!$disk->exists($directory)) {
                $disk->makeDirectory($directory);
            }
            
            // Move file
            if ($disk->exists($oldPath)) {
                $disk->move($oldPath, $newPath);
                $portfolio->updateQuietly(['featured_image' => $newPath]);
                \Log::info("Moved portfolio featured image from temp: {$oldPath} -> {$newPath}");
            }
        }
        
        // Move gallery images from temp-uploads
        if ($portfolio->images && is_array($portfolio->images) && count($portfolio->images) > 0) {
            $newImages = [];
            foreach ($portfolio->images as $index => $imagePath) {
                if (str_starts_with($imagePath, 'temp-uploads/')) {
                    $filename = basename($imagePath);
                    $newPath = "portfolios/{$portfolio->id}/gallery/{$filename}";
                    
                    // Ensure gallery directory exists
                    $galleryDir = "portfolios/{$portfolio->id}/gallery";
                    if (!$disk->exists($galleryDir)) {
                        $disk->makeDirectory($galleryDir);
                    }
                    
                    // Move file
                    if ($disk->exists($imagePath)) {
                        $disk->move($imagePath, $newPath);
                        $newImages[] = $newPath;
                        \Log::info("Moved portfolio gallery image from temp: {$imagePath} -> {$newPath}");
                    } else {
                        $newImages[] = $imagePath;
                    }
                } else {
                    $newImages[] = $imagePath;
                }
            }
            
            if (count($newImages) > 0) {
                $portfolio->updateQuietly(['images' => $newImages]);
            }
        }
    }

    /**
     * Process and convert images to WebP format.
     */
    protected function processImages(Portfolio $portfolio): void
    {
        // Process featured image if exists and not already WebP
        if ($portfolio->featured_image && !str_ends_with($portfolio->featured_image, '.webp')) {
            try {
                $webpPath = ImageCompressionService::convertToWebP($portfolio->featured_image, 85, 1920);
                $portfolio->updateQuietly(['featured_image' => $webpPath]);
            } catch (\Exception $e) {
                \Log::error("Failed to convert portfolio featured image to WebP: {$portfolio->id}", ['error' => $e->getMessage()]);
            }
        }

        // Process gallery images if exist
        if ($portfolio->images && is_array($portfolio->images) && count($portfolio->images) > 0) {
            try {
                $webpPaths = [];
                foreach ($portfolio->images as $imagePath) {
                    if (!str_ends_with($imagePath, '.webp')) {
                        $webpPaths[] = ImageCompressionService::convertToWebP($imagePath, 85, 1920);
                    } else {
                        $webpPaths[] = $imagePath;
                    }
                }
                
                if (count($webpPaths) > 0) {
                    $portfolio->updateQuietly(['images' => $webpPaths]);
                }
            } catch (\Exception $e) {
                \Log::error("Failed to convert portfolio gallery images to WebP: {$portfolio->id}", ['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Delete associated images when portfolio is deleted.
     */
    protected function deleteImages(Portfolio $portfolio): void
    {
        $disk = Storage::disk('public');
        
        // Delete featured image
        if ($portfolio->featured_image && $disk->exists($portfolio->featured_image)) {
            $disk->delete($portfolio->featured_image);
        }
        
        // Delete gallery images
        if ($portfolio->images && is_array($portfolio->images)) {
            foreach ($portfolio->images as $imagePath) {
                if ($disk->exists($imagePath)) {
                    $disk->delete($imagePath);
                }
            }
        }
        
        // Delete the entire portfolio folder if it exists
        $portfolioFolder = "portfolios/{$portfolio->id}";
        if ($disk->exists($portfolioFolder)) {
            $disk->deleteDirectory($portfolioFolder);
            \Log::info("Deleted portfolio folder: {$portfolioFolder}");
        }
    }

    /**
     * Clear all related cache.
     */
    protected function clearCache(Portfolio $portfolio): void
    {
        // Clear specific portfolio cache
        Cache::forget("portfolio_{$portfolio->slug}");

        // Clear portfolio listing cache
        Cache::forget('portfolio_listing');

        // Clear related portfolios cache
        if ($portfolio->category_id) {
            Cache::forget("portfolio_related_{$portfolio->category_id}");
        }

        // Clear home page cache (contains featured portfolios)
        Cache::forget('home_page_data');
    }
}


