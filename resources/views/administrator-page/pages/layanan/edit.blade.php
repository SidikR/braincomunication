@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/administrator/layanan">Daftar Layanan</a></li>
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
                <form action={{ route('dashboard.administrator.layanan.update', ['layanan' => $layanan->slug]) }}
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <fieldset>
                        <div class="d-flex row">

                            <div class="col-12 col-md-4  d-flex justify-content-center align-items-center ">
                                <div class="image text-center">
                                    <div class="mb-3">
                                        <label for="image1" class="required mb-2">Image Layanan </label>
                                        <div id="imagePreviewBox">
                                            <figure class="image-preview">
                                                <img src="{{ asset($layanan->image) }}" id="image1-display">
                                                <input type="hidden" name="image" id="image1"
                                                    value="{{ $layanan->image }}">
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

                            <div class="col-12 col-md-8">
                                {{-- alt imge field --}}
                                <div class="mb-3">
                                    <label for="alt_image" class="form-label">Alternatif Image Text</label>
                                    <input type="text" id="alt_image"
                                        class="form-control @error('alt_image') is-invalid @enderror"
                                        placeholder="Text alternatif image ...." name="alt_image"
                                        aria-invalid="{{ $errors->has('alt_image') ? 'true' : 'false' }}"
                                        aria-required="true" aria-describedby="alt_image_help"
                                        value="{{ $layanan->alt_image }}">
                                    @error('alt_image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label required">Nama Layanan</label>
                                    <input type="text" id="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama Layanan"
                                        name="name" value="{{ $layanan->name }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Layanan</label>
                                    <textarea class="form-control" name="description" id="description" rows="4">{{ $layanan->description }}</textarea>
                                </div>

                            </div>
                            <div class="mb-3 mt-3">
                                <label for="content" class="form-label required">Konten Layanan</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="30"
                                    required>{{ $layanan->content }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </fieldset>

                    <div class="d-flex flex-column  flex-lg-row  justify-content-end gap-2">
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
        var givenDate = '{{ $layanan->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
