<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ActivityWorkers;
use Illuminate\Support\Facades\DB;
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

        $activityWorker = ActivityWorkers::where('activity_id', $id)
            ->where('user_id', $user)
            ->firstOrFail();



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
        // Validasi request
        $request->validate([
            'foto_akhir' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisi_akhir' => 'required|string',
            'biaya' => 'nullable|integer'
        ]);

        // Mendapatkan ID pengguna yang sedang login
        $user = Auth::user()->id;

        // Mendapatkan data activity worker yang sesuai
        $activityWorker = ActivityWorkers::where('activity_id', $id)
            ->where('user_id', $user)
            ->firstOrFail();



        // Menghitung durasi kerja dari waktu mulai hingga sekarang
        $startTime = Carbon::parse($activityWorker->start_time);
        $endTime = Carbon::now();
        $workDuration = $endTime->diff($startTime)->format('%H:%I:%S');

        // Menyiapkan data yang akan diupdate
        $data = [
            'end_time' => $endTime,
            'work_duration' => $workDuration,
            'status' => 'done',
        ];

        // Melakukan update data activity worker
        $activityWorker->update($data);

        // Mendapatkan data activity yang terkait
        $activity = Activity::findOrFail($activityWorker->activity_id);

        // Menyimpan foto akhir jika ada
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

        // Mengupdate data activity
        $activity->kondisi_akhir = $request->kondisi_akhir;
        $activity->status = 'done';
        $activity->ended_at = Carbon::now();

        // Menghitung total durasi kerja untuk semua ActivityWorkers dengan activity_id yang sama
        $totalSeconds = ActivityWorkers::where('activity_id', $activityWorker->activity_id)
            ->sum(DB::raw("TIME_TO_SEC(work_duration)"));

        // Konversi total detik kembali ke format "jam:menit:detik"
        $totalWorkDuration = gmdate('H:i:s', $totalSeconds);

        $activity->waktu_pengerjaan = $totalWorkDuration;

        $activity->save();

        return response()->json(['message' => 'berhasil update activity worker', 'total_work_duration' => $totalWorkDuration, 'data' => $activity]);
    }


    public function getByActivityId($id)
    {
        $activityWorkers = ActivityWorkers::where('activity_id', $id)
            ->join('users', 'activity_workers.user_id', '=', 'users.id')
            ->select('activity_workers.*', 'users.username')
            ->get();

        return response()->json(['message' => 'berhasil mendapatkan activity worker', 'data' => $activityWorkers]);
    }

    public function getActivityWorkerByUser($id)
    {
        $user = Auth::user()->id;
        $activityWorker = ActivityWorkers::where('user_id', $user)->get();

        return response()->json(['message' => 'berhasil menampilkan', 'data' => $activityWorker]);
    }
}
