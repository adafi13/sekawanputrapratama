<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditBrand extends EditRecord
{
    protected static string $resource = BrandResource::class;

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
        // Store file path temporarily if new logo uploaded
        if (isset($data['logo'])) {
            $this->logoPath = $data['logo'];
        }

        // Remove file path from data to prevent saving to database column
        unset($data['logo']);

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        // Attach new logo to Spatie Media Library if uploaded
        if (!empty($this->logoPath)) {
            // Clear existing logo
            $record->clearMediaCollection('logo');

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
