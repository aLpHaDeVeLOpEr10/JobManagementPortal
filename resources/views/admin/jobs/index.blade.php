@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">All Jobs</h1>
        <a href="{{ route('jobs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Post New Job</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left text-sm font-semibold">
                <th class="p-4">Title</th>
                <th class="p-4">Company</th>
                <th class="p-4">Location</th> {{-- New Location Column --}}
                <th class="p-4">Type</th> {{-- New Job Type Column --}}
                <th class="p-4">Posted At</th>
                <th class="p-4">Expiry Date</th>
                <th class="p-4">Actions</th> {{-- Action Column --}}
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr class="border-t">
                    <td class="p-4">
                        {{ $job->title }}
                        @if($job->expiry_date && $job->expiry_date < now())
                            <span class="ml-2 text-red-600 text-sm font-semibold">(Expired)</span>
                        @endif
                    </td>
                    <td class="p-4">{{ $job->company }}</td>
                    <td class="p-4">{{ $job->location }}</td> {{-- Display Job Location --}}
                    <td class="p-4">{{ ucfirst($job->type) }}</td> {{-- Display Job Type --}}
                    <td class="p-4">{{ $job->created_at->format('d M Y') }}</td>
                    <td class="p-4">
                        {{ $job->expiry_date ? \Carbon\Carbon::parse($job->expiry_date)->format('d M Y') : 'N/A' }}
                    </td>
                    <td class="p-4">
                        <a href="{{ route('admin.jobs.edit', $job->id) }}"
                           class="text-blue-500 hover:underline">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
