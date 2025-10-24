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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.materi_pembelajaran.index') }}">
                        Data Materi Pembelajaran
                    </a>
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
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.staf_administrasi.materi_pembelajaran.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <fieldset>
                                <div class="d-flex row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="judul" class="form-label required">Nama Materi Pembelajaran</label>
                                            <input type="text" id="judul"
                                                class="form-control @error('judul') is-invalid @enderror"
                                                placeholder="Nama Materi Pembelajaran" aria-required="true"
                                                aria-describedby="judulHelp" name="judul" value="{{ old('judul') }}">
                                            @error('judul')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="topik" class="form-label required">Topik Materi Pembelajaran</label>
                                            <input type="text" id="topik"
                                                class="form-control @error('topik') is-invalid @enderror"
                                                placeholder="Topik Materi Pembelajaran" aria-required="true"
                                                aria-describedby="topikHelp" name="topik" value="{{ old('topik') }}">
                                            @error('topik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran</label>
                                            <select class="form-select" name="mata_pelajaran_id" id="mata_pelajaran_id">
                                                <option selected disabled>Pilih Mata Pelajaran</option>
                                                @forelse ($mata_pelajarans as $mata_pelajaran)
                                                    <option value="{{ $mata_pelajaran->id }}">{{ $mata_pelajaran->nama_mata_pelajaran }}</option>
                                                @empty
                                                    <option disabled>Tidak ada mata pelajaran tersedia</option>
                                                @endforelse
                                            </select>
                                            @error('mata_pelajaran_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" rows="7">{{ old('deskripsi') }}</textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="file" class="form-label required">Pilih File</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                                name="file" id="file" aria-describedby="fileHelp" />
                                            <div id="fileHelp" class="form-text">Ukuran Maksimal 10MB</div>
                                            @error('file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </fieldset>

                            <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                                <button type="button" class="btn btn-danger rounded-3" onclick="goBack()"><i
                                        class="fas fa-undo"></i> Kembali</button>
                                <button type="submit" class="btn btn-success rounded-3"><i class="fas fa-paper-plane"
                                        aria-hidden="true"></i> Kirim Data</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
