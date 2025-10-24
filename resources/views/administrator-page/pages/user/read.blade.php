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
                <li class="nav-role_user">
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
                        <span><i class="bi bi-clock-history"></i> Updated : <span id="result"></span></span>
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <a href={{ route('dashboard.administrator.user.create') }}>
                                <button type="button" class="btn btn-primary btn-sm rounded-4"><i class="fa fa-plus"
                                        aria-hidden="true"></i> Tambah Data</button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action={{ route('dashboard.administrator.user.edit', ['user' => $user->id]) }}>
                            <fieldset disabled>
                                <div class="d-flex row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ $user->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" id="email" class="form-control" name="email"
                                                value="{{ $user->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <input type="text" id="role" class="form-control" name="role"
                                                value="{{ $user->role }}">
                                        </div>
                                        <div class="mb-3 d-flex justify-content-start align-items-start text-center gap-2">
                                            <label for="role" class="form-label mt-1">Status Email Verifikasi</label>
                                            @if ($user->email_verified_at)
                                                <span class="rounded-5 bg-success p-1 px-3 text-white">Terverifikasi</span>
                                            @else
                                                <span class="rounded-5 bg-danger p-1 px-3 text-white">Belum
                                                    Terverifikasi</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 d-flex justify-content-start align-items-start text-center gap-2">
                                            <label for="role" class="form-label mt-1">Status Akun</label>
                                            @if ($user->status_akun)
                                                <span class="rounded-5 bg-success p-1 px-3 text-white">Aktif</span>
                                            @else
                                                <span class="rounded-5 bg-danger p-1 px-3 text-white">Tidak Aktif</span>
                                            @endif
                                        </div>

                                    </div>
                            </fieldset>

                            <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                                <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                        class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script script>
        var givenDate = '{{ $user->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
