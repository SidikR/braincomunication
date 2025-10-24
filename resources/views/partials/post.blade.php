 <!-- Recent-posts Section - Home Page -->
 <section id="recent-posts" class="recent-posts" data-aos="fade-up">

     <!--  Section Title -->
     <div class="container section-title">
         <h2>Berita Terbaru</h2>
         <p>Banyak hal berita terbaru di {{getInfo()->title}}, mari eksplor lebih jauh!</p>
     </div><!-- End Section Title -->

     <div class="container">

         <div class="row gy-4 d-flex justify-content-center align-items-center">
             @if ($berita == null)
                 <div class="col-lg-12 p-2 text-center">
                     <p>Tidak ada berita terbaru saat ini.</p>
                 </div>
             @else
                 <div class="content d-md-flex justify-content-center  gap-2">
                     @php $count = 0; @endphp

                     @foreach ($berita as $index => $item)
                         @if ($count < 3)
                             <div class="col-xl-4 col-12 px-3 my-4" data-aos="fade-up" data-aos-delay="100">
                                 <article>
                                     <div class="post-img" style="position: relative">
                                         <div class="post-img-overlay z-3  ">{{ $item->kategori->name }}</div>
                                         <img src="{{ asset($item->image) }}" alt="{{ $item->alt_image }}"
                                             class="img-fluid rounded-4"
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                     </div>

                                     <div class="info-post d-flex justify-content-between gap-2 flex-column "
                                         style="min-height: 150px">
                                         <div class="title-content">
                                             <h2 class="title mb-1">
                                                 <a href={{ route('berita.detail', [$item->slug]) }}>
                                                     @if (strlen($item->title) > 60)
                                                         {{ substr($item->title, 0, 60) }}...
                                                     @else
                                                         {{ $item->title }}
                                                     @endif
                                                 </a>
                                             </h2>

                                             <div class="content mb-2 mt-0">
                                                 @if (strlen($item->description) > 50)
                                                     {{ substr($item->description, 0, 50) }}...
                                                 @else
                                                     {{ $item->description }}
                                                 @endif
                                             </div>
                                         </div>

                                         <div class="d-flex align-items-center">
                                             <div class="post-meta">
                                                 <p class="post-date">
                                                     <span><i class="bi bi-clock-history"></i> <span
                                                             id="result{{ $index }}"></span></span>
                                                 </p>
                                             </div>
                                         </div>
                                     </div>

                                 </article>
                             </div><!-- End post list item -->
                             <script script>
                                 var givenDate = '{{ $item->published_at }}';
                                 calculateDaysAgo(givenDate, 'result{{ $index }}');
                             </script>
                             @php $count++; @endphp
                         @endif
                     @endforeach
                 </div>

                 <a href="{{ route('berita.index') }}" class="read-more d-flex justify-content-center "
                     style="max-width: max-content"><span>Berita Lainnya</span><i class="bi bi-arrow-right"></i></a>
             @endif
         </div><!-- End recent posts list -->

     </div>

 </section><!-- End Recent-posts Section -->
