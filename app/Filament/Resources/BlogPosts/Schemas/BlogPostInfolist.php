<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BlogPostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('slug'),
                TextEntry::make('category.name')
                    ->numeric(),
                TextEntry::make('author.name')
                    ->numeric(),
                TextEntry::make('meta_title'),
                TextEntry::make('meta_keywords'),
                TextEntry::make('status'),
                TextEntry::make('published_at')
                    ->dateTime(),
                TextEntry::make('views')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
