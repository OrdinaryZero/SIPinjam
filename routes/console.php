<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $now = Carbon::now()->format('H:i:s');
    $today = Carbon::now()->toDateString();

    // 1. Cari booking yang SUDAH SELESAI hari ini
    // Logikanya: Booking hari ini, jam selesai < jam sekarang, dan status ruangan masih 'penuh'
    $expiredBookings = Booking::where('tanggal', $today)
        ->where('jam_selesai', '<', $now)
        ->where('status', 'approved')
        ->get();

    foreach ($expiredBookings as $booking) {
        // Cek apakah ada booking LAIN yang sedang berlangsung di ruangan yang sama
        // Kalau tidak ada, barulah kita set jadi 'tersedia'
        $activeBooking = Booking::where('room_id', $booking->room_id)
            ->where('tanggal', $today)
            ->where('jam_mulai', '<=', $now)
            ->where('jam_selesai', '>', $now)
            ->exists();

        if (!$activeBooking) {
            Room::where('id', $booking->room_id)->update(['status' => 'tersedia']);
        }
    }
})->everyMinute();
