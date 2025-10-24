@extends('pages.program.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li class="current">Program</li>
            </ol>
        </div>
    </nav>
@endsection

@section('main')
    <div class="row icon-boxes d-flex row-gap-4 gap-0 justify-content-center ">
        @if ($program->isEmpty())
            <div class="col-lg-12 p-2 text-center">
                <p>Tidak ada data program saat ini.</p>
            </div>
        @else
            <div class="row align-items-xl-center gy-5 ">
                <div class="col">
                    <div class="row gy-4 d-flex justify-content-center ">

                        @foreach ($program as $item)
                            <div class="col-lg-3 d-flex justify-content-center " data-aos="fade-up"
                                data-aos-delay="200">
                                <div class="card p-0 grow-shadow rounded-4" style="width: 14rem;">
                                    <div class="image-service w-100 d-flex items-center justify-content-center" style="height: 100%">
                                        <img src="{{ asset($item->thumbnail) }}" class="card-img-top m-3 p-3 rounded-4"
                                            alt="{{ $item->alt_image }}" style="width: 100%; object-fit: cover">
                                    </div>

                                    <div class="card-body d-flex justify-content-center flex-column align-items-center bg-red-primary rounded-bottom-4"
                                        style="height: 30%">
                                         <a href="{{ route('program.detail', [$item->slug]) }}"
                                            class="d-flex flex-column">
                                            <h6 class="text-white text-center fw-bold m-0">{{ $item->title }}</h6>
                                        </a>
                                    </div>
                                </div>
                            </div> <!-- End Icon Box --><!-- End Icon Box -->
                        @endforeach

                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
