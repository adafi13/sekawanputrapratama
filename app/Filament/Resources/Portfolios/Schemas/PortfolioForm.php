<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

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
                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->rows(10)
                    ->columnSpanFull(),
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
                            ->label('Metric Label'),
                        TextInput::make('value')
                            ->required()
                            ->maxLength(255)
                            ->label('Metric Value'),
                    ])
                    ->defaultItems(0)
                    ->columnSpanFull()
                    ->label('Key Metrics/Achievements')
                    ->helperText('Add metrics like "Traffic increased 300%" or "Response time reduced by 50%"'),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('service_id')
                    ->relationship('service', 'title')
                    ->searchable()
                    ->preload()
                    ->label('Related Service')
                    ->helperText('Optional: Link to related service'),
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
                    ->placeholder('https://example.com'),
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
                    ->directory('portfolios/featured')
                    ->visibility('public')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->label('Gallery Images')
                    ->image()
                    ->multiple()
                    ->maxFiles(10)
                    ->imageEditor()
                    ->maxSize(5120)
                    ->directory('portfolios/gallery')
                    ->visibility('public')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->default(false)
                    ->label('Featured on Homepage'),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
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
