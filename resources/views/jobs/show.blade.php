@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-2">{{ $job->title }}</h1>
        <p class="text-gray-600 mb-2">{{ $job->company }}</p>
        <p class="mb-4">{{ $job->description }}</p>

        <form action="{{ route('jobs.apply', $job->id) }}" method="POST" class="bg-gray-100 p-4 rounded">
            @csrf
            <label for="cover_letter" class="block font-semibold mb-2">Cover Letter (optional):</label>
            <textarea name="cover_letter" rows="4" class="w-full p-2 border border-gray-300 rounded"></textarea>
            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Apply</button>
        </form>
    </div>
@endsection
