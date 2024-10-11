<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeCalculation extends Model
{
    use HasFactory;

    protected $fillable = ['hours', 'minutes', 'user_id', 'task_id'];
}
