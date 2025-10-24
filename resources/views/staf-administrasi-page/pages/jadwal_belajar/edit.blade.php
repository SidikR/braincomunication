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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.jadwal_belajar.index') }}">Data Mata
                        Pelajaran</a>
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
                            action={{ route('dashboard.staf_administrasi.jadwal_belajar.update', ['jadwal_belajar' => $jadwal_belajar->id]) }}
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <fieldset>
                                <div class="d-flex row">
                                    <div class="col-12">
                                        <div class="info-card-detail p-3 rounded-3 mb-4" style="background-color: honeydew">
                                            <div class="mb-3">
                                                <label for="title" class="form-label required">Title</label>
                                                <input type="text" id="title"
                                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                                    value="{{ $jadwal_belajar->title }}">
                                                @error('title')
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
                                                            {{ $jadwal_belajar->mata_pelajaran_id == $mata_pelajaran->id ? 'selected' : '' }}>
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
                                                <label for="start_time" class="form-label">Waktu Mulai</label>
                                                <input type="datetime-local" id="start_time" class="form-control"
                                                    name="start_time"
                                                    value="{{ \Carbon\Carbon::parse($jadwal_belajar->start_time)->format('Y-m-d H:i') }}">
                                                @error('start_time')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="end_time" class="form-label">Waktu Selesai</label>
                                                <input type="datetime-local" id="end_time" class="form-control"
                                                    name="end_time"
                                                    value="{{ \Carbon\Carbon::parse($jadwal_belajar->end_time)->format('Y-m-d H:i') }}">
                                                @error('end_time')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="status" class="form-label fw-bold">Status Belajar</label>
                                                <select name="status" id="status" class="form-select">
                                                    @php
                                                        $statuses = [
                                                            'pending' => 'Pending',
                                                            'active' => 'Active',
                                                            'unactive' => 'Unactive',
                                                        ];
                                                        $selectedStatus = old(
                                                            'status',
                                                            $jadwal_belajar->status ?? 'pending',
                                                        );
                                                    @endphp

                                                    @foreach ($statuses as $value => $label)
                                                        <option value="{{ $value }}"
                                                            {{ $selectedStatus === $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <textarea class="form-control" id="keterangan" rows="6" name="keterangan">{{ $jadwal_belajar->keterangan }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="pengajar" class="form-label">Pengajar</label>
                                                <select class="form-select form-select-md" name="teacher_ids[]"
                                                    id="teacher_ids" multiple>
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}"
                                                            {{ $selectedTeachers->contains($teacher->id) ? 'selected' : '' }}>
                                                            {{ $teacher->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="siswa" class="form-label">Siswa</label>
                                                <select class="form-select form-select-md" name="student_ids[]"
                                                    id="student_ids" multiple>
                                                    @foreach ($students as $student)
                                                        <option value="{{ $student->id }}"
                                                            {{ $selectedStudents->contains($student->id) ? 'selected' : '' }}>
                                                            {{ $student->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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

    <script script>
        var givenDate = '{{ $jadwal_belajar->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
