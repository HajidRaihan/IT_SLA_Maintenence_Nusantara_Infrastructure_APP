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

        $activityWorker = ActivityWorkers::where('activity_id', $id)->where('user_id', $user)->where('status', 'process')->firstOrFail();

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
        $user = Auth::user();

        $userId = $user->id;

        // Mendapatkan data activity worker yang sesuai
        $activityWorker = ActivityWorkers::where('activity_id', $id)
            ->where('user_id', $userId)
            ->latest()
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

    // public function done_activity(Request $request, $id)
    // {
    //     // Validasi request
    //     $request->validate([
    //         'foto_akhir' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'kondisi_akhir' => 'required|string',
    //         'biaya' => 'nullable|integer',
    //     ]);

    //     // Mendapatkan ID pengguna yang sedang login dan rolenya
    //     $user = Auth::user();
    //     $userId = $user->id;
    //     $userRole = $user->role;

    //     // Mendapatkan data activity worker yang sesuai
    //     $activityWorker = ActivityWorkers::where('activity_id', $id)->where('user_id', $userId)->first();

    //     // Menghitung durasi kerja dari waktu mulai hingga sekarang

    //     // Jika user adalah admin
    //     if ($userRole === 'admin') {
    //         if (!$activityWorker) {
    //             $newActivityWorker = new ActivityWorkers();
    //             $newActivityWorker->activity_id = $id;
    //             $newActivityWorker->user_id = $userId;
    //             $newActivityWorker->start_time = Carbon::now();
    //             $newActivityWorker->end_time = null;
    //             $newActivityWorker->work_duration = null;
    //             $newActivityWorker->status = 'done';
    //             $newActivityWorker->save();

    //             // Mengubah status activity menjadi 'done'
    //             $activity = Activity::findOrFail($id);
    //             $activity->status = 'done';
    //         } else {
    //         }
    //         # code...

    //         // return response()->json($activityWorker);
    //         // Membuat activity worker baru dengan status 'done'

    //         // $activity->ended_at = $;
    //     }
    //     $startTime = Carbon::parse($activityWorker->start_time);
    //     $endTime = Carbon::now();
    //     $workDuration = $endTime->diff($startTime)->format('%H:%I:%S');

    //     // Menyiapkan data yang akan diupdate
    //     $data = [
    //         'end_time' => $endTime,
    //         'work_duration' => $workDuration,
    //         'status' => 'done',
    //     ];

    //     // Menyimpan foto akhir jika ada
    //     if ($request->hasFile('foto_akhir')) {
    //         try {
    //             // Mendapatkan objek aktivitas
    //             $activity = Activity::findOrFail($id);
                
    //             $foto_akhir = $request->file('foto_akhir');
    //             $nama_foto_akhir = time() . '_akhir.' . $foto_akhir->getClientOriginalExtension();
    //             $foto_akhir->move(public_path('images'), $nama_foto_akhir);
    //             $activity->foto_akhir = $nama_foto_akhir;
    //             $activity->save(); // Simpan aktivitas setelah mengatur foto akhir
    //         } catch (\Exception $e) {
    //             return response()->json(['error' => 'Gagal mengunggah foto_akhir'], 500);
    //         }
    //     }

    //     // Mengupdate data activity
    //     $activity->kondisi_akhir = $request->kondisi_akhir;

    //     // Menghitung total durasi kerja untuk semua ActivityWorkers dengan activity_id yang sama
    //     $totalSeconds = ActivityWorkers::where('activity_id', $id)->sum(DB::raw('TIME_TO_SEC(work_duration)'));

    //     // Konversi total detik kembali ke format "jam:menit:detik"
    //     $totalWorkDuration = gmdate('H:i:s', $totalSeconds);
    //     $activity->save();

    //     return response()->json(['message' => 'Berhasil update activity worker', 'total_work_duration' => $totalWorkDuration, 'data' => $activity]);
    // }    

    function done_activity_by_admin(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'kondisi_akhir' => 'required|string',
                'biaya' => 'nullable|integer',
            ]);
            $user = Auth::user();
            $userId = $user->id;

            if ($user->role != 'admin') {
                throw new \Exception('anda bukan admin');
            }

            $activityWorker = ActivityWorkers::where('activity_id', $id)->where('user_id', $userId)->first();

            $activity = Activity::findOrFail($id);
            $activity->kondisi_akhir = $data['kondisi_akhir'];
            $activity->biaya = $data['biaya'];
            $activity->status = 'done';
            $activity->ended_at = Carbon::now();

            $totalSeconds = ActivityWorkers::where('activity_id', $activityWorker->activity_id)->sum(DB::raw('TIME_TO_SEC(work_duration)'));

            // Konversi total detik kembali ke format "jam:menit:detik"
            $totalWorkDuration = gmdate('H:i:s', $totalSeconds);

            $activity->waktu_pengerjaan = $totalWorkDuration;
            $activity->save();

            if ($activityWorker->status == 'process') {
                $activityWorker->status = 'done';

                $activityWorker->save();

                return response()->json(['message' => 'sukses done activtiy by admin', 'data' => $activityWorker]);
            }

            if ($activityWorker->status == 'done') {
                return response()->json(['message' => 'anda sudah menambahkan activity worker done by admin', 'data' => $activityWorker]);
            }

            if (!$activityWorker) {
                $newActivityWorker = new ActivityWorkers();
                $newActivityWorker->activity_id = $id;
                $newActivityWorker->user_id = $userId;
                $newActivityWorker->start_time = Carbon::now();
                $newActivityWorker->end_time = null;
                $newActivityWorker->work_duration = null;
                $newActivityWorker->status = 'done';
                $newActivityWorker->save();

                return response()->json(['message' => 'berhasil menambahkan activity worker done by admin', 'data' => $newActivityWorker]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getByActivityId($id)
    {
        $activityWorkers = ActivityWorkers::where('activity_id', $id)->join('users', 'activity_workers.user_id', '=', 'users.id')->select('activity_workers.*', 'users.username')->get();

        return response()->json(['message' => 'berhasil mendapatkan activity worker ', 'data' => $activityWorkers]);
    }

    public function getActivityWorkerByUser($id)
    {
        $year = request()->query('year');
        $month = request()->query('month');
    
        $query = ActivityWorkers::where('user_id', $id);
    
        if ($year) {
            $query->whereYear('created_at', $year);
        }
    
        if ($month) {
            $query->whereMonth('created_at', $month);
        }
    
        $activityWorker = $query->get();
    
        return response()->json(['message' => 'berhasil menampilkan data', 'data' => $activityWorker]);
    }

    // public function grafikWaktuPengerjaan($year) {
    //     // Mendapatkan total durasi kerja (dalam jam) per bulan untuk setiap user dalam satu tahun
    //     $workDurations = DB::table('activity_workers')
    //         ->select(
    //             DB::raw('user_id'),
    //             DB::raw('MONTH(created_at) as month'),
    //             DB::raw('SUM(work_duration) as total_duration')
    //         )
    //         ->whereYear('created_at', $year)
    //         ->groupBy('user_id', DB::raw('MONTH(created_at)'))
    //         ->get();

        
    //         return response()->json($workDurations, 200);
    
    //     // Menyusun data ke dalam format yang sesuai untuk grafik
    //     $result = [];
    //     foreach ($workDurations as $data) {
    //         $result[$data->user_id][$data->month] = $data->total_duration;
    //     }
        
    
    //     // Menyusun data dalam bentuk yang lebih mudah untuk digunakan oleh frontend
    //     $formattedData = [];
    //     foreach ($result as $userId => $durations) {
    //         $formattedData[] = [
    //             'user_id' => $userId,
    //             'durations' => array_values(array_replace(array_fill(1, 12, 0), $durations))
    //         ];
    //     }
    
    //     return response()->json(['message' => 'Data berhasil diambil', 'data' => $formattedData]);
    // }

    public function grafikWaktuPengerjaan($year) {
        $workDurations = DB::table('activity_workers')
            ->select(
                DB::raw('user_id'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('work_duration')
            )
            ->whereYear('created_at', $year)
            ->get();
    
        // Menyusun data ke dalam format yang sesuai untuk grafik
        $result = [];
        foreach ($workDurations as $data) {
            $userId = $data->user_id;
            $month = $data->month;
            $durationInSeconds = $this->convertToSeconds($data->work_duration);
    
            if (!isset($result[$userId][$month])) {
                $result[$userId][$month] = 0;
            }
    
            $result[$userId][$month] += $durationInSeconds;
        }
    
        // Konversi kembali hasil total durasi dari detik ke format HH:MM:SS
        $formattedData = [];
        foreach ($result as $userId => $durations) {
            $formattedDurations = [];
            for ($month = 1; $month <= 12; $month++) {
                $totalSeconds = $durations[$month] ?? 0;
                $formattedDurations[$month] = $this->formatDuration($totalSeconds);
            }
            $formattedData[] = [
                'user_id' => $userId,
                'durations' => array_values($formattedDurations)
            ];
        }
    
        return response()->json(['message' => 'Data berhasil diambil', 'data' => $formattedData]);
    }


    public function grafikWaktuPengerjaanByUser($id,$year) {
        $workDurations = DB::table('activity_workers')
            ->select(
                DB::raw('user_id'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('work_duration')
            )
            ->whereYear('created_at', $year)
            ->where('user_id', $id)
            ->get();
    
        // Menyusun data ke dalam format yang sesuai untuk grafik
        $result = [];
        foreach ($workDurations as $data) {
            $userId = $data->user_id;
            $month = $data->month;
            $durationInSeconds = $this->convertToSeconds($data->work_duration);
    
            if (!isset($result[$userId][$month])) {
                $result[$userId][$month] = 0;
            }
    
            $result[$userId][$month] += $durationInSeconds;
        }
    
        // Konversi kembali hasil total durasi dari detik ke format HH:MM:SS
        $formattedData = [];
        foreach ($result as $userId => $durations) {
            $formattedDurations = [];
            for ($month = 1; $month <= 12; $month++) {
                $totalSeconds = $durations[$month] ?? 0;
                $formattedDurations[$month] = $this->formatDuration($totalSeconds);
            }
            $formattedData[] = [
                'user_id' => $userId,
                'durations' => array_values($formattedDurations)
            ];
        }
    
        return response()->json(['message' => 'Data berhasil diambil', 'data' => $formattedData]);
    }
    
    
    
    
    private function formatDuration($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
    
    
    
    private function convertToSeconds($time) {
        // Pastikan format waktu adalah HH:MM:SS
        if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $time)) {
            list($hours, $minutes, $seconds) = explode(':', $time);
            return $hours * 3600 + $minutes * 60 + $seconds;
        } else {
            // Jika format tidak valid, kembalikan 0 sebagai fallback
            return 0;
        }
    }
    
    
    
}
