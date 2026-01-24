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


