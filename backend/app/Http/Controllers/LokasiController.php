<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    
    public function index()
    {
        $lokasi = Lokasi::all();
        return response()->json($lokasi);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_lokasi' => 'required|string',
        ]);

        $lokasi = Lokasi::create($request->all());

        return response()->json([
            'message' => 'yeay dpt tambah lokasi uhuy',
            'data' => $lokasi, 
        ]);
    }

    public function show(string $id)
    {
        $lokasi = Lokasi::findOrFail($id);
        return response()->json($lokasi);
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'nama_lokasi' => 'required|string',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($request->all());

        return response()->json([
            'message' => 'ini berhasil yee',
            'data' => $lokasi,
        ]);
    }

    public function destroy(string $id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return response()->json ([
            'message' => 'bisssaaaaa',
            'data' => $lokasi,
        ]);
    }
}
