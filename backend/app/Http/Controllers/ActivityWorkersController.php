<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ActivityWorkers;
use Illuminate\Support\Facades\Auth;

class ActivityWorkersController extends Controller
{
    public function index()
    {
        return ActivityWorkers::all();
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         // 'user_id' => 'required|exists:users,id',
    //         'activity_id' => 'required|exists:activity,id',
    //         // 'start_time' => 'required|date',
    //         // 'end_time' => 'required|date|after_or_equal:start_time',
    //         // 'work_duration' => 'required|string',
    //     ]);

    //     // if ($activity->status == 'masuk') {
    //     //     $activity['status'] = 'process';
    //     //     $activity['process_at'] = Carbon::now();
    //     //     $activity->save();
    //     // }

    //     $user = Auth::user()->id;
    //     $data['user_id'] = $user;
    //     $activity = Activity::findOrFail($data['activity_id']);
    //     $activity['status'] = 'process';
    //     $activity->save();

    //     // dd($data);
    //     $activityWorker = ActivityWorkers::create($request->all());
    //     return response()->json(['message' => 'berhasil menambahkan activity worker', 'data' => $activityWorker]);
    // }

    public function store(Request $request)
    {
        $data = $request->validate([
            'activity_id' => 'required|exists:activity,id',
        ]);

        $user = Auth::user()->id;
        $data['user_id'] = $user;
        $data['start_time'] = Carbon::now();

        $activity = Activity::findOrFail($data['activity_id']);
        $activity->status = 'process';
        $activity->save();

        $activityWorker = ActivityWorkers::create($data);
        return response()->json(['message' => 'berhasil menambahkan activity worker', 'data' => $activityWorker]);
    }


    public function pending_activity(Request $request, $id)
    {
        $data = $request->validate([
            'deskripsi_pending' => 'required|string',
        ]);


        $user = Auth::user()->id;

        $data['status'] = 'pending';
        $data['end_time'] = Carbon::now();

        $activityWorker = ActivityWorkers::findOrFail($id);

        $startTime = Carbon::parse($activityWorker->start_time);
        $endTime = Carbon::now();
        $workDuration = $endTime->diff($startTime)->format('%H:%I:%S');

        $data['work_duration'] = $workDuration;

        if ($activityWorker->user_id != $user) {
            return response()->json(['message' => 'anda tidak berhak mengedit activity worker ini'], 403);
        }

        $activityWorker->update($data);

        $activity = Activity::findOrFail($activityWorker->activity_id);

        $activity['status'] = 'pending';
        $activity->save();

        return response()->json(['message' => 'berhasil pending activity worker', 'data' => $activityWorker]);
    }

    public function done_activity(Request $request, $id)
    {
        $request->validate([
            'foto_akhir' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisi_akhir' => 'required|string',
            'biaya' => 'nullable|integer'
        ]);



        $activityWorker = ActivityWorkers::findOrFail($id);

        $startTime = Carbon::parse($activityWorker->start_time);
        $endTime = Carbon::now();
        $workDuration = $endTime->diff($startTime)->format('%H:%I:%S');

        $data = [
            'end_time' => $endTime,
            'work_duration' => $workDuration,
            'status' => 'done',
        ];

        $activityWorker->update($data);

        $activity = Activity::findOrFail($activityWorker->activity_id);

        if ($request->hasFile('foto_akhir')) {
            try {
                $foto_akhir = $request->file('foto_akhir');
                $nama_foto_akhir = time() . '_akhir.' . $foto_akhir->getClientOriginalExtension();
                $foto_akhir->move(public_path('images'), $nama_foto_akhir);
                $activity->foto_akhir = $nama_foto_akhir;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Gagal mengunggah foto_akhir'], 500);
            }
        }

        $activity->kondisi_akhir = $request->kondisi_akhir;
        $activity->status = 'done';
        $activity->ended_at = Carbon::now();

        // Menghitung total durasi kerja untuk semua ActivityWorkers dengan activity_id yang sama
        $totalDuration = ActivityWorkers::where('activity_id', $activity->id)
            ->get();

        dd($totalDuration);
        // ->reduce(function ($carry, $item) {
        //     $duration = Carbon::createFromFormat('H:i:s', $item->work_duration);
        //     return $carry->add($duration);
        // }, new Carbon('00:00:00'));
        $activity->waktu_pengerjaan = $totalDuration->format('H:i:s');
        $activity->save();

        return response()->json(['message' => 'berhasil update activity worker', 'data' => $activityWorker]);
    }

    // public function done_activity_sementara(Request $request, $id)
    // {
    //     $request->validate([
    //         // 'status' => 'required|in:precoess:done',
    //         'foto_akhir' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'kondisi_akhir' => 'required|string',
    //     ]);

    //     if ($request->hasFile('foto_akhir')) {
    //         try {
    //             $foto_akhir = $request->file('foto_akhir');
    //             $nama_foto_akhir = time() . '_akhir.' . $foto_akhir->getClientOriginalExtension();
    //             $foto_akhir->move(public_path('images'), $nama_foto_akhir);
    //             $activity->foto_akhir = $nama_foto_akhir;
    //         } catch (\Exception $e) {
    //             return response()->json(['error' => 'Failed to upload foto_akhir'], 500);
    //         }
    //     }

    //     $activity->kondisi_akhir = $request->kondisi_akhir;
    //     $activity->status = 'done';
    //     $activity->ended_at = Carbon::now();

    //     $activity->save();

    //     $activityWorker = ActivityWorkers::findOrFail($id);

    //     // Mengambil waktu mulai dari entri activity worker
    //     $startTime = Carbon::parse($activityWorker->start_time);

    //     // Mengambil waktu selesai saat ini
    //     $endTime = Carbon::now();

    //     // Menghitung durasi kerja
    //     $workDuration = $endTime->diff($startTime)->format('%H:%I:%S');

    //     // Menyimpan data baru
    //     $data = [
    //         'end_time' => $endTime,
    //         'work_duration' => $workDuration,
    //     ];

    //     // Perbarui entri activity worker
    //     $activityWorker->update($data);

    //     $activity = Activity::findOrFail($activityWorker->activity_id);

    //     if ($request->hasFile('foto_akhir')) {
    //         try {
    //             $foto_akhir = $request->file('foto_akhir');
    //             $nama_foto_akhir = time() . '_akhir.' . $foto_akhir->getClientOriginalExtension();
    //             $foto_akhir->move(public_path('images'), $nama_foto_akhir);
    //             $activity->foto_akhir = $nama_foto_akhir;
    //         } catch (\Exception $e) {
    //             return response()->json(['error' => 'Failed to upload foto_akhir'], 500);
    //         }
    //     }

    //     $activity->kondisi_akhir = $request->kondisi_akhir;
    //     $activity->status = 'done';
    //     $activity->ended_at = Carbon::now();

    //     $activity->save();

    //     if ($activity->status == "selesai") {
    //         return response()->json(['message'=> "Activity sudah selesai"]);
    //     }

    //     $activityWorker->update($data);

    //     return response()->json(['message'=> "berhasil update activity worker", 'data' => $activityWorker]);
    // }

    public function getByActivityId($id)
    {
        $activityWorker = ActivityWorkers::where('activity_id', $id)->get();

        return response()->json(['message' => 'berhasil mendapatkan activity worker', 'data' => $activityWorker]);
    }
}
