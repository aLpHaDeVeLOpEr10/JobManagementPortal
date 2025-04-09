@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Jobs</h2>
            <p class="text-2xl font-bold">{{ $jobCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Applications</h2>
            <p class="text-2xl font-bold">{{ $applicationCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Users</h2>
            <p class="text-2xl font-bold">{{ $userCount }}</p>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Latest Jobs</h2>
        <ul class="bg-white rounded-lg shadow divide-y">
            @foreach ($latestJobs as $job)
                <li class="p-4">{{ $job->title }} - {{ $job->company }}</li>
            @endforeach
        </ul>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Latest Applications</h2>
        <ul class="bg-white rounded-lg shadow divide-y">
            @foreach ($latestApplications as $app)
                <li class="p-4">
                    {{ $app->user->name }} applied for {{ $app->job->title }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection