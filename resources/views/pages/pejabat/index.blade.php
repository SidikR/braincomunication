@extends('pages.pejabat.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li class="current">Pejabat</li>
            </ol>
        </div>
    </nav>
@endsection

@section('main')
    <div class="row gy-4 icon-boxes gap-4 d-flex justify-content-center ">

        @if ($pejabat->isEmpty())
            <div class="col-lg-12 p-2 text-center">
                <p>Tidak ada data bidang saat ini.</p>
            </div>
        @else
            @foreach ($pejabat as $item)
                <div class="col-lg-3 d-flex justify-content-center gap-0 p-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="card p-0 grow-shadow rounded-4 gap-0" style="width: 14rem; height:400px">
                        <div class="image-service w-100 d-flex items-center" style="height: 60%">
                            <img src="{{ asset($item->image) }}" class="card-img-top mb-2 rounded-4 p-2"
                                alt="{{ $item->alt_image }}" style="width: 100%; object-fit: contain">
                        </div>

                        <div class="card-body d-flex justify-content-center flex-column align-items-center bg-red-primary rounded-4"
                            style="max-height: 40%">
                            <h6 class="card-title text-center fw-bold ">{{ $item->name }}</h6>
                            <p class="card-text text-center ">{{ $item->position }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $pejabat->links() }}
        @endif


        <div class="container-fluid mt-5">
            <div class="bg-body-tertiary rounded-3">
                <div class="layanan px-lg-5 py-lg-5 pt-4 pb-3 px-2">
                    <div class="m-0">{!! $konten[0]->content !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
