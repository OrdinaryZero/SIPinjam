<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    // 1. Tampilkan Daftar Ruangan (Admin Panel)
    public function index()
    {
        // Cek apakah user admin? (Security simpel)
        if (auth()->user()->role !== 'admin') { abort(403); }

        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        if (auth()->user()->role !== 'admin') { abort(403); }
        return view('admin.rooms.create');
    }

    // 3. Simpan Data Baru (Termasuk Upload Foto)
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'kapasitas' => 'required|integer',
            'fasilitas' => 'required',
            'lokasi_lantai' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi Foto
        ]);

        $data = $request->all();

        // LOGIKA UPLOAD FOTO SULTAN
        if ($request->hasFile('gambar')) {
            // Simpan ke folder 'public/img/ruangan'
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/ruangan'), $filename);
            
            $data['gambar'] = $filename;
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    // 4. Tampilkan Form Edit
public function edit($id)
{
    $room = \App\Models\Room::findOrFail($id);
    return view('admin.rooms.edit', compact('room'));
}
    // 5. Update Data (Cek ganti foto atau tidak)
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        
        $request->validate([
            'nama_ruangan' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus foto lama kalau ada (Biar hemat storage)
            if ($room->gambar && file_exists(public_path('img/ruangan/' . $room->gambar))) {
                unlink(public_path('img/ruangan/' . $room->gambar));
            }

            // Upload foto baru
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/ruangan'), $filename);
            
            $data['gambar'] = $filename;
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil diupdate!');
    }

    // 6. Hapus Ruangan
    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        // Hapus fotonya juga
        if ($room->gambar && file_exists(public_path('img/ruangan/' . $room->gambar))) {
            unlink(public_path('img/ruangan/' . $room->gambar));
        }

        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan dihapus!');
    }
public function denah()
{
    // Mengambil semua ruangan untuk dipetakan ke denah
    $rooms = \App\Models\Room::all();
    return view('denah', compact('rooms'));
}
}

