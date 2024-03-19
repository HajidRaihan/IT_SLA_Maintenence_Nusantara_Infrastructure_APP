<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activity')->insert([
            [
                'user_id'=> '1',
                'company'=> 'mmn',
                'tanggal'=> '2024-03-30',
                'jenis_hardware'=> 'komputer2',
                'standart_aplikasi'=> 'standar',
                'uraian_hardware'=> 'firaa',
                'uraian_aplikasi'=> 'firaa',
                'aplikasi_it_tol'=> 'firaa',
                'uraian_it_tol'=> 'firaa',
                'catatan'=> 'firaa',
                'shift'=> '2',
                'lokasi_id'=> '1',
                'kategori_id'=> '1',
                'kondisi_akhir'=> 'firaa',
                'biaya'=> '123',
                'fotos'=> '1710815317.jpeg',
                'status'=> 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
