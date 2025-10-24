@extends('pages.galeri.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="container">
                    <ol>
                        <li><a href={{ route('homepage') }}>Home</a></li>
                        <li class="current">Galeri</li>
                    </ol>
                </div>
                <div class="select-galeri d-flex gap-2">
                    <button id="buttonFoto" type="button" class="btn btn-galeris active">
                        Foto
                    </button>
                    <button id="buttonVideo" type="button" class="btn btn-galeris">
                        Video
                    </button>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('main')
    <div class="container">

        <h5 class="text-center mb-3">Kategori Galeri</h5>

        <div id="galeri_video">
            <div class="portfolio">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        @foreach ($kategori_galeri as $item)
                            <li data-filter=".filter-{{ $item->id }}">{{ $item->name }}</li>
                        @endforeach
                    </ul><!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container mb-5" data-aos="fade-up" data-aos-delay="200" accordion>
                        @if ($galeri_video->isEmpty())
                            <div class="col-lg-12 p-2 text-center mb-5">
                                <p>Tidak ada data galeri video saat ini.</p>
                            </div>
                        @else
                            @foreach ($galeri_video as $item)
                                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $item->category_id }}">

                                    <div class="iframe">
                                        {!! $item->script !!}
                                    </div>

                                    <div class="portfolio-info w-100">
                                        <h4>{{ $item->title }}</h4>
                                        <p>{{ $item->description }}</p>
                                        <a href="{{ $item->url }}" target="_blank" title="More Details"
                                            class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div><!-- End Portfolio Item -->
                            @endforeach
                        @endif
                    </div><!-- End Portfolio Container -->

                </div>
            </div>
        </div>

        <div id="galeri_foto">
            <div class="portfolio">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        @foreach ($kategori_galeri as $item)
                            <li data-filter=".filter-{{ $item->id }}">{{ $item->name }}</li>
                        @endforeach
                    </ul><!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container mb-5" data-aos="fade-up" data-aos-delay="200" accordion>
                        @if ($galeri->isEmpty())
                            <div class="col-lg-12 p-2 text-center mb-5">
                                <p>Tidak ada data galeri saat ini.</p>
                            </div>
                        @else
                            @foreach ($galeri as $item)
                                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $item->category_id }}">
                                    <img src="{{ asset($item->image) }}" class="img-fluid rounded-3 "
                                        alt="{{ $item->alt_image }}">
                                    <div class="portfolio-info">
                                        <h4>{{ $item->title }}</h4>
                                        <p>{{ $item->description }}</p>
                                        <a href="{{ asset($item->image) }}" title="{{ $item->title }}"
                                            data-gallery="portfolio-gallery-{{ $item->category_id }}"
                                            class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    </div>
                                </div><!-- End Portfolio Item -->
                            @endforeach
                        @endif
                    </div><!-- End Portfolio Container -->

                </div>
            </div>
        </div>

    </div>

    <script>
        // Memperoleh elemen-elemen HTML yang dibutuhkan
        const buttonFoto = document.getElementById('buttonFoto');
        const buttonVideo = document.getElementById('buttonVideo');
        const galeriVideo = document.getElementById('galeri_video');
        const galeriFoto = document.getElementById('galeri_foto');

        // Fungsi untuk menampilkan galeri foto dan menyembunyikan galeri video
        function tampilkanGaleriFoto() {
            galeriFoto.style.display = 'block';
            galeriVideo.style.display = 'none';
            buttonFoto.classList.add('active');
            buttonVideo.classList.remove('active');
        }

        // Fungsi untuk menampilkan galeri video dan menyembunyikan galeri foto
        function tampilkanGaleriVideo() {
            galeriFoto.style.display = 'none';
            galeriVideo.style.display = 'block';
            buttonVideo.classList.add('active');
            buttonFoto.classList.remove('active');
        }

        // Inisialisasi galeri, menampilkan galeri foto dan menyembunyikan galeri video
        tampilkanGaleriFoto();

        // Event listener untuk klik pada tombol foto
        buttonFoto.addEventListener('click', function() {
            tampilkanGaleriFoto();
        });

        // Event listener untuk klik pada tombol video
        buttonVideo.addEventListener('click', function() {
            tampilkanGaleriVideo();
        });
    </script>
@endsection
