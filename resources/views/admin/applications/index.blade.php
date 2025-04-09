@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">All Applications</h1>

    <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-4">User</th>
                <th class="p-4">Job</th>
                <th class="p-4">Status</th>
                <th class="p-4">Applied At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $app)
                <tr class="border-t">
                    <td class="p-4">{{ $app->user->name }}</td>
                    <td class="p-4">{{ $app->job->title }}</td>
                    <td class="p-4">{{ ucfirst($app->status) }}</td>
                    <td class="p-4">{{ $app->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $applications->links() }}
    </div>
</div>
@endsection