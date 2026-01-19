<?php

namespace App\Filament\Resources\Portfolios\Pages;

use App\Filament\Resources\Portfolios\PortfolioResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPortfolio extends EditRecord
{
    protected static string $resource = PortfolioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Store file paths temporarily (FileUpload already saved files to storage)
        $this->featuredImagePath = $data['featured_image'] ?? null;
        $this->galleryImagesPaths = $data['images'] ?? [];

        // Remove file paths from data to prevent saving to database column
        unset($data['featured_image'], $data['images']);

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        // Handle featured image (only if new file is uploaded)
        // Note: FileUpload returns null/empty if no new file is uploaded
        if (!empty($this->featuredImagePath)) {
            // Clear existing featured image
            $record->clearMediaCollection('featured_image');

            // Add new featured image
            $fullPath = Storage::disk('public')->path($this->featuredImagePath);
            if (file_exists($fullPath)) {
                $record->addMedia($fullPath)
                    ->usingName($record->title . ' - Featured Image')
                    ->usingFileName(basename($this->featuredImagePath))
                    ->toMediaCollection('featured_image');
            }
        }
        // If $this->featuredImagePath is empty, existing media is preserved

        // Handle gallery images (only if new files are uploaded)
        if (!empty($this->galleryImagesPaths) && is_array($this->galleryImagesPaths)) {
            // Clear existing gallery images
            $record->clearMediaCollection('images');

            // Add new gallery images
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
        // If $this->galleryImagesPaths is empty, existing media is preserved
    }
}
