<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->label('Key'),
                TextColumn::make('group')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'site' => 'success',
                        'contact' => 'info',
                        'social' => 'warning',
                        'banner' => 'primary',
                        'stats' => 'danger',
                        'footer' => 'gray',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'site' => 'Site Info',
                        'contact' => 'Contact Info',
                        'social' => 'Social Media',
                        'banner' => 'Banner Content',
                        'stats' => 'Statistics',
                        'footer' => 'Footer',
                        default => ucfirst($state),
                    }),
                TextColumn::make('value')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->value)
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'site' => 'Site Info',
                        'contact' => 'Contact Info',
                        'social' => 'Social Media',
                        'banner' => 'Banner Content',
                        'stats' => 'Statistics',
                        'footer' => 'Footer',
                        'general' => 'General',
                    ])
                    ->label('Group'),
                SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'number' => 'Number',
                        'email' => 'Email',
                        'url' => 'URL',
                        'boolean' => 'Boolean',
                    ])
                    ->label('Type'),
            ])
            ->defaultSort('group')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
