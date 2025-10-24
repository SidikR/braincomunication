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
                <li class="nav-testimoni">
                    <a href="{{ route('dashboard.administrator.kategori.index') }}">List Kategori Berita</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-testimoni">
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
                        <form action={{ route('dashboard.administrator.kategori.edit', [$kategori->id]) }} method="GET"
                            enctype="multipart/form-data">

                            <fieldset disabled>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        aria-describedby="helpId" value={{ $kategori->name }} />
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Kategori</label>
                                    <textarea class="form-control" name="description" id="description" rows="3">{{ $kategori->description }}</textarea>
                                </div>
                            </fieldset>

                            <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                                <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                        class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                                <button type="submit" class="btn btn-primary"> <i class="fas fa-edit"></i> Edit
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
