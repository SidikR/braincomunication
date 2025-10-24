<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="id" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($meta['title']) ? $meta['title'] . ' | ' . getInfo()->title : getInfo()->title }}</title>
    <meta name="title"
        content="{{ isset($meta['title']) ? $meta['title'] . ' | ' . getInfo()->title : getInfo()->title }} }}">
    <meta name="description"
        content="{{ isset($meta['description']) ? $meta['description'] : 'Selamat datang di ' . getInfo()->title . ' Temukan informasi terkini tentang layanan publik, kegiatan komunitas, dan inisiatif digital kami untuk memajukan Lampung Selatan. Mari bergabung dalam transformasi digital kami untuk menciptakan masyarakat yang terhubung dan berdaya saing tinggi' }}">
    <meta name="keywords"
        content="{{ isset($meta['keywords']) ? $meta['keywords'] . ',' . ' lampung, lampung selatan, dinas, opd, dinas komunikasi dan informatika, kominfo' : 'lampung, lampung selatan, dinas, opd, dinas komunikasi dan informatika, kominfo' }}">
    <meta name="author" content="{{ isset($meta['author']) ? $meta['author'] : getInfo()->title }}">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="1 days">
    <meta name="generator" content="Laravel">
    <meta name="googlebot-news" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="language" content="id" />
    <meta name="geo.country" content="id" />
    <meta name="geo.placename" content="Indonesia" />
    <link rel="canonical" href="{{ url()->current() }}" />


    <!-- Schema Markup -->
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "Dinas Komunikasi dan Informatika",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('assets/img/kominfo.png') }}",
      "description": "Deskripsi singkat tentang Dinas Komunikasi dan Informatika"
    }
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-70B1E9M424"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-70B1E9M424');
    </script>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title"
        content="{{ isset($meta['title']) ? $meta['title'] . ' | ' . getInfo()->title : getInfo()->title }}" />
    <meta property="og:description"
        content="{{ isset($meta['description']) ? $meta['description'] : 'Selamat datang di ' . getInfo()->title . ' Temukan informasi terkini tentang layanan publik, kegiatan komunitas, dan inisiatif digital kami untuk memajukan Lampung Selatan. Mari bergabung dalam transformasi digital kami untuk menciptakan masyarakat yang terhubung dan berdaya saing tinggi' }}" />
    <meta property="og:image" content="{{ $meta['thumbnail'] ?? asset('assets/img/thumbnail.jpg') }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="twitter:title"
        content="{{ isset($meta['title']) ? $meta['title'] . ' | ' . getInfo()->title : getInfo()->title }}" />
    <meta property="twitter:description"
        content="{{ isset($meta['description']) ? $meta['description'] : 'Selamat datang di ' . getInfo()->title . ' Temukan informasi terkini tentang layanan publik, kegiatan komunitas, dan inisiatif digital kami untuk memajukan Lampung Selatan. Mari bergabung dalam transformasi digital kami untuk menciptakan masyarakat yang terhubung dan berdaya saing tinggi' }}" />
    <meta property="twitter:image" content="{{ $meta['thumbnail'] ?? asset('assets/img/thumbnail.jpg') }}" />


    {{-- News --}}
    @if (isset($meta['published_at']))
        <meta property="article:published_time" content="{{ $meta['published_at'] }}" />
    @endif

    @if (isset($meta['modified_at']))
        <meta property="article:modified_time" content="{{ $meta['modified_at'] }}" />
    @endif



    <!-- Favicons -->
    <link rel="icon" href="{{ asset('storage/image/favicon.webp') }}" type="image/x-icon">

    <!-- Cache-Control -->
    <?php header('Cache-Control: max-age=3600, public'); ?>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Strict-Transport-Security (HSTS) -->
    <?php header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload'); ?>

    <!-- Cross-Origin Resource Sharing (CORS) -->
    <?php header('Access-Control-Allow-Origin: *'); ?>

    {{-- Css File --}}
    @vite(['resources/css/app.css'])
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/utils/calculateDaysAgo.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">


    <div class="loader-container">
        <div class="loader-bar" id="loaderBar"></div>
    </div>

    <x-navbar />

    <main id="main">
        @yield('content')

    </main>

    <x-footer />


    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/js/app.js'])

    <script>
        var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        function SuccessAlert(message, action, url) {
            var baseURL = window.location.origin;

            // Validasi parameter
            if (action === "reload") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: message,
                    showConfirmButton: false,
                    timer: 3000,
                }).then(() => {
                    window.location.reload();
                });
            } else if (action === "redirect" && url) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: message,
                    showConfirmButton: false,
                    timer: 3000,
                }).then(() => {
                    window.location.href = `${baseURL}/${url}`;
                });
            } else {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: message,
                    showConfirmButton: false,
                    timer: 3000,
                });
            }
        }

        function ErrorAlert(message, action, url) {
            var baseURL = window.location.origin;

            // Validasi parameter
            if (action === "reload") {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: message,
                    showConfirmButton: false,
                    timer: 3000,
                }).then(() => {
                    window.location.reload();
                });
            } else if (action === "redirect" && url) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: message,
                    showConfirmButton: false,
                    timer: 3000,
                }).then(() => {
                    window.location.href = `${baseURL}/${url}`;
                });
            } else {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: message,
                    showConfirmButton: false,
                    timer: 3000,
                });
            }
        }

        function WarningAlert(method, url, title, text) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger m-2",
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons
                .fire({
                    title: title,
                    text: text,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios[method](
                                url, {}, {
                                    baseURL: window.location.origin,
                                    headers: {
                                        "X-CSRF-TOKEN": csrfToken,
                                        "Content-Type": "application/json",
                                    },
                                }
                            )
                            .then((response) => {
                                if (response.data.success) {
                                    SuccessAlert(response.data.message, "reload");
                                } else {
                                    ErrorAlert(response.data.message);
                                }
                            })
                            .catch((error) => {
                                ErrorAlert(
                                    "An error occurred while processing your request. mkmkm"
                                );
                                console.error(error);
                            });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled",
                            text: "Your imaginary file is safe :)",
                            icon: "error",
                        });
                    }
                });
        }

        function LogoutAlert(title, text, form) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger m-2",
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons
                .fire({
                    title: title,
                    text: text,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        event.preventDefault();
                        form.submit();
                        SuccessAlert("Berhasil Logout", "reload");
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled",
                            text: "Ok stay sisini saja ya ;)",
                            icon: "error",
                        });
                    }
                });
        }
        @if (session('success'))
            var successMessage = "{{ session('success') }}";
            SuccessAlert(successMessage);
        @endif

        @if (session('error'))
            var errorMessage = "{{ session('error') }}";
            ErrorAlert(errorMessage);
        @endif
    </script>

</body>

</html>
