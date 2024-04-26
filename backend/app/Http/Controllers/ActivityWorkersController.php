<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ActivityWorkers;
use Illuminate\Support\Facades\Auth;

class ActivityWorkersController extends Controller
{
    public function index() {
        return ActivityWorkers::all();
    }   

    public function store(Request $request)
    {
        $data = $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'activity_id' => 'required|exists:activity,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'work_duration' => 'required|string',
        ]);

        $activity = Activity::findOrFail($data['activity_id']);

        if ($activity->status == 'masuk') {
            $activity['status'] = 'process';
            $activity['process_at'] = Carbon::now();
            $activity->save();
        }

        $activity['status'] = 'process';

        $user = Auth::user()->id;
        $data['user_id'] = $user;
        // dd($data);  
        $activityWorker = ActivityWorkers::create($request->all());
        return response()->json(['message'=> "berhasil menambahkan activity worker", 'data' => $activityWorker]);
    }

  

    public function add_end_time(Request $request, $id)
    {
        $data = $request->validate([
            'end_time' => 'required|date|after_or_equal:start_time',
            'work_duration' => 'required|string',
        ]);

        $activityWorker = ActivityWorkers::findOrFail($id);

        $activity = Activity::findOrFail($activityWorker->activity_id);

        if ($activity->status == "selesai") {
            return response()->json(['message'=> "Activity sudah selesai"]);
        }
        

        $activityWorker->update($data);

        return response()->json(['message'=> "berhasil update activity worker", 'data' => $activityWorker]);
    }

    public function getByActivityId(Request $request, $id)
    {

        $activityWorker = ActivityWorkers::where('activity_id', $id)->get();

        return response()->json(['message'=> "berhasil update activity worker", 'data' => $activityWorker]);
    }
   
}
