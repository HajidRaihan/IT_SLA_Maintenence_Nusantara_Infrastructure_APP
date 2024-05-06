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
                'nama_software' => 'Microsoft',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_software' => 'Excel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_software' => 'Power Point',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
