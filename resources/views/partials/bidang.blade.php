 <!-- Features Section - Home Page -->
 <section id="features" class="features" data-aos="fade-up">

     <!--  Section Title -->
     <div class="container section-title">
         <h2>Bidang Bidang</h2>
         <p>Berikut ini bidang bidang yang ada di Dinas Komunikasi dan Informatika Kabupaten
             Lampung Selatan</p>
     </div><!-- End Section Title -->

     <div class="container">
         <div class="row d-flex justify-content-center align-items-center">
             @if ($bidang->isEmpty())
                 <div class="col-lg-12 p-2 text-center">
                     <p>Tidak ada data bidang saat ini.</p>
                 </div>
             @else
                 <div class="content d-md-flex gap-4 flex-column ">
                     @foreach ($bidang as $key => $item)
                         @if ($loop->iteration % 2 == 0)
                             {{-- Ini adalah iterasi genap --}}
                             <div class="row gy-2 align-items-center justify-content-between features-item mb-0 mt-0">
                                 <div class="col-lg-7 d-flex justify-content-center flex-column" data-aos="fade-up">
                                     <h3>{{ $item->name }}</h3>
                                     <p>{{ $item->description }}</p>
                                     {{-- <a href="#" class="btn btn-get-started align-self-start">Selegkapnya</a> --}}
                                 </div>
                                 <div class="col-lg-5 d-none d-md-flex align-items-center w-25" data-aos="zoom-out"
                                     style="overflow: hidden;">
                                     <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->alt_image }}"
                                         style="object-fit: cover; width: 100%; height: 100%;">
                                 </div>

                             </div><!-- Features Item -->
                         @else
                             {{-- Ini adalah iterasi ganjil --}}
                             <div class="row gy-2 align-items-stretch justify-content-between features-item mb-0 mt-0">
                                 <div class="col-lg-5 d-none d-md-flex align-items-center w-25" data-aos="zoom-out">
                                     <img src="{{ asset($item->image) }}" class="img-fluid"
                                         alt="{{ $item->alt_image }}">
                                 </div>
                                 <div class="col-lg-7 d-flex justify-content-center flex-column" data-aos="fade-up">
                                     <a href="{{ route('bidang.detail', [$item->slug]) }}">
                                         <h3>{{ $item->name }}</h3>
                                     </a>
                                     <p>{{ $item->description }}</p>
                                     {{-- <a href="#" class="btn btn-get-started align-self-start">Selegkapnya</a> --}}
                                 </div>
                             </div><!-- Features Item -->
                         @endif
                     @endforeach
                 </div>
                 <a href="{{ route('bidang.index') }}" class="read-more d-flex justify-content-center mt-5"
                     style="max-width: max-content"><span>Bidang lainnya</span><i class="bi bi-arrow-right"></i></a>
             @endif
         </div>

     </div>

 </section><!-- End Features Section -->
