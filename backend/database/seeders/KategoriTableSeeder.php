<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;


class KategoriTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'nama_kategori' => 'Perbaikan barang',
                'deadline_duration'  => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'kerusakan mayor',
                'deadline_duration'  =>'6',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
