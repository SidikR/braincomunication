<h5>Berita</h5>
<section class="row">
    <div class="col-12">

        <div class="row">

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.administrator.berita.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-check-all"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Berita Publish</h6>
                                    <h6 class="font-extrabold mb-0">{{ $berita_publish_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.administrator.berita.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-exclamation-circle"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Berita Belum Publish</h6>
                                    <h6 class="font-extrabold mb-0">{{ $berita_unpublish_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.administrator.berita.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-newspaper"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Seluruh Berita</h6>
                                    <h6 class="font-extrabold mb-0">{{ $berita_count }}</h6>
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
