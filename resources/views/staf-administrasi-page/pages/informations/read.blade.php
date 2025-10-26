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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.jadwal_belajar.index') }}">Data Jadwal Belajar</a>
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
                                        <div class="info-card-detail p-3 rounded-3 mb-4" style="background-color: honeydew">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" id="title" class="form-control"
                                                    value="{{ $jadwal_belajar->title }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="mata_pelajaran" class="form-label">Title</label>
                                                <input type="text" id="mata_pelajaran" class="form-control"
                                                    value="{{ $jadwal_belajar->mataPelajaran->nama_mata_pelajaran }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="start_time" class="form-label">Waktu Mulai</label>
                                                <input type="text" id="start_time" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($jadwal_belajar->start_time)->format('Y-m-d H:i') }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="end_time" class="form-label">Waktu Selesai</label>
                                                <input type="datetime-local" id="end_time" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($jadwal_belajar->end_time)->format('Y-m-d H:i') }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <textarea class="form-control" id="keterangan" rows="6">{{ $jadwal_belajar->keterangan }}</textarea>
                                            </div>
                                        </div>

                                        {{-- list pengajar --}}
                                        <div class="pengajar info-card-detail p-3 rounded-3 mb-4"
                                            style="background-color: honeydew">
                                            <label for="">Daftar Pengajar</label>
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

                                        {{-- list siswa --}}
                                        <div class="siswa info-card-detail p-3 rounded-3"
                                            style="background-color: honeydew">
                                            <label for="">Daftar Pengajar</label>
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
            </div>

        </div>
    </div>

    <script script>
        var givenDate = '{{ $jadwal_belajar->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
