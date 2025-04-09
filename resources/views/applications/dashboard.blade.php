@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">My Applications</h1>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($applications as $application)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->job->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <a href="{{ route('applications.edit', $application->id) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('applications.destroy', $application->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
