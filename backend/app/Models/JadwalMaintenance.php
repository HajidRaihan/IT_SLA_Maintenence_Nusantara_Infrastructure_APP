<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMaintenance extends Model
{
    use HasFactory;

    protected $table = 'jadwal_maintenance';

    protected $fillable = [
        'jenis_perusahaan',
        'uraian_kegiatan',
        'tahun',
        'lokasi',
        'frekuensi',
        'waktu',
        'status'
    ];

    protected $casts = [
        'waktu' => 'array', // Menggunakan tipe data array
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->validateWaktu();
        });
    }

    public function validateWaktu()
    {
        $frekuensi = (int) str_replace('x pertahun', '', $this->frekuensi);
        $waktu = $this->waktu;

        // Pastikan waktu tidak null
        if (!$waktu) {
            throw new \Exception("Waktu harus disediakan.");
        }

        // Validasi jumlah waktu berdasarkan frekuensi
        if (count($waktu) !== $frekuensi) {
            throw new \Exception("Jumlah waktu tidak sesuai dengan frekuensi.");
        }
    }
    
}
