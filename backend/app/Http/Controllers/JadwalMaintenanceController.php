<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalMaintenance;

class JadwalMaintenanceController extends Controller
{
    public function index()
    {
        $jadwalMaintenance = JadwalMaintenance::all();
        return response()->json($jadwalMaintenance);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jenis_perusahaan' => 'required|string|in:tol,non tol',
            'uraian_kegiatan' => 'required|string',
            'tahun' => 'required|integer',
            'lokasi' => 'required|string',
            'frekuensi' => 'required|string|in:1x pertahun,2x pertahun',
            'waktu' => 'required|array',
            'waktu.*' => 'required|date_format:Y-m-d',

        ]);

        $waktuArray = $request->input('waktu');

        $jadwalMaintenance = JadwalMaintenance::create(array_merge($validateData, ['waktu' => $waktuArray]));
        
        return response()->json([
            'message' => 'Sukses menambahkan jadwal',
            'data' => $jadwalMaintenance,
        ]);
    }

    public function show(string $id)
    {
        $jadwalMaintenance = JadwalMaintenance::findOrFail($id);
        return response()->json($jadwalMaintenance);
    }

    public function updateStatus(Request $request, string $id)
    {
        // Validate the incoming request
        $validateData = $request->validate([
            'status' => 'required|string|in:on time,late,not done',
        ]);
    
        // Fetch the jadwalMaintenance record by ID
        $jadwalMaintenance = JadwalMaintenance::findOrFail($id);
    
        // Update the status field
        $jadwalMaintenance->status = $validateData['status'];
    
        // Save the changes to the database
        $jadwalMaintenance->save();
    
        // Log the query
        $queries = DB::getQueryLog();
        Log::info($queries);
    
        // Return a JSON response
        return response()->json([
            'message' => 'Success updating status',
            'data' => $jadwalMaintenance,
        ]);
    }

    public function update(Request $request, string $id)
{
    $validateData = $request->validate([
        'jenis_perusahaan' => 'required|string|in:tol,non tol',
        'uraian_kegiatan' => 'required|string',
        'tahun' => 'required|integer|min:1', 
        'lokasi' => 'required|string',
        'frekuensi' => 'required|string|in:1x pertahun,2x pertahun',
        'waktu' => 'required|array',
        'waktu.*' => 'required|date_format:Y-m-d',
       

    ]);

    // Konversi waktu menjadi array
    $waktuArray = $request->input('waktu');

    // Update data
    $jadwalMaintenance = JadwalMaintenance::findOrFail($id);
    $jadwalMaintenance->jenis_perusahaan = $validateData['jenis_perusahaan'];
    $jadwalMaintenance->uraian_kegiatan = $validateData['uraian_kegiatan'];
    $jadwalMaintenance->tahun = $validateData['tahun'];
    $jadwalMaintenance->lokasi = $validateData['lokasi'];
    $jadwalMaintenance->frekuensi = $validateData['frekuensi'];
    $jadwalMaintenance->waktu = $waktuArray;
    $jadwalMaintenance->status = $validateData['status'];
    $jadwalMaintenance->save();
    
    return response()->json([
        'message' => 'Sukses update frekuensi dan waktu jadwal',
        'data' => $jadwalMaintenance,
    ]);
}


    public function destroy(string $id)
    {
        $jadwalMaintenance = JadwalMaintenance::findOrFail($id);
        $jadwalMaintenance->delete();

        return response()->json([
            'message' => 'Sukses menghapus jadwal maintenance',
            'data' => $jadwalMaintenance,
        ]);
    }
}