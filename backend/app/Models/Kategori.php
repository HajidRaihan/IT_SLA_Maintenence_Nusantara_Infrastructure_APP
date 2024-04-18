<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'id',
        'nama_kategori',
        'deadline_duration',
    ];
    use HasFactory;

    public function getDeadlineDurationStringAttribute()
    {
        $deadlineDuration = $this->attributes['deadline_duration'];

        // Konversi nilai integer menjadi string dengan format tertentu
        switch ($deadlineDuration) {
            case 3:
                return 'Tiga hari';
            case 6:
                return 'Enam hari';
            default:
                return 'Format tidak valid';
        }
    }
}
