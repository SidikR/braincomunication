<div id="hero" class="slideshow-container ">
    <!-- Slides -->
    @foreach ($hero_carousel as $item)
        <div class="mySlides">
            <!-- Isi slide -->
            <img class="animate__animated animate__fadeIn" src="{{ asset($item->image) }}" alt="{{ $item->alt_image }}"
                style="width:100%">
            <div class="overlay-slide-hero"></div>
            <div class="heading-slide d-flex flex-column justify-content-center align-items-center text-center">
                <h1 class="text-white fw-bold animate__animated animate__bounceInLeft">{{ $item->heading }}</h1>
                <p class="animate__animated animate__bounceInRight">{{ $item->paragraph }}</p>
            </div>
        </div>
    @endforeach

    <!-- Navigasi -->
    <button type="button" class="prev" onclick="plusSlides(-1)" style="z-index: 50">❮</button>
    <button type="button" class="next" onclick="plusSlides(1)" style="z-index: 50">❯</button>

    <!-- Indikator -->
    <div class="dots gap-1" style="text-align:center; z-index: 50">
        @foreach ($hero_carousel as $item)
            <span class="dot" onclick="currentSlide({{ $loop->index + 1 }})"></span>
        @endforeach
    </div>

    <script>
        let slideIndex = 0;
        let slideInterval;

        showSlides();

        function plusSlides(n) {
            showSlides((slideIndex += n - 1));
        }

        function currentSlide(n) {
            showSlides((slideIndex = n - 1));
        }

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");

            if (slideIndex >= slides.length) {
                slideIndex = 0;
            }

            if (slideIndex < 0) {
                slideIndex = slides.length - 1;
            }

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }

            slides[slideIndex].style.display = "block";
            dots[slideIndex].className += " active";

            slideIndex++;
            clearInterval(slideInterval);
            slideInterval = setInterval(showSlides, 4000);
        }
    </script>

    <!-- Gelombang -->
    {{-- <div class="position-absolute w-100" style="bottom: 0; left: 0; z-index: 1;">
        <div class="ornamen d-flex justify-content-between position-relative ">
            <img class="ornamen-hero flip-image" src="{{ asset('storage/ornamen/BQC0CGNwpmPcHQzWMpn5.webp') }}"
                alt="">
            <img class="ornamen-hero" src="{{ asset('storage/ornamen/BQC0CGNwpmPcHQzWMpn5.webp') }}" alt="">

        </div>
    </div> --}}

</div>
