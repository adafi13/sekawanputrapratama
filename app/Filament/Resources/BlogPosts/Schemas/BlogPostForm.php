<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('excerpt')
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Select::make('category_id')
                    ->relationship('category', 'name'),
                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->default(fn () => auth()->id())
                    ->required(),
                FileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->imageEditor()
                    ->maxSize(5120)
                    ->directory('blog/featured')
                    ->visibility('public')
                    ->columnSpanFull(),
                TextInput::make('meta_title')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Textarea::make('meta_description')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),
                TextInput::make('meta_keywords')
                    ->maxLength(255)
                    ->placeholder('keyword1, keyword2, keyword3')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'scheduled' => 'Scheduled',
                    ])
                    ->default('draft')
                    ->required()
                    ->live(),
                DateTimePicker::make('published_at')
                    ->visible(fn ($get) => in_array($get('status'), ['published', 'scheduled']))
                    ->required(fn ($get) => in_array($get('status'), ['published', 'scheduled'])),
                TextInput::make('views')
                    ->numeric()
                    ->default(0)
                    ->disabled()
                    ->dehydrated(),
            ]);
    }
}
