<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->required()
                    ->maxLength(500)
                    ->label('Question')
                    ->columnSpanFull(),
                Textarea::make('answer')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull()
                    ->label('Answer'),
                TextInput::make('category')
                    ->maxLength(255)
                    ->label('Category')
                    ->placeholder('e.g., General, Services, Pricing, Technical')
                    ->helperText('Optional: Group FAQs by category'),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Lower numbers appear first'),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active')
                    ->helperText('Inactive FAQs won\'t be displayed on the website'),
            ]);
    }
}
