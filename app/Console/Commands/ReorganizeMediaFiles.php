<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use App\Models\Portfolio;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ReorganizeMediaFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:reorganize {--dry-run : Show what would be done without actually moving files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reorganize blog and portfolio media files into ID-based folder structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        if ($dryRun) {
            $this->warn('Running in DRY-RUN mode. No files will be moved.');
        }

        $this->info('Starting media reorganization...');
        $this->newLine();

        // Reorganize blog images
        $this->info('Processing Blog Posts...');
        $this->reorganizeBlogImages($dryRun);
        $this->newLine();

        // Reorganize portfolio images
        $this->info('Processing Portfolios...');
        $this->reorganizePortfolioImages($dryRun);
        $this->newLine();

        if ($dryRun) {
            $this->info('Dry-run completed. Run without --dry-run to actually move files.');
        } else {
            $this->info('Media reorganization completed successfully!');
        }

        return Command::SUCCESS;
    }

    protected function reorganizeBlogImages($dryRun = false)
    {
        $disk = Storage::disk('public');
        $blogs = BlogPost::whereNotNull('featured_image')->get();
        $processed = 0;
        $skipped = 0;

        foreach ($blogs as $blog) {
            $oldPath = $blog->featured_image;
            
            // Skip if already in correct structure (blog/{id}/...)
            if (preg_match("/^blog\/{$blog->id}\//", $oldPath)) {
                $skipped++;
                continue;
            }

            // Define new structure
            $filename = basename($oldPath);
            $newDirectory = "blog/{$blog->id}";
            $newPath = "{$newDirectory}/{$filename}";

            // Check if old file exists
            if (!$disk->exists($oldPath)) {
                $this->warn("  [SKIP] Blog #{$blog->id}: File not found - {$oldPath}");
                $skipped++;
                continue;
            }

            if ($dryRun) {
                $this->line("  [DRY-RUN] Blog #{$blog->id}: {$oldPath} → {$newPath}");
            } else {
                // Create directory
                if (!$disk->exists($newDirectory)) {
                    $disk->makeDirectory($newDirectory);
                }

                // Move file
                $disk->move($oldPath, $newPath);

                // Update database
                $blog->updateQuietly(['featured_image' => $newPath]);

                $this->info("  ✓ Blog #{$blog->id}: Moved to {$newPath}");
            }

            $processed++;
        }

        $this->info("  Total: {$blogs->count()} | Processed: {$processed} | Skipped: {$skipped}");
    }

    protected function reorganizePortfolioImages($dryRun = false)
    {
        $disk = Storage::disk('public');
        $portfolios = Portfolio::whereNotNull('featured_image')->get();
        $processed = 0;
        $skipped = 0;

        foreach ($portfolios as $portfolio) {
            $updated = false;

            // Process featured image
            $oldFeaturedPath = $portfolio->featured_image;
            
            if ($oldFeaturedPath && !preg_match("/^portfolios\/{$portfolio->id}\/[^\/]+$/", $oldFeaturedPath)) {
                $filename = basename($oldFeaturedPath);
                $newDirectory = "portfolios/{$portfolio->id}";
                $newFeaturedPath = "{$newDirectory}/{$filename}";

                if ($disk->exists($oldFeaturedPath)) {
                    if ($dryRun) {
                        $this->line("  [DRY-RUN] Portfolio #{$portfolio->id} (Featured): {$oldFeaturedPath} → {$newFeaturedPath}");
                    } else {
                        if (!$disk->exists($newDirectory)) {
                            $disk->makeDirectory($newDirectory);
                        }
                        $disk->move($oldFeaturedPath, $newFeaturedPath);
                        $portfolio->featured_image = $newFeaturedPath;
                        $updated = true;
                        $this->info("  ✓ Portfolio #{$portfolio->id}: Featured moved to {$newFeaturedPath}");
                    }
                    $processed++;
                }
            }

            // Process gallery images
            if ($portfolio->images && is_array($portfolio->images)) {
                $newGalleryPaths = [];
                $galleryDirectory = "portfolios/{$portfolio->id}/gallery";

                foreach ($portfolio->images as $oldGalleryPath) {
                    // Skip if already in correct structure
                    if (preg_match("/^portfolios\/{$portfolio->id}\/gallery\//", $oldGalleryPath)) {
                        $newGalleryPaths[] = $oldGalleryPath;
                        continue;
                    }

                    $filename = basename($oldGalleryPath);
                    $newGalleryPath = "{$galleryDirectory}/{$filename}";

                    if ($disk->exists($oldGalleryPath)) {
                        if ($dryRun) {
                            $this->line("  [DRY-RUN] Portfolio #{$portfolio->id} (Gallery): {$oldGalleryPath} → {$newGalleryPath}");
                        } else {
                            if (!$disk->exists($galleryDirectory)) {
                                $disk->makeDirectory($galleryDirectory);
                            }
                            $disk->move($oldGalleryPath, $newGalleryPath);
                            $newGalleryPaths[] = $newGalleryPath;
                            $updated = true;
                        }
                    } else {
                        $newGalleryPaths[] = $oldGalleryPath; // Keep old path if file not found
                    }
                }

                if (!$dryRun && count($newGalleryPaths) > 0) {
                    $portfolio->images = $newGalleryPaths;
                }
            }

            // Update database
            if (!$dryRun && $updated) {
                $portfolio->updateQuietly([
                    'featured_image' => $portfolio->featured_image,
                    'images' => $portfolio->images
                ]);
            }

            if (!$updated) {
                $skipped++;
            }
        }

        $this->info("  Total: {$portfolios->count()} | Processed: {$processed} | Skipped: {$skipped}");

        // Clean up old empty directories
        if (!$dryRun) {
            $this->cleanupOldDirectories();
        }
    }

    protected function cleanupOldDirectories()
    {
        $disk = Storage::disk('public');
        $oldDirs = [
            'portfolios/featured',
            'portfolios/gallery',
            'blog/featured',
        ];

        foreach ($oldDirs as $dir) {
            if ($disk->exists($dir)) {
                $files = $disk->allFiles($dir);
                if (empty($files)) {
                    $disk->deleteDirectory($dir);
                    $this->info("  ✓ Cleaned up empty directory: {$dir}");
                } else {
                    $this->warn("  [SKIP] Directory not empty: {$dir} ({count($files)} files remaining)");
                }
            }
        }
    }
}
