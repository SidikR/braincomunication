@extends('layouts.auth')
@section('form')
    <h6 class="text-center fw-bold ">Welcome,</h6>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label required">Email</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                <input type="email" id="email" name="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email Anda..."
                    aria-label="email" aria-describedby="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <label for="password" class="form-label required">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror"" placeholder="Masukan password Anda..."
                aria-label="password" aria-describedby="password" value="{{ old('password') }}" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="forgot-password-link my-3 text-end ">
            @if (Route::has('password.request'))
                <a class="text-body" style="font-size: 1rem" href="{{ route('password.request') }}">
                    {{ __('Lupa Kata Sandi ?') }}
                </a>
            @endif
        </div>
        <div class="mt-4 gap-2 button-submit d-flex flex-column justify-content-center align-items-center w-100">
            <button type="submit" class=" btn btn-sm btn-primary w-75 ">Masuk</button>
            <span class="text-body" style="font-size: 1rem">Belum punya akun? <a href="{{ route('register') }}">
                    {{ __('Klik DAFTAR') }}
                </a></span>

        </div>
    </form>
@endsection
