<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisHardwareController extends Controller
{
    public function index()
    {
        $hardware = JenisHardware::all();
        return response()->json($hardware);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_hardware' => 'required|string',
        ]);

        $hardware = JenisHardware::create($request->all());

        return response()->json([
            'message' => 'yeay dpt tambah hardware uhuy',
            'data' => $hardware, 
        ]);
    }

    public function show(string $id)
    {
        $hardware = JenisHardware::findOrFail($id);
        return response()->json($hardware);
    }

    public function update(Request $request, string $id)
    {

    }
    
    public function destroy(string $id)
    {
        $hardware = JenisHardware::findOrFail($id);
        $hardware->delete();

        return response()->json ([
            'message' => 'bisssaaaaa',
            'data' => $hardware,
        ]);
    }
}
