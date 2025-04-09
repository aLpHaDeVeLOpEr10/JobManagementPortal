<?php
namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_apply_for_job()
    {
        // Create a user and a job
        $user = User::factory()->create();
        $job = Job::factory()->create();

        // Act as the user and submit a job application
        $response = $this->actingAs($user)->post(route('jobs.apply', $job->id), [
            'cover_letter' => 'This is my cover letter.',
        ]);

        // Assert that the user is redirected and receives a success message
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Application submitted successfully!');

        // Assert that the application was created in the database
        $this->assertDatabaseHas('applications', [
            'user_id' => $user->id,
            'job_id' => $job->id,
            'cover_letter' => 'This is my cover letter.',
            'status' => 'Applied',
        ]);
    }

    public function test_user_cannot_apply_for_same_job_twice()
    {
        // Create a user and a job
        $user = User::factory()->create();
        $job = Job::factory()->create();

        // First application
        $this->actingAs($user)->post(route('jobs.apply', $job->id), [
            'cover_letter' => 'This is my cover letter.',
        ]);

        // Attempt to apply again
        $response = $this->actingAs($user)->post(route('jobs.apply', $job->id), [
            'cover_letter' => 'Trying to apply again.',
        ]);

        // Assert that the user is redirected and receives an error message
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error', 'You have already applied for this job.');
    }
}
