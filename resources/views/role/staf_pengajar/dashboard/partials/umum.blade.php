<h5>Umum</h5>
<section class="row">
    <div class="col-12">

        <div class="row">

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.administrator.layanan.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-buildings"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Layanan</h6>
                                    <h6 class="font-extrabold mb-0">{{ $layanan_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.administrator.pejabat.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-person-vcard"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Pejabat</h6>
                                    <h6 class="font-extrabold mb-0">{{ $layanan_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.administrator.bidang.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-command"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Bidang</h6>
                                    <h6 class="font-extrabold mb-0">{{ $layanan_count }}</h6>
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
