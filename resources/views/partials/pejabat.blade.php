<!-- Team Section - Home Page -->
<section id="team" class="team">

    <!--  Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2 class="text-white">Pejabat Dinas</h2>
        <p class="text-white">Berikut ini pejabat pejabat dan karyawan di Dinas Komunikasi dan Informatika
            Lampung Selatan</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row gy-5 d-flex justify-content-center align-items-center ">
            <div class="content d-flex justify-content-center align-items-center ">
                @foreach ($pejabat as $item)
                    <div class="col-lg-4 col-md-6 d-flex flex-column  member p-2" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->alt_image }}"
                                style="object-fit: cover">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>{{ $item->name }}</h4>
                            <span>{{ $item->position }}</span>
                        </div>
                    </div><!-- End Team Member -->
                @endforeach

            </div>

            <a href="{{ route('pejabat.index') }}" class="read-more d-flex justify-content-center "
                style="max-width: max-content"><span>Pejabat Lainnya</span><i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

</section><!-- End Team Section -->
