<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Perkembangan Belajar - {{ $siswa->name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .info { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #555; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Perkembangan Belajar</h2>
        <p><strong>Nama:</strong> {{ $siswa->name }} | <strong>Email:</strong> {{ $siswa->email }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Pembelajaran</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Nilai</th>
                <th>Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $i => $item)
                @php
                    $nilai = $item->nilaiSiswa->where('user_id', $siswa->id)->first()->nilai ?? '-';
                    $hadir = $item->kehadiranSiswa->where('user_id', $siswa->id)->count();
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->start_time }} - {{ $item->end_time }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ $nilai }}</td>
                    <td>{{ $hadir }} kali</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    <div style="text-align:right;">
        <p><strong>Tanggal Cetak:</strong> {{ now()->format('d M Y') }}</p>
    </div>
</body>
</html>
