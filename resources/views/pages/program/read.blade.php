@extends('pages.program.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li><a href={{ route('program.index') }}>Program</a></li>
                <li class="current">{{ $program->title }}</li>
            </ol>
        </div>
    </nav>
@endsection

@section('main')
    <div class="row gy-4 d-flex justify-content-center ">
        <div class="heading text-center">
            <h1>{{ $program->title }}</h1>
        </div>

        <div class="container mt-3 mb-4">
            <div class="bg-body-tertiary rounded-3 position-relative"
                style="box-shadow: -2px 8px 24px -14px rgba(0,0,0,0.9);
                                        -webkit-box-shadow: -2px 8px 24px -14px rgba(0,0,0,0.9);
                                        -moz-box-shadow: -2px 8px 24px -14px rgba(0,0,0,0.9);">
            </div>
        </div>

        <div class="container mt-3">
            <div class="bg-body-tertiary rounded-3 position-relative">
                <div class="program px-lg-5 py-lg-5 pt-4 pb-3 px-2">
                    <p class="m-0">{!! $program->konten !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
