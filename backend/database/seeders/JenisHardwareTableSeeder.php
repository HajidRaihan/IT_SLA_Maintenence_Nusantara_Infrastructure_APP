<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\JenisHardware;


class JenisHardwareTableSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('jenis_hardware')->insert([
            [
                'nama_hardware' => 'Gate Barrier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hardware' => 'LLA/OTL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hardware' => 'CCTV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hardware' => 'UPS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hardware' => 'STB',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
