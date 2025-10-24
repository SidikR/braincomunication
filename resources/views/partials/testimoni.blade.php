 <!-- Testimonials Section - Home Page -->
 <section id="testimonials" class="testimonials">

     <div class="container">

         <div class="row align-items-center">

             <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
                 <h3>Testimonials</h3>
                 <p>
                     Berikut testimoni dari di dari sahabat brainco, yuk gabung bersama kami 
                 </p>
             </div>

             <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

                 <div class="swiper">
                     <template class="swiper-config">
                         {
                         "loop": true,
                         "speed" : 600,
                         "autoplay": {
                         "delay": 5000
                         },
                         "slidesPerView": "auto",
                         "pagination": {
                         "el": ".swiper-pagination",
                         "type": "bullets",
                         "clickable": true
                         }
                         }
                     </template>
                     <div class="swiper-wrapper">
                         @foreach ($testimoni as $item)
                             <div class="swiper-slide">
                                 <section id="testimonials" class="testimonials rounded-4 row bg-white">
                                     <div class="testimonial-item p-3 m-5 rounded-4">
                                         <div class="d-flex">
                                             <img src="{{ asset($item->image) }}" class="testimonial-img flex-shrink-0"
                                                 alt="">
                                             <div>
                                                 <h3>{{ $item->nama }}</h3>
                                                 <h4>{{ $item->posisi }}</h4>
                                                 <div class="stars">
                                                     <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                         class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                         class="bi bi-star-fill"></i>
                                                 </div>
                                             </div>
                                         </div>
                                         <p>
                                             <i class="bi bi-quote quote-icon-left"></i>
                                             <span>{{ $item->pesan }}</span>
                                             <i class="bi bi-quote quote-icon-right"></i>
                                         </p>
                                     </div>
                                 </section><!-- End Testimonials Section -->
                             </div><!-- End testimonial item -->
                         @endforeach
                     </div>
                     <div class="swiper-pagination"></div>
                 </div>

             </div>

         </div>

     </div>

 </section><!-- End Testimonials Section -->
