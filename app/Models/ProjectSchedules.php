<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSchedule extends Model
{
    use HasFactory;

    protected $table = 'project_schedules';

    protected $fillable = [
        'date',
        'project_name',
        'location',
        'description'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
