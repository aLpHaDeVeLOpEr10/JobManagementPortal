@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Post a Job</h1>
        <form action="{{ route('jobs.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Job Title:</label>
                <input type="text" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter job title">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Job Description:</label>
                <textarea name="description" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter job description"></textarea>
            </div>
            <div class="mb-4">
                <label for="company" class="block text-sm font-medium text-gray-700">Company:</label>
                <input type="text" name="company" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter company name">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500">Post Job</button>
        </form>
    </div>
@endsection
