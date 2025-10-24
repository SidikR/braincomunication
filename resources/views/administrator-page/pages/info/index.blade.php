@extends('dashboard.layouts.main')
@section('content')
    <div class="page-inner">

        {{-- Breadcrumbs --}}
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.index') }}">
                        <i class="icon-home text-primary"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-kategori-galeri">
                    <a href="#">{{ $data['page_name'] ?? '' }}</a>
                </li>
            </ul>
        </div>

        {{-- Konten --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Tabel {{ $data['page_name'] ?? '' }}</h4>
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <span><i class="bi bi-clock-history"></i> Updated : <span id="result"></span></span>
                            <a href={{ route('dashboard.administrator.info.edit', [$info->id]) }}>
                                <button type="button" class="btn btn-primary btn-sm rounded-4"><i class="fa fa-plus"
                                        aria-hidden="true"></i> Edit Data</button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 bg-white">
                                <fieldset disabled>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title </label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            id="title" value="{{ $info->title }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email </label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            id="email" value="{{ $info->email }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="hp" class="form-label">Hp </label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            id="hp" value="{{ $info->hp }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" rows="8">{{ $info->alamat }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">Instagram Link</label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            id="instagram" value="{{ $info->instagram }}" />
                                        <small>Link Isntagram</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">Facebook Link</label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            id="facebook" value="{{ $info->facebook }}" />
                                        <small>Link Facebook</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="youtube" class="form-label">Youtube Link</label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            id="youtube" value="{{ $info->youtube }}" />
                                        <small>Link Youtube</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tiktok" class="form-label">Tiktok Link</label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            id="tiktok" value="{{ $info->tiktok }}" />
                                        <small>Link Tiktok</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="twitter" class="form-label">Twitter Link</label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            id="twitter" value="{{ $info->twitter }}" />
                                        <small>Link Twitter</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="maps" class="form-label">Maps Iframe</label>
                                        <textarea class="form-control" rows="8">{{ $info->maps }}</textarea>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script script>
        var givenDate = '{{ $info->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
