<?php

namespace App\Filament\Resources\TeamMembers\Pages;

use App\Filament\Resources\TeamMembers\TeamMemberResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateTeamMember extends CreateRecord
{
    protected static string $resource = TeamMemberResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store file path temporarily (FileUpload already saved file to storage)
        $this->photoPath = $data['photo'] ?? null;

        // Convert skills array if needed
        if (isset($data['skills']) && is_array($data['skills'])) {
            $data['skills'] = array_column($data['skills'], 'skill');
        }

        // Remove file path from data to prevent saving to database column
        unset($data['photo']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;

        // Attach photo to Spatie Media Library
        if (!empty($this->photoPath)) {
            $fullPath = Storage::disk('public')->path($this->photoPath);

            if (file_exists($fullPath)) {
                $record->addMedia($fullPath)
                    ->usingName($record->name . ' - Photo')
                    ->usingFileName(basename($this->photoPath))
                    ->toMediaCollection('photo');
            }
        }
    }
}
