<?php

namespace App\Filament\Resources\Invoices;

use App\Filament\Resources\Invoices\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\Project;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return 'CRM';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Invoice Information')
                    ->schema([
                        Components\Select::make('project_id')
                            ->label('Project')
                            ->options(Project::pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Components\TextInput::make('invoice_number')
                            ->label('Invoice Number')
                            ->disabled()
                            ->helperText('Auto-generated on save'),
                        Components\Select::make('stage')
                            ->label('Payment Stage')
                            ->options(Invoice::getStages())
                            ->required(),
                        Components\Select::make('status')
                            ->options(Invoice::getStatuses())
                            ->default(Invoice::STATUS_PENDING)
                            ->required(),
                    ])->columns(2),

                Section::make('Payment Details')
                    ->schema([
                        Components\TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                        Components\DatePicker::make('due_date')
                            ->label('Due Date')
                            ->required(),
                        Components\DateTimePicker::make('paid_at')
                            ->label('Paid Date')
                            ->visible(fn ($get) => $get('status') === Invoice::STATUS_PAID),
                        Components\Textarea::make('notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('stage')
                    ->formatStateUsing(fn ($state) => Invoice::getStages()[$state] ?? $state)
                    ->colors([
                        'primary' => Invoice::STAGE_DP,
                        'info' => Invoice::STAGE_PROGRESS,
                        'success' => Invoice::STAGE_FINAL,
                    ]),
                TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->formatStateUsing(fn ($state) => Invoice::getStatuses()[$state] ?? $state)
                    ->colors([
                        'gray' => Invoice::STATUS_PENDING,
                        'info' => Invoice::STATUS_SENT,
                        'success' => Invoice::STATUS_PAID,
                        'danger' => Invoice::STATUS_OVERDUE,
                        'warning' => Invoice::STATUS_CANCELLED,
                    ]),
                TextColumn::make('paid_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('stage')
                    ->options(Invoice::getStages()),
                SelectFilter::make('status')
                    ->options(Invoice::getStatuses()),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
