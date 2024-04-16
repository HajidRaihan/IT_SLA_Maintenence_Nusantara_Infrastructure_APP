<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AplikasiItTol;

class AplikasiItTolController extends Controller
{
    public function index()
    {
        $aplikasiIt = AplikasiItTol::all();
        return response()->json($aplikasiIt);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_aplikasiTol' => 'required|string',
        ]);

        $aplikasiIt = AplikasiItTol::create($request->all());

        return response()->json([
            'message' => 'yeay dpt tambah aplikasiIt uhuy',
            'data' => $aplikasiIt, 
        ]);
    }

    public function show(string $id)
    {
        $aplikasiIt = AplikasiItTol::findOrFail($id);
        return response()->json($aplikasiIt);
    }

    public function update(Request $request, string $id)
    {
       // 
    }

    public function destroy(string $id)
    {
        $aplikasiIt = AplikasiItTol::findOrFail($id);
        $aplikasiIt->delete();

        return response()->json ([
            'message' => 'bisssaaaaa',
            'data' => $aplikasiIt,
        ]);
    }
}
