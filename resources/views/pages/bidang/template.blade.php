@extends('layouts.main')
@section('content')
    <div data-aos="fade" class="page-title">
        <div class="heading"
            style="background-image: url({{ asset('storage/image/banner.webp') }}); background-size: fit; background-position: center; height: 300px">
            <div class="overlay"></div>
            <div class="container">
                <div class="container section-title detail mt-5 d-flex flex-column" data-aos="fade-up">
                    <h2 class="text-white">Bidang - Bidang</h2>
                    <p class="text-white">Berikut ini bidang yang ada di Dinas Komunikasi dan Informasi Lampung
                        Selatan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="page-title">
        <div class="heading p-0">
            @yield('breadcrumbs')
        </div>
    </div>

    <section id="services" class="services">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-xl-center gy-5">
                <div class="col">
                    @yield('main')
                </div>
            </div>
        </div>
    </section>
@endsection
