<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSoftware extends Model
{
    protected $table = 'jenis_software';
    use HasFactory;
    protected $fillable = [
        'id',
        'nama_software',
    ];
}
