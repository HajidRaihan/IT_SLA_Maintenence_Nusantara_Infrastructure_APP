<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use App\Events\ActivityWorkerUpdated;

class ActivityWorkers extends Model
{
    use HasFactory;

    protected $table = 'activity_workers';
    protected $fillable = ['user_id', 'activity_id', 'start_time', 'end_time', 'work_duration', 'status', 'deskripsi_pending'];

    protected static function booted()
    {
        static::created(function ($activityWorker) {
            Event::dispatch(new ActivityWorkerUpdated($activityWorker));
        });

        static::updated(function ($activityWorker) {
            Event::dispatch(new ActivityWorkerUpdated($activityWorker));
        });

        static::deleted(function ($activityWorker) {
            Event::dispatch(new ActivityWorkerUpdated($activityWorker));
        });
    }
}
