@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ route('dashboard.administrator.index') }}>Dashboard</a></li>
            <li class="breadcrumb-item"><a href={{ route('dashboard.administrator.pejabat.index') }}>Daftar Pejabat</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ $data['page_name'] }}
                </h5>
            </div>
            <div class="card-body">
                <form action={{ route('dashboard.administrator.pejabat.store') }} method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <fieldset>
                        <div class="px-xl-5 mb-4 col-12 d-flex gap-xl-5 m-0 justify-content-center align-items-center ">
                            <div class="image-container text-center">
                                <div class="mb-3 w-100">
                                    <label for="image1" class="required mb-2">Image Pejabat / Karyawan </label>
                                    <div id="imagePreviewBox">
                                        <figure class="image-preview w-100">
                                            <img src="{{ old('image') ? asset(old('image')) : asset('assets-admin/images/images.png') }}"
                                                id="image1-display">
                                            <input type="hidden" name="image" id="image1" value="{{ old('image') }}">
                                        </figure>
                                    </div>

                                    @error('image')
                                        <div class="text-danger ">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="button" class="btn btn-primary mt-2 upload-button" id="button-image"
                                    data-input-id="image1">
                                    <i class="bi bi-cloud-arrow-up-fill"></i> Upload Photo
                                </button>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="alt_image" class="form-label">Alt Image</label>
                            <input type="text" class="form-control @error('alt_image') 'is-invalid' @enderror"
                                name="alt_image" id="alt_image" aria-describedby="helpId"
                                placeholder="Masukkan Alt Image... " value="{{ old('alt_image') }}" />
                            @error('alt_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label required">Nama Pejabat</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nama Layanan" aria-required="true" aria-describedby="name_help" name="name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP Pejabat</label>
                            <input type="text" class="form-control @error('nip') 'is-invalid' @enderror" name="nip"
                                id="nip" aria-describedby="helpId" placeholder="Masukkan NIP Pejabat... "
                                value="{{ old('nip') }}" />
                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('position') 'is-invalid' @enderror"
                                name="position" id="position" aria-describedby="helpId" placeholder="Masukkan Jabatan... "
                                value="{{ old('position') }}" />
                            @error('position')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="detail" class="form-label">Detail Pejabat</label>
                            <textarea class="form-control" name="detail" id="detail" rows="3">{{ old('detail') }}</textarea>
                            @error('detail_pejabat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </fieldset>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                        <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy"></i> Simpan Data</button>
                    </div>

                </form>

            </div>
        </div>
    </section>
@endsection
