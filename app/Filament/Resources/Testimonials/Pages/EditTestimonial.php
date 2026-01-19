<?php

namespace App\Filament\Resources\Testimonials\Pages;

use App\Filament\Resources\Testimonials\TestimonialResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditTestimonial extends EditRecord
{
    protected static string $resource = TestimonialResource::class;

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
        // Store file paths temporarily if new files uploaded
        if (isset($data['client_photo'])) {
            $this->clientPhotoPath = $data['client_photo'];
        }
        if (isset($data['client_logo'])) {
            $this->clientLogoPath = $data['client_logo'];
        }

        // Remove file paths from data to prevent saving to database column
        unset($data['client_photo'], $data['client_logo']);

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        // Attach new client photo to Spatie Media Library if uploaded
        if (!empty($this->clientPhotoPath)) {
            $record->clearMediaCollection('client_photo');
            $fullPath = Storage::disk('public')->path($this->clientPhotoPath);
            if (file_exists($fullPath)) {
                $record->addMedia($fullPath)
                    ->usingName($record->client_name . ' - Photo')
                    ->usingFileName(basename($this->clientPhotoPath))
                    ->toMediaCollection('client_photo');
            }
        }

        // Attach new client logo to Spatie Media Library if uploaded
        if (!empty($this->clientLogoPath)) {
            $record->clearMediaCollection('client_logo');
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
