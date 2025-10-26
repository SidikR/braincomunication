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
                    <a href="{{ route('dashboard.' . roleName() . '.informasi.index') }}">Informasi</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Detail</a>
                </li>
            </ul>
        </div>

        {{-- Konten detail --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $data['information']->title }}</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Tanggal:</strong> {{ $data['information']->created_at->format('d M Y H:i') }}</p>
                        <p><strong>Status:</strong>
                            @if ($data['is_read'])
                                <span class="badge bg-success">Sudah Dibaca</span>
                            @else
                                <span class="badge bg-warning">Belum Dibaca</span>
                            @endif
                        </p>

                        </p>
                        <hr>
                        <p>{{ $data['information']->description }}</p>

                        {{-- File terkait --}}
                        @if ($data['files']->count() > 0)
                            <hr>
                            <h5>File Terkait</h5>
                            <ul class="list-group">
                                @foreach ($data['files'] as $file)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $file->file_name ?? basename($file->file_path) }}
                                        <a target="_blank" href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-primary">Lihat</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <a href="{{ route('dashboard.' . roleName() . '.informasi.index') }}"
                            class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
