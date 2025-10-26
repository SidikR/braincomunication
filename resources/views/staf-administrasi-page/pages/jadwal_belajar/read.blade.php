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
                        <h4 class="card-title">Tabel {{ $data['page_name'] ?? '' }}</h4>
                        <span><i class="fas fa-clock text-primary"></i> Updated : <span id="result"></span></span>
                    </div>
                    <div class="card-body">
                        <form
                            action={{ route('dashboard.staf_administrasi.jadwal_belajar.edit', ['jadwal_belajar' => $jadwal_belajar->id]) }}>
                            <fieldset disabled>
                                <div class="d-flex row">
                                    <div class="col-12">
                                        <table class="w-100 mb-4">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Title</strong></td>
                                                    <td>: {{ $jadwal_belajar->title }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Mata Pelajaran</strong></td>
                                                    <td>: {{ $jadwal_belajar->mataPelajaran->nama_mata_pelajaran }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Waktu Mulai</strong></td>
                                                    <td>:
                                                        {{ \Carbon\Carbon::parse($jadwal_belajar->start_time)->format('Y-m-d H:i') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Waktu Selesai</strong></td>
                                                    <td>:
                                                        {{ \Carbon\Carbon::parse($jadwal_belajar->end_time)->format('Y-m-d H:i') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Keterangan</strong></td>
                                                    <td>: {{ $jadwal_belajar->keterangan }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="card">
                                            <div class="card-body">
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
                                                                data-judul="{{ $materi->judul }}"
                                                                data-topik="{{ $materi->topik }}"
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
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="d-flex flex-column flex-lg-row justify-content-end gap-2 mt-4">
                                <button type="button" class="btn btn-danger rounded-3" onclick="goBack()"><i
                                        class="fas fa-undo"></i> Kembali</button>
                                <button type="submit" class="btn btn-primary rounded-3"><i class="fas fa-edit"
                                        aria-hidden="true"></i> Edit
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Pengajar</h4>
                    </div>
                    <div class="card-body">
                        {{-- list pengajar --}}
                        <div class="pengajar p-3 rounded-3 mb-4">
                            <div class="table-responsive">
                                <table class="table">
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

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Siswa</h4>
                    </div>
                    <div class="card-body">
                        {{-- list Siswa --}}
                        <div class="Siswa p-3 rounded-3 mb-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">Nomor</th>
                                            <th>Nama Siswa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($students as $item)
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

        </div>
    </div>

    <script script>
        var givenDate = '{{ $jadwal_belajar->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>

    <!-- Modal Detail Materi -->
    <div class="modal fade" id="materiModal" tabindex="-1" aria-labelledby="materiModalLabel" aria-hidden="true">
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
