@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ route('dashboard.administrator.index') }}>Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.administrator.bidang.index') }}">Daftar Bidang</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ $data['page_name'] }}
                </h5>
                <span><i class="bi bi-clock-history"></i> Updated : <span id="result"></span></span>
            </div>
            <div class="card-body">
                <form action={{ route('dashboard.administrator.bidang.update', [$bidang->slug]) }} method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <fieldset>
                        <div class="px-xl-5 mb-4 col-12 d-flex gap-xl-5 m-0 justify-content-center align-items-center ">
                            <div class="image-container text-center">
                                <div class="mb-3 w-100">
                                    <label for="image1" class="required mb-2">Image Bidang </label>
                                    <div id="imagePreviewBox">
                                        <figure class="image-preview w-100">
                                            <img src="{{ asset($bidang->image) }}" id="image1-display" width="100%">
                                            <input type="hidden" name="image" id="image1"
                                                value="{{ $bidang->image }}">
                                        </figure>
                                    </div>
                                    @error('image')
                                        <div class="text-danger ">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="button" class="btn btn-primary mt-2 upload-button" id="button-image"
                                    data-input-id="image1">
                                    <i class="bi bi-cloud-arrow-up-fill"></i> Update Photo
                                </button>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="alt_image" class="form-label">Alt Image</label>
                            <input type="text" class="form-control" name="alt_image" id="alt_image"
                                aria-describedby="helpId" placeholder="Masukkan Alt Image... "
                                value="{{ $bidang->alt_image }}" />
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label required">Nama Bidang</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nama Bidang" aria-required="true" aria-describedby="name_help" name="name"
                                value="{{ $bidang->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label required">Deskripsi Bidang</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                placeholder="Masukan description bidang..." rows="3">{{ $bidang->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label required">Konten Berita</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="30">{{ $bidang->content }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </fieldset>

                    <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                        <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                        <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy"></i> Simpan Data</button>
                    </div>

                </form>

            </div>
        </div>
    </section>

    {{-- Handle human updated at format --}}
    <script script>
        var givenDate = '{{ $bidang->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
