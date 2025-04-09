<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_job()
    {
        // Create an admin user
        $admin = User::factory()->create(['role' => 'admin']);

        // Act as the admin and submit a job creation request
        $response = $this->actingAs($admin)->post(route('admin.jobs.store'), [
            'title' => 'New Job',
            'company' => 'Company Name',
            'description' => 'Job Description',
            'location' => 'Location',
            'type' => 'full-time',
            'expiry_date' => now()->addDays(30)->toDateString(),
        ]);

        // Assert that the user is redirected and receives a success message
        $response->assertRedirect(route('admin.jobs.index'));
        $response->assertSessionHas('success', 'Job posted successfully!');

        // Assert that the job was created in the database
        $this->assertDatabaseHas('jobs', [
            'title' => 'New Job',
            'company' => 'Company Name',
            'description' => 'Job Description',
            'location' => 'Location',
            'type' => 'full-time',
        ]);
    }

    public function test_non_admin_user_cannot_create_job()
    {
        // Create a regular user
        $user = User::factory()->create(['role' => 'user']);

        // Attempt to create a job
        $response = $this->actingAs($user)->post(route('admin.jobs.store'), [
            'title' => 'Unauthorized Job',
            'company' => 'Unauthorized Company',
            'description' => 'Unauthorized Job Description',
            'location' => 'Unauthorized Location',
            'type' => 'full-time',
            'expiry_date' => now()->addDays(30)->toDateString(),
        ]);

        // Assert that the user is redirected and does not have permission
        $response->assertStatus(403); // Forbidden
    }
}
