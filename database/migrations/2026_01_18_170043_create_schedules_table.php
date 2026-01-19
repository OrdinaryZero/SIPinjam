<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            // Ini cara menghubungkan jadwal ke tabel rooms (Relasi)
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            
            $table->string('mata_kuliah');
            $table->string('dosen');
            $table->string('hari'); // Contoh: Senin, Selasa
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
