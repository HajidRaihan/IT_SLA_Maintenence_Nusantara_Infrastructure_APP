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
        'merk',
        'stock',
        'gambar',
        'adddata_string',
        'addata',
        'mindata',
    ];

    protected static function booted() {

        static::updated(function ($barang) {
            $changes = $barang->getChanges();
        
            if (isset($changes['addata'])) {
                LogBarang::create([
                    'addata' => $barang->addata,
                    'merk' => $barang->merk,
                    'nama_equipment' => $barang->nama_equipment,
                    'perusahaan' => $barang->perusahaan,
                    'adddata_string' => $barang->adddata_string
                ]);
            }
        
            if (isset($changes['mindata'])) {
                LogBarang::create([
                    'merk' => $barang->merk,
                    'nama_equipment' => $barang->nama_equipment,
                    'perusahaan' => $barang->perusahaan,
                    'mindata' => $barang->mindata,
                    'adddata_string' => $barang->adddata_string
                ]);
            }
        });
        
    }
}