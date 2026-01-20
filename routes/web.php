<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Middleware\IsAdmin;

// 1. HALAMAN UTAMA (WELCOME)
Route::get('/', function () {
    return view('welcome');
});

// 2. GRUP HALAMAN YANG BUTUH LOGIN (AUTH)
Route::middleware(['auth', 'verified'])->group(function () {

    // --- DASHBOARD USER ---
    Route::get('/dashboard', function (Request $request) {
        $rooms = \App\Models\Room::all(); 
        $selectedRoomId = $request->query('room_id');
        $myBookings = \App\Models\Booking::where('user_id', auth()->id())->get();

        return view('dashboard', compact('rooms', 'selectedRoomId', 'myBookings'));
    })->name('dashboard');

    // PERBAIKAN 1: Nama route diganti jadi 'denah3d' biar sinkron sama menu HP
    Route::get('/denah', [RoomController::class, 'denah'])->name('denah3d');

    // Halaman Form Peminjaman & Riwayat
    Route::get('/peminjaman', [BookingController::class, 'index'])->name('peminjaman');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    
    // Fitur Download PDF
    Route::get('/booking/{id}/download', [BookingController::class, 'downloadTicket'])->name('booking.download');

    // Halaman About Us
    Route::get('/about', function () {
        return view('about');
    })->name('about');


    // --- JALUR KHUSUS ADMIN PANEL (PERBAIKAN KEAMANAN) ---
    // Kita tambahkan pengecekan: Kalau bukan admin, tendang keluar!
   // --- JALUR KHUSUS ADMIN PANEL (YANG SUDAH DIPERBAIKI) ---
    // Kita panggil IsAdmin::class sebagai satpamnya
    Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
        
        // Halaman Awal Admin
        Route::get('/', function () {
            return redirect()->route('admin.rooms.index');
        })->name('admin.dashboard');

        // CRUD Kelola Ruangan
        Route::resource('rooms', RoomController::class)->names([
            'index' => 'admin.rooms.index',
            'create' => 'admin.rooms.create',
            'store' => 'admin.rooms.store',
            'edit' => 'admin.rooms.edit',
            'update' => 'admin.rooms.update',
            'destroy' => 'admin.rooms.destroy',
        ]);

        // KELOLA PEMINJAMAN
        Route::get('/bookings', [BookingController::class, 'allBookings'])->name('admin.bookings.index');
        Route::patch('/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.update');
    });

    // --- PROFILE USER ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';