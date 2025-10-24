<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Mengajar Bulan {{ $bulan }}/{{ $tahun }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>{{ getInfo()->title }}</h2>
    <h4>Laporan Aktivitas Mengajar Bulan {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
        {{ $tahun }}</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengajar</th>
                <th>Total Kelas</th>
                <th>Total Siswa Diajarkan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $i => $teacher)
                @php
                    $totalKelas = $teacher->schedulesAsTeacher->count();
                    $totalSiswa = $teacher->schedulesAsTeacher->flatMap(fn($j) => $j->users)->unique('id')->count();
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $totalKelas }}</td>
                    <td>{{ $totalSiswa }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        <p>Mengetahui,</p>
        <p><strong>Kepala Administrasi</strong></p>
        <br><br><br>
        <p>(___________________)</p>
    </div>
</body>

</html>
