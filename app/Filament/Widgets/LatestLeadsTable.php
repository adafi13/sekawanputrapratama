<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestLeadsTable extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected function getTableHeading(): string
    {
        return 'Leads Terbaru';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Lead::query()->latest())
            ->columns([
                TextColumn::make('company_name')
                    ->label('Perusahaan')
                    ->searchable(),
                TextColumn::make('contact_person')
                    ->label('Kontak'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => Lead::getStatuses()[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        Lead::STATUS_DEAL => 'success',
                        Lead::STATUS_LOST => 'danger',
                        Lead::STATUS_NEW => 'gray',
                        default => 'warning',
                    }),
                TextColumn::make('deal_value')
                    ->label('Nilai Deal')
                    ->money('IDR')
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->label('Masuk')
                    ->since(),
            ])
            ->paginated([5, 10, 25])
            ->defaultPaginationPageOption(5)
            ->recordUrl(fn (Lead $record) => route('filament.admin.resources.leads.edit', ['record' => $record]));
    }
}
