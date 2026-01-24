<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
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
                Select::make('service_id')
                    ->relationship('service', 'title')
                    ->searchable()
                    ->preload()
                    ->label('Related Service')
                    ->helperText('Optional: Link to related service'),
                Textarea::make('description')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->helperText('Brief overview of the project'),
                RichEditor::make('content')
                    ->label('Full Description')
                    ->columnSpanFull()
                    ->fileAttachmentsDirectory('portfolios/attachments')
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
                    ]),
                Textarea::make('challenge')
                    ->rows(4)
                    ->label('Challenge')
                    ->columnSpanFull()
                    ->helperText('What problem or challenge did the client face?'),
                Textarea::make('solution')
                    ->rows(4)
                    ->label('Solution')
                    ->columnSpanFull()
                    ->helperText('How did you solve the problem?'),
                Textarea::make('results')
                    ->rows(4)
                    ->label('Results')
                    ->columnSpanFull()
                    ->helperText('What were the outcomes and benefits?'),
                Repeater::make('metrics')
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(255)
                            ->label('Metric Label')
                            ->placeholder('e.g., Traffic Increase'),
                        TextInput::make('value')
                            ->required()
                            ->maxLength(255)
                            ->label('Metric Value')
                            ->placeholder('e.g., +300%'),
                    ])
                    ->defaultItems(0)
                    ->columnSpanFull()
                    ->label('Key Metrics/Achievements')
                    ->helperText('Add quantifiable results'),
                TextInput::make('client_name')
                    ->maxLength(255)
                    ->label('Client Name'),
                TextInput::make('client_industry')
                    ->maxLength(255)
                    ->label('Client Industry')
                    ->placeholder('e.g., E-commerce, Healthcare, Finance'),
                DatePicker::make('project_date')
                    ->label('Project Date'),
                TextInput::make('project_duration')
                    ->maxLength(100)
                    ->label('Project Duration')
                    ->placeholder('e.g., 3 months, 6 weeks'),
                TextInput::make('project_url')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://example.com')
                    ->columnSpanFull(),
                Textarea::make('technologies')
                    ->label('Technologies (comma-separated)')
                    ->placeholder('Laravel, Vue.js, Tailwind CSS')
                    ->helperText('Enter technologies separated by commas')
                    ->columnSpanFull(),
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
                    ->directory(fn ($record) => $record ? "portfolios/{$record->id}" : 'temp-uploads')
                    ->getUploadedFileNameForStorageUsing(fn ($file) => $file->hashName())
                    ->visibility('public')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull()
                    ->helperText('Main portfolio image. Will be compressed to WebP.'),
                FileUpload::make('images')
                    ->label('Gallery Images (Max 10)')
                    ->image()
                    ->multiple()
                    ->maxFiles(10)
                    ->reorderable()
                    ->imageEditor()
                    ->maxSize(5120)
                    ->directory(fn ($record) => $record ? "portfolios/{$record->id}/gallery" : 'temp-uploads/gallery')
                    ->getUploadedFileNameForStorageUsing(fn ($file) => $file->hashName())
                    ->visibility('public')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull()
                    ->helperText('Upload up to 10 images. All will be compressed to WebP format.'),
                Toggle::make('is_featured')
                    ->default(false)
                    ->label('Featured on Homepage')
                    ->helperText('Show this portfolio on the homepage'),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->label('Display Order')
                    ->helperText('Lower numbers appear first'),
                TextInput::make('meta_title')
                    ->maxLength(255)
                    ->helperText('Leave empty to use portfolio title')
                    ->columnSpanFull(),
                Textarea::make('meta_description')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->helperText('Leave empty to use description'),
            ]);
    }
}
