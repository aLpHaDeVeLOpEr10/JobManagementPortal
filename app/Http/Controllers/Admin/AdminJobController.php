<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'company' => 'required',
        ]);

        Job::create($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job posted successfully!');
    }
}
