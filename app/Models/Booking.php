<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // --- TAMBAHKAN BARIS INI ---
    // Artinya: "Semua kolom boleh diisi (user_id, room_id, dll)"
    protected $guarded = []; 
    // ---------------------------

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }
}