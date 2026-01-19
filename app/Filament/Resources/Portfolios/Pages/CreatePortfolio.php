<?php

namespace App\Filament\Resources\Portfolios\Pages;

use App\Filament\Resources\Portfolios\PortfolioResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreatePortfolio extends CreateRecord
{
    protected static string $resource = PortfolioResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store file paths temporarily (FileUpload already saved files to storage)
        $this->featuredImagePath = $data['featured_image'] ?? null;
        $this->galleryImagesPaths = $data['images'] ?? [];

        // Remove file paths from data to prevent saving to database column
        unset($data['featured_image'], $data['images']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;

        // Attach featured image to Spatie Media Library
        if (!empty($this->featuredImagePath)) {
            // FileUpload stores path relative to public disk root
            // Path format: "portfolios/featured/filename.jpg"
            $fullPath = Storage::disk('public')->path($this->featuredImagePath);
            
            if (file_exists($fullPath)) {
                $record->addMedia($fullPath)
                    ->usingName($record->title . ' - Featured Image')
                    ->usingFileName(basename($this->featuredImagePath))
                    ->toMediaCollection('featured_image');
            }
        }

        // Attach gallery images to Spatie Media Library
        if (!empty($this->galleryImagesPaths) && is_array($this->galleryImagesPaths)) {
            foreach ($this->galleryImagesPaths as $index => $imagePath) {
                $fullPath = Storage::disk('public')->path($imagePath);
                
                if (file_exists($fullPath)) {
                    $record->addMedia($fullPath)
                        ->usingName($record->title . ' - Gallery Image ' . ($index + 1))
                        ->usingFileName(basename($imagePath))
                        ->toMediaCollection('images');
                }
            }
        }
    }
}
