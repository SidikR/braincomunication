@extends('layouts.forgot-password')
@section('form')
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label required">Alamat Email</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror""
                    placeholder="Masukan alamat email Anda..." aria-label="email" aria-describedby="email"
                    value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="mt-4 gap-2 button-submit d-flex flex-column  justify-content-center align-items-center w-100">
            <button type="submit" class=" btn btn-sm btn-primary w-75 text-uppercase ">Kirim</button>
        </div>
    </form>
@endsection
