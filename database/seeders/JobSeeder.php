<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Carbon\Carbon;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            ['title' => 'Laravel Developer', 'company' => 'Tech Solutions'],
            ['title' => 'Frontend Engineer', 'company' => 'Design Hub'],
            ['title' => 'Full Stack Developer', 'company' => 'CodeWorks'],
            ['title' => 'UI/UX Designer', 'company' => 'Creative Minds'],
            ['title' => 'Backend Developer', 'company' => 'ServerSide Inc.'],
            ['title' => 'React Developer', 'company' => 'JS Experts'],
            ['title' => 'DevOps Engineer', 'company' => 'Cloud Solutions'],
            ['title' => 'QA Tester', 'company' => 'BugSquashers'],
            ['title' => 'Project Manager', 'company' => 'AgileSoft'],
            ['title' => 'Product Owner', 'company' => 'Visionary Products'],
        ];

        foreach ($jobs as $index => $job) {
            Job::create([
                'title' => $job['title'],
                'company' => $job['company'],
                'description' => 'This is a sample description for ' . $job['title'] . '.',
                'expiry_date' => Carbon::now()->addDays(rand(5, 30)),
            ]);
        }
    }
}
