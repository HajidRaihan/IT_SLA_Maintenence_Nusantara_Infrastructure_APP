<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;   
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{

    public function index(Request $request)
    {
            $perusahaan = $request->query('perusahaan');
            $barangQuery = Barang::query();
            if ($perusahaan) {
                $barangQuery->where('perusahaan', $perusahaan);
            }

            $barang = $barangQuery->get();
            return response()->json($barang);
    }


    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nama_equipment' => 'required|string|max:255',
        'perusahaan' => 'string|in:PT Makassar Metro Network,PT Jalan Tol Seksi Empat',
        'unit' => 'required|string|max:255',
        'merk' => 'required|string|max:255',
        'stock' => 'required|integer|min:0',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    if ($request->hasFile('gambar')) {
        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images'), $imageName);
    } else {
        // Handle case when no file is uploaded
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    $barang = Barang::create(array_merge($request->all(), ['gambar' => $imageName]));

    return response()->json([
        'message' => 'Sukses menambahkan barang',
        'data' => $barang,
    ], 201);
}


    public function show(string $id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json($barang);
        
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'adddata' => 'integer|min:0',
            'mindata' => 'integer|min:0',
            'stock' => 'integer|min:0',
            'adddata_string' => 'string|in:masuk,keluar'
           
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $barang = Barang::findOrFail($id);
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama       
            if (file_exists(public_path('images/'.$barang->gambar))) {
                unlink(public_path('images/'.$barang->gambar));
            }
            // Simpan gambar baru
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $barang->gambar = $imageName;
        }

        $barang->update($request->except('gambar'));

        return response()->json([
            'message' => 'Sukses update barang',
            'data' => $barang,
        ]);
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();  

        return response()->json([
            'message' => 'Sukses menghapus barang',
            'data' => $barang,
        ]);
    }
}
