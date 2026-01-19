@php
    // Ambil ruangan berdasarkan angka lantai (1, 2, atau 3)
    $floorRooms = $rooms->filter(function($r) use ($floor) {
        return str_contains($r->lokasi_lantai, (string)$floor);
    });
    
    // Koordinat yang sudah saya sesuaikan agar berjarak rapi
    $coords = [
        ['150,150 300,225 150,300 0,225', '70', '235'],   // Kiri
        ['410,150 560,225 410,300 260,225', '330', '235'], // Atas
        ['260,230 410,305 260,380 110,305', '180', '315'], // Tengah
        ['520,230 670,305 520,380 370,305', '440', '315']  // Kanan
    ];
@endphp

@foreach($floorRooms->values() as $index => $room)
    @if($index < 4)
    <a href="{{ route('peminjaman', ['room_id' => $room->id]) }}" class="room-group">
        <polygon points="{{ $coords[$index][0] }}" 
            class="room-path stroke-white/10 transition-all duration-500 {{ $room->status == 'tersedia' ? 'fill-white' : 'fill-zinc-900 opacity-60' }}" />
        
        <text x="{{ $coords[$index][1] }}" y="{{ $coords[$index][2] }}" 
            class="text-[14px] font-black italic tracking-tighter pointer-events-none {{ $room->status == 'tersedia' ? 'fill-black' : 'fill-white/20' }}">
            {{ strtoupper($room->nama_ruangan) }}
        </text>
    </a>
    @endif
@endforeach