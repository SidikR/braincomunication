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
                            <a href={{ route('dashboard.administrator.about.edit', [$about->id]) }}>
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
                                        <input type="text" class="form-control" aria-describedby="helpId" id="title"
                                            value="{{ $about->title }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Descripsi</label>
                                        <textarea class="form-control" rows="8">{{ $about->description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="media" class="form-label">Media</label>
                                        <div class="form-control" rows="8">{!! $about->iframe !!}</div>
                                    </div>

                                    <h3 class="p-3 text-center">Konten About</h3>

                                    <div class="content">
                                        {!! $about->content !!}
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
        var givenDate = '{{ $about->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
