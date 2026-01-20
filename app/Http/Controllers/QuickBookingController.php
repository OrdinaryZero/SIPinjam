<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class QuickBookingController extends Controller {
    public function show($room_id) {
        $room = Room::findOrFail($room_id);
        // Cek status, kalau penuh lempar ke halaman sibuk
        if (strtolower(trim($room->status)) != 'tersedia') {
            return view('scan.busy', compact('room'));
        }
        return view('scan.form', compact('room'));
    }

    public function store(Request $request) {
        $now = Carbon::now();
        // PAKSA duration jadi angka (int) supaya Carbon tidak error
        $duration = (int) $request->duration; 
        $endTime = $now->copy()->addHours($duration);

        // Buat booking otomatis
        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'tanggal' => $now->toDateString(),
            'jam_mulai' => $now->format('H:i'),
            'jam_selesai' => $endTime->format('H:i'),
            'keperluan' => 'Scan QR Quick Book',
            'status' => 'approved',
        ]);

        // Ganti status ruangan jadi Penuh
        Room::where('id', $request->room_id)->update(['status' => 'penuh']);

        return redirect()->route('dashboard')->with('success', "Ruangan terkunci selama $duration jam!");
    }
}