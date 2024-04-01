<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    use HasFactory;
    protected $table = "activity";
    protected $fillable = [
    'user_id',
    'company',
    'tanggal',
    'jenis_hardware',
    'standart_aplikasi',
    'uraian_hardware',
    'uraian_aplikasi',
    'aplikasi_it_tol',
    'uraian_it_tol',
    'catatan', 
    'shift',
    'lokasi_id',
    'kategori_id',
    'kondisi_akhir',
    'biaya',
    'fotos',
    'kategori_activity',
    'status'
    ];
}
