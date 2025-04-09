<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'company',
        // You can add other fields here if needed
    ];
    public function applications()
{
    return $this->hasMany(JobApplication::class);
}

}
