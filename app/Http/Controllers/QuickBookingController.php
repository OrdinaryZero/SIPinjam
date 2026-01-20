<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class QuickBookingController extends Controller
{
    // 1. TAMPILKAN HALAMAN SCAN
    public function show($room_id)
    {
        $room = Room::findOrFail($room_id);

        // Cek apakah ruangan SEDANG dipakai saat ini juga?
        // Kita pakai strtolower agar tidak sensitif huruf besar/kecil
        $status = strtolower(trim($room->status));
        
        if ($status != 'tersedia' && $status != 'available') {
             // Pastikan file resources/views/scan/busy.blade.php SUDAH DIBUAT
             return view('scan.busy', compact('room'));
        }

        // Pastikan file resources/views/scan/form.blade.php SUDAH DIBUAT
        return view('scan.form', compact('room'));
    }

    // 2. PROSES BOOKING CEPAT
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'duration' => 'required|numeric', // Validasi angka
            'keperluan' => 'required|string|max:255',
        ]);

        $room = Room::findOrFail($request->room_id);

        // A. Tentukan Waktu
        $now = Carbon::now(); 
        
        // --- PERBAIKAN DISINI ---
        // Kita paksa ubah duration jadi integer dengan (int)
        $duration = (int) $request->duration; 
        
        $endTime = $now->copy()->addHours($duration); 

        // B. Cek Tabrakan Jadwal (Double Check)
        $conflict = Booking::where('room_id', $room->id)
            ->where('tanggal', $now->toDateString())
            ->where(function($query) use ($now, $endTime) {
                $query->whereBetween('jam_mulai', [$now->format('H:i'), $endTime->format('H:i')])
                      ->orWhereBetween('jam_selesai', [$now->format('H:i'), $endTime->format('H:i')]);
            })
            ->where('status', 'approved')
            ->exists();

        if ($conflict) {
            return back()->with('error', 'Yah, baru saja ada yang booking ruangan ini secara online!');
        }

        // C. Simpan Booking
        Booking::create([
            'user_id' => Auth::id() ?? 1, // Pastikan user tamu (ID 1) ada, atau hapus baris ini jika wajib login
            'room_id' => $room->id,
            'tanggal' => $now->toDateString(),
            'jam_mulai' => $now->format('H:i'),
            'jam_selesai' => $endTime->format('H:i'),
            'keperluan' => $request->keperluan . ' (Quick Scan)',
            'status' => 'approved', 
        ]);

        // D. Update Status Ruangan jadi PENUH
        $room->update(['status' => 'penuh']);

        return redirect()->route('dashboard')->with('success', 'Ruangan berhasil dikunci untuk ' . $duration . ' jam ke depan!');
    }
}