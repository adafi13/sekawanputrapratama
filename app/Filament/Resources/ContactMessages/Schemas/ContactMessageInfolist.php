<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pengirim')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama'),
                        TextEntry::make('email')
                            ->label('Email')
                            ->copyable(),
                        TextEntry::make('phone')
                            ->label('Telepon')
                            ->copyable(),
                        TextEntry::make('service_type')
                            ->label('Layanan yang Diminati')
                            ->badge(),
                        TextEntry::make('created_at')
                            ->label('Dikirim')
                            ->dateTime('d M Y, H:i'),
                    ]),

                Section::make('Pesan')
                    ->schema([
                        TextEntry::make('message')
                            ->label('')
                            ->columnSpanFull(),
                    ]),

                Section::make('Status')
                    ->columns(3)
                    ->schema([
                        IconEntry::make('is_read')
                            ->label('Sudah Dibaca')
                            ->boolean(),
                        TextEntry::make('read_at')
                            ->label('Dibaca Pada')
                            ->dateTime('d M Y, H:i')
                            ->placeholder('-'),
                        TextEntry::make('reader.name')
                            ->label('Dibaca Oleh')
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
