@extends('admin.layouts.app')

@section('title', 'Create Service')
@section('page-title', 'Create Service')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" rows="10"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('content') }}</textarea>
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700">Icon (Class name or image)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    placeholder="e.g., fa fa-code or upload image below">
            </div>

            <div>
                <label for="icon_file" class="block text-sm font-medium text-gray-700">Icon Image</label>
                <input type="file" name="icon" id="icon_file" accept="image/*"
                    class="mt-1 block w-full">
            </div>

            <div>
                <label for="images" class="block text-sm font-medium text-gray-700">Service Images</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="mt-1 block w-full">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                    <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            <div>
                <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('meta_description') }}</textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.services.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Service
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

