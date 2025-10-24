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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.galeri.index') }}">Data Galeri</a>
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
                        <form action={{ route('dashboard.administrator.galeri.store') }} method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <fieldset>
                                <div class="px-5 mb-4 col-12 d-flex gap-5 justify-content-center align-items-center ">
                                    <div class="image text-center">
                                        <div class="mb-3">
                                            <label for="image1" class="required mb-2">Image Galeri </label>
                                            <div id="imagePreviewBox">
                                                <figure class="image-preview">
                                                    <img src="{{ old('image') ? asset(old('image')) : asset('assets-admin/images/images.png') }}"
                                                        id="image1-display">
                                                    <input type="hidden" name="image" id="image1"
                                                        value="{{ old('image') }}">
                                                    @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </figure>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-primary mt-2 upload-button"
                                            id="button-image" data-input-id="image1">
                                            <i class="bi bi-cloud-arrow-up-fill"></i> Upload Photo
                                        </button>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="alt_image" class="form-label required">Alt Image</label>
                                    <input type="" id="alt_image"
                                        class="form-control @error('alt_image') is-invalid @enderror"
                                        placeholder="isi alt image" name="alt_image"
                                        aria-invalid="{{ $errors->has('alt_image') ? 'true' : 'false' }}"
                                        aria-required="true" aria-describedby="alt_image_help"
                                        value="{{ old('alt_image') }}" required>
                                    @error('alt_image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-select-md @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id" required>
                                        <option value="" {{ old('category_id') == '' ? 'selected' : '' }}>Pilih
                                            Kategori Galeri...
                                        </option>
                                        @foreach ($kategori_galeri as $item)
                                            <option value={{ $item->id }}
                                                {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Galeri <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" id="title" aria-describedby="helpId"
                                        placeholder="Masukkan Judul Anda... " value="{{ old('title') }}" required />
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Galeri <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                        name="description" id="description" aria-describedby="helpId"
                                        placeholder="Masukkan deskripsi galeri... " value="{{ old('description') }}" />
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
