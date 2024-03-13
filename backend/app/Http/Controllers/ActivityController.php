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
            'status' => 'required|in:prosses,done',
        ]);

        if($request->hasFile('fotos')){
            $image = $request -> file('fotos');
            $imageName = time(). '.'.$image ->getClientOriginalExtension();
            $image->move(public_path('images'),$imageName);
            $data['fotos'] = $imageName; 
        }
        

        $activity = Activity::create($data);
        return response()->json(['data' => $activity]);
    }



    public function getactivity_toll()
    {
        $activity = Activity::all();
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
        'status' => 'required|in:prosses,done',
    ]);

    if($request->hasFile('fotos')){
        $image = $request -> file('fotos');
        $imageName = time(). '.'.$image ->getClientOriginalExtension();
        $image->move(public_path('images'),$imageName);
        $data['fotos'] = $imageName; 
    }
    

    $activity = Activity::create($data);
    return response()->json(['data' => $activity]);
}



public function getactivity_nontoll()
{
    $activity = Activity::all();
    return response()->json(['data' => $activity]);
}



public function edit_activitynontoll(Request $request, $id)
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

public function delete_activitynontoll($id)
{
$activity = Activity::findOrFail($id);
$activity->delete();

return response()->json(['message' => 'Activity deleted successfully']);
}


}
