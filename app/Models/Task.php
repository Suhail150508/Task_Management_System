<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
        'due_date',
        'assigned_to',
        'project_id',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
