@extends('dashboard.layouts.main')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dashboard Staf Administrasi</h4>
        </div>

        <div class="container">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h6>Total Guru</h6>
                            <h3>{{ $totalGuru }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h6>Total Siswa</h6>
                            <h3>{{ $totalSiswa }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h6>Rata Kehadiran Siswa</h6>
                            <h3>{{ number_format($rataKehadiranSiswa, 2) }}%</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h6>Rata Nilai Siswa</h6>
                            <h3>{{ number_format($rataNilaiSiswa, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="card">
                <div class="card-header">
                    <form action="{{ route('dashboard.staf_administrasi.export.hasilAkhir') }}" method="GET"
                        class="row g-3 align-items-end">

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Periode Awal</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Periode Akhir</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Nilai KKM</label>
                            <input type="number" name="kkm" class="form-control" value="70" min="0"
                                max="100" required>
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-file-earmark-excel"></i> Export Excel
                            </button>
                        </div>

                    </form>
                    <small class="text-muted d-block mt-2">
                        Jika periode dikosongkan, maka sistem akan mengekspor <strong>semua data hasil
                            pembelajaran</strong>.
                    </small>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Pengajar</h4>
                    <div class="d-flex row align-items-end">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Periode Bulan</label>
                            <input type="month" name="periode" class="form-control"
                                value="{{ $tahun }}-{{ $bulan }}">
                        </div>
                        <div class="col-md-6">
                            {{-- <button class="btn btn-primary">Tampilkan</button> --}}
                            <a href="{{ route('dashboard.staf_administrasi.laporan.export', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                                class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Pengajar</th>
                                <th>Total Kelas</th>
                                <th>Total Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                @php
                                    $totalKelas = $teacher->schedulesAsTeacher->count();
                                    $totalSiswa = $teacher->schedulesAsTeacher
                                        ->flatMap(fn($j) => $j->users)
                                        ->unique('id')
                                        ->count();
                                @endphp
                                <tr>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $totalKelas }}</td>
                                    <td>{{ $totalSiswa }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
