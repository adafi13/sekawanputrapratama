<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->label('Setting Key')
                    ->helperText('Unique identifier for this setting (e.g., site.phone)'),
                Select::make('group')
                    ->required()
                    ->options([
                        'site' => 'Site Info',
                        'contact' => 'Contact Info',
                        'social' => 'Social Media',
                        'banner' => 'Banner Content',
                        'stats' => 'Statistics',
                        'footer' => 'Footer',
                        'general' => 'General',
                    ])
                    ->default('general')
                    ->label('Group'),
                Select::make('type')
                    ->required()
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'number' => 'Number',
                        'email' => 'Email',
                        'url' => 'URL',
                        'boolean' => 'Boolean',
                    ])
                    ->default('text')
                    ->label('Type')
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('value', null)),
                Textarea::make('description')
                    ->rows(2)
                    ->columnSpanFull()
                    ->helperText('Description of what this setting is used for'),
                Textarea::make('value')
                    ->columnSpanFull()
                    ->label('Value')
                    ->visible(fn (callable $get) => in_array($get('type'), ['text', 'textarea', 'email', 'url']))
                    ->rows(fn (callable $get) => $get('type') === 'textarea' ? 5 : 3),
                TextInput::make('value')
                    ->numeric()
                    ->visible(fn (callable $get) => $get('type') === 'number')
                    ->label('Value'),
                Select::make('value')
                    ->boolean()
                    ->visible(fn (callable $get) => $get('type') === 'boolean')
                    ->label('Value')
                    ->default(false),
            ]);
    }
}
