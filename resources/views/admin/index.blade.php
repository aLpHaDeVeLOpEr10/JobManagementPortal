@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">All Jobs</h1>

    <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-4">Title</th>
                <th class="p-4">Company</th>
                <th class="p-4">Posted At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr class="border-t">
                    <td class="p-4">{{ $job->title }}</td>
                    <td class="p-4">{{ $job->company }}</td>
                    <td class="p-4">{{ $job->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $jobs->links() }}
    </div>
</div>
@endsection