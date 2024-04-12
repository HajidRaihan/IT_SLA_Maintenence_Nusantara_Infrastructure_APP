<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplikasiItTol extends Model
{
    protected $table = 'aplikasi_tol';
    use HasFactory;
    protected $fillable = [
        'id',
        'nama_aplikasiTol',
    ];
}
