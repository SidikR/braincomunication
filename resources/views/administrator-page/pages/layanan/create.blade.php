@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/administrator/layanan">Daftar Layanan</a></li>
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
                <form action={{ route('dashboard.administrator.layanan.store') }} method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <fieldset>
                        <div class="d-flex row">

                            <div class="col-12 col-md-4  d-flex justify-content-center align-items-center ">
                                {{-- image box field --}}
                                <div class="image text-center">
                                    <div class="mb-3">
                                        <label for="image1" class="required mb-2">Image Layanan</label>
                                        <div id="imagePreviewBox">
                                            <figure class="image-preview">
                                                <img src="{{ old('image') ? asset(old('image')) : asset('assets-admin/images/images.png') }}"
                                                    id="image1-display">
                                                <input type="hidden" name="image" id="image1"
                                                    value="{{ old('image') }}">
                                            </figure>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="text-danger ">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <button type="button" class="btn btn-primary mt-2 upload-button" id="button-image"
                                        data-input-id="image1">
                                        <i class="bi bi-cloud-arrow-up-fill"></i> Upload Photo
                                    </button>

                                </div>
                            </div>

                            <div class="col-12 col-md-8">

                                {{-- alt imge field --}}
                                <div class="mb-3">
                                    <label for="alt_image" class="form-label">Alternatif Image Text</label>
                                    <input type="text" id="alt_image"
                                        class="form-control @error('alt_image') is-invalid @enderror"
                                        placeholder="Text alternatif image ...." name="alt_image"
                                        aria-invalid="{{ $errors->has('alt_image') ? 'true' : 'false' }}"
                                        aria-required="true" aria-describedby="alt_image_help"
                                        value="{{ old('alt_image') }}">
                                    @error('alt_image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Layanan Name field --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label required">Nama Layanan</label>
                                    <input type="text" id="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama Layanan"
                                        aria-required="true" aria-describedby="name_help" name="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- deskripsi layanan --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Layanan</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                        rows="4" placeholder="Masukkan deskripsi layanan di sini" aria-describedby="description_help"
                                        aria-required="true">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="mb-3 mt-3">
                                <label for="content" class="form-label required">Konten Layanan </label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="30"
                                    required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

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
