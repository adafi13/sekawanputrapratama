<x-filament-panels::page>
    {{-- Kanban Board with SortableJS --}}
    <div>
        {{-- Header: Search & Tabs --}}
        <div class="mb-6 space-y-4">
            {{-- Search --}}
            <div class="max-w-md">
                <x-filament::input.wrapper>
                    <x-filament::input
                        type="search"
                        wire:model.live.debounce.300ms="searchTerm"
                        placeholder="Search by company, number, or name..."
                    />
                </x-filament::input.wrapper>
            </div>

            {{-- Tabs --}}
            <div class="flex gap-2 border-b border-gray-200 dark:border-gray-700 pb-2">
                <button
                    wire:click="setActiveTab('all')"
                    @class([
                        'px-4 py-2 text-sm font-medium rounded-lg transition',
                        'bg-primary-600 text-white' => $activeTab === 'all',
                        'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' => $activeTab !== 'all',
                    ])
                >
                    All Workflow
                </button>
                <button
                    wire:click="setActiveTab('leads')"
                    @class([
                        'px-4 py-2 text-sm font-medium rounded-lg transition',
                        'bg-primary-600 text-white' => $activeTab === 'leads',
                        'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' => $activeTab !== 'leads',
                    ])
                >
                    Leads Only
                </button>
                <button
                    wire:click="setActiveTab('projects')"
                    @class([
                        'px-4 py-2 text-sm font-medium rounded-lg transition',
                        'bg-primary-600 text-white' => $activeTab === 'projects',
                        'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' => $activeTab !== 'projects',
                    ])
                >
                    Projects Only
                </button>
            </div>
        </div>

        {{-- Kanban Board - Horizontal Scroll Container --}}
        <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg overflow-x-auto">
            <div class="flex gap-4" style="min-width: max-content;">
                @foreach($columns as $column)
                    {{-- Kanban Column --}}
                    <div class="flex flex-col bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200" style="width: 300px; min-width: 300px;">
                        
                        {{-- Column Header --}}
                        <div class="p-3 border-b-2" style="border-color: #3b82f6;">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-sm">{{ $column['label'] }}</h3>
                                <span class="px-2 py-1 text-xs font-bold bg-blue-600 text-white rounded-full">
                                    {{ $cards->where('column_id', $column['id'])->count() }}
                                </span>
                            </div>
                        </div>

                        {{-- Cards Container --}}
                        <div class="p-3 space-y-2" style="min-height: 300px; max-height: 500px; overflow-y: auto;">
                            @php
                                $columnCards = $cards->where('column_id', $column['id']);
                            @endphp

                            @forelse($columnCards as $card)
                                {{-- Card --}}
                                <div class="bg-white border border-gray-300 rounded-lg p-3 shadow-sm">
                                    <div class="mb-2">
                                        <span class="px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-700 rounded">
                                            {{ $card['status_label'] ?? 'N/A' }}
                                        </span>
                                    </div>
                                    
                                    <h4 class="font-semibold text-sm mb-2">{{ $card['title'] ?? 'Untitled' }}</h4>
                                    
                                    @if($card['model_type'] === 'Lead' && isset($card['email']))
                                        <p class="text-xs text-gray-600">{{ $card['email'] }}</p>
                                    @endif
                                    
                                    @if($card['model_type'] === 'Quotation' && isset($card['quotation_number']))
                                        <p class="text-xs text-gray-600">No: {{ $card['quotation_number'] }}</p>
                                    @endif
                                    
                                    <div class="mt-2 pt-2 border-t border-gray-200">
                                        <a href="{{ $card['view_url'] ?? '#' }}" class="text-xs text-blue-600 hover:text-blue-800">
                                            View Details →
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-400 text-sm">
                                    No items
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-filament-panels::page>
