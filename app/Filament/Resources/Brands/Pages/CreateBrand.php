<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store file path temporarily (FileUpload already saved file to storage)
        $this->logoPath = $data['logo'] ?? null;

        // Remove file path from data to prevent saving to database column
        unset($data['logo']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;

        // Attach logo to Spatie Media Library
        if (!empty($this->logoPath)) {
            $fullPath = Storage::disk('public')->path($this->logoPath);

            if (file_exists($fullPath)) {
                $record->addMedia($fullPath)
                    ->usingName($record->name . ' - Logo')
                    ->usingFileName(basename($this->logoPath))
                    ->toMediaCollection('logo');
            }
        }
    }
}
