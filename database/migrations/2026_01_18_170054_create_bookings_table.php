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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Yang pinjam siapa? (connect ke users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Ruangan apa? (connect ke rooms)
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('keperluan');
            $table->string('organisasi')->nullable(); // Boleh kosong kalau perorangan
            
            // Status persetujuan (defaultnya 'pending' / menunggu)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable(); // Alasan kalau ditolak
            
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
