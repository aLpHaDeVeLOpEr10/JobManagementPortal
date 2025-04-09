<?php

namespace App\Http\Controllers;

use App\Mail\JobApplicationConfirmation;
use App\Models\Application;
use App\Models\Job;
use App\Notifications\JobApplicationConfirmationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function apply(Request $request, Job $job)
    {
        // Validate the cover letter if provided
        $request->validate([
            'cover_letter' => 'nullable|string|max:5000',
        ]);
    
        // Check if the user has already applied for the job
        $existingApplication = Application::where('user_id', auth()->id())
            ->where('job_id', $job->id)
            ->first();
    
        if ($existingApplication) {
            return redirect()->route('dashboard')->with('error', 'You have already applied for this job.');
        }
    
        // Create the application
        Application::create([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
            'cover_letter' => $request->cover_letter,
            'status' => 'Applied',
        ]);
    
        // Send notification to the user
        // auth()->user()->notify(new JobApplicationConfirmationNotification($job));
    
        // Redirect with success message
        return redirect()->route('dashboard')->with('success', 'Application submitted successfully!');
    }
    

    public function myApplications()
    {
        // Get applications for the logged-in user
        $applications = Application::where('user_id', auth()->id())
            ->with('job')
            ->latest()
            ->get();
        return view('jobs.myapplications', compact('applications'));
    }
    public function edit($id)
    {
        $application = Application::findOrFail($id);
        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->update($request->validate([
            'cover_letter' => 'nullable|string|max:1000',
        ]));

        return redirect()->route('dashboard')->with('success', 'Application updated successfully.');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('dashboard')->with('success', 'Application removed successfully.');
    }
}
