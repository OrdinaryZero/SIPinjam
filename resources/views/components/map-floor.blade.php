@props(['floor', 'rooms'])

@php
    $floorRooms = $rooms->where('lokasi_lantai', $floor)->values();

    // Setting Grid
    $startX = 400; 
    $startY = 100;
    $offsetX = 60;  
    $offsetY = 35;  
    $cols = 4; 
@endphp

<g opacity="0.1">
    @for($i = 0; $i <= 10; $i++)
        <path d="M{{ 100 + ($i*30) }} {{ 210 - ($i*15) }} L{{ 400 + ($i*30) }} {{ 360 - ($i*15) }}" stroke="white" stroke-width="1" />
        <path d="M{{ 100 + ($i*30) }} {{ 210 + ($i*15) }} L{{ 400 + ($i*30) }} {{ 60 + ($i*15) }}" stroke="white" stroke-width="1" />
    @endfor
</g>

@foreach($floorRooms as $index => $room)
    @php
        $row = floor($index / $cols);
        $col = $index % $cols;

        $x = $startX + ($col - $row) * $offsetX;
        $y = $startY + ($col + $row) * $offsetY;

        // BERSIHKAN STATUS
        $statusRaw = strtolower(trim($room->status));

        // LOGIKA WARNA (Perbaikan Variable Name)
        $isAvailable = ($statusRaw == 'tersedia' || $statusRaw == 'available');

        if ($isAvailable) {
            // TEMA: AVAILABLE (PUTIH MATTE)
            $topColor    = '#f8fafc'; // Putih
            $leftColor   = '#94a3b8'; // Abu shadow
            $rightColor  = '#cbd5e1'; // Abu terang
            $strokeColor = '#64748b'; // Garis abu
            $textColor   = '#0f172a'; // Teks Hitam
        } else {
            // TEMA: BOOKED (MERAH SOLID)
            $topColor    = '#ef4444'; // Merah (Red-500)
            $leftColor   = '#7f1d1d'; // Merah Gelap (Red-900)
            $rightColor  = '#b91c1c'; // Merah Sedang (Red-700)
            $strokeColor = '#450a0a'; // Garis Merah Tua
            $textColor   = '#ffffff'; // Teks Putih
        }
    @endphp

    <g class="cursor-pointer transition-transform duration-300 hover:-translate-y-2 group"
       @click="activeRoom = {{ $room }}">
        
        <path d="M{{ $x }} {{ $y + 50 }} L{{ $x + 30 }} {{ $y + 65 }} L{{ $x - 30 }} {{ $y + 65 }} Z" fill="black" opacity="0.3" class="blur-[1px]" />

        <path d="M{{ $x }} {{ $y + 10 }} L{{ $x }} {{ $y + 50 }} L{{ $x - 30 }} {{ $y + 35 }} L{{ $x - 30 }} {{ $y - 5 }} Z" 
              fill="{{ $leftColor }}" stroke="{{ $strokeColor }}" stroke-width="0.5"/>
        
        <path d="M{{ $x }} {{ $y + 10 }} L{{ $x }} {{ $y + 50 }} L{{ $x + 30 }} {{ $y + 35 }} L{{ $x + 30 }} {{ $y - 5 }} Z" 
              fill="{{ $rightColor }}" stroke="{{ $strokeColor }}" stroke-width="0.5"/>

        <path d="M{{ $x }} {{ $y + 10 }} L{{ $x + 30 }} {{ $y - 5 }} L{{ $x }} {{ $y - 20 }} L{{ $x - 30 }} {{ $y - 5 }} Z" 
              fill="{{ $topColor }}" stroke="{{ $strokeColor }}" stroke-width="0.5" />

        <text x="{{ $x }}" y="{{ $y - 8 }}" 
              text-anchor="middle" 
              fill="{{ $textColor }}" 
              font-family="sans-serif" 
              font-size="9" 
              font-weight="800"
              style="pointer-events: none; text-transform: uppercase; text-shadow: 0 1px 2px rgba(0,0,0,0.1);">
            {{ Str::limit($room->nama_ruangan, 10) }}
        </text>

    </g>
@endforeach

@if($floorRooms->isEmpty())
    <text x="400" y="250" text-anchor="middle" fill="#64748b" font-family="sans-serif" font-size="14">
        (LANTAI KOSONG)
    </text>
@endif