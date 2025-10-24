    <footer id="footer" class="footer pb-0 position-relative ">

        <div class="container footer-top">

            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="#" class="logo d-flex align-items-center m-0">
                        <span>{{ getInfo()->title }}</span>
                    </a>
                    {{-- <a href="https://lampungselatankab.go.id" target="_blank">Pemerintah Kabupaten Lampung Selatan</a> --}}
                    <div class="social-links d-flex mt-4">
                        <a href="{{ getInfo()->twitter }}" target="_blank">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a target="_blank" href="{{ getInfo()->facebook }}"><i class="bi bi-facebook"></i></a>
                        <a target="_blank" href="{{ getInfo()->instagram }}"><i class="bi bi-instagram"></i></a>
                        {{-- <a href=""><i class="bi bi-linkedin"></i></a> --}}
                    </div>

                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="{{ route('tentang_kami.index') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('program.index') }}">Program</a></li>
                        <li><a href="{{ route('testimoni.index') }}">Testimoni</a></li>
                        <li><a href="{{ route('berita.index') }}">Berita dan Kegiatan</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Program</h4>
                    <ul>
                        @foreach (getProgram() as $slug => $title)
                            <li><a href="{{ route('program.detail', $slug) }}">{{ $title }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>{{ getInfo()->alamat }}
                    </p>
                    <p class="mt-4"><strong>Phone:</strong> <span>{{ getInfo()->hp }}</span></p>
                    <p><strong>Email:</strong> <span>{{ getInfo()->email }}</span></p>
                </div>

            </div>

        </div>

        <div class="container-fluid copyright text-center mt-4 mb-0">
            <p>&copy; <span>Copyright 2024</span> <strong class="px-1">{{ getInfo()->title }}</strong>
                <span>All
                    Rights Reserved</span>
            </p>
        </div>

    </footer>
