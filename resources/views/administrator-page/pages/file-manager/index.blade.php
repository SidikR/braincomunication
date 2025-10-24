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
                <li class="nav-fasilitas">
                    <a href="#">{{ $data['page_name'] ?? '' }}</a>
                </li>
            </ul>
        </div>

        {{-- Konten --}}
        <div class="row">
            <div class="col-md-12">
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div id="fm" style="height: 800px;"></div>
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-body p-0">
                        <iframe src="{{ url('file-manager/fm-button') }}" style="width:100%; height:800px; border:none;">
                        </iframe>
                    </div>
                </div>

            </div>

        </div>
        {{-- <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script> --}}
    </div>
@endsection
