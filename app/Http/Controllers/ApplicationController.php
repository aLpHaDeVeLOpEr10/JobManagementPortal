<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function apply(Request $request, Job $job)
    {
        $request->validate([
            'cover_letter' => 'nullable|string|max:1000',
        ]);

        Application::create([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
            'cover_letter' => $request->cover_letter,
            'status' => 'Applied',
        ]);

        return redirect()->route('jobs.index')->with('success', 'Application submitted successfully!');
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
