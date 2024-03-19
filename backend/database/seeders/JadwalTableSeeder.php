<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JadwalTableSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('jadwal')->insert([
            [
                'nama_kegiatan' => 'Dengar musik Opick',
                'tanggal_mulai'=> '2024-03-25',
                'tanggal_selesai'=> '2024-03-30',
                'perusahaan'=> 'PT Makassar Metro Network',
                'lokasi'=> 'Cambayya',
                'waktu_mulai'=> '09:00',
                'waktu_selesai'=> '12:00',
            ],
            
        ]);
    }
}
