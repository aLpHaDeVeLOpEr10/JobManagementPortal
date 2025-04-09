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
        'expiry_date'
        // You can add other fields here if needed
    ];
    public function scopeActive($query)
    {
        return $query->whereDate('expiry_date', '>=', now());
    }
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
