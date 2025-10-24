@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/administrator/user">Daftar user</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ $data['page_name'] }}
                </h5>
                <span><i class="bi bi-clock-history"></i> Updated : <span id="result"></span></span>
            </div>
            <div class="card-body p-3">
                <form action={{ route('dashboard.administrator.profile.edit', ['profile' => $user->id]) }}>
                    <fieldset disabled>

                        <div class="d-flex flex-column justify-items-center align-items-center w-100">
                            <div class=" col-12 image-container text-center p-5" style="width: 350px; height: 400px">
                                <div class="mb-3 w-100 h-100" style="">
                                    <label for="image1" class="required mb-2">Foto Pengguna </label>
                                    <div id="imagePreviewBox">
                                        <figure class="image-preview p-3" style="border-radius: 100%">
                                            <img src="{{ asset($user->image) }}" alt="{{ $user->alt_image }}"
                                                class="w-100 h-100" id="image1-display" style="border-radius: 100%">
                                            <input type="hidden" name="image" id="image1" value="{{ $user->image }}">
                                        </figure>
                                    </div>
                                </div>

                            </div>
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
                                        <span class="rounded-5 bg-danger p-1 px-3 text-white">Belum Terverifikasi</span>
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

    </section>

    <script script>
        var givenDate = '{{ $user->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
