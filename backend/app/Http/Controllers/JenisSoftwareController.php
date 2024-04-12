<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisSoftwareController extends Controller
{
    
    public function index()
    {
        $software = JenisSoftware::all();
        return response()->json($software);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_software' => 'required|string',
        ]);

        $software = JenisSoftware::create($request->all());

        return response()->json([
            'message' => 'yeay dpt tambah software uhuy',
            'data' => $software, 
        ]);
    }

    public function show(string $id)
    {
        $software = JenisSoftware::findOrFail($id);
        return response()->json($software);
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $software = JenisSoftware::findOrFail($id);
        $software->delete();

        return response()->json ([
            'message' => 'bisssaaaaa terhapus',
            'data' => $software,
        ]);
    }
}
