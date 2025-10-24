@extends('layouts.auth')
@section('form')
    <h6 class="text-center fw-bold ">Daftar</h6>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label required">Alamat Email</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                <input type="email" id="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"" placeholder="Masukan alamat email anda..."
                    aria-label="email" aria-describedby="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <label for="password" class="form-label required">Kata Sandi</label>
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror"" placeholder="Masukan kata sandi Anda..."
                aria-label="password" aria-describedby="password" value="{{ old('password') }}" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <label for="password_confirmation" class="form-label required">Masukkan Kembali Kata Sandi</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password_confirmation" id="password_confirmation" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror""
                placeholder="Konfirmasi ulang kata sandi..." aria-label="password_confirmation"
                aria-describedby="password_confirmation" value="{{ old('password_confirmation') }}" required>
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mt-4 gap-2 button-submit d-flex flex-column  justify-content-center align-items-center w-100">
            <button type="submit" class=" btn btn-sm btn-primary w-75 ">Daftar</button>
            <span class="text-body" style="font-size: 1rem">Sudah punya akun? <a href="{{ route('login') }}">
                    {{ __('Klik Masuk') }}
                </a></span>

        </div>
    </form>
@endsection
