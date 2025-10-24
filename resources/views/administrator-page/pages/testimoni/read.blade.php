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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.testimoni.index') }}">Data Testimoni</a>
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
                        <form action={{ route('dashboard.administrator.testimoni.edit', ['testimoni' => $testimoni->id]) }}
                            method="get">
                            @method('GET')

                            <fieldset disabled>
                                <div class="d-flex row">

                                    <div class="col-12">

                                        <div class="col-12 d-flex justify-content-center align-items-center ">
                                            <div class="image text-center">
                                                <div class="mb-3">
                                                    <label for="image1" class="mb-2">Foto </label>
                                                    <div id="imagePreviewBox">
                                                        <figure class="image-preview">
                                                            <img src="{{ asset($testimoni->image) }}" id="image1-display"
                                                                alt="{{ $testimoni->nama }}">
                                                            <input type="hidden" name="image" id="image1"
                                                                value="{{ $testimoni->image }}">
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label required">Nama</label>
                                            <input type="text" id="nama"
                                                class="form-control @error('nama') is-invalid @enderror" placeholder="Nama"
                                                aria-required="true" aria-describedby="name_help" name="nama"
                                                value="{{ $testimoni->nama }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="posisi" class="form-label required">Posisi</label>
                                            <input type="text" id="posisi"
                                                class="form-control @error('posisi') is-invalid @enderror"
                                                placeholder="Posisi" aria-required="true" aria-describedby="name_help"
                                                name="posisi" value="{{ $testimoni->posisi }}">
                                            @error('posisi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pesan" class="form-label required">Pesan</label>
                                            <textarea class="form-control @error('pesan') is-invalid @enderror" name="pesan" rows="3">{{ $testimoni->pesan }}</textarea>
                                            @error('pesan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="jenis" class="form-label required">Jenis</label>
                                            <select class="form-select @error('jenis') is-invalid @enderror" name="jenis"
                                                id="jenis">
                                                <option selected disabled>Pilih Salah Satu</option>
                                                <option value="stakeholder"
                                                    {{ $testimoni->jenis == 'stakeholder' ? 'selected' : '' }}>Stakeholder
                                                </option>
                                                <option value="sahabat" {{ $testimoni->jenis == 'sahabat' ? 'selected' : '' }}>
                                                    Sahabat</option>
                                            </select>
                                            @error('jenis')
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
                                        aria-hidden="true"></i> Edit Data
                                    Data</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script script>
        var givenDate = '{{ $testimoni->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
