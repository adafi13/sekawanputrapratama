<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PortfolioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('slug'),
                TextEntry::make('category.name')
                    ->numeric(),
                TextEntry::make('client_name'),
                TextEntry::make('project_date')
                    ->date(),
                TextEntry::make('project_url'),
                IconEntry::make('is_featured')
                    ->boolean(),
                TextEntry::make('order')
                    ->numeric(),
                TextEntry::make('meta_title'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
