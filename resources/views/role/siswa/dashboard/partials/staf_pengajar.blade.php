<h5>Umum</h5>
<!-- Card With Icon States Background -->
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Visitors</p>
                          <h4 class="card-title">1,294</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                          <i class="fas fa-user-check"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Subscribers</p>
                          <h4 class="card-title">1303</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-success bubble-shadow-small"
                        >
                          <i class="fas fa-luggage-cart"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Sales</p>
                          <h4 class="card-title">$ 1,345</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-secondary bubble-shadow-small"
                        >
                          <i class="far fa-check-circle"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Order</p>
                          <h4 class="card-title">576</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<section class="row">
    <div class="col-12">

        <div class="row">

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.staf_administrasi.siswa.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-buildings"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Jumlah Staf Pengajar</h6>
                                    <h6 class="font-extrabold mb-0">{{ $siswa_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.staf_administrasi.siswa.index') }}">
                        <div class="card-body p-3">
                            <div
                                class="row d-flex justify-content-center justify-content-xl-between align-items-center ">
                                <div class="col-12  icon text-center ">
                                    <i class="bi bi-buildings"></i>
                                </div>
                                <div class="col-12  info text-center ">
                                    <h6 class="text-black-50 font-semibold">Jumlah Staf Pengajar Aktif</h6>
                                    <h6 class="font-extrabold mb-0">{{ $siswa_active_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


            {{-- <div class="mb-2 col-12 col-lg-4 col-md-6">
                <div class="card-info">
                    <a href="{{ route('dashboard.staf_administrasi.pejabat.index') }}">
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
                    <a href="{{ route('dashboard.staf_administrasi.bidang.index') }}">
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
            </div> --}}

        </div>
    </div>
</section>
<hr>
