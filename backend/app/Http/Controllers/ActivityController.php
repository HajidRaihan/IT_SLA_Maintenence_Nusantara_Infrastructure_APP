<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function addactivity_toll(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'company' => 'required|in:jtse,mmn',
            'tanggal' => 'required|date',
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
            'kondisi_akhir' => 'required|string',
            'biaya' => 'required|integer',
            'fotos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:process,done,waiting',
        ]);

        if ($request->hasFile('fotos')) {
            $image = $request->file('fotos');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['fotos'] = $imageName;
        }

        $activity = Activity::create($data);
        return response()->json(['data' => $activity]);
    }

    public function getactivity_toll(Request $request)
    {
        $filters = $request->only(['company', 'status', 'location', 'category']);

        // Get activities based on filters and join with the category and lokasi tables
        $activities = Activity::query()
            ->select('activity.id', 'users.username as nama_user', 'activity.company', 'activity.tanggal', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.fotos', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.nama_kategori as category_name', 'lokasi.nama_lokasi as location_name')
            ->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')
            ->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')
            ->leftjoin('users', 'activity.user_id', '=', 'users.id')
            ->when(isset($filters['company']), function ($query) use ($filters) {
                $query->where('company', $filters['company']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['location']), function ($query) use ($filters) {
                $query->where('lokasi_name', $filters['location']);
            })
            ->when(isset($filters['category']), function ($query) use ($filters) {
                $query->where('kategori_name', $filters['category']);
            })
            ->paginate(5);

        return response()->json(['data' => $activities]);
    }

    public function getactivity_toll_id(Request $request, $id)
    {
        $filters = $request->only(['company', 'status', 'location', 'category']);

        // Get the activity based on ID and join with the category and lokasi tables
        $activity = Activity::query()
            ->select('activity.id', 'users.username as nama_user', 'activity.company', 'activity.tanggal', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.fotos', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.nama_kategori as category_name', 'lokasi.nama_lokasi as location_name')
            ->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')
            ->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')
            ->leftjoin('users', 'activity.user_id', '=', 'users.id')
            ->where('activity.id', $id)
            ->when(isset($filters['company']), function ($query) use ($filters) {
                $query->where('company', $filters['company']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['location']), function ($query) use ($filters) {
                $query->where('lokasi_name', $filters['location']);
            })
            ->when(isset($filters['category']), function ($query) use ($filters) {
                $query->where('kategori_name', $filters['category']);
            })
            ->findOrFail($id)->paginate(5);

        return response()->json(['data' => $activity]);
    }

    //     public function getactivity_toll_by_user($UserId)
    // {
    //         $activity = Activity::where('user_id', $userId)->get();
    //         return response()->json(['data' => $activity]);
    // }

    public function edit_activity(Request $request, $id)
    {
        $data = $request->validate([
            'company' => 'required|in:jtse,mmn',
            'tanggal' => 'required|date',
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
            'fotos' => 'required',
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
        'tanggal' => 'required|date',
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
        'kondisi_akhir' => 'required|string',
        'biaya' => 'required|integer',
        'fotos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:process,done,waiting',
    ]);

        if ($request->hasFile('fotos')) {
            $image = $request->file('fotos');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['fotos'] = $imageName;
        }

        $activity = Activity::create($data);
        return response()->json(['data' => $activity]);
    }

    public function getactivity_nontoll(Request $request)
    {
        $filters = $request->only(['company', 'status', 'location', 'category']);

        // Get activities based on filters and join with the category and lokasi tables
        $activities = Activity::query()
            ->select('activity.id', 'users.username as nama_user ', 'activity.company', 'activity.tanggal', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.fotos', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.nama_kategori as category_name', 'lokasi.nama_lokasi as location_name')
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
                $query->where('lokasi_name', $filters['location']);
            })
            ->when(isset($filters['category']), function ($query) use ($filters) {
                $query->where('kategori_name', $filters['category']);
            })
            ->paginate(5);

        return response()->json(['data' => $activities]);
    }

    public function getactivity_nontoll_id($id)
    {
        $filters = $request->only(['company', 'status', 'location', 'category']);

        // Get the activity based on ID and join with the category and lokasi tables
        $activity = Activity::query()
            ->select('activity.id', 'users.username as nama_user', 'activity.company', 'activity.tanggal', 'activity.jenis_hardware', 'activity.standart_aplikasi', 'activity.uraian_hardware', 'activity.uraian_aplikasi', 'activity.aplikasi_it_tol', 'activity.uraian_it_tol', 'activity.catatan', 'activity.shift', 'activity.kondisi_akhir', 'activity.biaya', 'activity.fotos', 'activity.status', 'activity.ended_at', 'activity.created_at', 'activity.updated_at', 'kategori.nama_kategori as category_name', 'lokasi.nama_lokasi as location_name')
            ->leftJoin('kategori', 'activity.kategori_id', '=', 'kategori.id')
            ->leftJoin('lokasi', 'activity.lokasi_id', '=', 'lokasi.id')
            ->leftjoin('users', 'activity.user_id', '=', 'users.id')
            ->where('activity.id', $id)
            ->when(isset($filters['company']), function ($query) use ($filters) {
                $query->where('company', $filters['company']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['location']), function ($query) use ($filters) {
                $query->where('lokasi_name', $filters['location']);
            })
            ->when(isset($filters['category']), function ($query) use ($filters) {
                $query->where('kategori_name', $filters['category']);
            })
            ->findoOrFail($id)->paginate(5);

        return response()->json(['data' => $activity]);
    }

    // public function getactivity_nontoll_by_user($userId)
    // {
    //     $activity = Activity::where('user_id', $userId)->paginate(5);
    //     return response()->json(['data' => $activity]);
    // }



public function edit_activitynontoll(Request $request, $id) {
$data = $request->validate([
    'company' => 'required|in:jtse,mmn',
    'tanggal' => 'required|date',
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
    'fotos' => 'required',
    'status' => 'required|in:process,done,waiting',
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
    public function changeStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:process,done,waiting',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->status = $data['status'];
        $activity->save();

        return response()->json(['data' => $activity]);
    }
}
