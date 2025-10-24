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
                    <a href="#">{{ $data['page_name'] ?? '' }}</a>
                </li>
            </ul>
        </div>

        {{-- Konten --}}
        <form action="{{ route('dashboard.administrator.tentang_kami.unit_usaha.update') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Konten --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Tabel {{ $data['page_name'] ?? '' }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="konten" class="form-label">Konten</label>
                                <textarea class="form-control" name="konten" id="summernote" rows="3">{{ $unitUsaha->konten ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
