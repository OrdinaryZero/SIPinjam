<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-white mb-6">Tambah Ruangan Baru</h2>

            <div class="bg-zinc-900/60 border border-white/10 rounded-2xl p-8 shadow-xl">
                <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-400 mb-2">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" class="w-full bg-black/50 border border-white/10 rounded-xl text-white px-4 py-3 focus:ring-indigo-500" required placeholder="Contoh: Lab Komputer B">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">Kapasitas (Orang)</label>
                            <input type="number" name="kapasitas" class="w-full bg-black/50 border border-white/10 rounded-xl text-white px-4 py-3" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">Lokasi</label>
                            <input type="text" name="lokasi_lantai" class="w-full bg-black/50 border border-white/10 rounded-xl text-white px-4 py-3" required placeholder="Contoh: Lantai 3">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-400 mb-2">Fasilitas</label>
                        <textarea name="fasilitas" rows="3" class="w-full bg-black/50 border border-white/10 rounded-xl text-white px-4 py-3" required placeholder="AC, Proyektor, ..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-400 mb-2">Foto Ruangan</label>
                        <input type="file" name="gambar" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-white/10 file:text-white hover:file:bg-indigo-700 bg-black/20 rounded-xl border border-white/10">
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-6 py-3 bg-white text-indigo-400 font-bold rounded-xl hover:bg-gray-200 transition">Simpan Ruangan</button>
                        <a href="{{ route('admin.rooms.index') }}" class="px-6 py-3 bg-transparent text-gray-400 font-bold rounded-xl hover:text-white transition">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>