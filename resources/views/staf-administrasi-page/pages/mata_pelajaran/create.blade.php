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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.mata_pelajaran.index') }}">Data Mata Pelajaran</a>
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
                        <form action={{ route('dashboard.staf_administrasi.mata_pelajaran.store') }} method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <fieldset>
                                <div class="d-flex row">

                                    <div class="col-12">

                                        {{-- Mata Pelajaran Name field --}}
                                        <div class="mb-3">
                                            <label for="nama_mata_pelajaran" class="form-label required">Nama Mata Pelajaran</label>
                                            <input type="text" id="nama_mata_pelajaran"
                                                class="form-control @error('nama_mata_pelajaran') is-invalid @enderror"
                                                placeholder="Nama Mata Pelajaran" aria-required="true"
                                                aria-describedby="name_help" name="nama_mata_pelajaran" value="{{ old('nama_mata_pelajaran') }}">
                                            @error('nama_mata_pelajaran')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Mata Pelajaran Keterangan field --}}
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label required">Keterangan Mata Pelajaran</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" cols="30" rows="10" placeholder="Keterangan Mata Pelajaran" aria-required="true"
                                                aria-describedby="name_help" name="keterangan" value="{{ old('keterangan') }}">{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
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
                                        aria-hidden="true"></i> Kirim
                                    Data</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
