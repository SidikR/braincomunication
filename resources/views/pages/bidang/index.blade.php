@extends('pages.bidang.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li class="current">Bidang</li>
            </ol>
        </div>
    </nav>
@endsection

@section('main')
    <div class="row icon-boxes d-flex row-gap-4 gap-0 justify-content-center ">
        @if ($bidang->isEmpty())
            <div class="col-lg-12 p-2 text-center">
                <p>Tidak ada data bidang saat ini.</p>
            </div>
        @else
            @foreach ($bidang as $item)
                <div class="col-lg-3 d-flex justify-content-center gap-0 p-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="card p-0 grow-shadow rounded-4 gap-0" style="width: 14rem; height:400px">
                        <div class="image-service w-100 d-flex items-center" style="height: 70%">
                            <img src="{{ asset($item->image) }}" class="card-img-top mb-2 rounded-3 "
                                alt="{{ $item->alt_image }}" style="width: 100%; object-fit: cover">
                        </div>

                        <div class="card-body d-flex justify-content-center flex-column align-items-center bg-red-primary rounded-4"
                            style="max-height: 30%">
                            <a href="{{ route('bidang.detail', [$item->slug]) }}" class="d-flex flex-column">
                                <h6 class="text-white text-center fw-bold m-0">{{ $item->name }}</h6>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
