<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AplikasiItTolTableSeeder extends Seeder
{
   public function run(): void
    {
        DB::table('aplikasi_tol')->insert([
            [
                'nama_aplikasiTol' => 'Program LTCS/TFI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_aplikasiTol' => 'Program PCS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_aplikasiTol' => 'Program RTM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_aplikasiTol' => 'Program CCTV/VMS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
