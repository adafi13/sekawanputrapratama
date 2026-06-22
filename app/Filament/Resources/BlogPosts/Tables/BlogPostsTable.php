<?php

namespace App\Filament\Resources\BlogPosts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BlogPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('author.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('meta_title')
                    ->searchable(),
                TextColumn::make('meta_keywords')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('newsletter_sent_at')
                    ->label('Newsletter')
                    ->boolean()
                    ->trueIcon('heroicon-o-paper-airplane')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->tooltip(fn ($record) => $record->newsletter_sent_at
                        ? 'Terkirim ke subscriber pada ' . $record->newsletter_sent_at->format('d M Y, H:i')
                        : 'Belum dikirim ke subscriber'),
                TextColumn::make('views')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
