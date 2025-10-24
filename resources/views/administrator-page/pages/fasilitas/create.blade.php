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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.fasilitas.index') }}">Data Fasilitas</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.administrator.role_user.index') }}">List Role User</a>
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
                        <form action={{ route('dashboard.administrator.fasilitas.store') }} method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <fieldset>
                                <div class="d-flex row">

                                    <div class="col-12">

                                        <div class="col-12 d-flex justify-content-center align-items-center ">
                                            {{-- image box field --}}
                                            <div class="image text-center">
                                                <div class="mb-3">
                                                    <label for="image1" class="required mb-2">Thumbnail Fasilitas</label>
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

                                                <button type="button" class="btn btn-primary mt-2 upload-button"
                                                    id="button-image" data-input-id="image1">
                                                    <i class="bi bi-cloud-arrow-up-fill"></i> Upload Foto
                                                </button>

                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="title" class="form-label required">Title</label>
                                            <input type="text" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Title" aria-required="true" aria-describedby="name_help"
                                                name="title" value="{{ old('title') }}">
                                            @error('title')
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
