@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-2">{{ $job->title }}</h1>
        <p class="text-gray-700 mb-2">Company: {{ $job->company }}</p>
        <p class="text-gray-600">{{ $job->description }}</p>
    </div>

    <div class="mt-6">
        @auth
            <form action="{{ route('jobs.apply', $job->id) }}" method="POST" class="bg-gray-100 p-4 rounded">
                @csrf
                <label for="cover_letter" class="block mb-2 text-sm font-medium text-gray-700">Cover Letter (Optional)</label>
                <textarea name="cover_letter" rows="4" class="w-full p-2 border rounded" placeholder="Write something..."></textarea>
                <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Apply Now</button>
            </form>
        @else
            <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 p-4 rounded">
                <p>You must <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> to apply for this job.</p>
            </div>
        @endauth
    </div>
</div>
@endsection
