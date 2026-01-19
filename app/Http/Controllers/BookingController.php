<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
// Cari fungsi ini di dalam file tersebut
public function index(Request $request)
{
    $rooms = \App\Models\Room::all();
    $selectedRoomId = $request->query('room_id');
    
    // Kamu harus ambil data ini juga supaya tabel riwayat tidak kosong
    $myBookings = \App\Models\Booking::where('user_id', auth()->id())->get();

    // MASUKKAN SEMUA KE SINI!
    return view('peminjaman', compact('rooms', 'selectedRoomId', 'myBookings'));
}
public function store(Request $request)
    {$conflict = Booking::where('room_id', $request->room_id)
    ->where('tanggal', $request->tanggal)
    ->where('status', 'approved')
    ->where(function ($query) use ($request) {
        $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
              ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
    })->first();

if ($conflict) {
    return back()->withErrors([
        'error' => "Ruangan sudah dipesan oleh {$conflict->user->name} untuk keperluan: '{$conflict->keperluan}' pada jam tersebut."
    ]);
}
        // 1. Validasi Input
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan' => 'required|string|max:255',

            
        ]);

        // 2. CEK BENTROK (Versi Simple & Kuat)
        // Kita cari: Apakah ada booking LAIN di ruangan & tanggal SAMA...
        // ...yang waktunya tumpang tindih dengan inputan baru?
        $isBooked = Booking::where('room_id', $request->room_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', '!=', 'rejected') // Abaikan yang sudah ditolak
            ->where(function ($query) use ($request) {
                // RUMUS SAKTI ANTI BENTROK:
                // (Mulai Lama < Selesai Baru) DAN (Selesai Lama > Mulai Baru)
                $query->where('jam_mulai', '<', $request->jam_selesai)
                      ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->exists(); // Cek apakah ada datanya?

        // 3. Eksekusi Penolakan
        if ($isBooked) {
            // Kalau ketemu ($isBooked = true), kembalikan user dengan pesan error
            return redirect()->back()
                ->with('error', 'GAGAL! Ruangan sudah terisi di jam tersebut. Cek tabel riwayat.')
                ->withInput(); // Biar capek-capek ngetik gak hilang
        }

        // 4. Kalau Lolos Seleksi, Simpan Data
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        Booking::create($validated);

        return redirect()->route('dashboard')->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function allBookings()
{
    if (auth()->user()->role !== 'admin') { abort(403); }
    
    // Ambil semua bookingan, urutkan yang terbaru di atas
    $bookings = Booking::with(['user', 'room'])->latest()->get();
    
    return view('admin.bookings.index', compact('bookings'));
}
    // Fungsi Cetak PDF
    public function downloadTicket($id)
    {
        // 1. Cari data booking berdasarkan ID
        $booking = Booking::with('room', 'user')->findOrFail($id);

        // 2. Pastikan hanya pemilik atau admin yang bisa download
        if (auth()->user()->role !== 'admin' && $booking->user_id !== auth()->id()) {
            abort(403);
        }

        // 3. Pastikan statusnya sudah APPROVED (Kalau pending gaboleh cetak surat)
        if ($booking->status !== 'approved') {
            return back()->with('error', 'Eits! Tunggu disetujui dulu baru bisa cetak surat.');
        }

        // 4. Load View PDF (Kita buat habis ini)
        $pdf = Pdf::loadView('pdf.tiket', compact('booking'));

        // 5. Download file
        return $pdf->download('Tiket-SaintekSpace-'.$booking->id.'.pdf');
    }
    // FUNGSI UNTUK ACC / REJECT PEMINJAMAN
public function updateStatus(Request $request, $id)
{
    // 1. Validasi input
    $request->validate([
        'status' => 'required|in:approved,rejected',
    ]);

    // 2. Cari data booking-nya
    $booking = Booking::findOrFail($id);

    // 3. Update statusnya
    $booking->update([
        'status' => $request->status
    ]);

    // 4. Update status ruangan (Opsional)
    // Jika di-acc, kita bisa set ruangan jadi 'penuh', jika direject atau selesai set 'tersedia'
    $room = \App\Models\Room::find($booking->room_id);
    if ($request->status == 'approved') {
        $room->update(['status' => 'penuh']);
    } else {
        $room->update(['status' => 'tersedia']);
    }

    // 5. Kembali ke halaman admin dengan pesan sukses
    return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui ke: ' . strtoupper($request->status));
}
}