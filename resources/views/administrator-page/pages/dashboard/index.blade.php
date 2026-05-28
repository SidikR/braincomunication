@extends('dashboard.layouts.main')
@section('content')
    <style>
        .dashboard-welcome {
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            border-radius: 16px;
            padding: 28px 32px;
            color: white;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-welcome::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .dashboard-welcome::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: 60px;
            width: 260px;
            height: 260px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .welcome-subtitle {
            opacity: 0.85;
            font-size: 0.95rem;
        }

        .stat-card {
            border-radius: 14px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            transition: transform .18s, box-shadow .18s;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.13);
        }

        .stat-card .card-body {
            padding: 20px 22px;
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-label {
            font-size: 0.78rem;
            color: #8a8d93;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 1.9rem;
            font-weight: 700;
            line-height: 1.1;
            color: #1e2330;
        }

        .stat-badge {
            font-size: 0.72rem;
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: 600;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1e2330;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .chart-card {
            border-radius: 14px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        }

        .chart-card .card-header {
            background: transparent;
            border-bottom: 1px solid #f0f0f0;
            padding: 16px 20px;
        }

        .chart-card .card-body {
            padding: 20px;
        }

        .pesan-item {
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f5;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pesan-item:last-child {
            border-bottom: none;
        }

        .pesan-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e8f0fe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a73e8;
            font-weight: 700;
            font-size: .9rem;
            flex-shrink: 0;
        }

        .pesan-name {
            font-weight: 600;
            font-size: 0.88rem;
            color: #1e2330;
        }

        .pesan-preview {
            font-size: 0.78rem;
            color: #8a8d93;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 260px;
        }

        .pesan-time {
            font-size: 0.72rem;
            color: #b0b3ba;
            margin-left: auto;
            white-space: nowrap;
        }

        .badge-baru {
            background: #fff3cd;
            color: #856404;
            font-size: 0.68rem;
            padding: 2px 7px;
            border-radius: 10px;
        }

        .quick-action-card {
            border-radius: 14px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            padding: 20px;
            text-align: center;
            transition: transform .15s, box-shadow .15s;
            text-decoration: none;
            display: block;
        }

        .quick-action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .quick-action-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 10px;
        }

        .quick-action-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #3d4255;
        }

        .progress-bar-custom {
            height: 8px;
            border-radius: 4px;
        }

        .icon-blue {
            background: #e8f0fe;
            color: #1a73e8;
        }

        .icon-green {
            background: #e6f4ea;
            color: #2e7d32;
        }

        .icon-orange {
            background: #fff3e0;
            color: #e65100;
        }

        .icon-purple {
            background: #f3e5f5;
            color: #6a1b9a;
        }

        .icon-teal {
            background: #e0f2f1;
            color: #00695c;
        }

        .icon-red {
            background: #fce4ec;
            color: #c62828;
        }

        .icon-indigo {
            background: #e8eaf6;
            color: #283593;
        }

        .icon-amber {
            background: #fff8e1;
            color: #ff6f00;
        }
    </style>

    <div class="page-inner">

        {{-- Welcome Banner --}}
        <div class="dashboard-welcome">
            <div class="d-flex align-items-center justify-content-between position-relative" style="z-index:1">
                <div>
                    <h4 class="mb-1 fw-bold" style="font-size:1.5rem">Selamat Datang, {{ Auth::user()->name }}!</h4>
                    <p class="welcome-subtitle mb-0">
                        <i class="fas fa-shield-alt me-1"></i> Administrator &nbsp;|&nbsp;
                        <i class="fas fa-calendar-alt me-1"></i> {{ now()->translatedFormat('l, d F Y') }}
                    </p>
                </div>
                <div class="text-end d-none d-md-block" style="opacity:.8">
                    <i class="fas fa-user-shield" style="font-size:3.5rem"></i>
                </div>
            </div>
        </div>

        {{-- Row 1: User Stats --}}
        <div class="section-title">
            <span class="dot bg-primary"></span> Statistik Pengguna
        </div>
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-blue"><i class="fas fa-users"></i></div>
                        <div>
                            <div class="stat-label">Total Pengguna</div>
                            <div class="stat-value">{{ $total_user }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-purple"><i class="fas fa-chalkboard-teacher"></i></div>
                        <div>
                            <div class="stat-label">Staf Pengajar</div>
                            <div class="stat-value">{{ $staf_pengajar_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-orange"><i class="fas fa-user-graduate"></i></div>
                        <div>
                            <div class="stat-label">Siswa</div>
                            <div class="stat-value">{{ $siswa_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-teal"><i class="fas fa-user-tie"></i></div>
                        <div>
                            <div class="stat-label">Staf Administrasi</div>
                            <div class="stat-value">{{ $staf_administrasi_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 2: Content & Learning Stats --}}
        <div class="section-title">
            <span class="dot bg-success"></span> Statistik Konten & Pembelajaran
        </div>
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-indigo"><i class="fas fa-newspaper"></i></div>
                        <div>
                            <div class="stat-label">Total Berita</div>
                            <div class="stat-value">{{ $berita_count }}</div>
                            <div class="d-flex gap-1 mt-1">
                                <span class="stat-badge bg-success bg-opacity-15 text-white">{{ $berita_publish_count }}
                                    Publish</span>
                                <span class="stat-badge bg-secondary bg-opacity-15 text-white">{{ $berita_unpublish_count }}
                                    Draft</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-amber"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div class="stat-label">Total Pesan</div>
                            <div class="stat-value">{{ $pesan_count }}</div>
                            @if ($jumlah_pesan_baru > 0)
                                <span class="stat-badge bg-warning bg-opacity-20 text-warning">{{ $jumlah_pesan_baru }}
                                    Baru</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-teal"><i class="fas fa-images"></i></div>
                        <div>
                            <div class="stat-label">Galeri Foto</div>
                            <div class="stat-value">{{ $galeri_foto_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-red"><i class="fas fa-video"></i></div>
                        <div>
                            <div class="stat-label">Galeri Video</div>
                            <div class="stat-value">{{ $galeri_video_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 3: More Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-blue"><i class="fas fa-concierge-bell"></i></div>
                        <div>
                            <div class="stat-label">Layanan</div>
                            <div class="stat-value">{{ $layanan_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-purple"><i class="fas fa-id-card"></i></div>
                        <div>
                            <div class="stat-label">Pejabat</div>
                            <div class="stat-value">{{ $pejabat_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-green"><i class="fas fa-calendar-alt"></i></div>
                        <div>
                            <div class="stat-label">Jadwal Belajar</div>
                            <div class="stat-value">{{ $jadwal_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon icon-orange"><i class="fas fa-book"></i></div>
                        <div>
                            <div class="stat-label">Mata Pelajaran</div>
                            <div class="stat-value">{{ $mata_pelajaran_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 4: Charts + Recent Pesan --}}
        <div class="row g-3 mb-4">
            {{-- Berita Chart --}}
            <div class="col-md-5">
                <div class="chart-card card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold" style="font-size:.9rem"><i
                                class="fas fa-chart-pie me-2 text-primary"></i>Status Berita</span>
                        <a href="{{ route('dashboard.administrator.berita.index') }}"
                            class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size:.75rem">Kelola</a>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <canvas id="beritaChart" height="200"></canvas>
                        <div class="d-flex gap-4 mt-3">
                            <div class="text-center">
                                <div class="fw-bold text-success" style="font-size:1.4rem">{{ $berita_publish_count }}
                                </div>
                                <div style="font-size:.75rem;color:#8a8d93">Dipublikasikan</div>
                            </div>
                            <div class="text-center">
                                <div class="fw-bold text-secondary" style="font-size:1.4rem">
                                    {{ $berita_unpublish_count }}</div>
                                <div style="font-size:.75rem;color:#8a8d93">Draft</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pesan Chart --}}
            <div class="col-md-3">
                <div class="chart-card card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold" style="font-size:.9rem"><i
                                class="fas fa-envelope me-2 text-warning"></i>Status Pesan</span>
                        <a href="{{ route('dashboard.administrator.pesan.index') }}"
                            class="btn btn-sm btn-outline-warning py-0 px-2" style="font-size:.75rem">Lihat</a>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center gap-3">
                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span style="font-size:.8rem;font-weight:600">Pesan Baru</span>
                                <span class="fw-bold text-warning">{{ $jumlah_pesan_baru }}</span>
                            </div>
                            <div class="progress" style="height:10px;border-radius:5px">
                                <div class="progress-bar bg-warning"
                                    style="width:{{ $pesan_count > 0 ? round(($jumlah_pesan_baru / $pesan_count) * 100) : 0 }}%">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span style="font-size:.8rem;font-weight:600">Sudah Dibaca</span>
                                <span class="fw-bold text-success">{{ $jumlah_pesan_dibaca }}</span>
                            </div>
                            <div class="progress" style="height:10px;border-radius:5px">
                                <div class="progress-bar bg-success"
                                    style="width:{{ $pesan_count > 0 ? round(($jumlah_pesan_dibaca / $pesan_count) * 100) : 0 }}%">
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-2 pt-2 border-top">
                            <div style="font-size:.75rem;color:#8a8d93">Total Pesan Masuk</div>
                            <div class="fw-bold" style="font-size:1.6rem;color:#1e2330">{{ $pesan_count }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Messages --}}
            <div class="col-md-4">
                <div class="chart-card card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold" style="font-size:.9rem"><i class="fas fa-bell me-2 text-danger"></i>Pesan
                            Terbaru</span>
                        <a href="{{ route('dashboard.administrator.pesan.index') }}"
                            class="btn btn-sm btn-outline-danger py-0 px-2" style="font-size:.75rem">Semua</a>
                    </div>
                    <div class="card-body" style="padding:12px 16px">
                        @forelse($pesan_terbaru as $pesan)
                            <div class="pesan-item">
                                <div class="pesan-avatar">{{ strtoupper(substr($pesan->nama ?? 'U', 0, 1)) }}</div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex align-items-center gap-1">
                                        <span class="pesan-name">{{ $pesan->nama ?? 'Anonim' }}</span>
                                        @if (!$pesan->dilihat)
                                            <span class="badge-baru">Baru</span>
                                        @endif
                                    </div>
                                    <div class="pesan-preview">{{ $pesan->pesan ?? '-' }}</div>
                                </div>
                                <div class="pesan-time">{{ $pesan->created_at->diffForHumans() }}</div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                <small>Belum ada pesan</small>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="section-title">
            <span class="dot bg-warning"></span> Aksi Cepat
        </div>
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-2">
                <a href="{{ route('dashboard.administrator.berita.create') }}" class="quick-action-card"
                    style="background:#e8f0fe">
                    <div class="quick-action-icon icon-blue"><i class="fas fa-plus-circle"></i></div>
                    <div class="quick-action-label">Tambah Berita</div>
                </a>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('dashboard.administrator.user.index') }}" class="quick-action-card"
                    style="background:#e6f4ea">
                    <div class="quick-action-icon icon-green"><i class="fas fa-users-cog"></i></div>
                    <div class="quick-action-label">Kelola User</div>
                </a>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('dashboard.administrator.galeri.index') }}" class="quick-action-card"
                    style="background:#e0f2f1">
                    <div class="quick-action-icon icon-teal"><i class="fas fa-images"></i></div>
                    <div class="quick-action-label">Kelola Galeri</div>
                </a>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('dashboard.administrator.pesan.index') }}" class="quick-action-card"
                    style="background:#fff3e0">
                    <div class="quick-action-icon icon-amber"><i class="fas fa-envelope-open-text"></i></div>
                    <div class="quick-action-label">Baca Pesan</div>
                </a>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('dashboard.administrator.pejabat.index') }}" class="quick-action-card"
                    style="background:#f3e5f5">
                    <div class="quick-action-icon icon-purple"><i class="fas fa-id-card"></i></div>
                    <div class="quick-action-label">Data Pejabat</div>
                </a>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('dashboard.administrator.layanan.index') }}" class="quick-action-card"
                    style="background:#fce4ec">
                    <div class="quick-action-icon icon-red"><i class="fas fa-concierge-bell"></i></div>
                    <div class="quick-action-label">Kelola Layanan</div>
                </a>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('beritaChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Dipublikasikan', 'Draft'],
                    datasets: [{
                        data: [{{ $berita_publish_count }}, {{ $berita_unpublish_count }}],
                        backgroundColor: ['#34a853', '#9e9e9e'],
                        borderWidth: 0,
                        hoverOffset: 6
                    }]
                },
                options: {
                    cutout: '72%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(ctx) {
                                    return ' ' + ctx.label + ': ' + ctx.parsed;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
