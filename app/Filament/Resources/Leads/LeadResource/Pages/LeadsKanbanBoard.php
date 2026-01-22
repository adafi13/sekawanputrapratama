<?php

namespace App\Filament\Resources\Leads\LeadResource\Pages;

use App\Filament\Resources\Leads\LeadResource;
use App\Models\Lead;
use BackedEnum;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;

class LeadsKanbanBoard extends Page
{
    protected static string $resource = LeadResource::class;

    protected string $view = 'filament.resources.leads.pages.leads-kanban-board';

    protected static ?string $title = 'Leads Kanban Board';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedViewColumns;

    public array $statusCounts = [];
    public Collection $leadsByStatus;

    public function mount(): void
    {
        $this->loadLeads();
    }

    public function loadLeads(): void
    {
        $this->leadsByStatus = Lead::with('assignedTo')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('status');

        $this->statusCounts = Lead::getStatuses();
        foreach ($this->statusCounts as $status => $label) {
            $this->statusCounts[$status] = [
                'label' => $label,
                'count' => $this->leadsByStatus->get($status)?->count() ?? 0,
            ];
        }
    }

    #[On('lead-moved')]
    public function onLeadMoved($leadId, $newStatus): void
    {
        $lead = Lead::find($leadId);
        
        if (!$lead) {
            Notification::make()
                ->title('Error')
                ->danger()
                ->body('Lead not found.')
                ->send();
            return;
        }

        // Simple status update for drag & drop
        $lead->update(['status' => $newStatus]);

        Notification::make()
            ->title('Lead Moved')
            ->success()
            ->body("Lead moved to: " . Lead::getStatuses()[$newStatus])
            ->send();

        $this->loadLeads();
    }

    public function advanceStageAction($leadId): void
    {
        $lead = Lead::find($leadId);
        
        if (!$lead) {
            Notification::make()
                ->title('Error')
                ->danger()
                ->body('Lead not found.')
                ->send();
            return;
        }

        // Determine next stage
        $nextStatus = match($lead->status) {
            Lead::STATUS_NEW => Lead::STATUS_CONTACTED,
            Lead::STATUS_CONTACTED => Lead::STATUS_QUOTATION_SENT,
            Lead::STATUS_QUOTATION_SENT => Lead::STATUS_NEGOTIATION,
            Lead::STATUS_NEGOTIATION => Lead::STATUS_DEAL,
            default => null,
        };

        if (!$nextStatus) {
            Notification::make()
                ->title('Cannot Advance')
                ->warning()
                ->body('This lead cannot be advanced further.')
                ->send();
            return;
        }

        // Build form based on next status
        $formSchema = $this->getFormSchemaForStatus($lead->status, $nextStatus);

        $this->mountAction('advanceStage', [
            'lead' => $lead,
            'nextStatus' => $nextStatus,
            'formSchema' => $formSchema,
        ]);
    }

    protected function getFormSchemaForStatus($currentStatus, $nextStatus): array
    {
        $schema = [];

        // Always show notes
        $schema[] = Components\Textarea::make('notes')
            ->label('Status Change Notes')
            ->placeholder('Add any relevant notes...')
            ->rows(3);

        // Specific fields based on transition
        if ($currentStatus === Lead::STATUS_CONTACTED && $nextStatus === Lead::STATUS_QUOTATION_SENT) {
            $schema[] = Components\Textarea::make('quotation_notes')
                ->label('Quotation Notes')
                ->placeholder('Enter quotation details, pricing, terms, etc.')
                ->required()
                ->rows(4);
            $schema[] = Components\DateTimePicker::make('quotation_sent_at')
                ->label('Quotation Sent Date')
                ->default(now())
                ->required();
        }

        if ($nextStatus === Lead::STATUS_DEAL) {
            $schema[] = Components\TextInput::make('deal_value')
                ->label('Deal Value')
                ->numeric()
                ->prefix('Rp')
                ->required()
                ->helperText('Enter the final deal value');
            $schema[] = Components\DateTimePicker::make('deal_closed_at')
                ->label('Deal Closed Date')
                ->default(now())
                ->required();
        }

        if ($nextStatus === Lead::STATUS_CONTACTED) {
            $schema[] = Components\DateTimePicker::make('contacted_at')
                ->label('Contact Date')
                ->default(now())
                ->required();
        }

        return $schema;
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back_to_list')
                ->label('Back to List View')
                ->icon(Heroicon::OutlinedListBullet)
                ->color('gray')
                ->url(LeadResource::getUrl('index')),
            \Filament\Actions\CreateAction::make()
                ->label('New Lead')
                ->icon(Heroicon::OutlinedPlus)
                ->model(Lead::class)
                ->schema(fn () => LeadResource::form(\Filament\Schemas\Schema::make())->getComponents()),
        ];
    }

    public function getActions(): array
    {
        return [
            \Filament\Actions\Action::make('advanceStage')
                ->label('Advance Stage')
                ->icon(Heroicon::OutlinedArrowRightCircle)
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading(fn (array $arguments) => 'Advance to ' . Lead::getStatuses()[$arguments['nextStatus']])
                ->modalDescription('Please provide additional information for this stage transition.')
                ->modalIcon(Heroicon::OutlinedShieldCheck)
                ->form(fn (array $arguments) => $arguments['formSchema'])
                ->action(function (array $data, array $arguments) {
                    $lead = $arguments['lead'];
                    $nextStatus = $arguments['nextStatus'];

                    $updateData = [
                        'status' => $nextStatus,
                    ];

                    if (!empty($data['notes'])) {
                        $updateData['notes'] = ($lead->notes ? $lead->notes . "\n\n" : '') . 
                            '[' . now()->format('Y-m-d H:i') . '] Advanced to ' . 
                            Lead::getStatuses()[$nextStatus] . ': ' . $data['notes'];
                    }

                    if (isset($data['quotation_notes'])) {
                        $updateData['quotation_notes'] = $data['quotation_notes'];
                    }

                    if (isset($data['deal_value'])) {
                        $updateData['deal_value'] = $data['deal_value'];
                    }

                    if (isset($data['contacted_at'])) {
                        $updateData['contacted_at'] = $data['contacted_at'];
                    }

                    if (isset($data['quotation_sent_at'])) {
                        $updateData['quotation_sent_at'] = $data['quotation_sent_at'];
                    }

                    if (isset($data['deal_closed_at'])) {
                        $updateData['deal_closed_at'] = $data['deal_closed_at'];
                    }

                    $lead->update($updateData);

                    Notification::make()
                        ->title('Stage Advanced')
                        ->success()
                        ->body("Lead advanced to: " . Lead::getStatuses()[$nextStatus])
                        ->send();

                    $this->loadLeads();
                }),
        ];
    }
}
