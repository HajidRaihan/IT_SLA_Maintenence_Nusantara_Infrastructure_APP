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
            'nama_barang' => 'required|string',
        ]);
            $regisbarang = Regisbarang::create($request->all());
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

