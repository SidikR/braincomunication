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
                <li class="nav-item">
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
                        <span><i class="fas fa-clock text-primary"></i> Updated : <span id="result"></span></span>
                    </div>
                    <div class="card-body">
                        <form action={{ route('dashboard.administrator.about.update', [$about->id]) }} method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <fieldset>

                                <div class="iframe d-flex justify-content-center ">
                                    {!! $about->iframe !!}
                                </div>

                                <div class="mb-3">
                                    <label for="iframe" class="form-label required">Iframe</label>
                                    <textarea class="form-control @error('iframe') is-invalid @enderror" name="iframe" id="iframe"
                                        placeholder="Masukan iframe about..." rows="3">{{ $about->iframe }}</textarea>
                                    @error('iframe')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label required">Title</label>
                                    <input type="text" class="form-control @error('title') 'is-invalid' @enderror"
                                        name="title" id="title" aria-describedby="helpId"
                                        placeholder="Masukkan Alt Image... " value="{{ $about->title }}" />
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label required">Deskripsi About</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                        placeholder="Masukan description about..." rows="3">{{ $about->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label required">Konten Berita</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="30">{{ $about->content }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </fieldset>

                            <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                                <button type="button" class="btn btn-danger rounded-3" onclick="goBack()"><i
                                        class="fas fa-undo"></i> Kembali</button>
                                <button type="submit" class="btn btn-success rounded-3"><i class="fas fa-paper-plane"
                                        aria-hidden="true"></i> Simpan Perubahan
                                    Data</button>
                            </div>

                        </form>
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
