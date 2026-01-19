<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ... kode user bawaan ...

        // Panggil Tukang Tanam Ruangan
        $this->call(RoomSeeder::class);
    }
}