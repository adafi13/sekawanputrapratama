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
use Filament\Forms\Components\Section as FormSection;
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
                    // CREATE QUOTATION ACTION
                    Action::make('create_quotation')
                        ->label('Create Quotation')
                        ->icon(Heroicon::OutlinedDocumentText)
                        ->color('info')
                        ->visible(fn (Lead $record): bool => 
                            in_array($record->status, [Lead::STATUS_QUALIFIED, Lead::STATUS_CONTACTED, Lead::STATUS_QUOTATION_SENT, Lead::STATUS_NEGOTIATION]))
                        ->form(function (Lead $record): array {
                            // If customer already exists, no form needed
                            if ($record->customer_id) {
                                return [];
                            }
                            
                            // Show customer form if customer doesn't exist
                            return [
                                FormComponents\TextInput::make('company_name')
                                    ->label('Company Name')
                                    ->default($record->company_name)
                                    ->required()
                                    ->maxLength(255),
                                FormComponents\TextInput::make('contact_person')
                                    ->label('Contact Person')
                                    ->default($record->contact_person)
                                    ->required()
                                    ->maxLength(255),
                                FormComponents\TextInput::make('email')
                                    ->label('Email')
                                    ->default($record->email)
                                    ->required()
                                    ->email()
                                    ->maxLength(255),
                                FormComponents\TextInput::make('phone')
                                    ->label('Phone')
                                    ->default($record->phone)
                                    ->tel()
                                    ->maxLength(255),
                                FormComponents\Textarea::make('notes')
                                    ->label('Notes')
                                    ->rows(3)
                                    ->placeholder('Additional customer notes...')
                                    ->columnSpanFull(),
                            ];
                        })
                        ->modalHeading(fn (Lead $record): string => 
                            $record->customer_id ? 'Create Quotation' : 'Complete Customer Information')
                        ->modalDescription(fn (Lead $record): string => 
                            $record->customer_id 
                                ? 'Create a new quotation for this lead.'
                                : 'Customer data is required before creating quotation.')
                        ->modalSubmitActionLabel('Create Quotation')
                        ->action(function (Lead $record, array $data) {
                            // Create customer if not exists
                            if (!$record->customer_id) {
                                // Check if customer exists by email
                                $customer = \App\Models\Customer::where('email', $data['email'])->first();
                                
                                if (!$customer) {
                                    // Create new customer with form data
                                    $customer = \App\Models\Customer::create([
                                        'company_name' => $data['company_name'],
                                        'contact_person' => $data['contact_person'],
                                        'email' => $data['email'],
                                        'phone' => $data['phone'] ?? null,
                                        'status' => 'active',
                                        'notes' => ($data['notes'] ?? '') . "\nCreated from Lead #{$record->id}",
                                    ]);
                                }
                                
                                // Update lead with customer_id
                                $record->update(['customer_id' => $customer->id]);
                            }
                            
                            // Redirect to create quotation with lead_id
                            return redirect()->route('filament.admin.resources.quotations.create', ['lead_id' => $record->id]);
                        }),
                    
                    // VIEW QUOTATIONS ACTION
                    Action::make('view_quotations')
                        ->label('View Quotations')
                        ->icon(Heroicon::OutlinedDocumentDuplicate)
                        ->color('gray')
                        ->badge(fn (Lead $record): int => $record->quotations()->count())
                        ->visible(fn (Lead $record): bool => $record->quotations()->count() > 0)
                        ->url(fn (Lead $record): string => 
                            route('filament.admin.resources.quotations.index', ['tableFilters[lead_id][value]' => $record->id]))
                        ->openUrlInNewTab(false),
                    
                    // CREATE PROJECT ACTION
                    Action::make('create_project')
                        ->label('Create Project')
                        ->icon(Heroicon::OutlinedRocketLaunch)
                        ->color('success')
                        ->visible(fn (Lead $record): bool => 
                            $record->status === Lead::STATUS_DEAL && $record->projects()->count() === 0)
                        ->requiresConfirmation()
                        ->modalHeading('Create Project from Deal')
                        ->modalDescription('This will create a new project and customer (if needed) from this lead.')
                        ->action(function (Lead $record) {
                            // Get or create customer (should already exist from Create Quotation)
                            $customer = $record->customer;
                            if (!$customer) {
                                // Try to find existing customer by email first
                                $customer = \App\Models\Customer::where('email', $record->email)->first();
                                
                                if (!$customer) {
                                    // Create new customer only if not found
                                    $customer = \App\Models\Customer::create([
                                        'company_name' => $record->company_name,
                                        'contact_person' => $record->contact_person,
                                        'email' => $record->email,
                                        'phone' => $record->phone,
                                        'status' => 'active',
                                        'notes' => "Created from Lead #{$record->id}",
                                    ]);
                                }
                                
                                $record->update(['customer_id' => $customer->id]);
                            }
                            
                            // Get latest quotation if exists
                            $latestQuotation = $record->quotations()->latest()->first();
                            
                            // Create project
                            $project = \App\Models\Project::create([
                                'lead_id' => $record->id,
                                'customer_id' => $customer->id,
                                'name' => $record->company_name . ' - Project',
                                'description' => $record->notes ?? 'Project created from lead',
                                'status' => \App\Models\Project::STATUS_PLANNING,
                                'budget' => $record->deal_value ?? ($latestQuotation?->grand_total ?? 0),
                                'assigned_to' => $record->assigned_to,
                                'start_date' => now(),
                            ]);
                            
                            Notification::make()
                                ->title('Project Created Successfully')
                                ->success()
                                ->body("Project '{$project->name}' has been created.")
                                ->actions([
                                    \Filament\Notifications\Actions\Action::make('view')
                                        ->label('View Project')
                                        ->url(route('filament.admin.resources.projects.edit', ['record' => $project->id]))
                                        ->button(),
                                ])
                                ->send();
                        }),
                    
                    // VIEW PROJECTS ACTION
                    Action::make('view_projects')
                        ->label('View Projects')
                        ->icon(Heroicon::OutlinedBriefcase)
                        ->color('gray')
                        ->badge(fn (Lead $record): int => $record->projects()->count())
                        ->visible(fn (Lead $record): bool => $record->projects()->count() > 0)
                        ->url(fn (Lead $record): string => 
                            route('filament.admin.resources.projects.index', ['tableFilters[lead_id][value]' => $record->id]))
                        ->openUrlInNewTab(false),
                    
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

                            // Auto-update Quotation status when advancing to Negotiation
                            if ($record->status === Lead::STATUS_QUOTATION_SENT && $nextStatus === Lead::STATUS_NEGOTIATION) {
                                $latestQuotation = $record->quotations()->latest()->first();
                                if ($latestQuotation && $latestQuotation->status === \App\Models\Quotation::STATUS_DRAFT) {
                                    $latestQuotation->update(['status' => \App\Models\Quotation::STATUS_SENT]);
                                    
                                    $updateData['notes'] = ($record->notes ? $record->notes . "\n\n" : '') . 
                                        '[' . now()->format('Y-m-d H:i') . '] Advanced to Negotiation. ' .
                                        'Quotation #' . $latestQuotation->quotation_number . ' marked as Sent.';
                                }
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

        // Note: Quotation Sent stage is skipped in manual advancement
        // Users must use "Create Quotation" button to reach Quotation Sent status

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
