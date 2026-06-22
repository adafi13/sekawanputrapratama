<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pesan Masuk')
                    ->description('Data ini dikirim langsung dari form kontak di website, tidak bisa diubah.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->disabled(),
                        TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        TextInput::make('phone')
                            ->label('Telepon')
                            ->disabled(),
                        TextInput::make('service_type')
                            ->label('Layanan Diminati')
                            ->disabled(),
                        Textarea::make('message')
                            ->label('Pesan')
                            ->disabled()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_read')
                            ->label('Sudah Dibaca'),
                    ]),
            ]);
    }
}
