<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;   



class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        return response()->json($jadwal);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_kegiatan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'perusahaan' => 'required|string|in:PT Makassar Metro Network,PT Jalan Tol Sesi Empat',
            'lokasi' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
        ]);
        
        $jadwal = Jadwal::create($request->all());
        return response()->json([
            'message' => 'sukses menambahkan jadwal',
            'data' => $jadwal,
        ]);
    }

    public function show(string $id)
    {
        
        $jadwal = Jadwal::findOrFail($id);
        return response()->json($jadwal);
    }


    public function update(Request $request, string $id)
    {
        $validateKategori = $request->validate([
            'nama_kegiatan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'perusahaan' => 'required|string|in:PT Makassar Metro Network,PT Jalan Tol Sesi Empat',
            'perusahaan' => 'required|string',
            'lokasi' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());
        return response()->json([
            'message' => 'sukses update jadwal',
            'data' => $jadwal,
        ]);
    }

    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return response()->json([
            'pesannya' => 'yeay kehapus jadwalnya',
            'data' => $jadwal,
        ]);
    }
}

