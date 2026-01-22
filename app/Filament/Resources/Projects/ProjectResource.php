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
                Components\Section::make('Project Information')
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

                Components\Section::make('Schedule & Budget')
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

                Components\Section::make('Assignment & Progress')
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('lead.company_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->formatStateUsing(fn ($state) => Project::getStatuses()[$state] ?? $state)
                    ->colors([
                        'gray' => Project::STATUS_PLANNING,
                        'info' => Project::STATUS_IN_PROGRESS,
                        'warning' => Project::STATUS_ON_HOLD,
                        'success' => Project::STATUS_COMPLETED,
                        'danger' => Project::STATUS_CANCELLED,
                    ]),
                TextColumn::make('assignedTo.name')
                    ->label('Project Manager')
                    ->sortable(),
                TextColumn::make('budget')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('completion_percentage')
                    ->suffix('%')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(Project::getStatuses()),
                SelectFilter::make('assigned_to')
                    ->label('Project Manager')
                    ->options(User::pluck('name', 'id')),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('create_invoice')
                    ->label('Create Invoice Termin')
                    ->icon(Heroicon::OutlinedDocumentText)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Create Invoice Termin')
                    ->modalDescription('Generate a new invoice for this project stage.')
                    ->modalIcon(Heroicon::OutlinedBanknotes)
                    ->form([
                        FormComponents\Select::make('project_id')
                            ->label('Project')
                            ->options(Project::pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->preload(),
                        FormComponents\Select::make('stage')
                            ->label('Payment Stage')
                            ->options(Invoice::getStages())
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                if ($state && $get('project_id')) {
                                    $project = Project::find($get('project_id'));
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
                    ->action(function (array $data) {
                        $invoice = Invoice::create([
                            'project_id' => $data['project_id'],
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
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
