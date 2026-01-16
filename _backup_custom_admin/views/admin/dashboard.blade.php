@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm font-medium">Total Pages</h3>
        <p class="text-3xl font-bold mt-2">{{ \App\Models\Page::count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm font-medium">Total Blog Posts</h3>
        <p class="text-3xl font-bold mt-2">{{ \App\Models\BlogPost::count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm font-medium">Total Portfolios</h3>
        <p class="text-3xl font-bold mt-2">{{ \App\Models\Portfolio::count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm font-medium">Unread Messages</h3>
        <p class="text-3xl font-bold mt-2">{{ \App\Models\ContactMessage::where('is_read', false)->count() }}</p>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Recent Activity</h2>
    <p class="text-gray-500">No recent activity</p>
</div>
@endsection

