@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Edit Job</h1>

    <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Job Title</label>
            <input type="text" name="title" value="{{ old('title', $job->title) }}" required class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Company</label>
            <input type="text" name="company" value="{{ old('company', $job->company) }}" required class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Job Description</label>
            <textarea name="description" rows="5" required class="w-full border border-gray-300 rounded p-2">{{ old('description', $job->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Location</label>
            <input type="text" name="location" value="{{ old('location', $job->location) }}" required class="w-full border border-gray-300 rounded p-2" placeholder="e.g., New York, Remote">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Job Type</label>
            <select name="type" required class="w-full border border-gray-300 rounded p-2">
                <option value="">Select Job Type</option>
                <option value="full-time" {{ old('type', $job->type) === 'full-time' ? 'selected' : '' }}>Full-Time</option>
                <option value="part-time" {{ old('type', $job->type) === 'part-time' ? 'selected' : '' }}>Part-Time</option>
                <option value="internship" {{ old('type', $job->type) === 'internship' ? 'selected' : '' }}>Internship</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Expiry Date</label>
            <input type="date" name="expiry_date" value="{{ old('expiry_date', $job->expiry_date ? \Carbon\Carbon::parse($job->expiry_date)->format('Y-m-d') : '') }}" class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Job</button>
        </div>
    </form>
</div>
@endsection
