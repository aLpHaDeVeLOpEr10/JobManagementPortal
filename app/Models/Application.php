<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'job_id',
        'user_id',
        'cover_letter',
        'status',
    ];

    // Define relationships

    // Relationship with Job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
