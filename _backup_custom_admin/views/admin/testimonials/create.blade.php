@extends('admin.layouts.app')

@section('title', 'Create Testimonial')
@section('page-title', 'Create Testimonial')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="testimonial" class="block text-sm font-medium text-gray-700">Testimonial *</label>
                <textarea name="testimonial" id="testimonial" rows="5" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('testimonial') }}</textarea>
                @error('testimonial')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="client_name" class="block text-sm font-medium text-gray-700">Client Name *</label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('client_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="client_company" class="block text-sm font-medium text-gray-700">Client Company</label>
                    <input type="text" name="client_company" id="client_company" value="{{ old('client_company') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="client_position" class="block text-sm font-medium text-gray-700">Client Position</label>
                    <input type="text" name="client_position" id="client_position" value="{{ old('client_position') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                <input type="number" name="rating" id="rating" value="{{ old('rating') }}" min="1" max="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="client_photo" class="block text-sm font-medium text-gray-700">Client Photo</label>
                <input type="file" name="client_photo" id="client_photo" accept="image/*"
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

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Testimonial
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

