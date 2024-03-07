<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;


class ActivityController extends Controller
{
     public function activity(Request $request)
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
            'fotos' => 'required',
            'status' => 'required|in:prosses,done',
        ]);
        

        $activity = Activity::create($data);

        return response()->json(['data' => $activity]);
    }

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
        'status' => 'required|in:prosses,done',
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


}
