<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Layanan')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull()
                            ->helperText('Ditampilkan di kartu layanan pada halaman depan.'),
                        TextInput::make('icon')
                            ->label('Icon (kelas Font Awesome)')
                            ->placeholder('fas fa-mobile-android-alt')
                            ->helperText('Contoh: fas fa-globe, fas fa-server, fas fa-mobile-android-alt')
                            ->columnSpanFull(),
                    ]),

                Section::make('Detail Layanan')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Konten Lengkap')
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold', 'italic', 'strike', 'link', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote',
                            ]),
                        Repeater::make('features')
                            ->label('Daftar Fitur')
                            ->simple(
                                TextInput::make('feature')
                                    ->required()
                                    ->placeholder('Contoh: Responsive Design')
                            )
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Fitur')
                            ->columnSpanFull(),
                        TagsInput::make('technologies')
                            ->label('Teknologi yang Digunakan')
                            ->placeholder('Laravel, React Native, MySQL')
                            ->columnSpanFull(),
                    ]),

                Section::make('Harga & Estimasi')
                    ->columns(2)
                    ->schema([
                        TextInput::make('pricing_starting_from')
                            ->label('Harga Mulai Dari')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(null),
                        TextInput::make('delivery_time')
                            ->label('Estimasi Pengerjaan')
                            ->placeholder('2-4 minggu')
                            ->default(null),
                    ]),

                Section::make('Gambar Layanan')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('images')
                            ->collection('images')
                            ->label('Gambar')
                            ->image()
                            ->imageEditor()
                            ->multiple()
                            ->maxFiles(5)
                            ->reorderable()
                            ->helperText('Gambar akan otomatis dikompres ke WebP.'),
                    ]),

                Section::make('Tampilan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil tampil lebih dulu.'),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->required(),
                    ]),

                Section::make('SEO')
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255)
                            ->helperText('Kosongkan untuk pakai nama layanan.')
                            ->columnSpanFull(),
                        Textarea::make('meta_description')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Kosongkan untuk pakai deskripsi singkat.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
