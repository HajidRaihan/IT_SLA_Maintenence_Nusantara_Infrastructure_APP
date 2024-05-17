<?php

namespace App\Events;

use App\Models\ActivityWorkers;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityWorkerUpdated
{
    use Dispatchable, SerializesModels;

    public $activityWorker;

    public function __construct(ActivityWorkers $activityWorker)
    {
        $this->activityWorker = $activityWorker;
    }
}
