<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_kategori' => 'required|string',
            'deadline_duration' => 'required|integer',
        ]);

        $kategori = Kategori::create($request->all());

        return response()->json([
            'message' => 'sukses menambahkan kategori',
            'data' => $kategori,
        ]);
    }

    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json($kategori);
    }
    

    public function update(Request $request, string $id)
    {
        $validateKategori = $request->validate([
            'nama_kategori' => 'required|string',
        ]);
            
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return response()->json([
            'message' => 'sukses update kategori',
            'data' => $kategori,
        ]);

    }

    public function destroy(string $id)
    {

        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json([
            'pesannya' => 'yeay kehapus',
            'data' => $kategori,
        ]);
    }
}
