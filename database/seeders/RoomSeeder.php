<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'nama_ruangan' => 'Laboratorium Komputer A',
                'kapasitas' => 40,
                'fasilitas' => 'AC, Proyektor, 40 PC, Wi-Fi',
                'lokasi_lantai' => 'Lantai 2',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ruangan' => 'Aula Utama SAINTEK',
                'kapasitas' => 200,
                'fasilitas' => 'Sound System, Panggung, AC Central',
                'lokasi_lantai' => 'Lantai Dasar',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ruangan' => 'Ruang Sidang Skripsi',
                'kapasitas' => 15,
                'fasilitas' => 'Meja Bundar, AC, TV LED',
                'lokasi_lantai' => 'Lantai 3',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ruangan' => 'Kelas Teori 101',
                'kapasitas' => 60,
                'fasilitas' => 'Papan Tulis, Kipas Angin',
                'lokasi_lantai' => 'Lantai 1',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}