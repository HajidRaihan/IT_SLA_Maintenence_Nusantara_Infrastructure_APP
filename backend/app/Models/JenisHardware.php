<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHardware extends Model
{
    protected $table = 'jenis_hardware';
    use HasFactory;
    protected $fillable = [
        'id',
        'nama_hardware',
    ];
}
