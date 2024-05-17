<?php

namespace App\Listeners;

use App\Events\ActivityWorkerUpdated;
use App\Models\ActivityWorker;
use App\Models\User;

class UpdateUserTotalWaktuPengerjaan
{
    /**
     * Handle the event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function handle($event)
    {
        // Get the user ID from the event data
        $userId = $event->activityWorker->user_id;

        // Calculate the total time from the activityWorker table
        $totalWaktu = ActivityWorker::where('user_id', $userId)->sum('work_duration');

        // Update the total_waktu_pengerjaan in the users table
        User::where('id', $userId)->update(['total_waktu_pengerjaan' => $totalWaktu]);
    }
}
