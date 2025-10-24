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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.staf_pengajar.index') }}">Data Staf Pengajar</a>
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
                        <form action={{ route('dashboard.staf_administrasi.staf_pengajar.store') }} method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <fieldset>
                                <div class="d-flex row">

                                    <div class="col-12">

                                        {{-- Staf Pengajar Name field --}}
                                        <div class="mb-3">
                                            <label for="name" class="form-label required">Nama Staf Pengajar</label>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nama Staf Pengajar" aria-required="true"
                                                aria-describedby="name_help" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Staf Pengajar Email field --}}
                                        <div class="mb-3">
                                            <label for="email" class="form-label required">Email Staf Pengajar</label>
                                            <input type="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email Staf Pengajar" aria-required="true"
                                                aria-describedby="name_help" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-2 position-relative">
                                            <label for="password" class="form-label required">Password</label>
                                            <input type="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" aria-required="true" aria-describedby="name_help"
                                                name="password" value="{{ old('password') }}">
                                            <span id="toggle-password" class="position-absolute"
                                                style="cursor: pointer; right: 20px; top: 38px;">
                                                <i id="eye-icon" class="bi bi-eye"></i>
                                            </span>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="button" id="generate-password" class="btn btn-primary rounded-3">Generate
                                            Password</button>

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
