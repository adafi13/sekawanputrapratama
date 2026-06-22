<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
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
                    ->label('Nama Klien/Brand')
                    ->required()
                    ->maxLength(255),
                TextInput::make('website_url')
                    ->label('Website')
                    ->url()
                    ->placeholder('https://example.com')
                    ->default(null),
                SpatieMediaLibraryFileUpload::make('logo')
                    ->collection('logo')
                    ->label('Logo')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                    ->required()
                    ->helperText('Logo akan ditampilkan di marquee homepage. Gunakan PNG transparan untuk hasil terbaik.')
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }
}
