<?php

namespace App\Filament\Resources\JobApplications\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class JobApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Pelamar')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jobOpening.title')
                    ->label('Posisi Dilamar')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('email')
                    ->label('Email & HP')
                    ->description(fn ($record) => $record->phone)
                    ->searchable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'reviewed',
                        'primary' => 'interviewed',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'Pending Review',
                        'reviewed' => 'Di-Review HR',
                        'interviewed' => 'Wawancara',
                        'accepted' => 'Diterima',
                        'rejected' => 'Ditolak',
                        default => strtoupper($state),
                    }),
                TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('download_cv')
                    ->label('Lihat CV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(fn ($record) => Storage::disk('public')->download($record->resume_path)),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
