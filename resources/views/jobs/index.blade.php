@extends('layouts.app')

@section('content')
@if (session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    {{ session('error') }}
</div>
@endif
@if (session('success'))
<div class="bg-red-100 border border-red-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif
{{-- @foreach(auth()->user()->notifications as $notification)
    <div class="bg-blue-100 border border-blue-400 text-blue-700 p-4 rounded mb-4">
        {{ $notification->data['message'] }} 
    </div>
@endforeach --}}

<div class="max-w-5xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Available Jobs</h2>
    
    <!-- Search and Filter Form -->
    <form action="{{ route('dashboard') }}" method="GET" class="mb-6">
        <div class="flex space-x-4">
            <input type="text" name="search" placeholder="Search by title, company, location" class="border rounded p-2 w-full">

            <select name="type" class="border rounded p-2">
                <option value="">All Types</option>
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
                <option value="internship">Internship</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>

            <!-- Show All Jobs Button -->
            <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Show All Jobs</a>
        </div>
    </form>

    @if ($jobs->isEmpty())
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
            No jobs found for your search criteria.
        </div>
    @else
        @foreach ($jobs as $job)
            <div class="bg-white shadow p-4 rounded mb-4">
                <h3 class="text-xl font-semibold">{{ $job->title }}</h3>
                <p class="text-gray-600">{{ $job->company }}</p>
                <p class="text-sm mt-1">{{ Str::limit($job->description, 100) }}</p>
                <p class="text-sm mt-1">Location: {{ $job->location }}</p> <!-- Display Job Location -->
                <p class="text-sm mt-1">Type: {{ ucfirst($job->type) }}</p> <!-- Display Job Type -->
                <a href="{{ route('jobs.show', $job->id) }}" class="text-blue-600 hover:underline mt-2 inline-block">View & Apply</a>
            </div>
        @endforeach
    @endif

    <!-- Pagination Links -->
    {{ $jobs->links() }}
</div>
@endsection
