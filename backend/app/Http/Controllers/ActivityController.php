<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\JenisHardware;
use Illuminate\Support\Carbon;
use App\Models\ActivityWorkers;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function addactivity_toll(Request $request)
    {
        $data = $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'company' => 'required|in:man,mmn',
            // 'tanggal' => 'required|date',
            'kategori_activity' => 'required|in:toll,nontoll',
            'jenis_hardware' => 'nullable|string',
            'standart_aplikasi' => 'nullable|string',
            'uraian_hardware' => 'nullable|string',
            'uraian_aplikasi' => 'nullable|string',
            'aplikasi_it_tol' => 'nullable|string',
            'uraian_it_tol' => 'nullable|string',
            'catatan' => 'nullable|string',
            'shift' => 'required|string',
            'lokasi_id' => 'required|exists:lokasi,id',
            'kategori_id' => 'required|exists:kategori,id',
            'kondisi_akhir' => 'nullable|string',
            // 'biaya' => 'nullable|integer',
            'foto_awal' => 'required|image|mimes:jpeg,png,jpg,gif',
            'foto_akhir' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            // 'status' => 'required|in:process,done',
        ]);

        $user = Auth::user()->id;
        $data['user_id'] = $user;
        // $data['status'] = 'process';

        // Simpan foto_awal
        if ($request->hasFile('foto_awal')) {
            // Penanganan kesalahan saat mengunggah file gambar
            try {
                $foto_awal = $request->file('foto_awal');
                $nama_foto_awal = time() . '_awal.' . $foto_awal->getClientOriginalExtension();
                $foto_awal->move(public_path('images'), $nama_foto_awal);
                $data['foto_awal'] = $nama_foto_awal;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to upload foto_awal'], 500);
            }
        }

        // Simpan foto_akhir
        if ($request->hasFile('foto_akhir')) {
            // Penanganan kesalahan saat mengunggah file gambar
            try {
                $foto_akhir = $request->file('foto_akhir');
                $nama_foto_akhir = time() . '_akhir.' . $foto_akhir->getClientOriginalExtension();
                $foto_akhir->move(public_path('images'), $nama_foto_akhir);
                $data['foto_akhir'] = $nama_foto_akhir;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to upload foto_akhir'], 500);
            }
        }

        if ($request->jenis_hardware) {
            $jenisHardwareList = explode(', ', $data['jenis_hardware']);

            foreach ($jenisHardwareList as $jenisHardwareName) {
                // Ambil jenis hardware yang terkait dengan aktivitas
                $jenisHardware = JenisHardware::where('nama_hardware', $jenisHardwareName)->first();

                if ($jenisHardware) {
                    // Jika jenis hardware ditemukan, tambahkan 1 ke jumlah kerusakan
                    try {
                        $jenisHardware->increment('jumlah_kerusakan');
                    } catch (\Exception $e) {
                        // Tangani kesalahan jika gagal menambahkan jumlah kerusakan
                        return response()->json(['error' => 'Failed to increment damage count'], 500);
                    }
                } else {
                    // Tangani jika jenis hardware tidak ditemukan
                    return response()->json(['error' => 'Hardware type not found: ' . $jenisHardwareName], 404);
                }
            }
        }

        $activity = Activity::create($data);

        $activityWorkerData = [
            'user_id' => $user,
            'activity_id' => $activity->id,
            'status' => 'process', // sesuaikan dengan nilai default yang Anda inginkan
            'start_time' => Carbon::now(),
            // Isi kolom lain sesuai kebutuhan, seperti 'start_time', 'end_time', 'work_duration', dst.
        ];

        try {
            $activityWorker = ActivityWorkers::create($activityWorkerData);
        } catch (\Exception $e) {
            // Penanganan kesalahan jika gagal membuat entri baru dalam tabel activity_workers
            return response()->json(['error' => 'Failed to create activity worker entry'], 500);
        }

        $activity = Activity::with(['user', 'kategori', 'lokasi']) // Eager loading untuk memuat relasi user, kategori, dan lokasi
            ->where('id', $activity->id)
            ->first();

        // Pastikan untuk menyesuaikan struktur respons sesuai kebutuhan Anda
        $responseData = [
            'id' => $activity->id,
            'nama_user' => $activity->user->username,
            'company' => $activity->company,
            'jenis_hardware' => $activity->jenis_hardware,
            'standart_aplikasi' => $activity->standart_aplikasi,
            'uraian_hardware' => $activity->uraian_hardware,
            'uraian_aplikasi' => $activity->uraian_aplikasi,
            'aplikasi_it_tol' => $activity->aplikasi_it_tol,
            'uraian_it_tol' => $activity->uraian_it_tol,
            'catatan' => $activity->catatan,
            'shift' => $activity->shift,
            'kondisi_akhir' => $activity->kondisi_akhir,
            'biaya' => $activity->biaya,
            'foto_awal' => $activity->foto_awal,
            'foto_akhir' => $activity->foto_akhir,
            'status' => $activity->status,
            'ended_at' => $activity->ended_at,
            'created_at' => $activity->created_at,
            'updated_at' => $activity->updated_at,
            'category_deadline' => $activity->kategori->deadline_duration,
            'category_name' => $activity->kategori->nama_kategori,
            'location_name' => $activity->lokasi->nama_lokasi,
        ];

        return response()->json(['message' => 'Add Activity success', 'data' => $responseData]);

        // return response()->json(['message' => 'Add Activity success', 'data' => $activity]);
    }

    public function getactivity_toll(Request $request)
    {
        $filters = $request->only(['company', 'status', 'lokasi_id', 'kategori_id', 'startYear', 'endYear']);

        $activities = Activity::query()
            ->select('activity.id', 'users.username as nama_user', 'activity.waktu_pengerjaan', 'activity.kategori_activity', 'activity.company', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.foto_awal', 'activity.foto_akhir', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.deadline_duration as category_deadline', 'kategori.nama_kategori as category_name', 'lokasi.nama_lokasi as location_name')
            ->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')
            ->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')
            ->leftJoin('users', 'activity.user_id', '=', 'users.id')
            ->when(isset($filters['company']), function ($query) use ($filters) {
                $query->where('activity.company', $filters['company']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('activity.status', $filters['status']);
            })
            ->when(isset($filters['lokasi_id']), function ($query) use ($filters) {
                $query->where('activity.lokasi_id', $filters['lokasi_id']);
            })
            ->when(isset($filters['kategori_id']), function ($query) use ($filters) {
                $query->where('activity.kategori_id', $filters['kategori_id']);
            })
            ->when(isset($filters['startYear']) && isset($filters['endYear']), function ($query) use ($filters) {
                $query->whereBetween(DB::raw('YEAR(activity.created_at)'), [$filters['startYear'], $filters['endYear']]);
            })
            ->paginate(10);

        return response()->json(['data' => $activities]);
    }

    public function getAllActivityTol(Request $request)
    {
        $startYear = $request->query('startYear');
        $endYear = $request->query('endYear');

        $activitiesQuery = Activity::with(['user', 'kategori', 'lokasi']);

        if ($startYear && $endYear) {
            $activitiesQuery->whereBetween(DB::raw('YEAR(created_at)'), [$startYear, $endYear]);
        }

        $activities = $activitiesQuery->get();

        $responseData = [];
        foreach ($activities as $activity) {
            $responseData[] = [
                'id' => $activity->id,
                'user' => $activity->user ? $activity->user->username : null,
                'company' => $activity->company,
                'kategori_activity' => $activity->kategori_activity,
                'jenis_hardware' => $activity->jenis_hardware,
                'standart_aplikasi' => $activity->standart_aplikasi,
                'uraian_hardware' => $activity->uraian_hardware,
                'uraian_aplikasi' => $activity->uraian_aplikasi,
                'aplikasi_it_tol' => $activity->aplikasi_it_tol,
                'uraian_it_tol' => $activity->uraian_it_tol,
                'catatan' => $activity->catatan,
                'shift' => $activity->shift,
                'kondisi_akhir' => $activity->kondisi_akhir,
                'biaya' => $activity->biaya,
                'foto_awal' => $activity->foto_awal,
                'foto_akhir' => $activity->foto_akhir,
                'status' => $activity->status,
                'waktu_pengerjaan' => $activity->waktu_pengerjaan,
                'ended_at' => $activity->ended_at,
                'created_at' => $activity->created_at,
                'updated_at' => $activity->updated_at,
                'category_deadline' => $activity->kategori ? $activity->kategori->deadline_duration : null,
                'category' => $activity->kategori ? $activity->kategori->nama_kategori : null,
                'location' => $activity->lokasi ? $activity->lokasi->nama_lokasi : null,
            ];
        }

        return response()->json(['message' => 'Data activity berhasil diperoleh', 'data' => $responseData]);
    }

    public function getactivity_toll_id(Request $request, $id)
    {
        $filters = $request->only(['company', 'status', 'location', 'category']);

        $activity = Activity::query()->select('activity.id', 'activity.kategori_activity', 'users.username as nama_user', 'activity.waktu_pengerjaan', 'activity.kategori_activity', 'activity.company', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.foto_awal', 'activity.foto_akhir', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.nama_kategori as category_name', 'kategori.deadline_duration as category_deadline', 'lokasi.nama_lokasi as location_name')->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')->leftJoin('users', 'activity.user_id', '=', 'users.id')->where('activity.id', $id);

        if (!empty($filters)) {
            if (isset($filters['company'])) {
                $activity->where('company', $filters['company']);
            }
            if (isset($filters['status'])) {
                $activity->where('status', $filters['status']);
            }
            if (isset($filters['location'])) {
                $activity->where('activity.lokasi_id', $filters['location']);
            }
            if (isset($filters['category'])) {
                $activity->where('activity.kategori_id', $filters['category']);
            }
            if (isset($filters['tanggal'])) {
                $activity->where('tanggal', $filters['tanggal']);
            }
        }

        $activity = $activity->paginate(5);

        return response()->json(['data' => $activity]);
    }

    public function getactivity_toll_by_user(Request $request = null, $userId)
    {
        $filters = $request->only(['lokasi_id']);

        $activities = Activity::query()
            ->select('activity.id', 'users.username as nama_user', 'activity.kategori_activity', 'activity.company', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.foto_awal', 'activity.foto_akhir', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.deadline_duration as category_deadline', 'kategori.nama_kategori as category_name', 'lokasi.nama_lokasi as location_name', 'waktu_pengerjaan')
            ->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')
            ->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')
            ->leftJoin('users', 'activity.user_id', '=', 'users.id')
            ->where('activity.user_id', $userId)
            ->when(isset($filters['lokasi_id']), function ($query) use ($filters) {
                $query->where('activity.lokasi_id', $filters['lokasi_id']);
            })
            ->paginate(5);

        // Mengembalikan data dalam format JSON
        return response()->json(['message' => 'Activities retrieved successfully.', 'data' => $activities], 200);
    }

    public function edit_activity(Request $request, $id)
    {
        $data = $request->validate([
            'company' => 'required|in:jtse,mmn',
            // 'created_at' => 'required|date',
            'jenis_hardware' => 'required|string',
            'standart_aplikasi' => 'required|string',
            'uraian_hardware' => 'required|string',
            'uraian_aplikasi' => 'required|string',
            'aplikasi_it_tol' => 'required|string',
            'uraian_it_tol' => 'required|string',
            'catatan' => 'required|string',
            'shift' => 'required|string',
            'lokasi_id' => 'required|exists:lokasi,id',
            'biaya' => 'required|integer',
            'kondisi_akhir' => 'nullable|string',
            'foto_awal' => 'required|image|mimes:jpeg,png,jpg,gif',
            'foto_akhir' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:process,done',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($data);

        return response()->json(['data' => $activity]);
    }

    public function delete_activity($id)
    {
        $activity = Activity::findOrFail($id);

        // Delete associated activity workers
        ActivityWorkers::where('activity_id', $activity->id)->delete();

        // Now delete the activity
        $activity->delete();

        return response()->json(['message' => 'Activity deleted successfully']);
    }

    public function addactivity_nontoll(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'company' => 'required|in:jtse,mmn',
            // 'tanggal' => 'required|date',
            'jenis_hardware' => 'required|string',
            'standart_aplikasi' => 'required|string',
            'uraian_hardware' => 'required|string',
            'uraian_aplikasi' => 'required|string',
            'aplikasi_it_tol' => 'required|string',
            'uraian_it_tol' => 'required|string',
            'catatan' => 'required|string',
            'shift' => 'required|string',
            'lokasi_id' => 'required|exists:lokasi,id',
            'kategori_id' => 'required|exists:kategori,id',
            'kondisi_akhir' => 'nullable|string',
            'biaya' => 'required|integer',
            'foto_awal' => 'required|image|mimes:jpeg,png,jpg,gif',
            'foto_akhir' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:process,done',
        ]);

        // Simpan foto_awal
        if ($request->hasFile('foto_awal')) {
            // Penanganan kesalahan saat mengunggah file gambar
            try {
                $foto_awal = $request->file('foto_awal');
                $nama_foto_awal = time() . '_awal.' . $foto_awal->getClientOriginalExtension();
                $foto_awal->move(public_path('images'), $nama_foto_awal);
                $data['foto_awal'] = $nama_foto_awal;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to upload foto_awal'], 500);
            }
        }

        // Simpan foto_akhir
        if ($request->hasFile('foto_akhir')) {
            // Penanganan kesalahan saat mengunggah file gambar
            try {
                $foto_akhir = $request->file('foto_akhir');
                $nama_foto_akhir = time() . '_akhir.' . $foto_akhir->getClientOriginalExtension();
                $foto_akhir->move(public_path('images'), $nama_foto_akhir);
                $data['foto_akhir'] = $nama_foto_akhir;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to upload foto_akhir'], 500);
            }
        }
        $activity = Activity::create($data);
        return response()->json(['data' => $activity]);
    }

    public function getactivity_nontoll(Request $request)
    {
        $filters = $request->only(['company', 'status', 'location', 'category', 'tanggal']);

        // Get activities based on filters and join with the category and lokasi tables
        $activities = Activity::query()
            ->select('activity.id', 'users.username as nama_user ', 'activity.company', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.foto_awal', 'activity.foto_akhir', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.nama_kategori as category_name', 'lokasi.nama_lokasi as location_name')
            ->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')
            ->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')
            ->leftJoin('users', 'activity.user_id', '=', 'users.id')
            ->when(isset($filters['company']), function ($query) use ($filters) {
                $query->where('company', $filters['company']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['location']), function ($query) use ($filters) {
                $query->where('activity.lokasi_id', $filters['location']);
            })
            ->when(isset($filters['category']), function ($query) use ($filters) {
                $query->where('activity.kategori_id', $filters['category']);
            })
            ->when(isset($filters['created_at']), function ($query) use ($filters) {
                $query->whereDate('activity.created_at', $filters['created_at']);
            })
            ->paginate(10);

        return response()->json(['data' => $activities]);
    }

    public function getactivity_nontoll_id(Request $request, $id)
    {
        $filters = $request->only(['company', 'status', 'location', 'category']);

        $activity = Activity::query()->select('activity.id', 'users.username as nama_user', 'activity.company', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.foto_awal', 'activity.foto_akhir', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.nama_kategori as category_name', 'kategori.deadline_duration as category_deadline', 'lokasi.nama_lokasi as location_name')->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')->leftJoin('users', 'activity.user_id', '=', 'users.id')->where('activity.id', $id);

        if (!empty($filters)) {
            if (isset($filters['company'])) {
                $activity->where('company', $filters['company']);
            }
            if (isset($filters['status'])) {
                $activity->where('status', $filters['status']);
            }
            if (isset($filters['location'])) {
                $activity->where('activity.lokasi_id', $filters['location']);
            }
            if (isset($filters['category'])) {
                $activity->where('activity.kategori_id', $filters['category']);
            }
            if (isset($filters['created_at'])) {
                $activity->where('activity.created_at', $filters['created_at']);
            }
        }

        $activity = $activity->paginate(5);

        return response()->json(['data' => $activity]);
    }

    // public function getactivity_nontoll_by_user($userId)
    // {
    //     $activity = Activity::where('user_id', $userId)->paginate(5);
    //     return response()->json(['data' => $activity]);
    // }

    public function edit_activitynontoll(Request $request, $id)
    {
        $data = $request->validate([
            'company' => 'required|in:jtse,mmn',
            // 'created_at' => 'required|date',
            'kategori_activity' => 'required|string',
            'jenis_hardware' => 'required|string',
            'standart_aplikasi' => 'required|string',
            'uraian_hardware' => 'required|string',
            'uraian_aplikasi' => 'required|string',
            'aplikasi_it_tol' => 'required|string',
            'uraian_it_tol' => 'required|string',
            'catatan' => 'required|string',
            'shift' => 'required|string',
            'lokasi_id' => 'required|exists:lokasi,id',
            'biaya' => 'required|integer',
            'kondisi_akhir' => 'nullable|string',
            'foto_awal' => 'required|image|mimes:jpeg,png,jpg,gif',
            'foto_akhir' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:process,done',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($data);

        return response()->json(['data' => $activity]);
    }

    public function delete_activitynontoll($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return response()->json(['message' => 'Activity deleted successfully']);
    }

    // public function changeStatus(Request $request, $id)
    // {
    //     // Validasi permintaan
    //     $request->validate([
    //         'status' => 'required|in:process,done',
    //         'foto_akhir' => 'required_if:status,done|image|mimes:jpeg,png,jpg,gif',
    //         'kondisi_akhir' => 'required_if:status,done|string',
    //     ]);

    //     $activity = Activity::findOrFail($id);

    //     // Jika status yang diminta adalah "done"
    //     if ($request->status === 'done') {
    //         // Periksa apakah ada file foto_akhir yang diunggah
    //         if (!$request->hasFile('foto_akhir')) {
    //             return response()->json(['error' => 'Please upload foto akhir before changing the status to done'], 400);
    //         }

    //         // Simpan foto_akhir
    //         try {
    //             $foto_akhir = $request->file('foto_akhir');
    //             $nama_foto_akhir = time() . '_akhir.' . $foto_akhir->getClientOriginalExtension();
    //             $foto_akhir->move(public_path('images'), $nama_foto_akhir);
    //             $activity->foto_akhir = $nama_foto_akhir;
    //         } catch (\Exception $e) {
    //             return response()->json(['error' => 'Failed to upload foto_akhir'], 500);
    //         }

    //         $activity->kondisi_akhir = $request->kondisi_akhir;
    //     }

    //     // Update status aktivitas
    //     $activity->status = $request->status;
    //     $activity->save();

    //     return response()->json(['data' => $activity]);
    // }

    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            // 'status' => 'required|in:precoess:done',
            'foto_akhir' => 'required|image|mimes:jpeg,png,jpg,gif',
            'kondisi_akhir' => 'required|string',
        ]);

        $activity = Activity::findOrFail($id);

        if ($request->hasFile('foto_akhir')) {
            try {
                $foto_akhir = $request->file('foto_akhir');
                $nama_foto_akhir = time() . '_akhir.' . $foto_akhir->getClientOriginalExtension();
                $foto_akhir->move(public_path('images'), $nama_foto_akhir);
                $activity->foto_akhir = $nama_foto_akhir;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to upload foto_akhir'], 500);
            }
        }
        $activity->kondisi_akhir = $request->kondisi_akhir;
        $activity->status = 'done';
        $activity->ended_at = Carbon::now();

        $activity->save();

        return response()->json(['message' => 'Add changes success', 'data' => $activity]);
    }
}
