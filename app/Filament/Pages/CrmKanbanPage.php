<?php

namespace App\Filament\Pages;

use App\Models\Lead;
use App\Models\Quotation;
use App\Models\Contract;
use App\Models\Project;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;

class CrmKanbanPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedViewColumns;

    protected static string $view = 'filament.pages.crm-kanban-page';

    protected static ?string $navigationLabel = 'CRM Kanban Board';

    protected static ?string $title = 'CRM Workflow Kanban';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'CRM';
    }

    public string $activeTab = 'all';
    public ?string $searchTerm = null;
    public ?string $filterAssignedTo = null;
    public ?string $filterPriority = null;

    public Collection $columns;
    public Collection $cards;

    /**
     * Define all workflow columns for the unified Kanban board
     */
    protected function getColumns(): array
    {
        return [
            // Lead Stages
            [
                'id' => 'lead_new',
                'label' => 'New Lead',
                'status' => Lead::STATUS_NEW,
                'model' => Lead::class,
                'color' => 'gray',
                'icon' => 'heroicon-o-user-plus',
            ],
            [
                'id' => 'lead_qualified',
                'label' => 'Qualified',
                'status' => Lead::STATUS_QUALIFIED,
                'model' => Lead::class,
                'color' => 'blue',
                'icon' => 'heroicon-o-check-badge',
            ],
            [
                'id' => 'lead_contacted',
                'label' => 'Contacted',
                'status' => Lead::STATUS_CONTACTED,
                'model' => Lead::class,
                'color' => 'indigo',
                'icon' => 'heroicon-o-phone',
            ],
            [
                'id' => 'lead_negotiation',
                'label' => 'Negotiation',
                'status' => Lead::STATUS_NEGOTIATION,
                'model' => Lead::class,
                'color' => 'yellow',
                'icon' => 'heroicon-o-chat-bubble-left-right',
            ],
            
            // Quotation Stages
            [
                'id' => 'quotation_draft',
                'label' => 'Quotation Draft',
                'status' => Quotation::STATUS_DRAFT,
                'model' => Quotation::class,
                'color' => 'gray',
                'icon' => 'heroicon-o-document',
            ],
            [
                'id' => 'quotation_sent',
                'label' => 'Quotation Sent',
                'status' => Quotation::STATUS_SENT,
                'model' => Quotation::class,
                'color' => 'blue',
                'icon' => 'heroicon-o-paper-airplane',
            ],
            [
                'id' => 'quotation_accepted',
                'label' => 'Quotation Accepted',
                'status' => Quotation::STATUS_ACCEPTED,
                'model' => Quotation::class,
                'color' => 'success',
                'icon' => 'heroicon-o-check-circle',
            ],
            
            // Contract Stages
            [
                'id' => 'contract_draft',
                'label' => 'Contract Draft',
                'status' => Contract::STATUS_DRAFT,
                'model' => Contract::class,
                'color' => 'gray',
                'icon' => 'heroicon-o-document-text',
            ],
            [
                'id' => 'contract_signed',
                'label' => 'Contract Signed',
                'status' => Contract::STATUS_SIGNED,
                'model' => Contract::class,
                'color' => 'indigo',
                'icon' => 'heroicon-o-pencil-square',
            ],
            
            // Project Stages
            [
                'id' => 'project_awaiting_dp',
                'label' => 'Awaiting DP',
                'status' => Project::STATUS_AWAITING_DP,
                'model' => Project::class,
                'color' => 'warning',
                'icon' => 'heroicon-o-credit-card',
                'requires_payment' => true,
                'payment_stage' => 'dp',
            ],
            [
                'id' => 'project_planning',
                'label' => 'Planning',
                'status' => Project::STATUS_PLANNING,
                'model' => Project::class,
                'color' => 'blue',
                'icon' => 'heroicon-o-map',
                'locked_until_payment' => 'dp',
            ],
            [
                'id' => 'project_dev_phase_1',
                'label' => 'Development Phase 1',
                'status' => Project::STATUS_DEVELOPMENT_PHASE_1,
                'model' => Project::class,
                'color' => 'purple',
                'icon' => 'heroicon-o-code-bracket',
            ],
            [
                'id' => 'project_dev_phase_2',
                'label' => 'Development Phase 2',
                'status' => Project::STATUS_DEVELOPMENT_PHASE_2,
                'model' => Project::class,
                'color' => 'purple',
                'icon' => 'heroicon-o-code-bracket-square',
            ],
            [
                'id' => 'project_uat',
                'label' => 'UAT',
                'status' => Project::STATUS_UAT,
                'model' => Project::class,
                'color' => 'orange',
                'icon' => 'heroicon-o-beaker',
                'locked_until_payment' => 'progress',
            ],
            [
                'id' => 'project_deployment',
                'label' => 'Deployment',
                'status' => Project::STATUS_DEPLOYMENT,
                'model' => Project::class,
                'color' => 'teal',
                'icon' => 'heroicon-o-arrow-up-tray',
                'locked_until_payment' => 'final',
            ],
            [
                'id' => 'project_completed',
                'label' => 'Completed',
                'status' => Project::STATUS_COMPLETED,
                'model' => Project::class,
                'color' => 'success',
                'icon' => 'heroicon-o-check-badge',
            ],
        ];
    }

    /**
     * Mount the component and load initial data
     */
    public function mount(): void
    {
        $this->loadData();
    }

    /**
     * Load all cards data from multiple models
     */
    public function loadData(): void
    {
        $this->columns = collect($this->getColumns());
        $this->cards = collect();

        // Load Leads
        $leads = Lead::with(['assignedTo', 'customer'])
            ->whereIn('status', [
                Lead::STATUS_NEW,
                Lead::STATUS_QUALIFIED,
                Lead::STATUS_CONTACTED,
                Lead::STATUS_NEGOTIATION,
            ])
            ->when($this->searchTerm, function ($query) {
                $query->where(function ($q) {
                    $q->where('company_name', 'like', "%{$this->searchTerm}%")
                        ->orWhere('contact_person', 'like', "%{$this->searchTerm}%")
                        ->orWhere('email', 'like', "%{$this->searchTerm}%");
                });
            })
            ->when($this->filterAssignedTo, function ($query) {
                $query->where('assigned_to', $this->filterAssignedTo);
            })
            ->when($this->filterPriority, function ($query) {
                $query->where('priority', $this->filterPriority);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($lead) {
                return [
                    'id' => 'lead_' . $lead->id,
                    'model_type' => 'lead',
                    'model_id' => $lead->id,
                    'column_id' => 'lead_' . $lead->status,
                    'title' => $lead->company_name,
                    'subtitle' => $lead->contact_person,
                    'meta' => [
                        'email' => $lead->email,
                        'phone' => $lead->phone,
                        'assigned_to' => $lead->assignedTo?->name,
                        'deal_value' => $lead->deal_value ? 'Rp ' . number_format($lead->deal_value, 0, ',', '.') : null,
                        'priority' => $lead->priority,
                    ],
                    'record' => $lead,
                ];
            });

        // Load Quotations
        $quotations = Quotation::with(['lead', 'customer'])
            ->whereIn('status', [
                Quotation::STATUS_DRAFT,
                Quotation::STATUS_SENT,
                Quotation::STATUS_ACCEPTED,
            ])
            ->when($this->searchTerm, function ($query) {
                $query->where(function ($q) {
                    $q->where('quotation_number', 'like', "%{$this->searchTerm}%")
                        ->orWhereHas('customer', function ($q) {
                            $q->where('company_name', 'like', "%{$this->searchTerm}%");
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($quotation) {
                return [
                    'id' => 'quotation_' . $quotation->id,
                    'model_type' => 'quotation',
                    'model_id' => $quotation->id,
                    'column_id' => 'quotation_' . $quotation->status,
                    'title' => $quotation->quotation_number,
                    'subtitle' => $quotation->customer?->company_name ?? $quotation->lead?->company_name,
                    'meta' => [
                        'total' => 'Rp ' . number_format($quotation->grand_total, 0, ',', '.'),
                        'valid_until' => $quotation->valid_until?->format('d M Y'),
                        'items_count' => $quotation->items->count() . ' items',
                    ],
                    'record' => $quotation,
                ];
            });

        // Load Contracts
        $contracts = Contract::with(['customer', 'project'])
            ->whereIn('status', [
                Contract::STATUS_DRAFT,
                Contract::STATUS_SIGNED,
            ])
            ->when($this->searchTerm, function ($query) {
                $query->where(function ($q) {
                    $q->where('contract_number', 'like', "%{$this->searchTerm}%")
                        ->orWhereHas('customer', function ($q) {
                            $q->where('company_name', 'like', "%{$this->searchTerm}%");
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($contract) {
                return [
                    'id' => 'contract_' . $contract->id,
                    'model_type' => 'contract',
                    'model_id' => $contract->id,
                    'column_id' => 'contract_' . $contract->status,
                    'title' => $contract->contract_number,
                    'subtitle' => $contract->customer?->company_name,
                    'meta' => [
                        'value' => 'Rp ' . number_format($contract->contract_value, 0, ',', '.'),
                        'signed_date' => $contract->signed_at?->format('d M Y'),
                        'project_type' => ucwords(str_replace('_', ' ', $contract->project_type ?? '')),
                    ],
                    'record' => $contract,
                ];
            });

        // Load Projects
        $projects = Project::with(['customer', 'assignedTo', 'invoices'])
            ->whereIn('status', [
                Project::STATUS_AWAITING_DP,
                Project::STATUS_PLANNING,
                Project::STATUS_DEVELOPMENT_PHASE_1,
                Project::STATUS_DEVELOPMENT_PHASE_2,
                Project::STATUS_UAT,
                Project::STATUS_DEPLOYMENT,
                Project::STATUS_COMPLETED,
            ])
            ->when($this->searchTerm, function ($query) {
                $query->where(function ($q) {
                    $q->where('project_code', 'like', "%{$this->searchTerm}%")
                        ->orWhere('project_name', 'like', "%{$this->searchTerm}%")
                        ->orWhereHas('customer', function ($q) {
                            $q->where('company_name', 'like', "%{$this->searchTerm}%");
                        });
                });
            })
            ->when($this->filterAssignedTo, function ($query) {
                $query->where('assigned_to', $this->filterAssignedTo);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($project) {
                $paymentStatus = $this->getProjectPaymentStatus($project);
                
                return [
                    'id' => 'project_' . $project->id,
                    'model_type' => 'project',
                    'model_id' => $project->id,
                    'column_id' => 'project_' . $project->status,
                    'title' => $project->project_code,
                    'subtitle' => $project->customer?->company_name,
                    'meta' => [
                        'project_name' => $project->project_name,
                        'pm' => $project->assignedTo?->name,
                        'budget' => 'Rp ' . number_format($project->estimated_budget, 0, ',', '.'),
                        'progress' => $project->progress_percentage . '%',
                        'payment_status' => $paymentStatus,
                    ],
                    'record' => $project,
                ];
            });

        // Merge all cards
        $this->cards = $leads->concat($quotations)->concat($contracts)->concat($projects);
    }

    /**
     * Get payment status for project
     */
    protected function getProjectPaymentStatus(Project $project): array
    {
        $invoices = $project->invoices;
        
        $dpInvoice = $invoices->where('stage', 'dp')->first();
        $progressInvoice = $invoices->where('stage', 'progress')->first();
        $finalInvoice = $invoices->where('stage', 'final')->first();
        
        return [
            'dp_paid' => $dpInvoice?->status === 'paid',
            'progress_paid' => $progressInvoice?->status === 'paid',
            'final_paid' => $finalInvoice?->status === 'paid',
            'dp_pending' => $dpInvoice && $dpInvoice->status !== 'paid',
            'progress_pending' => $progressInvoice && $progressInvoice->status !== 'paid',
            'final_pending' => $finalInvoice && $finalInvoice->status !== 'paid',
        ];
    }

    /**
     * Handle card moved event from frontend
     */
    #[On('card-moved')]
    public function onCardMoved(string $cardId, string $newColumnId): void
    {
        [$modelType, $modelId] = explode('_', $cardId, 2);
        [$targetModel, $targetStatus] = explode('_', $newColumnId, 2);

        try {
            $record = $this->findRecord($modelType, $modelId);
            
            if (!$record) {
                $this->dispatch('show-notification', [
                    'type' => 'error',
                    'message' => 'Record not found',
                ]);
                return;
            }

            // Validate transition
            if (!$this->canMoveToStatus($record, $targetStatus, $modelType)) {
                $this->dispatch('show-notification', [
                    'type' => 'error',
                    'message' => 'Invalid status transition',
                ]);
                $this->loadData();
                return;
            }

            // Check if payment is required for project moves
            if ($modelType === 'project' && !$this->isPaymentSatisfied($record, $targetStatus)) {
                $this->dispatch('show-payment-warning', [
                    'projectId' => $record->id,
                    'requiredStage' => $this->getRequiredPaymentStage($targetStatus),
                ]);
                $this->loadData();
                return;
            }

            // Show advancement modal for forward moves
            if ($this->isForwardMove($record, $targetStatus, $modelType)) {
                $this->dispatch('show-advancement-modal', [
                    'cardId' => $cardId,
                    'modelType' => $modelType,
                    'modelId' => $modelId,
                    'newStatus' => $targetStatus,
                ]);
                return;
            }

            // Direct move (backward or allowed forward)
            $record->update(['status' => $targetStatus]);
            
            $this->dispatch('show-notification', [
                'type' => 'success',
                'message' => 'Status updated successfully',
            ]);
            
            $this->loadData();
            
        } catch (\Exception $e) {
            \Log::error('Kanban move error: ' . $e->getMessage());
            
            $this->dispatch('show-notification', [
                'type' => 'error',
                'message' => 'Failed to move card: ' . $e->getMessage(),
            ]);
            
            $this->loadData();
        }
    }

    /**
     * Find record by model type and ID
     */
    protected function findRecord(string $modelType, int $modelId)
    {
        return match($modelType) {
            'lead' => Lead::find($modelId),
            'quotation' => Quotation::find($modelId),
            'contract' => Contract::find($modelId),
            'project' => Project::find($modelId),
            default => null,
        };
    }

    /**
     * Check if status transition is valid
     */
    protected function canMoveToStatus($record, string $targetStatus, string $modelType): bool
    {
        if (method_exists($record, 'isValidStatusChange')) {
            return $record->isValidStatusChange($targetStatus);
        }
        
        return true;
    }

    /**
     * Check if payment requirements are satisfied for project status
     */
    protected function isPaymentSatisfied(Project $project, string $targetStatus): bool
    {
        $requiredStage = $this->getRequiredPaymentStage($targetStatus);
        
        if (!$requiredStage) {
            return true;
        }
        
        return $project->hasInvoicePaid($requiredStage);
    }

    /**
     * Get required payment stage for target status
     */
    protected function getRequiredPaymentStage(string $targetStatus): ?string
    {
        return match($targetStatus) {
            Project::STATUS_PLANNING => 'dp',
            Project::STATUS_UAT => 'progress',
            Project::STATUS_DEPLOYMENT => 'final',
            default => null,
        };
    }

    /**
     * Check if this is a forward move (requires modal)
     */
    protected function isForwardMove($record, string $targetStatus, string $modelType): bool
    {
        if (!method_exists($record, 'getNextStatus')) {
            return false;
        }
        
        return $record->getNextStatus() === $targetStatus;
    }

    /**
     * Refresh data after action completed
     */
    #[On('refresh-kanban')]
    public function refresh(): void
    {
        $this->loadData();
    }

    /**
     * Update active tab filter
     */
    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->loadData();
    }

    /**
     * Update search term
     */
    public function updatedSearchTerm(): void
    {
        $this->loadData();
    }

    /**
     * Update filters
     */
    public function updatedFilterAssignedTo(): void
    {
        $this->loadData();
    }

    public function updatedFilterPriority(): void
    {
        $this->loadData();
    }

    /**
     * Clear all filters
     */
    public function clearFilters(): void
    {
        $this->searchTerm = null;
        $this->filterAssignedTo = null;
        $this->filterPriority = null;
        $this->loadData();
    }
}
