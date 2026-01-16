@extends('admin.layouts.app')

@section('title', 'Create Portfolio')
@section('page-title', 'Create Portfolio')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="client_name" class="block text-sm font-medium text-gray-700">Client Name</label>
                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="project_date" class="block text-sm font-medium text-gray-700">Project Date</label>
                    <input type="date" name="project_date" id="project_date" value="{{ old('project_date') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            <div>
                <label for="project_url" class="block text-sm font-medium text-gray-700">Project URL</label>
                <input type="url" name="project_url" id="project_url" value="{{ old('project_url') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="technologies" class="block text-sm font-medium text-gray-700">Technologies (comma separated)</label>
                <input type="text" name="technologies" id="technologies" value="{{ old('technologies') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    placeholder="Laravel, Vue.js, MySQL">
            </div>

            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" accept="image/*"
                    class="mt-1 block w-full">
            </div>

            <div>
                <label for="images" class="block text-sm font-medium text-gray-700">Additional Images</label>
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
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="is_featured" class="ml-2 block text-sm text-gray-900">Featured</label>
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
                <a href="{{ route('admin.portfolio.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Portfolio
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

