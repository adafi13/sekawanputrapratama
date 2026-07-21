<?php

namespace App\Filament\Resources\JobOpenings\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JobOpeningForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Lowongan Pekerjaan')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Posisi Lowongan')
                            ->placeholder('contoh: Fullstack Web Developer (Laravel & React)')
                            ->required(),
                        TextInput::make('slug')
                            ->label('Slug URL (Opsional)'),
                        TextInput::make('department')
                            ->label('Departemen / Divisi')
                            ->default('Engineering')
                            ->required(),
                        TextInput::make('location')
                            ->label('Lokasi Kerja')
                            ->default('Bekasi / Remote')
                            ->required(),
                        TextInput::make('type')
                            ->label('Tipe Pekerjaan')
                            ->default('Full-time')
                            ->required(),
                        TextInput::make('experience')
                            ->label('Kualifikasi Pengalaman')
                            ->default('1 - 3 Tahun')
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Publikasikan Lowongan Ini')
                            ->default(true),
                        Textarea::make('description')
                            ->label('Deskripsi Ringkas Posisi')
                            ->columnSpanFull()
                            ->required(),
                    ])->columns(2),

                Section::make('Rincian Tanggung Jawab & Persyaratan')
                    ->schema([
                        Repeater::make('responsibilities')
                            ->label('Tanggung Jawab Pekerjaan')
                            ->simple(TextInput::make('item')->required())
                            ->columnSpanFull(),
                        Repeater::make('requirements')
                            ->label('Persyaratan & Kualifikasi Pelamar')
                            ->simple(TextInput::make('item')->required())
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
