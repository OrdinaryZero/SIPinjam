<!DOCTYPE html>
<html>
<head>
    <title>Bukti Peminjaman Ruangan</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; color: #000; }
        .header { text-align: center; border-bottom: 2px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .logo { width: 80px; position: absolute; left: 0; top: 0; }
        h1, h2, h3 { margin: 0; }
        h2 { font-size: 16px; text-transform: uppercase; }
        h3 { font-size: 12px; font-weight: normal; }
        .content { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 8px; vertical-align: top; }
        .label { width: 150px; font-weight: bold; }
        .status-box { 
            border: 2px solid #000; 
            padding: 10px; 
            text-align: center; 
            font-weight: bold; 
            font-size: 20px; 
            margin-top: 30px; 
            width: 200px;
            margin-left: auto; margin-right: auto;
        }
        .footer { margin-top: 50px; text-align: right; font-size: 12px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Fakultas Sains dan Teknologi</h2>
        <h2>Universitas Teknologi Digital</h2>
        <h3>Jl. Kode Pintar No. 101, Banjarmasin. Telp: (021) 123456</h3>
    </div>

    <center>
        <h3>SURAT IZIN PENGGUNAAN FASILITAS</h3>
        <p>Nomor: {{ $booking->id }}/SAINTEK/{{ date('Y') }}</p>
    </center>

    <div class="content">
        <p>Dengan ini menerangkan bahwa permohonan peminjaman ruangan yang diajukan oleh:</p>

        <table>
            <tr>
                <td class="label">Nama Peminjam</td>
                <td>: {{ $booking->user->name }}</td>
            </tr>
            <tr>
                <td class="label">NIM / ID</td>
                <td>: {{ $booking->user->email }}</td> </tr>
        </table>

        <p>Telah <strong>DISETUJUI</strong> untuk menggunakan fasilitas kampus dengan detail sebagai berikut:</p>

        <table border="1" style="border: 1px solid #000;">
            <tr>
                <td class="label" style="background-color: #eee;">Ruangan</td>
                <td>{{ $booking->room->nama_ruangan }} ({{ $booking->room->lokasi_lantai }})</td>
            </tr>
            <tr>
                <td class="label" style="background-color: #eee;">Tanggal</td>
                <td>{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td class="label" style="background-color: #eee;">Waktu</td>
                <td>{{ $booking->jam_mulai }} s/d {{ $booking->jam_selesai }}</td>
            </tr>
            <tr>
                <td class="label" style="background-color: #eee;">Keperluan</td>
                <td>{{ $booking->keperluan }}</td>
            </tr>
        </table>

        <div class="status-box">
            STATUS: APPROVED
        </div>

        <p style="font-size: 10px; margin-top: 20px; font-style: italic;">
            *Harap tunjukkan surat ini kepada petugas keamanan atau staff yang bertugas.<br>
            *Harap menjaga kebersihan dan ketertiban selama penggunaan ruangan.
        </p>
    </div>

    <div class="footer">
        <p>Banjarmasin, {{ date('d F Y') }}</p>
        <br><br><br>
        <p><u>Admin Saintek Space</u><br>Digital Signature</p>
    </div>

</body>
</html>