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
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
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

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lead Information')
                    ->schema([
                        TextEntry::make('company_name')
                            ->label('Company Name'),
                        TextEntry::make('contact_person')
                            ->label('Contact Person'),
                        TextEntry::make('email'),
                        TextEntry::make('phone')
                            ->label('Phone Number'),
                        TextEntry::make('status')
                            ->badge()
                            ->formatStateUsing(fn ($state) => Lead::getStatuses()[$state] ?? $state),
                        TextEntry::make('source'),
                    ])->columns(2),
                
                Section::make('Assignment & Tracking')
                    ->schema([
                        TextEntry::make('assignedTo.name')
                            ->label('Assigned To'),
                        TextEntry::make('contacted_at')
                            ->label('Contact Date')
                            ->dateTime(),
                        TextEntry::make('quotation_sent_at')
                            ->label('Quotation Sent Date')
                            ->dateTime(),
                        TextEntry::make('deal_closed_at')
                            ->label('Deal Closed Date')
                            ->dateTime(),
                    ])->columns(2),
                
                Section::make('Deal Details')
                    ->schema([
                        TextEntry::make('deal_value')
                            ->label('Deal Value')
                            ->money('IDR'),
                        TextEntry::make('quotation_notes')
                            ->columnSpanFull(),
                        TextEntry::make('notes')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_name')
                    ->label('Company')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('contact_person')
                    ->label('Contact Person')
                    ->searchable(['contact_person', 'phone'])
                    ->html()
                    ->formatStateUsing(fn (Lead $record) => 
                        '<div>' . 
                        '<div>' . e($record->contact_person) . '</div>' .
                        ($record->phone ? '<div style="font-size: 0.75rem; color: #6b7280; margin-top: 2px;">' . e($record->phone) . '</div>' : '') .
                        '</div>'
                    ),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                BadgeColumn::make('status')
                    ->label('Status')
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
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('deal_value')
                    ->label('Deal Value')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(),
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
                            $record->quotations()->count() === 0 && 
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
                            $record->customer_id ? 'Create Quotation' : 'Create Customer')
                        ->modalDescription(fn (Lead $record): string => 
                            $record->customer_id 
                                ? 'Create a new quotation for this lead.'
                                : 'Create & complete customer information before creating a quotation.')
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
                            
                            // Create project - starts with awaiting_dp status (payment workflow)
                            $project = \App\Models\Project::create([
                                'lead_id' => $record->id,
                                'customer_id' => $customer->id,
                                'name' => $record->company_name . ' - Project',
                                'description' => $record->notes ?? 'Project created from lead',
                                'status' => \App\Models\Project::STATUS_AWAITING_DP,
                                'budget' => $record->deal_value ?? ($latestQuotation?->grand_total ?? 0),
                                'assigned_to' => $record->assigned_to,
                                'start_date' => now(),
                            ]);
                            
                            Notification::make()
                                ->title('Project Created Successfully')
                                ->success()
                                ->body("Project '{$project->name}' has been created. ID: {$project->id}")
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
                    
                    // ACCEPT QUOTATION ACTION (Quick Action)
                    Action::make('accept_quotation')
                        ->label('Accept Quotation')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->color('success')
                        ->visible(function (Lead $record): bool {
                            // Show if has sent/revised quotation but not accepted yet
                            return $record->quotations()
                                ->whereIn('status', [\App\Models\Quotation::STATUS_SENT, \App\Models\Quotation::STATUS_REVISED])
                                ->exists();
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Accept Quotation')
                        ->modalDescription(fn (Lead $record) => 
                            "Accept quotation for {$record->company_name}? This will allow you to create a contract.")
                        ->action(function (Lead $record) {
                            $quotation = $record->quotations()
                                ->whereIn('status', [\App\Models\Quotation::STATUS_SENT, \App\Models\Quotation::STATUS_REVISED])
                                ->latest()
                                ->first();
                            
                            if ($quotation) {
                                $quotation->update(['status' => \App\Models\Quotation::STATUS_ACCEPTED]);
                                
                                Notification::make()
                                    ->title('Quotation Accepted')
                                    ->success()
                                    ->body("Quotation {$quotation->quotation_number} has been accepted. You can now create a contract.")
                                    ->send();
                            }
                        }),
                    
                    // CREATE CONTRACT ACTION
                    Action::make('create_contract')
                        ->label('Create Contract')
                        ->icon(Heroicon::OutlinedDocumentText)
                        ->color('indigo')
                        ->visible(function (Lead $record): bool {
                            // Only show if has project and accepted quotation, but no contract yet
                            $hasProject = $record->projects()->count() > 0;
                            $hasQuotation = $record->quotations()->where('status', \App\Models\Quotation::STATUS_ACCEPTED)->exists();
                            $hasContract = \App\Models\Contract::whereHas('project', function ($query) use ($record) {
                                $query->where('lead_id', $record->id);
                            })->exists();
                            
                            return $hasProject && $hasQuotation && !$hasContract;
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Create Contract')
                        ->modalDescription('Review and verify contract details loaded from your accepted quotation. All fields are editable in case there were any deal changes or revisions after quotation approval.')
                        ->modalWidth('3xl')
                        ->fillForm(function (Lead $record): array {
                            $quotation = $record->quotations()->where('status', \App\Models\Quotation::STATUS_ACCEPTED)->latest()->first();
                            $project = $record->projects()->latest()->first();
                            
                            // Prepare payment terms array
                            $paymentTerms = [];
                            if ($quotation) {
                                \Log::info('Loading payment terms from Quotation', [
                                    'quotation_id' => $quotation->id,
                                    'quotation_number' => $quotation->quotation_number,
                                    'term_1' => $quotation->payment_term_1_percentage . '% - ' . $quotation->payment_term_1_description,
                                    'term_2' => $quotation->payment_term_2_percentage . '% - ' . $quotation->payment_term_2_description,
                                    'term_3' => $quotation->payment_term_3_percentage . '% - ' . $quotation->payment_term_3_description,
                                ]);
                                
                                if ($quotation->payment_term_1_percentage) {
                                    $paymentTerms[] = [
                                        'percentage' => (float)$quotation->payment_term_1_percentage,
                                        'description' => $quotation->payment_term_1_description ?? 'Down Payment (DP)',
                                    ];
                                }
                                if ($quotation->payment_term_2_percentage) {
                                    $paymentTerms[] = [
                                        'percentage' => (float)$quotation->payment_term_2_percentage,
                                        'description' => $quotation->payment_term_2_description ?? 'Progress Payment',
                                    ];
                                }
                                if ($quotation->payment_term_3_percentage) {
                                    $paymentTerms[] = [
                                        'percentage' => (float)$quotation->payment_term_3_percentage,
                                        'description' => $quotation->payment_term_3_description ?? 'Final Payment',
                                    ];
                                }
                            } else {
                                \Log::warning('No accepted quotation found, using fallback payment terms');
                            }
                            
                            // Fallback if no payment terms
                            if (empty($paymentTerms)) {
                                \Log::info('Using fallback payment terms (30/40/30)');
                                $paymentTerms = [
                                    ['percentage' => 30, 'description' => 'Down Payment (DP)'],
                                    ['percentage' => 40, 'description' => 'Progress Payment'],
                                    ['percentage' => 30, 'description' => 'Final Payment'],
                                ];
                            }
                            
                            return [
                                'project_id' => $project?->id,
                                'project_type' => \App\Models\Contract::TYPE_BUY_OUT,
                                'contract_value' => $quotation ? (float)$quotation->grand_total : 0,
                                'warranty_period' => 30,
                                'start_date' => now(),
                                'estimated_duration' => 90,
                                'end_date' => now()->addDays(90),
                                'payment_terms' => $paymentTerms,
                            ];
                        })
                        ->form(function (Lead $record): array {
                            $quotation = $record->quotations()->where('status', \App\Models\Quotation::STATUS_ACCEPTED)->latest()->first();
                            $project = $record->projects()->latest()->first();
                            
                            // Build quotation summary for reference
                            $quotationSummary = '';
                            if ($quotation) {
                                $quotationSummary = "<strong>Quotation #{$quotation->quotation_number}</strong><br>";
                                $quotationSummary .= "Total: Rp " . number_format($quotation->grand_total, 0, ',', '.') . "<br>";
                                if ($quotation->items()->exists()) {
                                    $quotationSummary .= "Items: " . $quotation->items()->count() . " item(s)<br>";
                                }
                                $quotationSummary .= "<br><em>You can adjust the values below if there were any deal/revision after quotation approval.</em>";
                            }
                            
                            return [
                                // Quotation Reference Banner
                                FormComponents\Placeholder::make('quotation_reference')
                                    ->label('Reference from Accepted Quotation')
                                    ->content(new \Illuminate\Support\HtmlString($quotationSummary ?: 'No quotation data available'))
                                    ->columnSpanFull()
                                    ->visible(fn() => !empty($quotationSummary)),
                                // === SECTION 1: PROJECT INFORMATION ===
                                Section::make('Project Information')
                                    ->icon('heroicon-o-briefcase')
                                    ->description('Project details and deliverables from quotation (editable)')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                FormComponents\Select::make('project_id')
                                                    ->label('Project')
                                                    ->options($record->projects()->pluck('name', 'id'))
                                                    ->default($project?->id)
                                                    ->required()
                                                    ->reactive()
                                                    ->prefixIcon('heroicon-o-folder'),
                                                
                                                FormComponents\Select::make('project_type')
                                                    ->label('Contract Type')
                                                    ->options([
                                                        \App\Models\Contract::TYPE_BUY_OUT => 'Buy-Out (Source code delivered)',
                                                        \App\Models\Contract::TYPE_MANAGED_SERVICE => 'Managed Service (License only)',
                                                    ])
                                                    ->default(\App\Models\Contract::TYPE_BUY_OUT)
                                                    ->required()
                                                    ->reactive()
                                                    ->helperText('Determines which contract template will be used')
                                                    ->prefixIcon('heroicon-o-document-text'),
                                            ]),
                                        
                                        FormComponents\TextInput::make('warranty_period')
                                            ->label('Warranty Period')
                                            ->numeric()
                                            ->default(30)
                                            ->required()
                                            ->minValue(0)
                                            ->maxValue(365)
                                            ->suffix('days')
                                            ->helperText('Post-delivery support period')
                                            ->prefixIcon('heroicon-o-shield-check')
                                            ->columnSpan(1),
                                    ]),
                                
                                // === SECTION 2: TIMELINE ===
                                Section::make('Project Timeline')
                                    ->icon('heroicon-o-calendar')
                                    ->description('Set project start date and duration. End date will be calculated automatically.')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                FormComponents\DatePicker::make('start_date')
                                                    ->label('Start Date')
                                                    ->default(now())
                                                    ->required()
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                        if ($state && $get('estimated_duration')) {
                                                            $endDate = \Carbon\Carbon::parse($state)->addDays($get('estimated_duration'));
                                                            $set('end_date', $endDate->format('Y-m-d'));
                                                        }
                                                    })
                                                    ->prefixIcon('heroicon-o-calendar'),
                                                
                                                FormComponents\TextInput::make('estimated_duration')
                                                    ->label('Duration')
                                                    ->numeric()
                                                    ->default(90)
                                                    ->required()
                                                    ->minValue(1)
                                                    ->suffix('days')
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                        if ($state && $get('start_date')) {
                                                            $endDate = \Carbon\Carbon::parse($get('start_date'))->addDays($state);
                                                            $set('end_date', $endDate->format('Y-m-d'));
                                                        }
                                                    })
                                                    ->prefixIcon('heroicon-o-clock'),
                                                
                                                FormComponents\DatePicker::make('end_date')
                                                    ->label('End Date (Auto)')
                                                    ->default(now()->addDays(90))
                                                    ->required()
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->helperText('Automatically calculated from start date + duration')
                                                    ->prefixIcon('heroicon-o-calendar-days'),
                                            ]),
                                    ]),
                                
                                // === SECTION 3: FINANCIAL DETAILS ===
                                Section::make('Financial Details')
                                    ->icon('heroicon-o-banknotes')
                                    ->description('Contract value and payment terms loaded from accepted quotation (adjust if deal changed)')
                                    ->schema([
                                        FormComponents\TextInput::make('contract_value')
                                            ->label('Contract Value')
                                            ->prefix('Rp')
                                            ->numeric()
                                            ->required()
                                            ->helperText(fn() => $quotation 
                                                ? '✓ Loaded from Quotation #' . $quotation->quotation_number . ': Rp ' . number_format($quotation->grand_total, 0, ',', '.') . ' (editable if deal changed)'
                                                : 'Enter contract value')
                                            ->prefixIcon('heroicon-o-currency-dollar')
                                            ->reactive()
                                            ->columnSpanFull(),
                                        
                                        // Payment Terms Repeater
                                        FormComponents\Repeater::make('payment_terms')
                                            ->label('Payment Terms')
                                            ->schema([
                                                Grid::make(2)
                                                    ->schema([
                                                        FormComponents\TextInput::make('percentage')
                                                            ->label('Percentage')
                                                            ->numeric()
                                                            ->required()
                                                            ->suffix('%')
                                                            ->minValue(0)
                                                            ->maxValue(100)
                                                            ->reactive(),
                                                        
                                                        FormComponents\TextInput::make('description')
                                                            ->label('Description')
                                                            ->required()
                                                            ->placeholder('e.g., Down Payment, Progress Payment, Final Payment')
                                                            ->maxLength(255),
                                                    ]),
                                            ])
                                            ->itemLabel(fn (array $state): ?string => 
                                                isset($state['percentage']) && isset($state['description']) 
                                                    ? "Termin: {$state['percentage']}% - {$state['description']}"
                                                    : null
                                            )
                                            ->collapsible()
                                            ->collapsed(false)
                                            ->addActionLabel('Add Payment Term')
                                            ->defaultItems(3)
                                            ->minItems(1)
                                            ->maxItems(10)
                                            ->reorderable()
                                            ->cloneable()
                                            ->helperText(fn() => $quotation 
                                                ? '✓ Payment terms loaded from quotation. Total should equal 100%. Adjust if needed after negotiation.'
                                                : 'Define payment milestones. Total should equal 100%. You can add up to 10 terms.')
                                            ->columnSpanFull(),
                                    ]),
                                
                                // === SECTION 4: MANAGED SERVICE OPTIONS (Conditional) ===
                                Section::make('Managed Service Options')
                                    ->icon('heroicon-o-cog-6-tooth')
                                    ->description('Monthly/yearly maintenance fee configuration')
                                    ->visible(fn (callable $get) => $get('project_type') === \App\Models\Contract::TYPE_MANAGED_SERVICE)
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                FormComponents\TextInput::make('maintenance_fee')
                                                    ->label('Maintenance Fee')
                                                    ->prefix('Rp')
                                                    ->numeric()
                                                    ->required(fn (callable $get) => $get('project_type') === \App\Models\Contract::TYPE_MANAGED_SERVICE)
                                                    ->prefixIcon('heroicon-o-wrench-screwdriver'),
                                                
                                                FormComponents\Select::make('maintenance_cycle')
                                                    ->label('Billing Cycle')
                                                    ->options([
                                                        \App\Models\Contract::CYCLE_MONTHLY => 'Monthly',
                                                        \App\Models\Contract::CYCLE_YEARLY => 'Yearly',
                                                    ])
                                                    ->default(\App\Models\Contract::CYCLE_MONTHLY)
                                                    ->required(fn (callable $get) => $get('project_type') === \App\Models\Contract::TYPE_MANAGED_SERVICE)
                                                    ->prefixIcon('heroicon-o-arrow-path'),
                                            ]),
                                    ]),
                            ];
                        })
                        ->action(function (Lead $record, array $data) {
                            $quotation = $record->quotations()->where('status', \App\Models\Quotation::STATUS_ACCEPTED)->latest()->first();
                            $project = \App\Models\Project::find($data['project_id']);
                            
                            // Process payment terms from repeater
                            $paymentTerms = [];
                            if (isset($data['payment_terms']) && is_array($data['payment_terms'])) {
                                foreach ($data['payment_terms'] as $term) {
                                    $paymentTerms[] = [
                                        'percentage' => $term['percentage'],
                                        'description' => $term['description'],
                                        'amount' => ($data['contract_value'] * $term['percentage']) / 100,
                                    ];
                                }
                            }
                            
                            // Calculate end date (already set by reactive field, but ensure it's correct)
                            $endDate = \Carbon\Carbon::parse($data['start_date'])->addDays($data['estimated_duration']);
                            
                            // Create contract
                            $contract = \App\Models\Contract::create([
                                'project_id' => $project->id,
                                'customer_id' => $record->customer_id,
                                'quotation_id' => $quotation->id,
                                'contract_value' => $data['contract_value'],
                                'start_date' => $data['start_date'],
                                'end_date' => $endDate,
                                'status' => \App\Models\Contract::STATUS_DRAFT,
                                'project_type' => $data['project_type'],
                                'warranty_period' => $data['warranty_period'],
                                'estimated_duration' => $data['estimated_duration'],
                                'payment_terms' => $paymentTerms,
                                'maintenance_fee' => $data['maintenance_fee'] ?? null,
                                'maintenance_cycle' => $data['maintenance_cycle'] ?? null,
                                'deliverables' => $data['deliverables'] ?? null,
                            ]);
                            
                            // Update project with contract_id
                            $project->update(['contract_id' => $contract->id]);
                            
                            Notification::make()
                                ->title('Contract Created Successfully')
                                ->success()
                                ->body("Contract {$contract->contract_number} has been created. Click to view or download.")
                                ->send();
                        }),
                    
                    Action::make('next_stage')
                        ->label(fn (Lead $record): string => 
                            $record->getNextStatus() 
                                ? Lead::getStatuses()[$record->getNextStatus()]
                                : 'Next Stage')
                        ->icon(Heroicon::OutlinedArrowRightCircle)
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(function (Lead $record): bool {
                            if (!$record->canAdvanceToNextStage()) {
                                return false;
                            }
                            
                            // If in Negotiation and trying to advance to Deal Won,
                            // require accepted quotation first
                            if ($record->status === Lead::STATUS_NEGOTIATION && 
                                $record->getNextStatus() === Lead::STATUS_DEAL) {
                                $hasAcceptedQuotation = $record->quotations()
                                    ->where('status', \App\Models\Quotation::STATUS_ACCEPTED)
                                    ->exists();
                                return $hasAcceptedQuotation;
                            }
                            
                            return true;
                        })
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
            ])
            ->recordUrl(fn (Lead $record): string => Pages\ViewLead::getUrl(['record' => $record]))
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
            'view' => Pages\ViewLead::route('/{record}'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
            'kanban' => Pages\LeadsKanbanBoard::route('/kanban'),
        ];
    }
}
