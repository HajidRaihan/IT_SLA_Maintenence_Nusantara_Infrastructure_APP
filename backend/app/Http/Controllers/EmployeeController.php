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
        $validateData = $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string|in:teknisi,kspt',
            'ttd' => 'required|string',
        ]);

        $employee = Employee::create($request->all());

        return response()->json([
            'message' => 'tambah data employee berhasil',
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
