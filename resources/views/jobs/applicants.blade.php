@extends('layouts.app')

@section('content')
    <h1>Applicants for {{ $job->title }}</h1>
    <ul>
        @foreach ($applicants as $application)
            <li>{{ $application->user->name }} - {{ $application->created_at->diffForHumans() }}</li>
        @endforeach
    </ul>

    <form action="{{ route('jobs.sendEmail', $job->id) }}" method="POST">
        @csrf
        <button type="submit">Send Email to All Applicants</button>
    </form>

    <a href="{{ route('jobs.index') }}">Back to Job List</a>
@endsection
