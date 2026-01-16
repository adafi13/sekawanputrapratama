@extends('admin.layouts.app')

@section('title', 'Edit Team Member')
@section('page-title', 'Edit Team Member')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.team.update', $team) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="position" class="block text-sm font-medium text-gray-700">Position *</label>
                <input type="text" name="position" id="position" value="{{ old('position', $team->position) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea name="bio" id="bio" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('bio', $team->bio) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $team->email) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $team->phone) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            <div>
                <label for="years_experience" class="block text-sm font-medium text-gray-700">Years of Experience</label>
                <input type="number" name="years_experience" id="years_experience" value="{{ old('years_experience', $team->years_experience) }}" min="0"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="social_links" class="block text-sm font-medium text-gray-700">Social Links (JSON format)</label>
                <textarea name="social_links" id="social_links" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm font-mono text-sm">{{ old('social_links', is_array($team->social_links) ? json_encode($team->social_links, JSON_PRETTY_PRINT) : $team->social_links) }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Enter as JSON object with keys like linkedin, github, twitter, etc.</p>
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                @if($team->getFirstMediaUrl('photo'))
                    <div class="mb-2">
                        <img src="{{ $team->getFirstMediaUrl('photo') }}" alt="Current photo" class="h-32 w-auto rounded">
                    </div>
                @endif
                <input type="file" name="photo" id="photo" accept="image/*"
                    class="mt-1 block w-full">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $team->order) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $team->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.team.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Member
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

