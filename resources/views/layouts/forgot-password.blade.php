<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        <div class="container">
            <div class="d-flex justify-content-center align-items-center flex-column w-100" style="height: 100vh;">
                <div class="heading">
                    <h1 class="text-uppercase fs-3 ">Lupa Kata Sandi?</h1>
                    <p class="">Masukkan email Anda dan tunggu kode etik akan dikirimkan.</p>
                </div>
                <div class="form-auth p-4 rounded-2 mt-4">
                    @yield('form')
                </div>
            </div>
        </div>
    </main>

    @vite(['resources/js/app.js'])
</body>

</html>
