<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Mail\JobApplied;
use App\Models\Job;

class JobApplicationController extends Controller
{

    public function apply(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId); // Get the job details
        $application = new JobApplication();
        $application->job_id = $jobId;
        $application->user_id = auth()->id();
        $application->save();
    
        // Send email notification
        \Mail::to(auth()->user()->email)->send(new JobApplied(auth()->user(), $job));
    
        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
