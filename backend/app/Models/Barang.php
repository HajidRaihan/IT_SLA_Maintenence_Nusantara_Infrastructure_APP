<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_equipment',
        'perusahaan',
        'unit',
        'merk',
        'stock',
        'gambar',
        'adddata_string',
        'addata',
        'mindata',
    ];

    protected static function booted() {
        static::created(function ($barang) {
            // Initial log creation when a new Barang is added
            LogBarang::create([
                'merk' => $barang->merk,
                'nama_equipment' => $barang->nama_equipment,
                'perusahaan' => $barang->perusahaan,
            ]);
        });

        static::updated(function ($barang) {
            $changes = $barang->getChanges();

            if (array_key_exists('addata', $changes)) {
               
                // Log this addition
                LogBarang::create([
                    'addata' => $barang->addata,
                    'merk' => $barang->merk,
                    'nama_equipment' => $barang->nama_equipment,
                    'perusahaan' => $barang->perusahaan,
                    'mindata' => $barang->mindata,
                    'adddata_string' => $barang->adddata_string,
                ]);
            }

            if (array_key_exists('mindata', $changes)) {
                LogBarang::create([
                    'addata' => $barang->addata,
                    'merk' => $barang->merk,
                    'nama_equipment' => $barang->nama_equipment,
                    'perusahaan' => $barang->perusahaan,
                    'mindata' => $barang->mindata,
                    'adddata_string' => $barang->adddata_string,
                ]);
            }
        });
    }
}