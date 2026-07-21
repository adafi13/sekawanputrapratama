<?php

namespace App\Filament\Resources\JobOpenings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JobOpeningsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Posisi Pekerjaan')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('department')
                    ->label('Departemen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipe'),
                TextColumn::make('location')
                    ->label('Lokasi'),
                TextColumn::make('applications_count')
                    ->counts('applications')
                    ->label('Jumlah Pelamar')
                    ->badge()
                    ->color('info'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
