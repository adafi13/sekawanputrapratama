<?php

namespace App\Filament\Resources\Portfolios\Tables;

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

class PortfoliosTable
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
                TextColumn::make('client_name')
                    ->searchable(),
                TextColumn::make('project_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('project_url')
                    ->searchable(),
                IconColumn::make('is_featured')
                    ->boolean(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('meta_title')
                    ->searchable(),
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
                \Filament\Actions\DeleteAction::make('archive')
                    ->label('Arsipkan')
                    ->icon(\Filament\Support\Icons\Heroicon::OutlinedArchiveBox)
                    ->color('warning')
                    ->modalHeading('Arsipkan Portofolio')
                    ->modalDescription('Apakah Anda yakin ingin mengarsipkan portofolio ini? Portofolio akan disembunyikan dari website publik.')
                    ->modalSubmitActionLabel('Arsipkan')
                    ->successNotificationTitle('Portofolio berhasil diarsipkan'),
                \Filament\Actions\RestoreAction::make('restore')
                    ->label('Buka Arsip')
                    ->icon(\Filament\Support\Icons\Heroicon::OutlinedArchiveBoxArrowDown)
                    ->color('success')
                    ->modalHeading('Tampilkan Kembali Portofolio')
                    ->modalDescription('Apakah Anda yakin ingin memunculkan kembali portofolio ini ke website publik?')
                    ->modalSubmitActionLabel('Tampilkan Kembali')
                    ->successNotificationTitle('Portofolio berhasil dipulihkan'),
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
