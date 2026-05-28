@extends('dashboard.layouts.main')
@section('content')
    <div class="page-inner">

        <div class="page-header mb-4">
            <h4 class="page-title fw-bold">Selamat Datang, {{ Auth::user()->name }}</h4>
            <p class="text-muted mb-0">{{ getInfo()->title }}</p>
        </div>

        {{-- Profil singkat --}}
        <div class="row g-3 mb-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body d-flex align-items-center gap-4 flex-wrap">
                        <img src="{{ asset(Auth::user()->image) }}" alt="Foto Profil"
                            class="rounded-circle border" style="width:72px;height:72px;object-fit:cover;">
                        <div>
                            <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-1 small"><i class="fas fa-envelope me-1"></i>{{ Auth::user()->email }}</p>
                            <span class="badge bg-primary rounded-pill px-3">{{ ucfirst(Auth::user()->role) }}</span>
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('dashboard.profile.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-user-edit me-1"></i> Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Akses Cepat --}}
        <div class="row g-3 mb-4">
            <div class="col-md-12">
                <h6 class="fw-semibold text-muted mb-3">Akses Cepat</h6>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('dashboard.user.informasi.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3 h-100">
                        <div class="rounded-circle bg-primary bg-opacity-10 mx-auto p-3 mb-2" style="width:56px;height:56px;">
                            <i class="fas fa-bell text-primary"></i>
                        </div>
                        <p class="mb-0 small fw-semibold text-dark">Informasi</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('program.index') }}" target="_blank" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3 h-100">
                        <div class="rounded-circle bg-success bg-opacity-10 mx-auto p-3 mb-2" style="width:56px;height:56px;">
                            <i class="fas fa-book text-success"></i>
                        </div>
                        <p class="mb-0 small fw-semibold text-dark">Program</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('layanan.index') }}" target="_blank" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3 h-100">
                        <div class="rounded-circle bg-warning bg-opacity-10 mx-auto p-3 mb-2" style="width:56px;height:56px;">
                            <i class="fas fa-concierge-bell text-warning"></i>
                        </div>
                        <p class="mb-0 small fw-semibold text-dark">Layanan</p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('dashboard.profile.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-3 h-100">
                        <div class="rounded-circle bg-info bg-opacity-10 mx-auto p-3 mb-2" style="width:56px;height:56px;">
                            <i class="fas fa-cog text-info"></i>
                        </div>
                        <p class="mb-0 small fw-semibold text-dark">Profil</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- Hubungi --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded-3 text-center p-4">
                    <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold mb-1">Butuh Bantuan?</h5>
                    <p class="text-muted mb-3">Hubungi admin kami melalui WhatsApp untuk informasi lebih lanjut.</p>
                    <a href="https://wa.me/{{ getInfo()->hp }}" target="_blank" class="btn btn-success px-4">
                        <i class="fab fa-whatsapp me-2"></i> Hubungi Admin
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
