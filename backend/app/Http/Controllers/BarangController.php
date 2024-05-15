<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;   
use App\Models\LogBarang;
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

    public function logbarang(Request $request)
    {
        $perusahaan = $request->query('perusahaan');
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
    
        $barangQuery = LogBarang::query();
    
        // Filter by perusahaan if it's provided
        if ($perusahaan) {
            $barangQuery->where('perusahaan', $perusahaan);
        }
    
        // Filter by date range if both start_date and end_date are provided
        if ($start_date && $end_date) {
            $barangQuery->whereDate('created_at', '>=', $start_date)
                        ->whereDate('created_at', '<=', $end_date);
        }
    
        $barang = $barangQuery->get();
    
        return response()->json($barang);
    }
    

    public function logbarang_byid($barangId)
{
    $logbarang = Logbarang::where('id_barang', $barangId)->paginate(100);
    return response()->json(['data' => $logbarang]);
}

public function barang_byid($barangId)
{
    $barang = Barang::where('id', $barangId)->paginate(5);
    return response()->json(['data' => $barang]);
}

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nama_equipment' => 'required|string|max:255',
        'perusahaan' => 'string|in:PT Makassar Metro Network,PT Makassar Airport Network',
        'merk' => 'required|string|max:255',
        'stock' => 'required|integer|min:0',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
        'catatan' => 'string|required'
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
        } else {
            // Handle case when no file is uploaded
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        $barang = Barang::create(array_merge($request->all(), ['gambar' => $imageName]));
            return response()->json([
               'message' => 'barang berhasil ditambahkan',
               'data' => $barang,
            ]);
    }


public function show($barangId)
{
    $barang = Barang::where('id', $barangId)->get();
    return response()->json(['data' => $barang]);
}

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'adddata' => 'integer|min:0',
            'mindata' => 'integer|min:0',
            'stock' => 'integer|min:0',
            'adddata_string' => 'string|in:masuk,keluar',
            'catatan' => 'string',
           
        
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
 