<!-- Portfolio Section - Home Page -->
<section id="galeri" class="portfolio">

    <!--  Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Galeri</h2>
        <p>Setiap Momen yang ada di Dinas Komunikasi dan Informatika, ada di sini. Yuk Cek Langsung.!</p>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="d-flex flex-column gap-3 justify-content-center align-items-center">
            @if ($galeri->isEmpty())
                <div class="col-lg-12 p-2 text-center">
                    <p>Tidak ada data galeri saat ini.</p>
                </div>
            @else
                <div class="row d-flex justify-content-center align-items-center ">
                    @foreach ($galeri as $item)
                        <div class="d-flex justify-content-center col-12 col-lg-6 col-xl-4 p-2">
                            <div class="images" style="height: 250px; width: 100%">
                                <img src="{{ asset($item->image) }}"
                                    class="img-fluid rounded-3 object-fit-cover w-100 h-100"
                                    alt="{{ $item->alt_image }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('galeri.index') }}" class="read-more " style="max-width: max-content"><span>Galeri
                        Lainnya</span><i class="bi bi-arrow-right"></i></a>
            @endif
        </div>
    </div>

</section>
