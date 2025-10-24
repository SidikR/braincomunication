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
            <div class="d-flex justify-content-center pb-5 align-items-center flex-column w-70" style="height: 100vh;">
                <div class="icon-login p-4 m-4 me-0">
                    <img src="{{ asset('storage/image/navbar.webp') }}" alt="logo dinas">
                    {{-- <i class="bi bi-person-fill" style="font-size: 8rem"></i> --}}
                </div>
                <div class="form-auth p-4 rounded-2 ">
                    @yield('form')
                </div>
            </div>
        </div>
    </main>

    @vite(['resources/js/app.js'])
</body>

</html>
