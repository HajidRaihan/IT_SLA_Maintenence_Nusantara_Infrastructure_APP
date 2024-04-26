<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function addactivity_toll(Request $request)
    {
        $data = $request->validate([
            // 'user_id' => 'required|exists:users,id',
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
            'foto_awal' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_akhir' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        $activity = Activity::create($data);
       return response()->json(['message' => 'Add Activity success', 'data'=>$activity]);
    }

    public function getactivity_toll(Request $request)
    {
        $filters = $request->only(['company', 'status', 'lokasi_id', 'kategori_id']);

        // Get activities based on filters and join with the category and lokasi tables

        $activities = Activity::query()
            ->select('activity.id', 'users.username as nama_user', 'activity.company', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.foto_awal', 'activity.foto_akhir', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.deadline_duration as category_deadline', 'kategori.nama_kategori as category_name', 'lokasi.nama_lokasi as location_name')
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
            ->paginate(5);

        return response()->json(['data' => $activities]);
    }

    public function getactivity_toll_id(Request $request, $id)
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
        }

        $activity = $activity->paginate(5);

        return response()->json(['data' => $activity]);
    }

    public function getactivity_toll_by_user($userId)
    {
        // Lakukan query untuk mendapatkan data aktivitas tol berdasarkan ID pengguna
        $activities = Activity::select('activity.id', 'users.username as nama_user', 'activity.company', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.foto_awal', 'activity.foto_akhir', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.deadline_duration as category_deadline', 'kategori.nama_kategori as category_name', 'lokasi.nama_lokasi as location_name')
            ->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')
            ->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')
            ->leftJoin('users', 'activity.user_id', '=', 'users.id')
            ->where('activity.user_id', $userId)
            ->get();
    
        // Periksa apakah data ditemukan atau tidak
        if ($activities->isEmpty()) {
            // Jika tidak ditemukan, kembalikan respons JSON kosong dengan kode status 404 (Not Found)
            return response()->json(['message' => 'No activities found for the user with the provided ID.'], 404);
        }
    
        // Jika ditemukan, kembalikan data aktivitas tol dalam bentuk respons JSON dengan kode status 200 (OK)
        return response()->json(['message' => 'Activities retrieved successfully.', 'data' => $activities], 200);
    }

    public function edit_activity(Request $request, $id)
    {
        $data = $request->validate([
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
            'biaya' => 'required|integer',
            'kondisi_akhir' => 'nullable|string',
            'foto_awal' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_akhir' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:process,done',
        ]);

        

        $activity = Activity::findOrFail($id);
        $activity->update($data);

        return response()->json(['data' => $activity]);
    }

    public function delete_activity($id)
    {
        $activity = Activity::findOrFail($id);
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
            'foto_awal' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_akhir' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        $filters = $request->only(['company', 'status', 'location', 'category']);

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
            ->paginate(5);

        return response()->json(['data' => $activities]);
    }

    public function getactivity_nontoll_id(Request $request, $id)
    {
        $filters = $request->only(['company', 'status', 'location', 'category']);

        $activity = Activity::query()->$activity = Activity::query()->select('activity.id', 'users.username as nama_user', 'activity.company', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.foto_awal', 'activity.foto_akhir', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.nama_kategori as category_name', 'kategori.deadline_duration as category_deadline', 'lokasi.nama_lokasi as location_name')->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')->leftJoin('users', 'activity.user_id', '=', 'users.id')->where('activity.id', $id);

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
            'biaya' => 'required|integer',
            'kondisi_akhir' => 'nullable|string',
            'foto_awal' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_akhir' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
    //         'foto_akhir' => 'required_if:status,done|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'foto_akhir' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        return response()->json(['data' => $activity]);
    }
}
