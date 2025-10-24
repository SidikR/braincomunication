@extends('pages.service.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li><a href={{ route('bidang.index') }}>Bidang</a></li>
                <li class="current">{{ $bidang->name }}</li>
            </ol>
        </div>
    </nav>
@endsection

@section('main')
    <div class="row gy-4 d-flex justify-content-center ">
        <div class="heading text-center">
            <h1>{{ $bidang->name }}</h1>
        </div>

        <div class="container mt-3 mb-4">
            <div class="bg-body-tertiary rounded-3 position-relative"
                style="box-shadow: -2px 8px 24px -14px rgba(0,0,0,0.9);
                                        -webkit-box-shadow: -2px 8px 24px -14px rgba(0,0,0,0.9);
                                        -moz-box-shadow: -2px 8px 24px -14px rgba(0,0,0,0.9);">
                <div class="bidang px-lg-5 py-lg-5 pt-4 pb-3 px-2">
                    <p class="fw-bold m-0 bg-red-primary text-white rounded-3 p-2"
                        style="left: 10px; top: -20px; position: absolute;">
                        Deskripsi
                    </p>
                    <p class="m-0 text-center ">{{ $bidang->description }}</p>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <div class="bg-body-tertiary rounded-3 position-relative"
                style="box-shadow: -2px 8px 24px -14px rgba(0,0,0,0.9);
                                    -webkit-box-shadow: -2px 8px 24px -14px rgba(0,0,0,0.9);
                                    -moz-box-shadow: -2px 8px 24px -14px rgba(0,0,0,0.9);">
                <div class="bidang px-lg-5 py-lg-5 pt-4 pb-3 px-2">
                    <p class="fw-bold m-0 bg-red-primary text-white rounded-3 p-2"
                        style="left: 10px; top: -20px; position: absolute;">
                        Konten
                    </p>
                    <p class="m-0">{!! $bidang->content !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
