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
                        <form action={{ route('dashboard.administrator.fasilitas.update', ['fasilitas' => $fasilitas->id]) }}
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <fieldset>
                                <div class="d-flex row">
                                    <div class="col-12">
                                        <div class="p-3 rounded-3 mb-4">

                                            <div class="col-12 d-flex justify-content-center align-items-center ">
                                                <div class="image text-center">
                                                    <div class="mb-3">
                                                        <label for="image1" class="mb-2">Thumbnail </label>
                                                        <div id="imagePreviewBox">
                                                            <figure class="image-preview">
                                                                <img src="{{ asset($fasilitas->thumbnail) }}" id="image1-display"
                                                                    alt="{{ $fasilitas->title }}">
                                                                <input type="hidden" name="image" id="image1"
                                                                    value="{{ $fasilitas->thumbnail }}">
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="title" class="form-label required">Title</label>
                                                <input type="text" id="title"
                                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                                    value="{{ $fasilitas->title }}">
                                                @error('title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        </div>
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
        var givenDate = '{{ $fasilitas->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
