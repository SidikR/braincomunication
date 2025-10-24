<h5>Pesan</h5>
<section class="row">
    <div class="col-12">

        <div class="row">

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.administrator.pesan.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-envelope-exclamation"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Pesan Baru</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlah_pesan_baru }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.administrator.pesan.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-envelope-paper"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Sudah Dibaca</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlah_pesan_dibaca }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.administrator.pesan.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Seluruh Pesan</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pesan_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<hr>
