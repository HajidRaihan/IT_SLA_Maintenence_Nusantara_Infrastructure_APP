<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KategoriTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'nama_kategori' => 'Perbaikan barang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'kerusakan mayor',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
