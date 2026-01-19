<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
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
                    ->required()
                    ->maxLength(255),
                TextInput::make('client_company')
                    ->maxLength(255)
                    ->label('Company Name'),
                TextInput::make('company_industry')
                    ->maxLength(255)
                    ->label('Company Industry')
                    ->placeholder('e.g., E-commerce, Healthcare, Finance'),
                TextInput::make('client_position')
                    ->maxLength(255)
                    ->label('Client Position')
                    ->placeholder('e.g., CEO, CTO, Project Manager'),
                TextInput::make('rating')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->default(5)
                    ->required()
                    ->helperText('Rating from 1 to 5 stars'),
                Toggle::make('is_verified')
                    ->default(false)
                    ->label('Verified Purchase')
                    ->helperText('Mark as verified if this is from a real project'),
                FileUpload::make('client_photo')
                    ->label('Client Photo')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048)
                    ->directory('testimonials/photos')
                    ->visibility('public')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                FileUpload::make('client_logo')
                    ->label('Company Logo')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048)
                    ->directory('testimonials/logos')
                    ->visibility('public')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Optional: Upload company logo')
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->default(false)
                    ->label('Featured on Homepage'),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }
}
