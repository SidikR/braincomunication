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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.staf_pengajar.index') }}">Data Staf
                        Pengajar</a>
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
                            action={{ route('dashboard.staf_administrasi.staf_pengajar.update', ['staf_pengajar' => $staf_pengajar->id]) }}
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <fieldset>
                                <div class="d-flex row">

                                    <div class="col-12">
                                        {{-- alt imge field --}}
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nama ...." name="name"
                                                aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                                                aria-required="true" aria-describedby="alt_image_help"
                                                value="{{ $staf_pengajar->name }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label required">Email</label>
                                            <input type="text" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" name="email" value="{{ $staf_pengajar->email }}"
                                                required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 d-flex justify-content-start align-items-start text-center gap-2"
                                            style="cursor: pointer">
                                            <label class="form-label mt-1">Status Akun</label>
                                            @if ($staf_pengajar->status_akun)
                                                <span class="rounded-5 bg-success p-1 px-3 text-white"
                                                    onclick="WarningAlert('put', '/dashboard/staf_administrasi/staf_pengajar/status_akun/{{ $staf_pengajar->id }}', 'Update Status?', `Apakah anda yakin ingin menonaktifkan staf_pengajar? '{{ $staf_pengajar->name }}' ?`)">Aktif</span>
                                            @else
                                                <span class="rounded-5 bg-danger p-1 px-3 text-white"
                                                    onclick="WarningAlert('put', '/dashboard/staf_administrasi/staf_pengajar/status_akun/{{ $staf_pengajar->id }}', 'Update Status?', `Apakah anda yakin ingin mengaktifkan staf pengajar '{{ $staf_pengajar->name }}' ?`)">Tidak
                                                    Aktif</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <a
                                                href={{ route('dashboard.staf_administrasi.staf_pengajar.update_password', ['id' => $staf_pengajar->id]) }}><span
                                                    class="btn btn-primary rounded-3">Ubah Password</span></a>
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

    <script script>
        var givenDate = '{{ $staf_pengajar->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
