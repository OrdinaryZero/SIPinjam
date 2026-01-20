<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    // 1. Tampilkan Semua Data
    public function index()
    {
        // Ambil semua booking, urutkan dari yang terbaru
        // 'with' gunanya biar nama user & nama ruangan ikut terbawa
        $bookings = Booking::with(['user', 'room'])->latest()->get();
        
        return view('admin.dashboard', compact('bookings'));
    }

    // 2. Proses Setujui / Tolak
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Validasi input (status harus approved atau rejected)
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        // Simpan status baru
        $booking->update($validated);

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}