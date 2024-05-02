<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regisbarang extends Model
{
    protected $table = 'regisbarang';
    use HasFactory;
    protected $fillable = [
        'id',
        'nama_barang',
        'perusahaan',
        'stock',
        'merk',
        'gambar',
        'spesifikasi',
    ];

}
