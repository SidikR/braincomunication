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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.materi_pembelajaran.index') }}">Data Materi Pembelajaran</a>
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
                        <form
                            action={{ route('dashboard.staf_administrasi.materi_pembelajaran.edit', ['materi_pembelajaran' => $materi_pembelajaran->id]) }}>
                            <fieldset disabled>
                                <div class="d-flex row">
                                    <div class="col-8">
                                        <div class="mb-3">
                                            <label for="judul" class="form-label">Judul</label>
                                            <input type="text" id="judul" class="form-control"
                                                value="{{ $materi_pembelajaran->judul }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="topik" class="form-label">Topik</label>
                                            <input type="text" id="topik" class="form-control"
                                                value="{{ $materi_pembelajaran->topik }}">
                                        </div>
                                         <div class="mb-3">
                                            <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran</label>
                                            <input type="text" id="mata_pelajaran_id" class="form-control"
                                                value="{{ $materi_pembelajaran->mata_pelajaran->nama_mata_pelajaran }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi" rows="6">{{ $materi_pembelajaran->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex flex-column justify-content-center align-items-center ">
                                        <p class="">Preview File</p>
                                        <div class="file bg-secondary text-white d-flex flex-column justify-content-center align-items-center rounded-4"
                                            onclick="handlePreviewFile()"
                                            style="width: 100%; height: 200px; cursor: pointer">
                                            <p>
                                                <i class="{{ $fileIcon }} icon" style="font-size: 4rem"></i>
                                                <!-- Ikon file -->
                                            </p>
                                            <span class="format">Format : {{ strtoupper($fileExtension) }}</span>
                                            <!-- Format file -->
                                        </div>
                                    </div>
                            </fieldset>

                            <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                                <button type="button" class="btn btn-danger rounded-3" onclick="goBack()"><i
                                        class="fas fa-undo"></i> Kembali</button>
                                <button type="submit" class="btn btn-primary rounded-3"><i class="fas fa-edit"
                                        aria-hidden="true"></i> Edit
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function handlePreviewFile() {
            const fileUrl = "{{ asset('storage/' . $materi_pembelajaran->file_path) }}";
            window.open(fileUrl, '_blank');
        }
    </script>

    <script script>
        var givenDate = '{{ $materi_pembelajaran->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
