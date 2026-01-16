@extends('admin.layouts.app')

@section('title', 'View Message')
@section('page-title', 'View Contact Message')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <a href="{{ route('admin.contacts.index') }}" class="text-indigo-600 hover:text-indigo-900">← Back to Messages</a>
    </div>

    <div class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <p class="mt-1 text-sm text-gray-900">{{ $contact->name }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <p class="mt-1 text-sm text-gray-900">{{ $contact->email }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Phone</label>
            <p class="mt-1 text-sm text-gray-900">{{ $contact->phone ?? '-' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Service Type</label>
            <p class="mt-1 text-sm text-gray-900">{{ $contact->service_type ?? '-' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Message</label>
            <p class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $contact->message }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <p class="mt-1 text-sm text-gray-900">{{ $contact->created_at->format('F d, Y h:i A') }}</p>
        </div>

        @if($contact->is_read && $contact->reader)
            <div>
                <label class="block text-sm font-medium text-gray-700">Read By</label>
                <p class="mt-1 text-sm text-gray-900">{{ $contact->reader->name }} on {{ $contact->read_at->format('F d, Y h:i A') }}</p>
            </div>
        @endif

        <div class="flex justify-end space-x-3">
            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

