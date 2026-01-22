<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Quotations\Pages\CreateQuotation;
use App\Filament\Resources\Quotations\Pages\EditQuotation;
use App\Filament\Resources\Quotations\Pages\ListQuotations;
use App\Filament\Resources\Quotations\Pages\ViewQuotation;
use App\Filament\Resources\Quotations\Schemas\QuotationForm;
use App\Models\Quotation;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuotationResource extends Resource
{
    protected static ?string $model = Quotation::class;

    // PERBAIKAN: Tipe data harus sama persis dengan parent class (BackedEnum|string|null)
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'quotation_number';

    public static function getNavigationGroup(): ?string
    {
        return 'CRM';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(QuotationForm::getSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quotation_number')
                    ->label('No. Quotation')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                TextColumn::make('client.company')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('valid_until')
                    ->label('Valid Until')
                    ->date('d M Y')
                    ->sortable()
                    ->color(fn ($state) => $state < now() ? 'danger' : 'success'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'sent' => 'info',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                    
                TextColumn::make('grand_total')
                    ->label('Total')
                    ->money('IDR')
                    ->getStateUsing(function (Quotation $record) {
                        // Use grand_total if available, otherwise calculate from items
                        if ($record->grand_total) {
                            return $record->grand_total;
                        }
                        
                        // Safe calculation with null check
                        if (!$record->quotation_items) {
                            return 0;
                        }
                        
                        return $record->quotation_items->sum(function ($item) {
                            $price = $item->unit_price ?? 0;
                            $disc = $item->discount_percent ?? 0;
                            return $price - ($price * ($disc / 100));
                        });
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Quotation $record): string => static::getUrl('view', ['record' => $record])),
                Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn (Quotation $record): string => route('quotations.download', $record))
                    ->openUrlInNewTab()
                    ->visible(fn (Quotation $record): bool => $record->pdf_path && \Storage::disk('local')->exists($record->pdf_path)),
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
            'index' => ListQuotations::route('/'),
            'create' => CreateQuotation::route('/create'),
            'view' => ViewQuotation::route('/{record}'),
            'edit' => EditQuotation::route('/{record}/edit'),
        ];
    }
}