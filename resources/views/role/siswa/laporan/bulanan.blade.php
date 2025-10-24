<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan Siswa</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h1,
        h2,
        h3,
        h4 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f1f1f1;
        }

        .summary {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Bulanan Siswa</h2>
    <p><strong>Nama:</strong> {{ $siswa->name }}</p>
    <p><strong>Periode:</strong> {{ \Carbon\Carbon::createFromDate($tahun, $bulan)->translatedFormat('F Y') }}</p>

    <div class="summary">
        <table>
            <tr>
                <th>Total Kelas</th>
                <th>Total Hadir</th>
                <th>Total Tidak Hadir</th>
                <th>Rata-rata Nilai</th>
            </tr>
            <tr>
                <td>{{ $totalKelas }}</td>
                <td>{{ $totalHadir }}</td>
                <td>{{ $totalTidakHadir }}</td>
                <td>{{ number_format($rataNilai, 2) }}</td>
            </tr>
        </table>
    </div>

    <h4 style="margin-top: 20px;">Daftar Kelas Bulan Ini</h4>
    <table>
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Guru Pengajar</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Jumlah Peserta</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwal as $j)
                <tr>
                    <td>{{ $j->title }}</td>
                    <td>{{ $j->teachers->first()->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->start_time)->format('d M Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->end_time)->format('d M Y H:i') }}</td>
                    <td>{{ $j->users->count() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Tidak ada kelas di bulan ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p style="text-align: right; margin-top: 40px;">
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
    </p>
</body>

</html>
