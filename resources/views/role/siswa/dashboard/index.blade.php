@extends('dashboard.layouts.main')
@section('content')
    <div class="page-inner">
        {{-- <div class="page-header mb-4">
            <h3 class="fw-bold">Dashboard Siswa</h3>
        </div> --}}

        <div class="page-header d-flex justify-content-between align-items-center mb-4">
            <h4 class="page-title mb-0">Dashboard Siswa</h4>

            <form method="get" action="{{ route('dashboard.siswa.laporan.export_bulanan') }}" class="d-flex gap-2">
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

        {{-- Statistik ringkas --}}
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3 text-center p-3">
                    <h6 class="text-muted mb-1">Total Jadwal</h6>
                    <h3 class="fw-bold">{{ $totalJadwal }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3 text-center p-3">
                    <h6 class="text-muted mb-1">Jadwal Aktif</h6>
                    <h3 class="fw-bold text-success">{{ $jadwalAktif }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3 text-center p-3">
                    <h6 class="text-muted mb-1">Rata-rata Nilai</h6>
                    <h3 class="fw-bold text-primary">{{ $rataNilai ? number_format($rataNilai, 2) : '-' }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3 text-center p-3">
                    <h6 class="text-muted mb-1">Kehadiran</h6>
                    <h3 class="fw-bold text-warning">{{ $persentaseKehadiran }}%</h3>
                </div>
            </div>
        </div>

        {{-- Grafik nilai per mapel --}}
        <div class="card mt-4 shadow-sm border-0 rounded-3">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Grafik Nilai Per Mata Pelajaran</h5>
                <canvas id="chartNilai"></canvas>
            </div>
        </div>

        {{-- Jadwal terbaru --}}
        <div class="card mt-4 shadow-sm border-0 rounded-3">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Jadwal Terbaru</h5>
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Mata Pelajaran</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwalTerbaru as $index => $j)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $j->title }}</td>
                                <td>{{ $j->mataPelajaran->nama ?? '-' }}</td>
                                <td>{{ $j->start_time }} - {{ $j->end_time }}</td>
                                <td>
                                    @if ($j->status == 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($j->status == 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tombol export --}}
        <div class="mt-4 text-end">
            <a href="{{ route('dashboard.siswa.laporan.export') }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Export Laporan
            </a>
        </div>
    </div>

    {{-- ChartJS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartNilai').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($nilaiPerMapel->keys()) !!},
                datasets: [{
                    label: 'Nilai Rata-rata',
                    data: {!! json_encode($nilaiPerMapel->values()) !!},
                    borderWidth: 1,
                    backgroundColor: '#3b82f6'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>
@endsection
