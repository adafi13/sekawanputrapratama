<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Testimoni')
                    ->schema([
                        Textarea::make('testimonial')
                            ->label('Isi Testimoni')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Select::make('rating')
                            ->label('Rating')
                            ->options([
                                5 => '⭐⭐⭐⭐⭐ (5)',
                                4 => '⭐⭐⭐⭐ (4)',
                                3 => '⭐⭐⭐ (3)',
                                2 => '⭐⭐ (2)',
                                1 => '⭐ (1)',
                            ])
                            ->default(5)
                            ->required(),
                    ]),

                Section::make('Klien')
                    ->columns(2)
                    ->schema([
                        TextInput::make('client_name')
                            ->label('Nama Klien')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('client_position')
                            ->label('Posisi/Jabatan')
                            ->maxLength(255),
                        TextInput::make('client_company')
                            ->label('Perusahaan')
                            ->maxLength(255),
                        TextInput::make('company_industry')
                            ->label('Industri')
                            ->placeholder('E-commerce, Manufaktur, dll')
                            ->maxLength(255),
                    ]),

                Section::make('Foto & Logo')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('client_photo')
                            ->collection('client_photo')
                            ->label('Foto Klien')
                            ->image()
                            ->imageEditor()
                            ->avatar(),
                        SpatieMediaLibraryFileUpload::make('client_logo')
                            ->collection('client_logo')
                            ->label('Logo Perusahaan')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                    ]),

                Section::make('Tampilan')
                    ->columns(3)
                    ->schema([
                        Toggle::make('is_verified')
                            ->label('Terverifikasi')
                            ->default(false)
                            ->required(),
                        Toggle::make('is_featured')
                            ->label('Tampilkan di Homepage')
                            ->default(false)
                            ->required(),
                        TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}
