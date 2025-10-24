 <!-- Contact Section - Home Page -->
 <section id="contact" class="contact" style="background-color: #f4f4f4">

     <!--  Section Title -->
     <div class="container section-title">
         <h2>Kontak Kami</h2>
         <p>Silakan hubungi kami melalui beberapa saluran berikut</p>
     </div><!-- End Section Title -->

     <div class="container" data-aos-delay="100">

         <div class="row gy-4">
             <div class="col-lg-6 rounded-3 ">
                 <form action="{{ route('pesan.store') }}" method="post" class="php-email-form rounded-3"
                     data-aos-delay="200">
                     @method('POST')
                     @csrf
                     <div class="row gy-4">

                         <div class="col-md-6">
                             <input type="text" name="nama" class="form-control rounded-3 "
                                 placeholder="Nama Anda" required>
                         </div>

                         <div class="col-md-6 ">
                             <input type="text" class="form-control rounded-3 " name="hp" placeholder="Nomor Hp"
                                 required>
                         </div>

                         <div class="col-md-12">
                             <input type="text" class="form-control rounded-3 " name="subject" placeholder="Subject"
                                 required>
                         </div>

                         <div class="col-md-12">
                             <textarea class="form-control rounded-3 " name="pesan" rows="6" placeholder="Pesan" required></textarea>
                         </div>

                         <div class="col-md-12 text-center">

                             @if (session('success'))
                                 <div class="alert alert-success">
                                     {{ session('success') }}
                                 </div>
                             @endif
                             @if (session('error'))
                                 <div class="alert alert-error">
                                     {{ session('error') }}
                                 </div>
                             @endif

                             <button type="submit" class="rounded-4">Send Message</button>
                         </div>

                     </div>
                 </form>
             </div><!-- End Contact Form -->

             <div class="col-lg-6">
                 <div class="row gy-4">
                     <div class="info-item rounded-3" data-aos="fade" data-aos-delay="200">
                         <div class="maps d-flex flex-column w-100" style="height: 400px;">
                             <h3 class="text-center p-2 mt-0">Lokasi</h3>
                             {!! getInfo()->maps !!}
                         </div>
                     </div>
                 </div>

             </div>
         </div>

     </div>

 </section><!-- End Contact Section -->
