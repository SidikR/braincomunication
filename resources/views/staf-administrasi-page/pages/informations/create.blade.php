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
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.jadwal_belajar.index') }}">Data Jadwal
                        Belajar</a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">
                    <a href="#">{{ $data['page_name'] ?? '' }}</a>
                </li>
            </ul>
        </div>

        {{-- Konten --}}
        <div class="row">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="col-md-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div
                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                        <h4 class="mb-0 fw-bold">Kirim {{ $data['page_name'] ?? 'Informasi' }}</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('dashboard.staf_administrasi.information.store') }}" method="POST"
                            enctype="multipart/form-data" id="informationForm">
                            @csrf

                            {{-- Judul --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul</label>
                                <input type="text" name="title" class="form-control form-control-lg rounded-3"
                                    placeholder="Masukkan judul informasi" required>
                            </div>

                            {{-- Keterangan --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Keterangan</label>
                                <textarea name="description" class="form-control rounded-3" rows="4" placeholder="Tuliskan isi informasi..."></textarea>
                            </div>

                            {{-- Penerima --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Penerima</label>
                                <select name="recipients[]" id="recipients" class="form-select select2 rounded-3" multiple>
                                    <optgroup label="Guru">
                                        <option value="all_teachers">🔹 Semua Guru</option>
                                        @foreach ($teachers as $t)
                                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Siswa">
                                        <option value="all_students">🔸 Semua Siswa</option>
                                        @foreach ($students as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                <small class="text-muted">Kosongkan jika ingin dikirim ke semua guru & siswa.</small>
                            </div>

                            {{-- Lampiran --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Lampiran</label>
                                <input type="file" name="files[]" id="filesInput" class="form-control rounded-3"
                                    multiple>
                                <div id="filePreviewContainer" class="mt-3 d-flex flex-wrap gap-3"></div>
                            </div>

                            <button type="submit" class="btn btn-primary rounded-3 px-4 py-2">
                                <i class="fas fa-paper-plane me-1"></i> Kirim Informasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Styling Select2 */
        .select2-container--bootstrap-5 .select2-selection {
            border-radius: 0.5rem !important;
            padding: 0.4rem 0.75rem !important;
            min-height: 45px;
            border-color: #ced4da !important;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
            background-color: #0d6efd !important;
            color: #fff !important;
            border: none !important;
            border-radius: 0.375rem !important;
            padding: 0.2rem 0.5rem !important;
            margin-top: 0.2rem;
        }

        .file-preview-item {
            border: 1px solid #e0e0e0;
            border-radius: 0.5rem;
            padding: 10px;
            background: #f9f9f9;
            width: 120px;
            text-align: center;
            position: relative;
        }

        .file-preview-item img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        .file-preview-name {
            font-size: 12px;
            margin-top: 5px;
            word-break: break-word;
        }
    </style>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('.select2').select2({
                placeholder: "Pilih penerima...",
                allowClear: true,
                width: '100%',
                theme: 'bootstrap-5'
            });

            // Handle opsi "Semua Guru" dan "Semua Siswa"
            $('#recipients').on('select2:select', function(e) {
                const val = e.params.data.id;
                if (val === 'all_teachers') {
                    $('#recipients option').each(function() {
                        if ($(this).parent().attr('label') === 'Guru') {
                            $(this).prop('selected', true);
                        }
                    });
                    $('#recipients').trigger('change');
                } else if (val === 'all_students') {
                    $('#recipients option').each(function() {
                        if ($(this).parent().attr('label') === 'Siswa') {
                            $(this).prop('selected', true);
                        }
                    });
                    $('#recipients').trigger('change');
                }
            });

            // File preview
            const fileInput = document.getElementById('filesInput');
            const previewContainer = document.getElementById('filePreviewContainer');

            fileInput.addEventListener('change', function() {
                previewContainer.innerHTML = '';
                Array.from(fileInput.files).forEach((file, index) => {
                    const reader = new FileReader();
                    const previewItem = document.createElement('div');
                    previewItem.classList.add('file-preview-item');

                    if (file.type.startsWith('image/')) {
                        reader.onload = e => {
                            previewItem.innerHTML = `
                                <img src="${e.target.result}" alt="${file.name}" title="Klik untuk preview">
                                <div class="file-preview-name">${file.name}</div>
                            `;
                            previewItem.querySelector('img').onclick = () => window.open(e
                                .target.result, '_blank');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewItem.innerHTML = `
                            <div class="file-preview-name">${file.name}</div>
                            <small class="text-muted">(klik untuk preview)</small>
                        `;
                        previewItem.onclick = () => {
                            const blobUrl = URL.createObjectURL(file);
                            window.open(blobUrl, '_blank');
                        };
                    }

                    previewContainer.appendChild(previewItem);
                });
            });
        });
    </script>
@endsection
