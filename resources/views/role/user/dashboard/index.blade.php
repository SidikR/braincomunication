@extends('dashboard.layouts.main')
@section('content')
    <div class="container text-center p-3">
        <h1>Selamat Datang di {{ getInfo()->title }}</h1>
        <div class="button">
            <a href="https://wa.me/{{ getInfo()->hp }}" target="_blank">
                <button class="btn btn-lg btn-primary">
                    <i class="fas fa-phone"></i>  HUBUNGI ADMIN
                </button>
            </a>
        </div>
    </div>
@endsection
