<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{ route('homepage') }}" class="logo d-flex align-items-center me-auto me-xl-0 gap-2">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('storage/image/navbar.webp') }}" alt="logo dinas">
            {{-- <h1 class="d-none d-lg-block ">{{ getInfo()->title }}</h1> --}}
        </a>

        <!-- Nav Menu -->
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('homepage') }}">Beranda</a></li>
                <li><a href="{{ route('tentang_kami.index') }}">Tentang Kami</a></li>
                <li><a href="{{ route('program.index') }}">Program</a></li>
                <li><a href="{{ route('testimoni.index') }}">Testimoni</a></li>
                <li><a href="{{ route('berita.index') }}">Berita & Kegiatan</a></li>
                <li><a href="{{ route('galeri.index') }}">Galeri</a></li>
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="button" class="btn btn-sm btn-danger px-3 rounded-3 mx-3"
                            onclick="LogoutAlert('Apakah Anda yakin ingin logout?', 'Anda akan diarahkan ke halaman login.' , document.getElementById('logout-form'))"
                            title="Logout Now!"><i class="bi bi-box-arrow-right"></i>  Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        <button class="btn btn-primary btn-sm mx-3 rounded-3">Login</button>
                    </a>
                @endauth
            </ul>

            <script>
                $(document).ready(function() {
                    // Mendapatkan URL saat ini
                    var currentUrl = window.location.href;

                    // Loop melalui setiap tautan pada navigasi
                    $("ul li a").each(function() {
                        // Memeriksa apakah URL tautan ini cocok dengan URL saat ini
                        if ($(this).attr("href") === currentUrl) {
                            // Menambahkan kelas "active" jika cocok
                            $(this).addClass("active");
                        } else if (
                            currentUrl.endsWith("/") &&
                            $(this).attr("href") === "{{ route('homepage') }}"
                        ) {
                            // Kasus khusus untuk tautan "Home" jika URL saat ini adalah halaman beranda
                            $(this).addClass("active");
                        }
                    });
                });
            </script>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav><!-- End Nav Menu -->

    </div>
</header><!-- End Header -->
