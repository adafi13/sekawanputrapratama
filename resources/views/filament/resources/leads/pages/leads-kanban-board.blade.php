<x-filament-panels::page>
    <style>
        .kanban-board {
            display: flex;
            gap: 1rem;
            overflow-x: auto;
            padding: 1rem 0;
        }
        
        .kanban-column {
            flex: 0 0 320px;
            background: var(--gray-50);
            border-radius: 0.5rem;
            padding: 1rem;
            min-height: 500px;
        }
        
        .dark .kanban-column {
            background: rgb(var(--gray-800));
        }
        
        .kanban-column-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--gray-200);
        }
        
        .dark .kanban-column-header {
            border-bottom-color: rgb(var(--gray-700));
        }
        
        .kanban-column-title {
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .kanban-column-count {
            background: var(--primary-500);
            color: white;
            border-radius: 9999px;
            padding: 0.125rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .kanban-cards {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .kanban-card {
            background: white;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            cursor: grab;
            transition: all 0.2s;
        }
        
        .dark .kanban-card {
            background: rgb(var(--gray-900));
        }
        
        .kanban-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .kanban-card:active {
            cursor: grabbing;
        }
        
        .kanban-card-dragging {
            opacity: 0.5;
        }
        
        .kanban-card-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--gray-900);
        }
        
        .dark .kanban-card-title {
            color: rgb(var(--gray-100));
        }
        
        .kanban-card-meta {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
            font-size: 0.75rem;
            color: var(--gray-600);
            margin-bottom: 0.75rem;
        }
        
        .dark .kanban-card-meta {
            color: rgb(var(--gray-400));
        }
        
        .kanban-card-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid var(--gray-200);
        }
        
        .dark .kanban-card-actions {
            border-top-color: rgb(var(--gray-700));
        }
        
        .kanban-card-btn {
            flex: 1;
            padding: 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .kanban-card-btn-primary {
            background: var(--success-500);
            color: white;
        }
        
        .kanban-card-btn-primary:hover {
            background: var(--success-600);
        }
        
        .kanban-card-btn-secondary {
            background: var(--gray-200);
            color: var(--gray-700);
        }
        
        .dark .kanban-card-btn-secondary {
            background: rgb(var(--gray-700));
            color: rgb(var(--gray-300));
        }
        
        .kanban-card-btn-secondary:hover {
            background: var(--gray-300);
        }
        
        .dark .kanban-card-btn-secondary:hover {
            background: rgb(var(--gray-600));
        }
        
        .kanban-column-drag-over {
            background: var(--primary-100);
        }
        
        .dark .kanban-column-drag-over {
            background: rgb(var(--primary-900));
        }
    </style>

    <div class="kanban-board" x-data="kanbanBoard()">
        @foreach(\App\Models\Lead::getStatuses() as $status => $label)
            <div class="kanban-column" 
                 data-status="{{ $status }}"
                 x-on:dragover.prevent="dragOver($event)"
                 x-on:dragleave.prevent="dragLeave($event)"
                 x-on:drop.prevent="drop($event, '{{ $status }}')">
                <div class="kanban-column-header">
                    <span class="kanban-column-title">{{ $label }}</span>
                    <span class="kanban-column-count">
                        {{ $statusCounts[$status]['count'] ?? 0 }}
                    </span>
                </div>
                <div class="kanban-cards">
                    @foreach($leadsByStatus->get($status, collect()) as $lead)
                        <div class="kanban-card" 
                             draggable="true"
                             data-lead-id="{{ $lead->id }}"
                             x-on:dragstart="dragStart($event)"
                             x-on:dragend="dragEnd($event)">
                            <div class="kanban-card-title">
                                {{ $lead->company_name }}
                            </div>
                            <div class="kanban-card-meta">
                                <div>
                                    <x-heroicon-o-user class="inline w-3 h-3" />
                                    {{ $lead->contact_person }}
                                </div>
                                <div>
                                    <x-heroicon-o-envelope class="inline w-3 h-3" />
                                    {{ $lead->email }}
                                </div>
                                @if($lead->phone)
                                    <div>
                                        <x-heroicon-o-phone class="inline w-3 h-3" />
                                        {{ $lead->phone }}
                                    </div>
                                @endif
                                @if($lead->assignedTo)
                                    <div>
                                        <x-heroicon-o-user-circle class="inline w-3 h-3" />
                                        Assigned: {{ $lead->assignedTo->name }}
                                    </div>
                                @endif
                                @if($lead->deal_value)
                                    <div class="font-semibold text-success-600 dark:text-success-400">
                                        <x-heroicon-o-banknotes class="inline w-3 h-3" />
                                        Rp {{ number_format($lead->deal_value, 0, ',', '.') }}
                                    </div>
                                @endif
                            </div>
                            <div class="kanban-card-actions">
                                @if(!in_array($lead->status, [\App\Models\Lead::STATUS_DEAL, \App\Models\Lead::STATUS_LOST]))
                                    <button 
                                        type="button"
                                        class="kanban-card-btn kanban-card-btn-primary"
                                        wire:click="advanceStageAction({{ $lead->id }})"
                                        onclick="event.stopPropagation()">
                                        <x-heroicon-o-arrow-right-circle class="inline w-4 h-4" />
                                        Advance Stage
                                    </button>
                                @endif
                                <a href="{{ \App\Filament\Resources\Leads\LeadResource::getUrl('edit', ['record' => $lead->id]) }}"
                                   class="kanban-card-btn kanban-card-btn-secondary"
                                   onclick="event.stopPropagation()">
                                    <x-heroicon-o-pencil class="inline w-4 h-4" />
                                    Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function kanbanBoard() {
            return {
                draggedElement: null,
                
                dragStart(event) {
                    this.draggedElement = event.target;
                    event.target.classList.add('kanban-card-dragging');
                    event.dataTransfer.effectAllowed = 'move';
                    event.dataTransfer.setData('text/html', event.target.innerHTML);
                },
                
                dragEnd(event) {
                    event.target.classList.remove('kanban-card-dragging');
                },
                
                dragOver(event) {
                    if (event.preventDefault) {
                        event.preventDefault();
                    }
                    
                    event.dataTransfer.dropEffect = 'move';
                    
                    const column = event.target.closest('.kanban-column');
                    if (column) {
                        column.classList.add('kanban-column-drag-over');
                    }
                    
                    return false;
                },
                
                dragLeave(event) {
                    const column = event.target.closest('.kanban-column');
                    if (column) {
                        column.classList.remove('kanban-column-drag-over');
                    }
                },
                
                drop(event, newStatus) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    }
                    
                    const column = event.target.closest('.kanban-column');
                    if (column) {
                        column.classList.remove('kanban-column-drag-over');
                    }
                    
                    if (this.draggedElement) {
                        const leadId = this.draggedElement.getAttribute('data-lead-id');
                        
                        // Emit event to Livewire component
                        @this.dispatch('lead-moved', { leadId: leadId, newStatus: newStatus });
                    }
                    
                    return false;
                }
            }
        }
    </script>

    <x-filament-actions::modals />
</x-filament-panels::page>
