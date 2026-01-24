<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageCompressionService
{
    /**
     * Compress and convert image to WebP format.
     *
     * @param string $path Original image path
     * @param int $quality Quality (0-100)
     * @param int|null $maxWidth Maximum width (null = no resize)
     * @return string WebP image path
     */
    public static function convertToWebP(string $path, int $quality = 85, ?int $maxWidth = 1920): string
    {
        // Get full path
        $fullPath = Storage::disk('public')->path($path);
        
        if (!file_exists($fullPath)) {
            \Log::warning("Image file not found: {$fullPath}");
            return $path;
        }
        
        // Create Image Manager with GD driver
        $manager = new ImageManager(new Driver());
        
        // Load image
        $image = $manager->read($fullPath);
        
        // Resize if needed
        if ($maxWidth && $image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }
        
        // Generate new WebP filename
        $pathInfo = pathinfo($path);
        $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
        $webpFullPath = Storage::disk('public')->path($webpPath);
        
        // Ensure directory exists
        $directory = dirname($webpFullPath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        
        // Encode to WebP and save
        $encoded = $image->toWebp($quality);
        file_put_contents($webpFullPath, $encoded);
        
        // Delete original image if different from webp
        if (file_exists($fullPath) && $fullPath !== $webpFullPath) {
            @unlink($fullPath);
        }
        
        \Log::info("Converted image to WebP: {$path} -> {$webpPath}");
        
        return $webpPath;
    }
    
    /**
     * Process multiple images for portfolio.
     *
     * @param array $paths Array of image paths
     * @param int $quality Quality (0-100)
     * @param int|null $maxWidth Maximum width
     * @return array Array of WebP paths
     */
    public static function convertMultipleToWebP(array $paths, int $quality = 85, ?int $maxWidth = 1920): array
    {
        $webpPaths = [];
        
        foreach ($paths as $path) {
            try {
                $webpPaths[] = self::convertToWebP($path, $quality, $maxWidth);
            } catch (\Exception $e) {
                \Log::error("Failed to convert image to WebP: {$path}", ['error' => $e->getMessage()]);
                // Keep original if conversion fails
                $webpPaths[] = $path;
            }
        }
        
        return $webpPaths;
    }
    
    /**
     * Generate thumbnail from image.
     *
     * @param string $path Original image path
     * @param int $width Thumbnail width
     * @param int $height Thumbnail height
     * @return string Thumbnail path
     */
    public static function generateThumbnail(string $path, int $width = 400, int $height = 300): string
    {
        $fullPath = Storage::disk('public')->path($path);
        
        if (!file_exists($fullPath)) {
            return $path;
        }
        
        // Create Image Manager
        $manager = new ImageManager(new Driver());
        $image = $manager->read($fullPath);
        
        // Cover (crop to fit)
        $image->cover($width, $height);
        
        // Generate thumbnail filename
        $pathInfo = pathinfo($path);
        $thumbPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_thumb.webp';
        $thumbFullPath = Storage::disk('public')->path($thumbPath);
        
        // Save as WebP
        $encoded = $image->toWebp(85);
        file_put_contents($thumbFullPath, $encoded);
        
        return $thumbPath;
    }
}
