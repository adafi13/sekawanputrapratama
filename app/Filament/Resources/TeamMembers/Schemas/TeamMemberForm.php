<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('position')
                    ->required()
                    ->maxLength(255)
                    ->label('Position/Role'),
                Textarea::make('bio')
                    ->rows(4)
                    ->columnSpanFull()
                    ->label('Biography'),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('linkedin_url')
                    ->url()
                    ->maxLength(255)
                    ->label('LinkedIn URL')
                    ->placeholder('https://linkedin.com/in/username'),
                TextInput::make('experience_years')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->default(0)
                    ->label('Years of Experience')
                    ->helperText('Number of years of experience'),
                Repeater::make('skills')
                    ->schema([
                        TextInput::make('skill')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->defaultItems(0)
                    ->columnSpanFull()
                    ->label('Skills')
                    ->helperText('Add skills one by one'),
                FileUpload::make('photo')
                    ->label('Photo')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                        '4:5',
                    ])
                    ->maxSize(2048)
                    ->directory('team/photos')
                    ->visibility('public')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Lower numbers appear first'),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active')
                    ->helperText('Inactive members won\'t be displayed on the website'),
            ]);
    }
}
