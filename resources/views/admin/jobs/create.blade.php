@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Post a New Job</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.jobs.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block font-medium text-gray-700">Job Title</label>
            <input type="text" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
        </div>

        <div>
            <label for="description" class="block font-medium text-gray-700">Job Description</label>
            <textarea name="description" required rows="5" class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
        </div>

        <div>
            <label for="company" class="block font-medium text-gray-700">Company</label>
            <input type="text" name="company" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
        </div>
        <div>
            <label for="location" class="block font-medium text-gray-700">Location</label>
            <input type="text" name="location" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="e.g., New York, Remote">
        </div>
        <div>
            <label for="type" class="block font-medium text-gray-700">Job Type</label>
            <select name="type" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                <option value="">Select Job Type</option>
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
                <option value="internship">Internship</option>
            </select>
        </div>
        <div>
            <label for="expiry_date" class="block font-medium text-gray-700">Expiry Date</label>
            <input type="date" name="expiry_date" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
        </div>
                
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
    </form>
</div>
@endsection
