<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regisbarang;

class RegisbarangController extends Controller
{
    public function get_regisbarang(){
        $regisbarang = Regisbarang::all();
        return response()->json($regisbarang);
    }

    public function add_regisbarang(Request $request){
        $data = $request -> validate([
        'nama_barang' => 'required|string|max:255',
        'perusahaan' => 'string|in:PT Makassar Metro Network,PT Makassar Airport Network',
        'merk' => 'required|string|max:255',
        'stock' => 'required|integer|max:255',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
        'spesifikasi' => 'string|required'
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
        } else {
            // Handle case when no file is uploaded
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        $regisbarang = Regisbarang::create(array_merge($request->all(), ['gambar' => $imageName]));
            return response()->json([
               'message' => 'barang berhasil ditambahkan',
               'data' => $regisbarang,
            ]);
    }
     public function get_regisbarangid(string $id){
        $regisbarang = Regisbarang::findOrFail($id);
        return response()->json($regisbarang);
    }

    public function update_barang(Request $request, string $id)
    {
        $validateData = $request->validate([
            'nama_barang' => 'required|string',
        ]);

        $barang = Regisbarang::findOrFail($id);
        $barang->update($request->all());

        return response()->json([
            'message' => 'ini berhasil yee',
            'data' => $barang,
        ]);
    }

        public function deletebarang(string $id)
        {
            $regisbarang = Regisbarang::findOrFail($id);
            $regisbarang->delete();
    
            return response()->json ([
                'message' => 'barang di delete',
                'data' => $regisbarang,
            ]);
        }
    }

