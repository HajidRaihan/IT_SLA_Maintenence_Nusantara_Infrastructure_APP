<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangTableSeeder extends Seeder
{

    public function run(): void
    {
        $barangData = [
            [
                'nama_equipment' => 'Buku Novel 21',
                'perusahaan' => 'PT Makassar Metro Network',
                'unit' => '12',
                'merk' => 'fira',
                'stock' => 12,
                'gambar' => '1710742074.jpg',
            ],
            [
                'nama_equipment' => 'Meja',
                'perusahaan' => 'PT Jalan Tol Seksi Empat',
                'unit' => '12',
                'merk' => 'fira',
                'stock' => 12,
                'gambar' => '1710742074.jpg',
            ],
        ];

              // Loop through barangData and create Barang instances
              foreach ($barangData as $data) {
                Barang::create($data);
            }
    }
}
