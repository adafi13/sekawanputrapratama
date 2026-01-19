<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->rows(8)
                    ->columnSpanFull(),
                Repeater::make('features')
                    ->schema([
                        TextInput::make('feature')
                            ->required()
                            ->maxLength(255)
                            ->label('Feature'),
                    ])
                    ->defaultItems(0)
                    ->columnSpanFull()
                    ->label('Features')
                    ->helperText('List key features included in this service'),
                Repeater::make('technologies')
                    ->schema([
                        TextInput::make('technology')
                            ->required()
                            ->maxLength(255)
                            ->label('Technology'),
                    ])
                    ->defaultItems(0)
                    ->columnSpanFull()
                    ->label('Technologies Used')
                    ->helperText('List technologies and tools used for this service'),
                TextInput::make('pricing_starting_from')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Starting Price')
                    ->helperText('Optional: Starting price for this service'),
                TextInput::make('delivery_time')
                    ->maxLength(100)
                    ->label('Delivery Time')
                    ->placeholder('e.g., 2-4 weeks, 1-2 months')
                    ->helperText('Expected delivery timeframe'),
                TextInput::make('icon')
                    ->maxLength(255)
                    ->placeholder('Icon class atau nama'),
                FileUpload::make('images')
                    ->label('Service Image')
                    ->image()
                    ->imageEditor()
                    ->maxSize(5120)
                    ->directory('services/images')
                    ->visibility('public')
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                TextInput::make('meta_title')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Textarea::make('meta_description')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),
            ]);
    }
}
