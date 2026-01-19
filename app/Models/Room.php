<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // --- TAMBAHKAN BAGIAN INI (Daftar kolom yang boleh diisi) ---
    protected $fillable = [
        'nama_ruangan',
        'kapasitas',
        'fasilitas',
        'lokasi_lantai',
        'status',
        'gambar', // <--- Penting! Biar foto bisa disimpan
    ];
}