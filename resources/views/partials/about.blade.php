<!-- About Section - Home Page -->
<section id="about" class="about">

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

            <div class="col-xl-7 content text-white ">
                <h3>About Us</h3>
                <h2 class="text-white">{{ $about->title }}</h2>
                <p>{{ $about->description }}</p>
                <a href="{{ route('about.index') }}" class="read-more"><span>Read More</span><i
                        class="bi bi-arrow-right"></i></a>
            </div>

            <div class="col-xl-5">
                <div class="row gy-4 icon-boxes" style="height: 300px">

                    {!! $about->iframe !!}

                </div>
            </div>

        </div>
    </div>

</section><!-- End About Section -->
