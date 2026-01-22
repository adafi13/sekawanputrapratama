<?php

namespace App\Filament\Resources\Leads;

use App\Filament\Resources\Leads\LeadResource\Pages;
use App\Models\Lead;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components as FormComponents;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'CRM';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Components\Section::make('Lead Information')
                    ->schema([
                        Components\TextInput::make('company_name')
                            ->required()
                            ->maxLength(255),
                        Components\TextInput::make('contact_person')
                            ->required()
                            ->maxLength(255),
                        Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        Components\Select::make('status')
                            ->options(Lead::getStatuses())
                            ->default(Lead::STATUS_NEW)
                            ->required(),
                        Components\TextInput::make('source')
                            ->maxLength(255)
                            ->placeholder('e.g., Website, Referral, Cold Call'),
                    ])->columns(2),

                Components\Section::make('Assignment & Tracking')
                    ->schema([
                        Components\Select::make('assigned_to')
                            ->label('Assigned To')
                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->nullable(),
                        Components\DateTimePicker::make('contacted_at')
                            ->label('Contact Date'),
                        Components\DateTimePicker::make('quotation_sent_at')
                            ->label('Quotation Sent Date'),
                        Components\DateTimePicker::make('deal_closed_at')
                            ->label('Deal Closed Date'),
                    ])->columns(2),

                Components\Section::make('Deal Details')
                    ->schema([
                        Components\TextInput::make('deal_value')
                            ->numeric()
                            ->prefix('Rp')
                            ->maxValue(999999999999.99),
                        Components\Textarea::make('quotation_notes')
                            ->rows(3)
                            ->columnSpanFull(),
                        Components\Textarea::make('notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('contact_person')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->copyable(),
                BadgeColumn::make('status')
                    ->formatStateUsing(fn ($state) => Lead::getStatuses()[$state] ?? $state)
                    ->colors([
                        'gray' => Lead::STATUS_NEW,
                        'info' => Lead::STATUS_CONTACTED,
                        'warning' => Lead::STATUS_QUOTATION_SENT,
                        'primary' => Lead::STATUS_NEGOTIATION,
                        'success' => Lead::STATUS_DEAL,
                        'danger' => Lead::STATUS_LOST,
                    ]),
                TextColumn::make('assignedTo.name')
                    ->label('Assigned To')
                    ->sortable(),
                TextColumn::make('deal_value')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(Lead::getStatuses()),
                SelectFilter::make('assigned_to')
                    ->label('Assigned To')
                    ->options(User::pluck('name', 'id')),
            ])
            ->recordActions([
                Action::make('change_status')
                    ->label('Change Status')
                    ->icon(Heroicon::OutlinedArrowPath)
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Change Lead Status')
                    ->modalDescription('Please verify the status change and provide additional information if needed.')
                    ->modalIcon(Heroicon::OutlinedShieldCheck)
                    ->form([
                        FormComponents\Select::make('new_status')
                            ->label('New Status')
                            ->options(Lead::getStatuses())
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn ($state, $set) => 
                                $state === Lead::STATUS_CONTACTED ? $set('contacted_at', now()) : 
                                ($state === Lead::STATUS_QUOTATION_SENT ? $set('quotation_sent_at', now()) :
                                ($state === Lead::STATUS_DEAL ? $set('deal_closed_at', now()) : null))
                            ),
                        FormComponents\Textarea::make('notes')
                            ->label('Status Change Notes')
                            ->placeholder('Add any relevant notes about this status change...')
                            ->rows(3)
                            ->columnSpanFull(),
                        FormComponents\Textarea::make('quotation_notes')
                            ->label('Quotation Details')
                            ->placeholder('Enter quotation details, pricing, terms, etc.')
                            ->rows(3)
                            ->visible(fn ($get) => $get('new_status') === Lead::STATUS_QUOTATION_SENT)
                            ->columnSpanFull(),
                        FormComponents\TextInput::make('deal_value')
                            ->label('Deal Value')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->visible(fn ($get) => $get('new_status') === Lead::STATUS_DEAL)
                            ->columnSpanFull(),
                        FormComponents\DateTimePicker::make('contacted_at')
                            ->label('Contact Date')
                            ->default(now())
                            ->visible(fn ($get) => $get('new_status') === Lead::STATUS_CONTACTED),
                        FormComponents\DateTimePicker::make('quotation_sent_at')
                            ->label('Quotation Sent Date')
                            ->default(now())
                            ->visible(fn ($get) => $get('new_status') === Lead::STATUS_QUOTATION_SENT),
                        FormComponents\DateTimePicker::make('deal_closed_at')
                            ->label('Deal Closed Date')
                            ->default(now())
                            ->visible(fn ($get) => $get('new_status') === Lead::STATUS_DEAL),
                    ])
                    ->action(function (Lead $record, array $data) {
                        $updateData = [
                            'status' => $data['new_status'],
                        ];

                        if (!empty($data['notes'])) {
                            $updateData['notes'] = ($record->notes ? $record->notes . "\n\n" : '') . 
                                '[' . now()->format('Y-m-d H:i') . '] Status changed to ' . 
                                Lead::getStatuses()[$data['new_status']] . ': ' . $data['notes'];
                        }

                        if ($data['new_status'] === Lead::STATUS_QUOTATION_SENT && !empty($data['quotation_notes'])) {
                            $updateData['quotation_notes'] = $data['quotation_notes'];
                            $updateData['quotation_sent_at'] = $data['quotation_sent_at'] ?? now();
                        }

                        if ($data['new_status'] === Lead::STATUS_DEAL && !empty($data['deal_value'])) {
                            $updateData['deal_value'] = $data['deal_value'];
                            $updateData['deal_closed_at'] = $data['deal_closed_at'] ?? now();
                        }

                        if ($data['new_status'] === Lead::STATUS_CONTACTED) {
                            $updateData['contacted_at'] = $data['contacted_at'] ?? now();
                        }

                        $record->update($updateData);

                        Notification::make()
                            ->title('Status Updated')
                            ->success()
                            ->body("Lead status changed to: " . Lead::getStatuses()[$data['new_status']])
                            ->send();
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('kanban_view')
                    ->label('Switch to Kanban Board')
                    ->icon(Heroicon::OutlinedViewColumns)
                    ->color('info')
                    ->url(fn () => Pages\LeadsKanbanBoard::getUrl()),
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
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
            'kanban' => Pages\LeadsKanbanBoard::route('/kanban'),
        ];
    }
}
