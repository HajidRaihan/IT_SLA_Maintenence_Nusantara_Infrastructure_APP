<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBarang extends Model
{
    use HasFactory;

    protected $table = 'log_barang';

    protected $fillable = [
        'id',
        'id_barang',
        'nama_equipment',
        'perusahaan',
        'merk',
        'spesifikasi',
        'adddata_string',
        'addata',
        'stock'
    ];
}

