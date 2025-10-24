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
                        <span><i class="fas fa-clock text-primary"></i> Updated : <span id="result"></span></span>
                    </div>
                    <div class="card-body">
                        <form action={{ route('dashboard.administrator.galeri.edit', ['ulid' => $galeri->ulid]) }}
                            method="get">
                            @method('GET')

                             <fieldset disabled>
                                <div
                                    class="px-xl-5 mb-4 col-12 d-flex gap-xl-5 m-0 justify-content-center align-items-center ">
                                    <div class="image-container text-center">
                                        <div class="mb-3 w-100">
                                            <label for="image1" class="mb-2">Image Galeri </label>
                                            <div id="imagePreviewBox">
                                                <figure class="image-preview">
                                                    <img src="{{ asset($galeri->image) }}" id="image1-display"
                                                        alt="{{ $galeri->alt_image }}">
                                                    <input type="hidden" name="image" id="image1"
                                                        value="{{ $galeri->image }}">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="alt_image" class="form-label">Alt Image</label>
                                    <input type="text" class="form-control" aria-describedby="helpId"
                                        value="{{ $galeri->alt_image }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori Galeri</label>
                                    <input type="text" class="form-control" aria-describedby="helpId"
                                        value="{{ $galeri->category->name }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Galeri</label>
                                    <input type="text" class="form-control" aria-describedby="helpId"
                                        value="{{ $galeri->title }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Deskripsi Galeri</label>
                                    <textarea class="form-control" rows="3">{{ $galeri->description }}</textarea>
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
        var givenDate = '{{ $galeri->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
