<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Belajar Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        h1,
        h2,
        h3 {
            text-align: start;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 0px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .header-table {
            margin-bottom: 40px;
        }

        .header-table td {
            border: none;
            padding: 0;
        }

        .footer {
            margin-bottom: 20px;
            font-size: 10px;
            color: gray;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">Laporan Belajar Pengajar</h1>

    <!-- Tabel Nilai Siswa -->
    <h3>Informasi Pelajaran</h3>
    <table style="border: none">
        <thead>
            <tr>
                <th style="width: 100px"><strong>Mata Pelajaran</strong></th>
                <td>{{ $jadwalBelajar->mataPelajaran->nama_mata_pelajaran }}</td>
            </tr>
            <tr>
                <th style="width: 100px"><strong>Pengajar</strong></th>
                <td>
                    @php
                        $count = count($teachers);
                    @endphp

                    @if ($count > 1)
                        @foreach ($teachers as $index => $item)
                            {{ $item->name }}
                            @if ($index < $count - 2)
                                ,
                            @elseif ($index === $count - 2)
                                dan
                            @endif
                        @endforeach
                    @else
                        {{ $teachers->first()->name }}
                    @endif

                </td>
            </tr>
            <tr>
                <th style="width: 100px"><strong>Tanggal</strong></th>
                <td>{{ \Carbon\Carbon::parse($jadwalBelajar->start_time)->format('l') }},
                    {{ \Carbon\Carbon::parse($jadwalBelajar->start_time)->format('Y-m-d') }} -
                    {{ \Carbon\Carbon::parse($jadwalBelajar->end_time)->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <th style="width: 100px"><strong>Pukul / Jam</strong></th>
                <td>{{ \Carbon\Carbon::parse($jadwalBelajar->start_time)->format('H:i:s') }} -
                    {{ \Carbon\Carbon::parse($jadwalBelajar->end_time)->format('H:i:s') }} WIB</td>
            </tr>
            <tr>
                <th style="width: 100px"><strong>Keterangan</strong></th>
                <td>{{$jadwalBelajar->keterangan}}</td>
            </tr>
        </thead>
    </table>

    <br>

    <!-- Tabel Nilai Siswa -->
    <h3>Daftar Nilai Siswa</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 20px">No</th>
                <th style="width: 20px">Nama Siswa</th>
                <th style="width: 20px">Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilaiSiswa as $index => $nilai)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $nilai->user->name }}</td>
                    <td>{{ $nilai->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <!-- Tabel Presensi Siswa -->
    <h3>Daftar Presensi Siswa</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensiSiswa as $index => $presensi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $presensi->user->name }}</td>
                    <td>{{ $presensi->kehadiran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

     <div class="footer" style="margin-top: 50px; position: fixed; bottom: 0; width: 100%;">
         <p>Dicetak melalui Sistem Informasi Brainco pada {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }} dari IP {{ request()->ip() }}</p>
    </div>
</body>

</html>
