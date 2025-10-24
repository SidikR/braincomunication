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
                        <span><i class="fas fa-clock text-primary"></i> Updated : <span id="result"></span></span>
                    </div>
                    <div class="card-body">
                        <form
                            action={{ route('dashboard.staf_administrasi.mata_pelajaran.update', ['mata_pelajaran' => $mata_pelajaran->id]) }}
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <fieldset>
                                <div class="d-flex row">

                                    <div class="col-12">
                                        {{-- alt imge field --}}
                                        <div class="mb-3">
                                            <label for="nama_mata_pelajaran" class="form-label">Nama Mata Pelajaran</label>
                                            <input type="text" id="nama_mata_pelajaran"
                                                class="form-control @error('nama_mata_pelajaran') is-invalid @enderror"
                                                placeholder="Nama Mata Pelajaran ...." name="nama_mata_pelajaran"
                                                aria-invalid="{{ $errors->has('nama_mata_pelajaran') ? 'true' : 'false' }}"
                                                aria-required="true" aria-describedby="alt_image_help"
                                                value="{{ $mata_pelajaran->nama_mata_pelajaran }}">
                                            @error('nama_mata_pelajaran')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label required">Keterangan</label>
                                            <textarea id="keterangan"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                placeholder="Keterangan" name="keterangan" cols="30" rows="10">{{ $mata_pelajaran->keterangan }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                            </fieldset>

                             <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                                <button type="button" class="btn btn-danger rounded-3" onclick="goBack()"><i
                                        class="fas fa-undo"></i> Kembali</button>
                               <button type="submit" class="btn btn-success rounded-3"><i class="fas fa-paper-plane"
                                        aria-hidden="true"></i> Simpan Perubahan
                                    Data</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script script>
        var givenDate = '{{ $mata_pelajaran->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
