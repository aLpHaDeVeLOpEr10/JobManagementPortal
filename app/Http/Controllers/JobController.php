<?php

namespace App\Http\Controllers;

use App\Mail\JobApplied;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class JobController extends Controller
{

    public function dashboard(Request $request): View | RedirectResponse
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        $query = Job::active();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }
        $jobs = $query->latest()->paginate(10);

        return view('jobs.index', compact('jobs'));
    }
    public function create(): View
    {
        return view('jobs.create');
    }
    public function show($id): View
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    public function store(Request $request): RedirectResponse
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
    public function destroy($id): RedirectResponse
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }

    public function showApplicants($id): View
    {
        $job = Job::findOrFail($id);
        $applicants = $job->applications()->with('user')->get(); 
        return view('jobs.applicants', compact('job', 'applicants'));
    }
    public function edit(Job $job): View
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
        ]);

        $job->update($request->only('title', 'description', 'company', 'expiry_date', 'location', 'type'));

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
    }

    public function sendEmailToApplicants($id): RedirectResponse
    {
        $job = Job::findOrFail($id);
        $applicants = $job->applications()->with('user')->get();

        foreach ($applicants as $application) {
            Mail::to($application->user->email)->send(new JobApplied($application->user, $job));
        }

        return redirect()->back()->with('success', 'Emails sent to all applicants!');
    }
}
