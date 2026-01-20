<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
{
    // Menggunakan format H:i agar lebih toleran terhadap perbedaan detik
    $now = Carbon::now()->format('H:i'); 
    $today = Carbon::now()->toDateString();

    $rooms = Room::with(['bookings' => function($q) use ($now, $today) {
        $q->where('tanggal', $today)
          ->where('status', 'approved')
          ->where('jam_mulai', '<=', $now)
          ->where('jam_selesai', '>', $now);
    }])->get();

    $bookings = Booking::with(['user', 'room'])->latest()->get();
    
    return view('admin.dashboard', compact('bookings', 'rooms'));
}
    // FUNGSI UNTUK STOP PAKSA (KILL SWITCH)
    public function resetStatus($id)
    {
        $room = Room::findOrFail($id);
        $now = Carbon::now()->format('H:i:s');

        // Balikin status ruangan jadi tersedia
        $room->update(['status' => 'tersedia']);

        // Cari booking aktif, paksa jam selesainya jadi sekarang (biar timer berhenti)
        Booking::where('room_id', $id)
            ->where('tanggal', Carbon::now()->toDateString())
            ->where('status', 'approved')
            ->where('jam_selesai', '>', $now)
            ->update(['jam_selesai' => $now]);

        return redirect()->back()->with('success', 'Ruangan berhasil di-reset!');
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $validated = $request->validate(['status' => 'required|in:approved,rejected']);
        $booking->update($validated);
        return redirect()->back()->with('success', 'Status diperbarui!');
    }
}