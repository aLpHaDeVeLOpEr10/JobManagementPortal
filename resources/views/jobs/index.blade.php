@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Available Jobs</h2>
    @foreach ($jobs as $job)
        <div class="bg-white shadow p-4 rounded mb-4">
            <h3 class="text-xl font-semibold">{{ $job->title }}</h3>
            <p class="text-gray-600">{{ $job->company }}</p>
            <p class="text-sm mt-1">{{ Str::limit($job->description, 100) }}</p>
            <a href="{{ route('jobs.show', $job->id) }}" class="text-blue-600 hover:underline mt-2 inline-block">View & Apply</a>
        </div>
    @endforeach
</div>
@endsection
