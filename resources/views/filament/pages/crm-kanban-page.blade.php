<x-filament-panels::page>
    <div x-data="kanbanBoard()" class="space-y-4">
        {{-- Header with filters and search --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            {{-- Search --}}
            <div class="flex-1 max-w-md">
                <x-filament::input.wrapper>
                    <x-filament::input
                        type="search"
                        wire:model.live.debounce.300ms="searchTerm"
                        placeholder="Search by company, number, or name..."
                        x-ref="searchInput"
                    />
                </x-filament::input.wrapper>
            </div>

            {{-- Tab navigation --}}
            <div class="flex gap-2">
                <x-filament::button
                    wire:click="setActiveTab('all')"
                    :color="$activeTab === 'all' ? 'primary' : 'gray'"
                    size="sm"
                >
                    All Workflow
                </x-filament::button>
                <x-filament::button
                    wire:click="setActiveTab('leads')"
                    :color="$activeTab === 'leads' ? 'primary' : 'gray'"
                    size="sm"
                >
                    Leads Only
                </x-filament::button>
                <x-filament::button
                    wire:click="setActiveTab('projects')"
                    :color="$activeTab === 'projects' ? 'primary' : 'gray'"
                    size="sm"
                >
                    Projects Only
                </x-filament::button>
            </div>
        </div>

        {{-- Filter pills --}}
        @if($searchTerm || $filterAssignedTo || $filterPriority)
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-sm text-gray-500 dark:text-gray-400">Active filters:</span>
                
                @if($searchTerm)
                    <x-filament::badge size="sm" color="gray">
                        Search: {{ $searchTerm }}
                        <button wire:click="$set('searchTerm', null)" class="ml-1 hover:text-danger-600">
                            <x-heroicon-s-x-mark class="w-3 h-3" />
                        </button>
                    </x-filament::badge>
                @endif

                <x-filament::button
                    wire:click="clearFilters"
                    size="xs"
                    color="danger"
                    outlined
                >
                    Clear all
                </x-filament::button>
            </div>
        @endif

        {{-- Kanban board container --}}
        <div 
            class="overflow-x-auto pb-4"
            x-on:card-moved="handleCardMoved($event.detail)"
            x-on:show-notification="showNotification($event.detail)"
        >
            <div class="inline-flex gap-4 min-h-screen">
                @foreach($columns as $column)
                    {{-- Kanban column --}}
                    <div 
                        class="flex flex-col w-80 bg-gray-50 dark:bg-gray-800 rounded-lg p-4"
                        x-data="{ 
                            isDragOver: false,
                            columnId: '{{ $column['id'] }}',
                            isLocked: {{ isset($column['locked_until_payment']) ? 'true' : 'false' }},
                            requiresPayment: {{ isset($column['requires_payment']) ? 'true' : 'false' }}
                        }"
                    >
                        {{-- Column header --}}
                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-2">
                                @if(isset($column['icon']))
                                    <x-dynamic-component 
                                        :component="$column['icon']" 
                                        class="w-5 h-5 text-{{ $column['color'] }}-600"
                                    />
                                @endif
                                <h3 class="font-semibold text-sm text-gray-900 dark:text-white">
                                    {{ $column['label'] }}
                                </h3>
                                
                                {{-- Lock icon for locked columns --}}
                                @if(isset($column['locked_until_payment']))
                                    <x-heroicon-s-lock-closed class="w-4 h-4 text-yellow-500" x-show="isLocked" />
                                @endif
                            </div>
                            
                            {{-- Count badge --}}
                            <x-filament::badge :color="$column['color']" size="sm">
                                {{ $cards->where('column_id', $column['id'])->count() }}
                            </x-filament::badge>
                        </div>

                        {{-- Drop zone --}}
                        <div 
                            class="flex-1 space-y-3 min-h-[200px] rounded-lg transition-colors"
                            :class="{ 
                                'bg-primary-50 dark:bg-primary-900/20 ring-2 ring-primary-500': isDragOver && !isLocked,
                                'bg-yellow-50 dark:bg-yellow-900/20 ring-2 ring-yellow-500': isDragOver && isLocked
                            }"
                            x-on:dragover.prevent="isDragOver = true"
                            x-on:dragleave="isDragOver = false"
                            x-on:drop="handleDrop($event, columnId); isDragOver = false"
                        >
                            @foreach($cards->where('column_id', $column['id']) as $card)
                                {{-- Kanban card --}}
                                <div 
                                    draggable="true"
                                    x-data="{ 
                                        cardId: '{{ $card['id'] }}',
                                        isDragging: false 
                                    }"
                                    x-on:dragstart="handleDragStart($event, cardId); isDragging = true"
                                    x-on:dragend="isDragging = false"
                                    :class="{ 'opacity-50 cursor-grabbing': isDragging, 'cursor-grab': !isDragging }"
                                    class="group bg-white dark:bg-gray-900 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all"
                                >
                                    {{-- Card header --}}
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-sm text-gray-900 dark:text-white truncate">
                                                {{ $card['title'] }}
                                            </h4>
                                            @if($card['subtitle'])
                                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-1">
                                                    {{ $card['subtitle'] }}
                                                </p>
                                            @endif
                                        </div>
                                        
                                        {{-- Model type badge --}}
                                        <x-filament::badge 
                                            :color="match($card['model_type']) {
                                                'lead' => 'info',
                                                'quotation' => 'warning',
                                                'contract' => 'success',
                                                'project' => 'primary',
                                                default => 'gray'
                                            }"
                                            size="xs"
                                            class="ml-2 shrink-0"
                                        >
                                            {{ ucfirst($card['model_type']) }}
                                        </x-filament::badge>
                                    </div>

                                    {{-- Card metadata --}}
                                    <div class="space-y-2 text-xs text-gray-600 dark:text-gray-400">
                                        @foreach($card['meta'] as $key => $value)
                                            @if($value && $key !== 'payment_status')
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                                                    <span class="text-right truncate ml-2">{{ $value }}</span>
                                                </div>
                                            @endif
                                        @endforeach

                                        {{-- Payment status badges for projects --}}
                                        @if($card['model_type'] === 'project' && isset($card['meta']['payment_status']))
                                            <div class="flex flex-wrap gap-1 pt-2 border-t border-gray-100 dark:border-gray-800">
                                                @if($card['meta']['payment_status']['dp_paid'])
                                                    <x-filament::badge color="success" size="xs">
                                                        <x-heroicon-s-check-circle class="w-3 h-3 inline mr-1" />
                                                        DP Paid
                                                    </x-filament::badge>
                                                @elseif($card['meta']['payment_status']['dp_pending'])
                                                    <x-filament::badge color="warning" size="xs">
                                                        <x-heroicon-s-clock class="w-3 h-3 inline mr-1" />
                                                        DP Pending
                                                    </x-filament::badge>
                                                @endif

                                                @if($card['meta']['payment_status']['progress_paid'])
                                                    <x-filament::badge color="success" size="xs">
                                                        <x-heroicon-s-check-circle class="w-3 h-3 inline mr-1" />
                                                        Progress Paid
                                                    </x-filament::badge>
                                                @elseif($card['meta']['payment_status']['progress_pending'])
                                                    <x-filament::badge color="warning" size="xs">
                                                        <x-heroicon-s-clock class="w-3 h-3 inline mr-1" />
                                                        Progress Pending
                                                    </x-filament::badge>
                                                @endif

                                                @if($card['meta']['payment_status']['final_paid'])
                                                    <x-filament::badge color="success" size="xs">
                                                        <x-heroicon-s-check-circle class="w-3 h-3 inline mr-1" />
                                                        Final Paid
                                                    </x-filament::badge>
                                                @elseif($card['meta']['payment_status']['final_pending'])
                                                    <x-filament::badge color="warning" size="xs">
                                                        <x-heroicon-s-clock class="w-3 h-3 inline mr-1" />
                                                        Final Pending
                                                    </x-filament::badge>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Quick actions (shown on hover) --}}
                                    <div class="mt-3 pt-3 border-t border-gray-100 dark:border-gray-800 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <div class="flex items-center gap-2">
                                            <a 
                                                href="{{ match($card['model_type']) {
                                                    'lead' => route('filament.admin.resources.leads.edit', $card['model_id']),
                                                    'quotation' => route('filament.admin.resources.quotations.edit', $card['model_id']),
                                                    'contract' => route('filament.admin.resources.contracts.edit', $card['model_id']),
                                                    'project' => route('filament.admin.resources.projects.edit', $card['model_id']),
                                                    default => '#'
                                                } }}"
                                                class="text-xs text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 font-medium"
                                            >
                                                View Details →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Empty state --}}
                            @if($cards->where('column_id', $column['id'])->isEmpty())
                                <div class="flex items-center justify-center h-32 text-gray-400 dark:text-gray-600">
                                    <div class="text-center">
                                        <x-heroicon-o-inbox class="w-8 h-8 mx-auto mb-2" />
                                        <p class="text-xs">No items</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Alpine.js Kanban Board Logic --}}
    <script>
        function kanbanBoard() {
            return {
                draggedCardId: null,

                handleDragStart(event, cardId) {
                    this.draggedCardId = cardId;
                    event.dataTransfer.effectAllowed = 'move';
                    event.dataTransfer.setData('text/plain', cardId);
                },

                handleDrop(event, columnId) {
                    event.preventDefault();
                    
                    if (!this.draggedCardId) return;

                    // Dispatch to Livewire
                    @this.dispatch('card-moved', {
                        cardId: this.draggedCardId,
                        newColumnId: columnId
                    });

                    this.draggedCardId = null;
                },

                showNotification(detail) {
                    // Use Filament notification system
                    if (detail.type === 'error') {
                        new FilamentNotification()
                            .title(detail.message)
                            .danger()
                            .send();
                    } else if (detail.type === 'success') {
                        new FilamentNotification()
                            .title(detail.message)
                            .success()
                            .send();
                    }
                }
            }
        }
    </script>
</x-filament-panels::page>
