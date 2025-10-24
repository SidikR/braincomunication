@extends('dashboard.layouts.main')
@section('content')

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
                        <form action={{ route('dashboard.administrator.user.update', ['user' => $user->id]) }}
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
                                                value="{{ $user->name }}">
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
                                                placeholder="Email" name="email" value="{{ $user->email }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="role" class="form-label required">Role User</label>
                                            <select class="form-select  @error('role') is-invalid @enderror" name="role"
                                                id="role" required>
                                                <option value="" {{ $user->role == '' ? 'selected' : '' }}>Pilih
                                                    Role User...
                                                </option>

                                                @foreach ($role_user as $role)
                                                    <option value={{ $role->nama }}
                                                        {{ $user->role == $role->nama ? 'selected' : '' }}>
                                                        {{ $role->nama }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 d-flex justify-content-start align-items-start text-center gap-2"
                                            style="cursor: pointer">
                                            <label class="form-label mt-1">Status Akun</label>
                                            @if ($user->status_akun)
                                                <span class="rounded-5 bg-success p-1 px-3 text-white"
                                                    onclick="WarningAlert('put', '/dashboard/administrator/user/status_akun/{{ $user->id }}', 'Update Status?', `Apakah anda yakin ingin menonaktifkan user? '{{ $user->name }}' ?`)">Aktif</span>
                                            @else
                                                <span class="rounded-5 bg-danger p-1 px-3 text-white"
                                                    onclick="WarningAlert('put', '/dashboard/administrator/user/status_akun/{{ $user->id }}', 'Update Status?', `Apakah anda yakin ingin mengaktifkan user? '{{ $user->name }}' ?`)">Tidak
                                                    Aktif</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <a
                                                href={{ route('dashboard.administrator.user.update_password', ['id' => $user->id]) }}><span
                                                    class="btn btn-primary">Ubah Password</span></a>
                                        </div>

                                    </div>

                            </fieldset>

                            <div class="d-flex flex-column  flex-lg-row  justify-content-end gap-2">
                                <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                        class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                                <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy"></i> Simpan
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
