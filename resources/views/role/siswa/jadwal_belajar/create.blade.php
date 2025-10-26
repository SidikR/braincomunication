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
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.jadwal_belajar.index') }}">Data Jadwal
                        Belajar</a>
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
                        <h4 class="card-title">Ajukan {{ $data['page_name'] ?? '' }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <h1>Selamat Datang di {{ getInfo()->title }}, Untuk Request Jadwal Belajar Silakan</h1>
                            <div class="button">
                                <a href="https://wa.me/{{ getInfo()->hp }}" target="_blank">
                                    <button class="btn btn-lg btn-primary">
                                        <i class="fas fa-phone"></i> HUBUNGI ADMIN
                                    </button>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
