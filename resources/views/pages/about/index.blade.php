@extends('pages.about.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li class="current">About</li>
            </ol>
        </div>
    </nav>
@endsection

@section('main')
    <div class="row gy-4 icon-boxes d-flex justify-content-center ">

        <div class="iframe w-50 d-flex justify-content-center ">
            {!! $about->iframe !!}
        </div>

        <h3>Deskripsi</h3>
        <p>{{ $about->description }}</p>

        <div class="container-fluid mt-5">
            <div class="bg-body-tertiary rounded-1">
                <div class="layanan px-2 py-2">
                    <div class="m-0">{!! $about->content !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
