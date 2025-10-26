@extends('dashboard.layouts.main')
@section('content')
    <div class="page-inner">

        {{-- Breadcrumbs --}}
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.index') }}">
                        <i class="icon-home text-primary"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.jadwal_belajar.index') }}">Data Jadwal
                        Belajar</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">{{ $data['page_name'] ?? '' }}</a>
                </li>
            </ul>
        </div>

        {{-- Konten --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="info d-flex gap-2 align-items-center">
                            <h4 class="card-title">Tabel {{ $data['page_name'] ?? '' }}</h4>
                            <span><i class="fas fa-clock text-primary"></i> <span id="result"></span></span>
                        </div>
                        <div class="button d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-primary p-2 py-1 fs-6 rounded-3"
                                onclick="editKeterangan('{{ $jadwalBelajarId }}')"><i class="fas fa-pencil-alt"></i> Edit
                                Keterangan Pelajaran</button>
                            <a
                                href="{{ route('dashboard.staf_pengajar.jadwal_belajar.pdf', ['jadwalBelajarId' => $jadwalBelajarId]) }}">
                                <button type="button" class="btn btn-sm btn-success p-2 py-1 fs-6 rounded-3"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Export Laporan : {{ $jadwalBelajar->title }}">
                                    <i class="fas fa-clipboard-list" aria-hidden="true"></i> Export Laporan
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="w-100 mb-4">
                            <tbody>
                                <tr>
                                    <td><strong>Title</strong></td>
                                    <td>: {{ $jadwalBelajar->title }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mata Pelajaran</strong></td>
                                    <td>: {{ $jadwalBelajar->mataPelajaran->nama_mata_pelajaran }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Waktu Mulai</strong></td>
                                    <td>:
                                        {{ \Carbon\Carbon::parse($jadwalBelajar->start_time)->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Waktu Selesai</strong></td>
                                    <td>:
                                        {{ \Carbon\Carbon::parse($jadwalBelajar->end_time)->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Keterangan</strong></td>
                                    <td>: {{ $jadwalBelajar->keterangan }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-3">
                            <h4 class="mb-3">📘 Materi Pembelajaran</h4>
                            @if ($materis->isEmpty())
                                <div class="alert alert-warning">Belum ada materi untuk mata pelajaran
                                    ini.</div>
                            @else
                                <div class="list-group shadow-sm rounded-3">
                                    @foreach ($materis as $materi)
                                        <a href="javascript:void(0)"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                            data-bs-toggle="modal" data-bs-target="#materiModal"
                                            data-judul="{{ $materi->judul }}" data-topik="{{ $materi->topik }}"
                                            data-deskripsi="{{ $materi->deskripsi }}"
                                            data-file="{{ asset('storage/' . $materi->file_path) }}">
                                            <div>
                                                <h6 class="mb-1">{{ $materi->judul }}</h6>
                                                <small class="text-muted">{{ $materi->topik }}</small>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">
                                                <i class="bi bi-eye"></i> Lihat
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Pengajar --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4 class="card-title">Pengajar
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="basic_datatables" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%">Nomor</th>
                                                        <th>Nama Pengajar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $index = 1;
                                                    @endphp
                                                    @foreach ($teachers as $item)
                                                        <tr>
                                                            <td>{{ $index++ }}</td>
                                                            <td>{{ $item->name }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tabel Nilai Siswa --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4 class="card-title">Tabel Nilai Siswa
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="basic_datatables" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nomor</th>
                                                        <th>Nama</th>
                                                        <th>Nilai</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $index = 1;
                                                    @endphp
                                                    @foreach ($students as $item)
                                                        @php
                                                            // Ambil nilai dari rekapNilai berdasarkan user_id
                                                            $nilai = $rekapNilai->firstWhere('user_id', $item->id);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $index++ }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td id="nilai-{{ $item->id }}">
                                                                {{ $nilai->nilai ?? '-' }}</td>
                                                            <!-- Placeholder untuk nilai -->
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-primary btn-sm rounded-4"
                                                                    onclick="tambahNilai('{{ $item->id }}', '{{ $jadwalBelajarId }}')"><i
                                                                        class="fas fa-pencil-alt"></i> Edit
                                                                    Nilai</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tabel Kahadiran Siswa --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4 class="card-title">Tabel Kehadiran Siswa</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="basic_datatables" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nomor</th>
                                                        <th>Nama</th>
                                                        <th>Kehadiran</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $index = 1;
                                                    @endphp
                                                    @foreach ($students as $item)
                                                        @php
                                                            // Ambil kehadiran dari rekapKehadirans berdasarkan user_id
                                                            $kehadiran = $rekapKehadirans->firstWhere(
                                                                'user_id',
                                                                $item->id,
                                                            );
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $index++ }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td id="kehadiran-{{ $item->id }}">
                                                                {{ $kehadiran->kehadiran ?? '-' }}</td>
                                                            <!-- Placeholder untuk kehadiran -->
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-primary btn-sm rounded-4"
                                                                    onclick="tambahKehadiran('{{ $item->id }}', '{{ $jadwalBelajarId }}')"><i
                                                                        class="fas fa-pencil-alt"></i> Edit
                                                                    Kehadiran</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script script>
        var givenDate = '{{ $jadwalBelajar->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>

    <script>
        function tambahNilai(userId, jadwalBelajarId) {
            Swal.fire({
                title: 'Masukkan Nilai',
                input: 'number',
                inputAttributes: {
                    min: 0,
                    max: 100,
                    step: 1
                },
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Nilai tidak boleh kosong!';
                    } else if (value < 0 || value > 100) {
                        return 'Nilai harus antara 0 dan 100!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan AJAX request untuk menyimpan nilai
                    $.ajax({
                        url: "{{ route('dashboard.staf_pengajar.nilai.store', '') }}/" +
                            jadwalBelajarId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_id: userId,
                            nilai: result.value
                        },
                        success: function(response) {
                            // Update nilai di tabel
                            $('#nilai-' + userId).text(response.nilai.nilai);
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.message,
                                icon: 'success'
                            }).then(function() {
                                location.reload(); // Reload the page after the alert is closed
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan saat menyimpan nilai.';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMessage = xhr.responseJSON.error;
                            }
                            Swal.fire('Gagal', errorMessage, 'error');
                        }

                    });
                }
            });
        }
    </script>

    <script>
        function tambahKehadiran(userId, jadwalBelajarId) {
            Swal.fire({
                title: 'Pilih Kehadiran',
                input: 'select',
                inputOptions: {
                    'sakit': 'Sakit',
                    'izin': 'Izin',
                    'alpa': 'Alpa',
                    'hadir': 'Hadir'
                },
                inputPlaceholder: 'Pilih status kehadiran',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Anda harus memilih status kehadiran!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan AJAX request untuk menyimpan kehadiran
                    $.ajax({
                        url: "{{ route('dashboard.staf_pengajar.jadwal_belajar.kehadiran.store', '') }}/" +
                            jadwalBelajarId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_id: userId,
                            kehadiran: result.value
                        },
                        success: function(response) {
                            // Update kehadiran di tabel
                            $('#kehadiran-' + userId).text(response.kehadiran);
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.message,
                                icon: 'success'
                            }).then(function() {
                                location.reload(); // Reload the page after the alert is closed
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan saat menyimpan kehadiran.';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMessage = xhr.responseJSON.error;
                            }
                            Swal.fire('Gagal', errorMessage, 'error');
                        }
                    });
                }
            });

        }
    </script>

    <script>
        function editKeterangan(jadwalBelajarId) {
            Swal.fire({
                    title: 'Masukan Deskripsi Pembelajaran',
                    input: 'textarea',
                    inputAttributes: {
                        rows: 3, // Increase the number of rows for a larger textarea
                        cols: 70 // Increase the number of columns for a wider textarea
                    },
                    inputValue: '{{ $jadwalBelajar->keterangan }}' || '',
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal',
                    width: '70%', // Set the width of the modal to 70% of the screen width
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Deskripsi tidak boleh kosong!';
                        }
                    }
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan AJAX request untuk menyimpan deskripsi
                        $.ajax({
                            url: "{{ route('dashboard.staf_pengajar.jadwal_belajar.updateKeterangan', '') }}/" +
                                jadwalBelajarId,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                keterangan: result.value
                            },
                            success: function(response) {
                                // Update deskripsi di tabel
                                $('#keterangan-' + jadwalBelajarId).text(response.keterangan);
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: response.message,
                                    icon: 'success'
                                }).then(function() {
                                    location.reload(); // Reload the page after the alert is closed
                                });
                            },
                            error: function(xhr) {
                                let errorMessage = 'Terjadi kesalahan saat menyimpan deskripsi.';
                                if (xhr.responseJSON && xhr.responseJSON.error) {
                                    errorMessage = xhr.responseJSON.error;
                                }
                                Swal.fire('Gagal', errorMessage, 'error');
                            }
                        });
                    }
                });
        }
    </script>

    <!-- Modal Detail Materi -->
    <div class="modal fade" id="materiModal" tabindex="-1" aria-labelledby="materiModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-xl">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title" id="materiModalLabel">Detail Materi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="modalJudul"></h5>
                    <p class="text-muted" id="modalTopik"></p>
                    <p id="modalDeskripsi" class="mt-3"></p>

                    <div id="modalFileContainer" class="mt-4">
                        <iframe id="modalFilePreview" src="" frameborder="0" width="100%" height="400px"
                            class="border rounded-3"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const materiModal = document.getElementById('materiModal');
        materiModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const judul = button.getAttribute('data-judul');
            const topik = button.getAttribute('data-topik');
            const deskripsi = button.getAttribute('data-deskripsi');
            const file = button.getAttribute('data-file');

            document.getElementById('modalJudul').textContent = judul;
            document.getElementById('modalTopik').textContent = "Topik: " + topik;
            document.getElementById('modalDeskripsi').textContent = deskripsi;

            const iframe = document.getElementById('modalFilePreview');
            iframe.src = file ? file : '';
        });
    </script>

@endsection
