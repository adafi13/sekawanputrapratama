<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->rows(3),
                    ]),
                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->default(fn () => auth()->id())
                    ->required()
                    ->searchable(),
                Textarea::make('excerpt')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->helperText('Brief summary of the post (Ringkasan Singkat)'),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDirectory('blog/attachments')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'strike',
                        'link',
                        'h2',
                        'h3',
                        'bulletList',
                        'orderedList',
                        'blockquote',
                        'codeBlock',
                    ]),
                FileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->maxSize(5120)
                    ->directory(fn ($record) => $record ? "blog/{$record->id}" : 'temp-uploads')
                    ->getUploadedFileNameForStorageUsing(fn ($file) => $file->hashName())
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->helperText('Recommended size: 1200x630px. Will be automatically compressed to WebP format.'),
                TextInput::make('meta_title')
                    ->maxLength(255)
                    ->helperText('Leave empty to use post title'),
                TextInput::make('meta_keywords')
                    ->maxLength(255)
                    ->placeholder('keyword1, keyword2, keyword3'),
                Textarea::make('meta_description')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->helperText('Leave empty to use excerpt'),
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
                    ->label('Publish Date')
                    ->visible(fn ($get) => in_array($get('status'), ['published', 'scheduled']))
                    ->required(fn ($get) => in_array($get('status'), ['published', 'scheduled']))
                    ->default(now()),
                TextInput::make('views')
                    ->numeric()
                    ->default(0)
                    ->disabled()
                    ->dehydrated(),
            ]);
    }
}
