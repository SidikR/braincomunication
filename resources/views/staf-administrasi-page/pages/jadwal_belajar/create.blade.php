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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.jadwal_belajar.index') }}">Data Jadwal
                        Belajar</a>
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
                        <form action={{ route('dashboard.staf_administrasi.jadwal_belajar.store') }} method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <fieldset>
                                <div class="d-flex row">

                                    <div class="col-12">

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

                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <textarea class="form-control" name="keterangan" id="keterangan" rows="7">{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="start_time" class="form-label required">Waktu Mulai</label>
                                            <input type="datetime-local"
                                                class="form-control @error('start_time') is-invalid @enderror"
                                                name="start_time" id="start_time" aria-describedby="start_time"
                                                placeholder="Pilih Waktu Mulai" value="{{ old('start_time') }}" />
                                            @error('start_time')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="end_time" class="form-label required">Waktu Selesai</label>
                                            <input type="datetime-local"
                                                class="form-control @error('end_time') is-invalid @enderror" name="end_time"
                                                id="end_time" aria-describedby="end_time" placeholder="Pilih Waktu Selesai"
                                                value="{{ old('end_time') }}" />
                                            @error('end_time')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran</label>
                                            <select class="form-select @error('mata_pelajaran_id') is-invalid @enderror"
                                                name="mata_pelajaran_id" id="mata_pelajaran_id">
                                                <option selected disabled>Pilih Mata Pelajaran</option>
                                                @forelse ($mata_pelajarans as $mata_pelajaran)
                                                    <option value="{{ $mata_pelajaran->id }}"
                                                        {{ old('mata_pelajaran_id') == $mata_pelajaran->id ? 'selected' : '' }}>
                                                        {{ $mata_pelajaran->nama_mata_pelajaran }}
                                                    </option>
                                                @empty
                                                    <option disabled>Tidak ada mata pelajaran tersedia</option>
                                                @endforelse
                                            </select>
                                            @error('mata_pelajaran_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pengajar" class="form-label">Pengajar</label>
                                            <select class="form-select form-select-md" name="teacher_ids[]" id="teacher_ids"
                                                multiple>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}"
                                                        {{ is_array(old('teacher_ids')) && in_array($teacher->id, old('teacher_ids')) ? 'selected' : '' }}>
                                                        {{ $teacher->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="students" class="form-label">Siswa</label>
                                            <select class="form-select form-select-md" name="student_ids[]" id="student_ids"
                                                multiple>
                                                @foreach ($students as $student)
                                                    <option value="{{ $student->id }}"
                                                        {{ is_array(old('student_ids')) && in_array($student->id, old('student_ids')) ? 'selected' : '' }}>
                                                        {{ $student->name }}
                                                    </option>
                                                @endforeach
                                            </select>
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

    <script>
        $(document).ready(function() {
            $('#teacher_ids').select2({
                placeholder: 'Pilih Pengajar',
                allowClear: true
            });
            $('#student_ids').select2({
                placeholder: 'Pilih Siswa',
                allowClear: true
            });
        });
    </script>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        });

        document.getElementById('generate-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            passwordInput.value = generatePassword(12);
        });

        function generatePassword(length) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=";
            let password = "";
            for (let i = 0, n = charset.length; i < length; ++i) {
                password += charset.charAt(Math.floor(Math.random() * n));
            }
            return password;
        }
    </script>
@endsection
