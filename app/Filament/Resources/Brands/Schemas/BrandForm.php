<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Brand/Partner Name'),
                TextInput::make('website_url')
                    ->url()
                    ->maxLength(255)
                    ->label('Website URL')
                    ->placeholder('https://example.com')
                    ->helperText('Optional: Link to brand/partner website'),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->maxSize(2048)
                    ->directory('brands/logos')
                    ->visibility('public')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                    ->columnSpanFull()
                    ->helperText('Upload brand/partner logo (SVG, PNG, JPG)'),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Lower numbers appear first'),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active')
                    ->helperText('Inactive brands won\'t be displayed on the website'),
            ]);
    }
}
