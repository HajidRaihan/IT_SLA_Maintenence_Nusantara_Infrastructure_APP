<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';

    protected $fillable =[
        'nama_equipment',
        'perusahaan',
        'unit',
        'merk',
        'stock',
        'gambar'
    ];

    public static function rules($id = null)
    {
        return [
            'nama_equipment' => 'required|string|max:255',
            'perusahaan' => [
                'required',
                'string',
                'max:255',
                Rule::in(['PT Makassar Metro Network', 'PT Jalan Tol Seksi Empat']),
            ],
            'unit' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id' => [
                'nullable',
                'integer',
                Rule::unique('barang')->ignore($id),
            ],
        ];
    }
}
