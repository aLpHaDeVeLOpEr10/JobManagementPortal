<?php

namespace App\Http\Controllers;

use App\Mail\BulkEmailToApplicants;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jobCount = Job::count();
        $applicationCount = Application::count();
        $userCount = User::where('role', 'user')->count();
        $latestJobs = Job::latest()->take(5)->get();
        $latestApplications = Application::latest()->with('user', 'job')->take(5)->get();

        return view('admin.dashboard', compact(
            'jobCount',
            'applicationCount',
            'userCount',
            'latestJobs',
            'latestApplications'
        ));
    }

    public function jobs()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function applications()
    {
        $applications = Application::with('user', 'job')->latest()->paginate(10);
        return view('admin.applications.index', compact('applications'));
    }

    public function users()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function sendBulkEmail(Request $request, Job $job)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        $applications = Application::where('job_id', $job->id)->with('user')->get();
    
        foreach ($applications as $application) {
            if ($application->user && $application->user->email) {
                Mail::to($application->user->email)->send(
                    new BulkEmailToApplicants($request->subject, $request->message)
                );
            }
        }
    
        return back()->with('success', 'Bulk email sent to all applicants!');
    }
}
