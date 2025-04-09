<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use App\Models\User;

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
}
