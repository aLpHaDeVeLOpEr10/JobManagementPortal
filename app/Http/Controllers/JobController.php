<?php

namespace App\Http\Controllers;

use App\Mail\JobApplied;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class JobController extends Controller
{

    public function dashboard()
    {
        if (auth()->check()) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }
        $jobs = Job::active()->latest()->get(); // uses the scope we just defined
        return view('jobs.index', compact('jobs'));
    }
    public function create()
    {
        return view('jobs.create');
    }
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'company' => 'required',
            'expiry_date' => 'required|date',
        ]);

        Job::create($request->all());
        return redirect()->route('jobs.index')->with('success', 'Job posted successfully!');
    }
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }

    public function showApplicants($id)
    {
        $job = Job::findOrFail($id);
        $applicants = $job->applications()->with('user')->get(); // Get applicants with user info

        return view('jobs.applicants', compact('job', 'applicants'));
    }
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
        ]);

        $job->update($request->only('title', 'description', 'company', 'expiry_date'));

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
    }

    public function sendEmailToApplicants($id)
    {
        $job = Job::findOrFail($id);
        $applicants = $job->applications()->with('user')->get();

        foreach ($applicants as $application) {
            Mail::to($application->user->email)->send(new JobApplied($application->user, $job));
        }

        return redirect()->back()->with('success', 'Emails sent to all applicants!');
    }
}
