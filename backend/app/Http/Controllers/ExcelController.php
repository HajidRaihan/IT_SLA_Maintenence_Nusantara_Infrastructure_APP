<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function generateExcel(Request $request)
    {
        $data = $request->all(); // Menerima data dari frontend

        // Implementasi logika untuk membuat tampilan Excel
        $excelData = [
            ['Name', 'Age'],
            [$data['name'], $data['age']],
        ];

        // Membuat file Excel menggunakan Maatwebsite\Excel
        return Excel::create('data_excel', function($excel) use ($excelData) {
            $excel->sheet('Sheet1', function($sheet) use ($excelData) {
                $sheet->fromArray($excelData);
            });
        })->download('xlsx');
    }
}
