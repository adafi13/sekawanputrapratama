<?php

namespace App\Filament\Resources\TeamMembers\Pages;

use App\Filament\Resources\TeamMembers\TeamMemberResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditTeamMember extends EditRecord
{
    protected static string $resource = TeamMemberResource::class;

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
        // Store file path temporarily if new photo uploaded
        if (isset($data['photo'])) {
            $this->photoPath = $data['photo'];
        }

        // Convert skills array if needed
        if (isset($data['skills']) && is_array($data['skills'])) {
            $data['skills'] = array_column($data['skills'], 'skill');
        }

        // Remove file path from data to prevent saving to database column
        unset($data['photo']);

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        // Attach new photo to Spatie Media Library if uploaded
        if (!empty($this->photoPath)) {
            // Clear existing photo
            $record->clearMediaCollection('photo');

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
