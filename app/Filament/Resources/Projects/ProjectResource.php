<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\ProjectResource\Pages;
use App\Models\Project;
use App\Models\Lead;
use App\Models\User;
use App\Models\Invoice;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components;
use Filament\Forms\Components as FormComponents;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'CRM';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Information')
                    ->schema([
                        Components\Select::make('lead_id')
                            ->label('Related Lead')
                            ->options(Lead::pluck('company_name', 'id'))
                            ->searchable()
                            ->nullable(),
                        Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Components\Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Schedule & Budget')
                    ->schema([
                        Components\DatePicker::make('start_date'),
                        Components\DatePicker::make('end_date'),
                        Components\TextInput::make('budget')
                            ->numeric()
                            ->prefix('Rp')
                            ->maxValue(999999999999.99),
                        Components\Select::make('status')
                            ->options(Project::getStatuses())
                            ->default(Project::STATUS_PLANNING)
                            ->required(),
                    ])->columns(2),

                Section::make('Assignment & Progress')
                    ->schema([
                        Components\Select::make('assigned_to')
                            ->label('Project Manager')
                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->nullable(),
                        Components\TextInput::make('completion_percentage')
                            ->numeric()
                            ->suffix('%')
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Project Name'),
                TextEntry::make('lead.company_name')
                    ->label('Client'),
                TextEntry::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Project::getStatuses()[$state] ?? $state)
                    ->color(fn ($state) => match($state) {
                        Project::STATUS_AWAITING_CONTRACT => 'warning',
                        Project::STATUS_PLANNING => 'gray',
                        Project::STATUS_IN_PROGRESS => 'info',
                        Project::STATUS_ON_HOLD => 'warning',
                        Project::STATUS_COMPLETED => 'success',
                        Project::STATUS_CANCELLED => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('assignedTo.name')
                    ->label('Project Manager'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('budget')
                    ->money('IDR'),
                TextEntry::make('completion_percentage')
                    ->suffix('%'),
                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('end_date')
                    ->date(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('lead.company_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                BadgeColumn::make('status')
                    ->formatStateUsing(fn ($state) => Project::getStatuses()[$state] ?? $state)
                    ->colors([
                        'warning' => Project::STATUS_AWAITING_CONTRACT,
                        'gray' => Project::STATUS_PLANNING,
                        'info' => Project::STATUS_IN_PROGRESS,
                        'warning' => Project::STATUS_ON_HOLD,
                        'success' => Project::STATUS_COMPLETED,
                        'danger' => Project::STATUS_CANCELLED,
                    ]),
                TextColumn::make('assignedTo.name')
                    ->label('PM')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('budget')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('lead_id')
                    ->label('Lead')
                    ->relationship('lead', 'company_name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('status')
                    ->options(Project::getStatuses()),
                SelectFilter::make('assigned_to')
                    ->label('Project Manager')
                    ->options(User::pluck('name', 'id')),
            ])
            ->recordActions([
                \Filament\Actions\ActionGroup::make([
                    // Sign Contract - Only for Manager when contract is DRAFT
                    Action::make('sign_contract')
                        ->label('Sign Contract')
                        ->icon(Heroicon::OutlinedDocumentCheck)
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalHeading('Sign Contract')
                        ->modalDescription('By signing this contract, the project will be activated and moved to Planning stage.')
                        ->modalIcon(Heroicon::OutlinedPencilSquare)
                        ->visible(fn (Project $record) => 
                            $record->status === Project::STATUS_AWAITING_CONTRACT &&
                            $record->contract &&
                            $record->contract->status === 'draft'
                        )
                        ->form([
                            FormComponents\Textarea::make('notes')
                                ->label('Signature Notes')
                                ->placeholder('Add any notes about this contract signing...')
                                ->rows(2),
                        ])
                        ->action(function (Project $record, array $data) {
                            $contract = $record->contract;
                            
                            // Update contract to ACTIVE
                            $contract->update([
                                'status' => \App\Models\Contract::STATUS_ACTIVE,
                                'signed_at' => now(),
                            ]);
                            
                            // Auto-advance project to PLANNING
                            $record->update([
                                'status' => Project::STATUS_PLANNING,
                            ]);
                            
                            Notification::make()
                                ->title('Contract Signed')
                                ->success()
                                ->body("Contract signed successfully. Project moved to Planning stage.")
                                ->send();
                        }),
                    
                    // Next Stage - Progress project status
                    Action::make('next_stage')
                        ->label('Next Stage')
                        ->icon(Heroicon::OutlinedArrowRight)
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading(fn (Project $record) => 'Advance to: ' . (Project::getStatuses()[$record->getNextStatus()] ?? 'Next Stage'))
                        ->modalDescription('Move this project to the next stage.')
                        ->modalIcon(Heroicon::OutlinedArrowTrendingUp)
                        ->visible(fn (Project $record) => $record->getNextStatus() !== null)
                        ->form([
                            FormComponents\Textarea::make('notes')
                                ->label('Stage Progression Notes')
                                ->placeholder('Why are you moving to the next stage?')
                                ->required()
                                ->rows(3),
                        ])
                        ->action(function (Project $record, array $data) {
                            $oldStatus = $record->status;
                            $nextStatus = $record->getNextStatus();
                            
                            // Validate can advance (checks contract signed if needed)
                            if (!$record->canAdvanceToNextStage()) {
                                Notification::make()
                                    ->title('Cannot Advance')
                                    ->danger()
                                    ->body('Contract must be signed before advancing from Awaiting Contract stage.')
                                    ->send();
                                return;
                            }
                            
                            $record->update(['status' => $nextStatus]);
                            
                            Notification::make()
                                ->title('Stage Updated')
                                ->success()
                                ->body("Project moved from " . Project::getStatuses()[$oldStatus] . " to " . Project::getStatuses()[$nextStatus])
                                ->send();
                        }),
                    
                    // Previous Stage - Rollback with reason
                    Action::make('previous_stage')
                        ->label('Previous Stage')
                        ->icon(Heroicon::OutlinedArrowLeft)
                        ->color('gray')
                        ->requiresConfirmation()
                        ->modalHeading(fn (Project $record) => 'Rollback to: ' . (Project::getStatuses()[$record->getPreviousStatus()] ?? 'Previous Stage'))
                        ->modalDescription('Move this project back to the previous stage.')
                        ->modalIcon(Heroicon::OutlinedArrowUturnLeft)
                        ->visible(fn (Project $record) => $record->getPreviousStatus() !== null)
                        ->form([
                            FormComponents\Textarea::make('reason')
                                ->label('Rollback Reason')
                                ->placeholder('Why are you moving back to the previous stage?')
                                ->required()
                                ->rows(3),
                        ])
                        ->action(function (Project $record, array $data) {
                            $oldStatus = $record->status;
                            $previousStatus = $record->getPreviousStatus();
                            
                            $record->update(['status' => $previousStatus]);
                            
                            Notification::make()
                                ->title('Stage Rolled Back')
                                ->warning()
                                ->body("Project moved back from " . Project::getStatuses()[$oldStatus] . " to " . Project::getStatuses()[$previousStatus])
                                ->send();
                        }),
                    
                    // Create Invoice - With validation
                    Action::make('create_invoice')
                        ->label('Create Invoice')
                        ->icon(Heroicon::OutlinedDocumentText)
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Create Invoice Termin')
                        ->modalDescription('Generate a new invoice for this project stage.')
                        ->modalIcon(Heroicon::OutlinedBanknotes)
                        ->form([
                            FormComponents\Select::make('stage')
                                ->label('Payment Stage')
                                ->options(Invoice::getStages())
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, $set, $get, $livewire) {
                                    if ($state && $livewire->record) {
                                        $project = $livewire->record;
                                        if ($project && $project->budget) {
                                            // Auto-suggest amounts based on stage
                                            $suggestion = match($state) {
                                                Invoice::STAGE_DP => $project->budget * 0.3,
                                                Invoice::STAGE_PROGRESS => $project->budget * 0.4,
                                                Invoice::STAGE_FINAL => $project->budget * 0.3,
                                                default => 0,
                                            };
                                            $set('amount', $suggestion);
                                        }
                                    }
                                }),
                            FormComponents\TextInput::make('amount')
                                ->label('Invoice Amount')
                                ->numeric()
                                ->prefix('Rp')
                                ->required()
                                ->helperText('Amount will auto-populate based on project budget and stage'),
                            FormComponents\DatePicker::make('due_date')
                                ->label('Due Date')
                                ->required()
                                ->default(now()->addDays(30)),
                            FormComponents\Textarea::make('notes')
                                ->label('Invoice Notes')
                                ->placeholder('Add any special terms, conditions, or notes...')
                                ->rows(3)
                                ->columnSpanFull(),
                        ])
                        ->action(function (Project $record, array $data) {
                            // Validate contract signed
                            if (!$record->canCreateInvoice()) {
                                Notification::make()
                                    ->title('Cannot Create Invoice')
                                    ->danger()
                                    ->body('Contract must be signed (Active status) before creating invoices.')
                                    ->send();
                                return;
                            }
                            
                            $invoice = Invoice::create([
                                'project_id' => $record->id,
                                'stage' => $data['stage'],
                                'amount' => $data['amount'],
                                'due_date' => $data['due_date'],
                                'notes' => $data['notes'] ?? null,
                                'status' => Invoice::STATUS_PENDING,
                            ]);

                            Notification::make()
                                ->title('Invoice Created')
                                ->success()
                                ->body("Invoice {$invoice->invoice_number} has been created successfully.")
                                ->send();
                        }),
                ])
                ->label('Actions')
                ->icon(Heroicon::OutlinedEllipsisVertical)
                ->size('sm')
                ->color('primary')
                ->button(),
                
                \Filament\Actions\ViewAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
