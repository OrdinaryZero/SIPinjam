<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\QuickBookingController;
use App\Http\Controllers\AdminRoomController;

// 1. HALAMAN UTAMA (WELCOME)
Route::get('/', function () {
    return view('welcome');
});

// 2. GRUP HALAMAN YANG BUTUH LOGIN (AUTH)
Route::middleware(['auth', 'verified'])->group(function () {

    // --- DASHBOARD USER ---
    // Dashboard Galeri Ruangan


Route::get('/dashboard', function (Request $request) {
    // 1. Ambil semua data ruangan
    $rooms = \App\Models\Room::all(); 
    
    // 2. TANGKAP ID RUANGAN (Ini yang tadi menyebabkan error)
    $selectedRoomId = $request->query('room_id');

    // 3. Ambil riwayat booking (agar tabel riwayat tidak error)
    $myBookings = \App\Models\Booking::where('user_id', auth()->id())->get();

    // 4. Kirim SEMUA variabel ke view
    return view('dashboard', compact('rooms', 'selectedRoomId', 'myBookings'));
})->name('dashboard');

    Route::get('/denah', [App\Http\Controllers\RoomController::class, 'denah'])->name('denah')->middleware(['auth']);

    // Halaman Form Peminjaman & Riwayat
 // Route untuk halaman peminjaman
Route::get('/peminjaman', [App\Http\Controllers\BookingController::class, 'index'])->name('peminjaman');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    
    // Fitur Download PDF
    Route::get('/booking/{id}/download', [BookingController::class, 'downloadTicket'])->name('booking.download');

    // Halaman About Us
    Route::get('/about', function () {
        return view('about');
    })->name('about');


    // --- JALUR KHUSUS ADMIN PANEL ---
    // Kita pakai prefix 'admin' agar rapi
    Route::prefix('admin')->group(function () {

        Route::post('/admin/rooms/{id}/reset', [AdminRoomController::class, 'resetStatus'])->name('admin.rooms.reset');
        
        // Halaman Awal Admin (Otomatis ke List Ruangan)
        Route::get('/', function () {
            return redirect()->route('admin.rooms.index');
        })->name('admin.dashboard');

        // CRUD Kelola Ruangan (Sultan Mode)
        Route::resource('rooms', RoomController::class)->names([
            'index' => 'admin.rooms.index',
            'create' => 'admin.rooms.create',
            'store' => 'admin.rooms.store',
            'edit' => 'admin.rooms.edit',
            'update' => 'admin.rooms.update',
            'destroy' => 'admin.rooms.destroy',
        ]);

        // KELOLA PEMINJAMAN (Approval/Reject)
        // Rute ini yang tadi error karena belum ada
        Route::get('/bookings', [BookingController::class, 'allBookings'])->name('admin.bookings.index');
        Route::patch('/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.update');
    });


    // --- PROFILE USER (Bawaan Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



// Route untuk halaman Scan QR (GET)
Route::get('/scan/{room_id}', [QuickBookingController::class, 'show'])->name('scan.show');

// Route untuk memproses booking cepat (POST)
Route::post('/scan/process', [QuickBookingController::class, 'store'])->name('scan.store');
});

require __DIR__.'/auth.php';