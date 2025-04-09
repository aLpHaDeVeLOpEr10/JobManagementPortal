<?php

namespace App\Http\Controllers;

use App\Mail\JobApplicationConfirmation;
use App\Models\Application;
use App\Models\Job;
use App\Notifications\JobApplicationConfirmationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ApplicationController extends Controller
{
    public function apply(Request $request, Job $job): RedirectResponse
    {
        $request->validate([
            'cover_letter' => 'nullable|string|max:5000',
        ]);
        $existingApplication = Application::where('user_id', auth()->id())
            ->where('job_id', $job->id)
            ->first();
    
        if ($existingApplication) {
            return redirect()->route('dashboard')->with('error', 'You have already applied for this job.');
        }
            Application::create([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
            'cover_letter' => $request->cover_letter,
            'status' => 'Applied',
        ]);
    
        // Send notification to the user
        // auth()->user()->notify(new JobApplicationConfirmationNotification($job));
            return redirect()->route('dashboard')->with('success', 'Application submitted successfully!');
    }
    

    public function myApplications(): View
    {
        $applications = Application::where('user_id', auth()->id())
            ->with('job')
            ->latest()
            ->get();
        return view('jobs.myapplications', compact('applications'));
    }
    public function edit($id): View
    {
        $application = Application::findOrFail($id);
        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $application = Application::findOrFail($id);
        $application->update($request->validate([
            'cover_letter' => 'nullable|string|max:1000',
        ]));

        return redirect()->route('dashboard')->with('success', 'Application updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('dashboard')->with('success', 'Application removed successfully.');
    }
}
