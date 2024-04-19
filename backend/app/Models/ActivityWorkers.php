<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityWorkers extends Model
{
    use HasFactory;
    protected $table = 'activity_workers';
    protected $fillable = ['user_id', 'activity_id', 'start_time', 'end_time', 'work_duration'];

}
