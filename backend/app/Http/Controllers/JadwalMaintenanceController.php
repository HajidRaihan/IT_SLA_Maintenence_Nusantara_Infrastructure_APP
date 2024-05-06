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
