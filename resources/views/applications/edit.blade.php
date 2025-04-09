@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">Edit Application</h1>
    <form action="{{ route('applications.update', $application->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="cover_letter" class="block text-sm font-medium text-gray-700">Cover Letter:</label>
            <textarea name="cover_letter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $application->cover_letter }}</textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">Update Application</button>
    </form>
@endsection
