<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    'foto_awal',
    'foto_akhir',
    'kondisi_akhir',
    'kategori_activity',
    'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }
}
