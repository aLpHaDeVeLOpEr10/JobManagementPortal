@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">Apply for {{ $job->title }}</h1>
    <form action="{{ route('jobs.apply', $job->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="cover_letter" class="block text-sm font-medium text-gray-700">Cover Letter (optional):</label>
            <textarea name="cover_letter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Enter your cover letter..."></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">Submit Application</button>
    </form>
@endsection
