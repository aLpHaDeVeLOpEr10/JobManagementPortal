<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Job;

class JobApplicationConfirmationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function via($notifiable)
    {
        return ['mail']; // You can also add other channels like 'database', 'broadcast', etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Job Application Confirmation')
            ->greeting('Hello!')
            ->line('You have successfully applied for the job: ' . $this->job->title)
            ->line('Company: ' . $this->job->company)
            ->action('View Job', route('jobs.show', $this->job->id))
            ->line('Thank you for your application!');
    }
}
