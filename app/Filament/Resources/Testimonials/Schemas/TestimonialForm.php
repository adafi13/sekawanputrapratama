<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('testimonial')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('client_name')
                    ->required(),
                TextInput::make('client_company'),
                TextInput::make('client_position'),
                TextInput::make('rating')
                    ->numeric(),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
