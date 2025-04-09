@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">My Applications</h1>
  
    @if($applications->count())
        @foreach($applications as $application)
            <div class="bg-white shadow p-4 rounded mb-4">
                <h2 class="text-xl font-semibold">{{ $application->job->title }}</h2>
                <p class="text-gray-600">Company: {{ $application->job->company }}</p>
                <p class="text-sm text-gray-500 mt-1">Applied On: {{ $application->created_at->format('d M Y') }}</p>
                <p class="mt-2">
                    Status:
                    <span class="inline-block px-2 py-1 text-sm rounded 
                        @if($application->status == 'Applied') bg-blue-100 text-blue-800 
                        @elseif($application->status == 'Interview') bg-yellow-100 text-yellow-800 
                        @elseif($application->status == 'Hired') bg-green-100 text-green-800 
                        @elseif($application->status == 'Rejected') bg-red-100 text-red-800 
                        @endif">
                        {{ $application->status }}
                    </span>
                </p>

                @if($application->status === 'Applied')
                    <div class="mt-3 flex gap-3">
                        <a href="{{ route('applications.edit', $application->id) }}" class="text-blue-600 hover:underline">Edit</a>

                        <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this application?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <p class="text-gray-600">You haven't applied to any jobs yet.</p>
    @endif
</div>
@endsection
