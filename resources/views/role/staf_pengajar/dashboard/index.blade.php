@extends('dashboard.layouts.main')

@section('content')
    <div class="page-inner">
        {{-- Header --}}
        <div class="page-header d-flex justify-content-between align-items-center mb-4">
            <h4 class="page-title mb-0">Dashboard Staf Pengajar</h4>

            <form method="get" action="{{ route('dashboard.staf_pengajar.laporan.export_bulanan') }}" class="d-flex gap-2">
                {{-- Pilihan Bulan --}}
                <select name="bulan" class="form-select" style="width: auto">
                    @foreach (range(1, 12) as $b)
                        <option value="{{ $b }}" {{ $b == request('bulan', now()->month) ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>

                {{-- Pilihan Tahun --}}
                <select name="tahun" class="form-select" style="width: auto">
                    @foreach (range(now()->year - 2, now()->year) as $t)
                        <option value="{{ $t }}" {{ $t == request('tahun', now()->year) ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-file-export me-1"></i> Export
                </button>
            </form>
        </div>

        {{-- Statistik Ringkas --}}
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card card-stats card-round shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6 class="fw-semibold text-primary mb-1">Total Kelas</h6>
                        <h2 class="fw-bold mb-0">{{ $totalKelas }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stats card-round shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6 class="fw-semibold text-success mb-1">Total Siswa</h6>
                        <h2 class="fw-bold mb-0">{{ $totalSiswa }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stats card-round shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6 class="fw-semibold text-info mb-1">Rata Kehadiran</h6>
                        <h2 class="fw-bold mb-0">{{ number_format($rataKehadiran * 100, 1) }}%</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stats card-round shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6 class="fw-semibold text-warning mb-1">Rata Nilai</h6>
                        <h2 class="fw-bold mb-0">{{ number_format($rataNilai, 1) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jadwal Terdekat --}}
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white fw-semibold">
                        Jadwal Terdekat
                    </div>

                    <div class="card-body">
                        @if ($jadwalTerdekat->isEmpty())
                            <p class="text-muted mb-0">Tidak ada jadwal terdekat.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Kelas</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>Jumlah Siswa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalTerdekat as $j)
                                            <tr>
                                                <td>{{ $j->title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($j->start_time)->translatedFormat('d M Y H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($j->end_time)->translatedFormat('d M Y H:i') }}</td>
                                                <td>{{ $j->users->where('role', 'siswa')->count() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
