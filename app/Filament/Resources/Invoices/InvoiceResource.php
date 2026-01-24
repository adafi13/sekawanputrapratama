<?php

namespace App\Filament\Resources\Invoices;

use App\Filament\Resources\Invoices\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\Project;
use App\Services\InvoicePdfService;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
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
                        Components\Select::make('payment_stage')
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
                        Components\Select::make('payment_method')
                            ->label('Payment Method')
                            ->options(Invoice::getPaymentMethods())
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
                BadgeColumn::make('payment_stage')
                    ->label('Payment Stage')
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
                SelectFilter::make('payment_stage')
                    ->label('Payment Stage')
                    ->options(Invoice::getStages()),
                SelectFilter::make('status')
                    ->options(Invoice::getStatuses()),
            ])
            ->recordActions([
                Action::make('mark_as_paid')
                    ->label('Confirm Payment')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Invoice $record) => $record->status !== Invoice::STATUS_PAID)
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Payment')
                    ->modalDescription(fn (Invoice $record) => "Mark invoice {$record->invoice_number} as paid?")
                    ->form([
                        Components\DateTimePicker::make('paid_at')
                            ->label('Payment Date')
                            ->default(now())
                            ->required(),
                        Components\Select::make('payment_method')
                            ->label('Payment Method')
                            ->options(Invoice::getPaymentMethods())
                            ->required(),
                        Components\Textarea::make('payment_notes')
                            ->label('Payment Notes')
                            ->placeholder('Add any payment notes here...')
                            ->rows(3),
                    ])
                    ->action(function (Invoice $record, array $data) {
                        // Build payment details notes
                        $paymentMethodLabel = Invoice::getPaymentMethods()[$data['payment_method']] ?? $data['payment_method'];
                        $paymentDetails = "\n\n--- Payment Details ---\n";
                        $paymentDetails .= "Paid at: " . \Carbon\Carbon::parse($data['paid_at'])->format('d/m/Y H:i') . "\n";
                        $paymentDetails .= "Payment method: {$paymentMethodLabel}\n";
                        
                        if (!empty($data['payment_notes'])) {
                            $paymentDetails .= "Notes: {$data['payment_notes']}";
                        }
                        
                        // Append to existing notes
                        $updatedNotes = ($record->notes ?? '') . $paymentDetails;
                        
                        $record->update([
                            'status' => Invoice::STATUS_PAID,
                            'paid_at' => $data['paid_at'],
                            'payment_method' => $data['payment_method'],
                            'payment_notes' => $data['payment_notes'] ?? null,
                            'notes' => $updatedNotes,
                        ]);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Payment Confirmed')
                            ->success()
                            ->body("Invoice {$record->invoice_number} marked as paid.")
                            ->send();
                    }),
                Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('gray')
                    ->action(fn (Invoice $record) => InvoicePdfService::download($record)),
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
