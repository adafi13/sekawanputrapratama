<?php

namespace App\Filament\Resources\Testimonials\Pages;

use App\Filament\Resources\Testimonials\TestimonialResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateTestimonial extends CreateRecord
{
    protected static string $resource = TestimonialResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store file paths temporarily (FileUpload already saved files to storage)
        $this->clientPhotoPath = $data['client_photo'] ?? null;
        $this->clientLogoPath = $data['client_logo'] ?? null;

        // Remove file paths from data to prevent saving to database column
        unset($data['client_photo'], $data['client_logo']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;

        // Attach client photo to Spatie Media Library
        if (!empty($this->clientPhotoPath)) {
            $fullPath = Storage::disk('public')->path($this->clientPhotoPath);
            if (file_exists($fullPath)) {
                $record->addMedia($fullPath)
                    ->usingName($record->client_name . ' - Photo')
                    ->usingFileName(basename($this->clientPhotoPath))
                    ->toMediaCollection('client_photo');
            }
        }

        // Attach client logo to Spatie Media Library
        if (!empty($this->clientLogoPath)) {
            $fullPath = Storage::disk('public')->path($this->clientLogoPath);
            if (file_exists($fullPath)) {
                $record->addMedia($fullPath)
                    ->usingName($record->client_company . ' - Logo')
                    ->usingFileName(basename($this->clientLogoPath))
                    ->toMediaCollection('client_logo');
            }
        }
    }
}
