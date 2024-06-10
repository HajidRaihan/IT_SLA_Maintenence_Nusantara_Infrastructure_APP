<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
    }


    public function store(Request $request)
    {
        // Validasi input termasuk file ttd
        $validateData = $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string|in:teknisi,kspt',
            'ttd' => 'required|file|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        // Penanganan pengunggahan file ttd
        if ($request->hasFile('ttd')) {
            try {
                $ttd = $request->file('ttd');
                $nama_ttd = time() . '_ttd.' . $ttd->getClientOriginalExtension();
                $ttd->move(public_path('images'), $nama_ttd); // Menyimpan file di direktori public/images
                $data['ttd'] = $nama_ttd; // Menyimpan nama file ttd di array data
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to upload ttd'], 500);
            }
        }
    
        // Menyimpan data employee ke database
        $employee = Employee::create([
            'nama' => $validateData['nama'],
            'jabatan' => $validateData['jabatan'],
            'ttd' => $data['ttd'], // Mengambil nama file ttd dari array data
        ]);
    
        return response()->json([
            'message' => 'Tambah data employee berhasil',
            'data' => $employee,
        ]);
    }
    

 
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string|in:teknisi,kspt',
            'ttd' => 'required|string',
        ]);
        
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return response()->json([
            'message' => 'update data employee berhasil',
            'data' => $employee, 
        ]);
    }


    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'message' => 'menghapus data employee berhasil',
            'data' => $employee, 
        ]);
    }
}
