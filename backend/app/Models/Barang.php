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
        'catatan',
        'gambar',
        'adddata_string',
        'addata'
      
    ];

    protected static function booted() {

        static::updated(function ($barang) {
            $changes = $barang->getChanges();
        
            if (isset($changes['addata'])) {
                LogBarang::create([
                    'id_barang'=> $barang->id,
                    'addata' => $barang->addata,
                    'merk' => $barang->merk,
                    'nama_equipment' => $barang->nama_equipment,
                    'perusahaan' => $barang->perusahaan,
                    'adddata_string' => $barang->adddata_string,
                    'spesifikasi' => $barang->catatan,
                    'stock'=> $barang->stock,
                
                    
                ]);
            }
        
            if (isset($changes['mindata'])) {
                LogBarang::create([
                    'id_barang'=> $barang->id,
                    'addata' => $barang->addata,
                    'merk' => $barang->merk,
                    'nama_equipment' => $barang->nama_equipment,
                    'perusahaan' => $barang->perusahaan,
                    'adddata_string' => $barang->adddata_string,
                    'spesifikasi' => $barang->catatan,
                    'stock'=> $barang->stock,
                 
                ]);
            }
        });
        
    }
}