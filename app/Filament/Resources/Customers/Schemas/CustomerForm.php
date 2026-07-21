<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Schema as DbSchema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        $components = [
            Section::make('Informasi Perusahaan & Kontak')
                ->columns(2)
                ->schema([
                    TextInput::make('company_name')
                        ->required(),
                    TextInput::make('contact_person')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email Address (Portal Login)')
                        ->email()
                        ->required(),
                    TextInput::make('phone')
                        ->tel(),
                    TextInput::make('website'),
                    TextInput::make('industry'),
                    TextInput::make('tax_id'),
                    Textarea::make('address')
                        ->columnSpanFull(),
                    Textarea::make('notes')
                        ->columnSpanFull(),
                ]),
        ];

        if (DbSchema::hasColumn('customers', 'password')) {
            $portalFields = [
                TextInput::make('password')
                    ->label('Portal Password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Kosongkan jika tidak ingin mengubah password saat ini.'),
            ];

            if (DbSchema::hasColumn('customers', 'is_portal_active')) {
                $portalFields[] = Toggle::make('is_portal_active')
                    ->label('Status Portal Aktif')
                    ->default(true)
                    ->helperText('Nonaktifkan jika ingin memblokir akses login portal klien ini.');
            }

            $components[] = Section::make('Akses Client Portal (/client/login)')
                ->description('Atur password dan akses login portal untuk klien ini')
                ->columns(2)
                ->schema($portalFields);
        }

        return $schema->components($components);
    }
}
