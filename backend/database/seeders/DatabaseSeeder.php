<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\BarangTableSeeder;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(BarangTableSeeder::class);
        $this->call(LokasiTableSeeder::class);
        $this->call(KategoriTableSeeder::class);
        $this->call(JadwalTableSeeder::class);
        $this->call(ActivityTableSeeder::class);
        $this->call(JenisHardwareTableSeeder::class);
        $this->call(JenisSoftwareTableSeeder::class);
        $this->call(AplikasiItTolTableSeeder::class);







    }
}
