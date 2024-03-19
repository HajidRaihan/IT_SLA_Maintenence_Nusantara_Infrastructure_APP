<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lokasi')->insert([
            [
                'nama_lokasi' => 'kantor cambayya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'kantor IT Workshop',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
