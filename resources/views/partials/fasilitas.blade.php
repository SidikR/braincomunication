<!-- Services Section - Home Page -->
<section id="services" class="service bg-white">

    <!--  Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Fasilitas Apa Saja yang Akan Didapatkan?</h2>
        {{-- <p>Berikut ini layanan yang ada di Dinas Komunikasi dan Informasi Lampung Selatan</p> --}}
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        @if ($fasilitas->isEmpty())
            <div class="col-lg-12 p-2 text-center">
                <p>Tidak ada data layanan/fasilitas saat ini.</p>
            </div>
        @else
            <div class="row align-items-xl-center gy-5 ">
                <div class="col">
                    <div class="row gy-4 d-flex justify-content-center ">

                        @foreach ($fasilitas as $item)
                            <div class="col-lg-2 d-flex justify-content-center " data-aos="fade-up"
                                data-aos-delay="200">
                                <div class="card p-0 grow-shadow rounded-4" style="width: 14rem;">
                                    <div class="image-service w-100 d-flex items-center justify-content-center" style="height: 100%">
                                        <img src="{{ asset($item->image) }}" class="card-img-top m-3 p-3 rounded-4"
                                            alt="{{ $item->alt_image }}" style="width: 100%; object-fit: cover">
                                    </div>

                                    <div class="card-body d-flex justify-content-center flex-column align-items-center bg-red-primary rounded-bottom-4"
                                        style="height: 30%">
                                        {{-- <a href="#"
                                            class="d-flex flex-column">
                                            <h6 class="text-white text-center fw-bold m-0">{{ $item->title }}</h6>
                                        </a> --}}
                                        <h6 class="text-white text-center fw-bold m-0">{{ $item->title }}</h6>
                                    </div>
                                </div>
                            </div> <!-- End Icon Box --><!-- End Icon Box -->
                        @endforeach

                    </div>
                </div>
            </div>
        @endif
    </div>

</section><!-- End Services Section -->
