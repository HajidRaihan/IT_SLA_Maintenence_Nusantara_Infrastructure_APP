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
        'nama_equipment',
        'perusahaan',
        'merk',
        'adddata_string',
        'addata',
    ];
}

