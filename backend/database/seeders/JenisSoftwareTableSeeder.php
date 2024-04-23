<?php

namespace Database\Seeders;

use App\Models\JenisSoftware;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class JenisSoftwareTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_software')->insert([
            [
                'nama_software' => 'Gate Barrier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_software' => 'LLA/OTL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_software' => 'CCTV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_software' => 'UPS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_software' => 'STB',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
