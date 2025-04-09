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
            ['title' => 'Laravel Developer', 'company' => 'Tech Solutions', 'location' => 'New York, NY'],
            ['title' => 'Frontend Engineer', 'company' => 'Design Hub', 'location' => 'San Francisco, CA'],
            ['title' => 'Full Stack Developer', 'company' => 'CodeWorks', 'location' => 'Austin, TX'],
            ['title' => 'UI/UX Designer', 'company' => 'Creative Minds', 'location' => 'Los Angeles, CA'],
            ['title' => 'Backend Developer', 'company' => 'ServerSide Inc.', 'location' => 'Chicago, IL'],
            ['title' => 'React Developer', 'company' => 'JS Experts', 'location' => 'Seattle, WA'],
            ['title' => 'DevOps Engineer', 'company' => 'Cloud Solutions', 'location' => 'Miami, FL'],
            ['title' => 'QA Tester', 'company' => 'BugSquashers', 'location' => 'Boston, MA'],
            ['title' => 'Project Manager', 'company' => 'AgileSoft', 'location' => 'Denver, CO'],
            ['title' => 'Product Owner', 'company' => 'Visionary Products', 'location' => 'Portland, OR'],
        ];

        foreach ($jobs as $index => $job) {
            Job::create([
                'title' => $job['title'],
                'company' => $job['company'],
                'location' => $job['location'],
                'description' => 'This is a sample description for ' . $job['title'] . '.',
                'expiry_date' => Carbon::now()->addDays(rand(5, 30)),
            ]);
        }
    }
}
