@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'Site Settings')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        @foreach($settings as $group => $groupSettings)
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4 capitalize">{{ str_replace('_', ' ', $group) }}</h3>
                <div class="space-y-4">
                    @foreach($groupSettings as $setting)
                        <div>
                            <label for="setting_{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                                {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                @if($setting->description)
                                    <span class="text-xs text-gray-500">({{ $setting->description }})</span>
                                @endif
                            </label>
                            @if($setting->type === 'textarea')
                                <textarea name="{{ $setting->key }}" id="setting_{{ $setting->key }}" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old($setting->key, $setting->value) }}</textarea>
                            @else
                                <input type="{{ $setting->type }}" name="{{ $setting->key }}" id="setting_{{ $setting->key }}"
                                    value="{{ old($setting->key, $setting->value) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection

