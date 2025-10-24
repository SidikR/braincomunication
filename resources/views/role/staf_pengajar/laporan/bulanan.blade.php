<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan Staf Pengajar</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }

        .info {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Laporan Bulanan Staf Pengajar</h2>
    <h4>Bulan {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }}</h4>
    <hr>

    <div class="info">
        <strong>Nama Pengajar:</strong> {{ $teacher->name }} <br>
        <strong>Email:</strong> {{ $teacher->email }} <br>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Jumlah Siswa</th>
                <th>Pertemuan</th>
                <th>Rata Kehadiran</th>
                <th>Rata Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row['kelas'] }}</td>
                    <td>{{ $row['jumlah_siswa'] }}</td>
                    <td>{{ $row['jumlah_pertemuan'] }}</td>
                    <td>{{ $row['rata_kehadiran'] }}%</td>
                    <td>{{ $row['rata_nilai'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data untuk bulan ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p style="margin-top: 40px; text-align: right;">
        <em>Dicetak pada {{ now()->format('d F Y H:i') }}</em>
    </p>
</body>

</html>
