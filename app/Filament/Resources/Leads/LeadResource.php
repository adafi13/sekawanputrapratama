<?php

namespace App\Filament\Resources\Leads;

use App\Filament\Resources\Leads\LeadResource\Pages;
use App\Models\Lead;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components;
use Filament\Forms\Components as FormComponents;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
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
                Section::make('Lead Information')
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
                            ->required()
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Status can only be changed via action buttons'),
                        Components\TextInput::make('source')
                            ->maxLength(255)
                            ->placeholder('e.g., Website, Referral, Cold Call'),
                    ])->columns(2),

                Section::make('Assignment & Tracking')
                    ->schema([
                        Components\Select::make('assigned_to')
                            ->label('Assigned To')
                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->nullable()
                            ->disabled(fn () => !auth()->user()?->hasRole('Super Admin'))
                            ->dehydrated(fn () => auth()->user()?->hasRole('Super Admin')),
                        Components\DateTimePicker::make('contacted_at')
                            ->label('Contact Date')
                            ->disabled(fn () => !auth()->user()?->hasRole('Super Admin'))
                            ->dehydrated(fn () => auth()->user()?->hasRole('Super Admin')),
                        Components\DateTimePicker::make('quotation_sent_at')
                            ->label('Quotation Sent Date')
                            ->disabled(fn () => !auth()->user()?->hasRole('Super Admin'))
                            ->dehydrated(fn () => auth()->user()?->hasRole('Super Admin')),
                        Components\DateTimePicker::make('deal_closed_at')
                            ->label('Deal Closed Date')
                            ->disabled(fn () => !auth()->user()?->hasRole('Super Admin'))
                            ->dehydrated(fn () => auth()->user()?->hasRole('Super Admin')),
                    ])->columns(2),

                Section::make('Deal Details')
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
                        'sky' => Lead::STATUS_QUALIFIED,
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
                ActionGroup::make([
                    Action::make('next_stage')
                        ->label(fn (Lead $record): string => 
                            $record->getNextStatus() 
                                ? Lead::getStatuses()[$record->getNextStatus()]
                                : 'Next Stage')
                        ->icon(Heroicon::OutlinedArrowRightCircle)
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn (Lead $record): bool => $record->canAdvanceToNextStage())
                        ->modalHeading(fn (Lead $record): string => 
                            'Advance to ' . Lead::getStatuses()[$record->getNextStatus()])
                        ->modalDescription('Please provide required information to advance to the next stage.')
                        ->modalIcon(Heroicon::OutlinedCheckCircle)
                        ->form(fn (Lead $record): array => self::getAdvanceStageForm($record))
                        ->action(function (Lead $record, array $data) {
                            $nextStatus = $record->getNextStatus();
                            
                            $updateData = [
                                'status' => $nextStatus,
                            ];

                            // Add status change note
                            if (!empty($data['notes'])) {
                                $updateData['notes'] = ($record->notes ? $record->notes . "\n\n" : '') . 
                                    '[' . now()->format('Y-m-d H:i') . '] Advanced to ' . 
                                    Lead::getStatuses()[$nextStatus] . ': ' . $data['notes'];
                            }

                            // Handle specific status requirements
                            if ($nextStatus === Lead::STATUS_CONTACTED) {
                                $updateData['contacted_at'] = $data['contacted_at'] ?? now();
                            }

                            if ($nextStatus === Lead::STATUS_QUOTATION_SENT) {
                                $updateData['quotation_notes'] = $data['quotation_notes'] ?? '';
                                $updateData['quotation_sent_at'] = now();
                            }

                            if ($nextStatus === Lead::STATUS_DEAL) {
                                $updateData['deal_value'] = $data['deal_value'];
                                $updateData['deal_closed_at'] = now();
                            }

                            $record->update($updateData);

                            Notification::make()
                                ->title('Stage Advanced')
                                ->success()
                                ->body("Lead advanced to: " . Lead::getStatuses()[$nextStatus])
                                ->send();
                        }),
                    
                    Action::make('move_back')
                        ->label('Previous Stage')
                        ->icon(Heroicon::OutlinedArrowLeftCircle)
                        ->color('warning')
                        ->requiresConfirmation()
                        ->visible(fn (Lead $record): bool => $record->getPreviousStatus() !== null)
                        ->modalHeading(fn (Lead $record): string => 
                            $record->getPreviousStatus() 
                                ? 'Move Back to ' . Lead::getStatuses()[$record->getPreviousStatus()]
                                : 'Cannot Move Back')
                        ->modalDescription('This will move the lead back to the previous stage.')
                        ->form([
                            FormComponents\Textarea::make('reason')
                                ->label('Reason for Moving Back')
                                ->required()
                                ->rows(3),
                        ])
                        ->action(function (Lead $record, array $data) {
                            $previousStatus = $record->getPreviousStatus();
                            
                            $updateData = [
                                'status' => $previousStatus,
                                'notes' => ($record->notes ? $record->notes . "\n\n" : '') . 
                                    '[' . now()->format('Y-m-d H:i') . '] Moved back to ' . 
                                    Lead::getStatuses()[$previousStatus] . ': ' . $data['reason'],
                            ];

                            $record->update($updateData);

                            Notification::make()
                                ->title('Lead Moved Back')
                                ->warning()
                                ->body("Lead moved back to: " . Lead::getStatuses()[$previousStatus])
                                ->send();
                        }),
                    
                    Action::make('mark_as_lost')
                        ->label('Mark as Lost')
                        ->icon(Heroicon::OutlinedXCircle)
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (Lead $record): bool => 
                            !in_array($record->status, [Lead::STATUS_DEAL, Lead::STATUS_LOST]))
                        ->modalHeading('Mark Lead as Lost')
                        ->modalDescription('Please provide a reason why this lead was lost.')
                        ->form([
                            FormComponents\Textarea::make('reason')
                                ->label('Reason for Lost')
                                ->required()
                                ->rows(3)
                                ->placeholder('e.g., Budget constraints, chose competitor, timing not right, etc.'),
                        ])
                        ->action(function (Lead $record, array $data) {
                            $record->update([
                                'status' => Lead::STATUS_LOST,
                                'notes' => ($record->notes ? $record->notes . "\n\n" : '') . 
                                    '[' . now()->format('Y-m-d H:i') . '] Marked as LOST: ' . $data['reason'],
                            ]);

                            Notification::make()
                                ->title('Lead Marked as Lost')
                                ->danger()
                                ->body("Lead has been marked as lost.")
                                ->send();
                        }),
                    
                    Action::make('revive_lead')
                        ->label('Revive Lead')
                        ->icon(Heroicon::OutlinedArrowPath)
                        ->color('info')
                        ->requiresConfirmation()
                        ->visible(fn (Lead $record): bool => $record->status === Lead::STATUS_LOST)
                        ->modalHeading('Revive Lost Lead')
                        ->modalDescription('This will move the lead back to Contacted stage.')
                        ->form([
                            FormComponents\Textarea::make('reason')
                                ->label('Reason for Reviving')
                                ->required()
                                ->rows(3),
                        ])
                        ->action(function (Lead $record, array $data) {
                            $record->update([
                                'status' => Lead::STATUS_CONTACTED,
                                'notes' => ($record->notes ? $record->notes . "\n\n" : '') . 
                                    '[' . now()->format('Y-m-d H:i') . '] Lead REVIVED: ' . $data['reason'],
                            ]);

                            Notification::make()
                                ->title('Lead Revived')
                                ->success()
                                ->body("Lead has been revived and moved to Contacted stage.")
                                ->send();
                        }),
                ])
                    ->label('Actions')
                    ->icon(Heroicon::OutlinedEllipsisVertical)
                    ->size('sm')
                    ->color('primary')
                    ->button(),
                
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

    /**
     * Get form schema for advancing to next stage
     */
    protected static function getAdvanceStageForm(Lead $record): array
    {
        $nextStatus = $record->getNextStatus();
        $form = [];

        // Always show notes field
        $form[] = FormComponents\Textarea::make('notes')
            ->label('Stage Notes')
            ->placeholder('Add any notes about this stage advancement...')
            ->rows(3);

        // Specific fields based on next status
        if ($nextStatus === Lead::STATUS_CONTACTED) {
            $form[] = FormComponents\DateTimePicker::make('contacted_at')
                ->label('Contact Date')
                ->default(now())
                ->required();
        }

        if ($nextStatus === Lead::STATUS_QUOTATION_SENT) {
            $form[] = FormComponents\Textarea::make('quotation_notes')
                ->label('Quotation Details')
                ->placeholder('Enter quotation summary, key points, pricing overview...')
                ->required()
                ->rows(4);
        }

        if ($nextStatus === Lead::STATUS_DEAL) {
            $form[] = FormComponents\TextInput::make('deal_value')
                ->label('Deal Value')
                ->numeric()
                ->prefix('Rp')
                ->required()
                ->helperText('Enter the total value of this deal');
        }

        return $form;
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
