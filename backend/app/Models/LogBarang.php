<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBarang extends Model
{
    protected $table = 'log_barang';
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'nama_equipment',
        'perusahaan',
        'unit',
        'merk',
        'stock',
        'activity',
    ];
}
