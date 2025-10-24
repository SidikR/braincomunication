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
            <div class="card-body p-3">
                <form action={{ route('dashboard.administrator.layanan.edit', ['layanan' => $layanan->slug]) }}>
                    <fieldset disabled>
                        <div class="d-flex row">

                            <div class="col-12 col-md-4  d-flex justify-content-center align-items-center ">
                                <div class="image text-center">
                                    <div class="mb-3">
                                        <label for="image1" class="mb-2">Image Layanan </label>
                                        <div id="imagePreviewBox">
                                            <figure class="image-preview">
                                                <img src="{{ asset($layanan->image) }}" id="image1-display"
                                                    alt="{{ $layanan->alt_image }}">
                                                <input type="hidden" name="image" id="image1"
                                                    value="{{ $layanan->image }}">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-8">
                                <div class="mb-3">
                                    <label for="alt_image" class="form-label">Alt Image</label>
                                    <input type="text" id="alt_image" class="form-control" name="alt_image"
                                        value="{{ $layanan->alt_image }}">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Layanan</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        value="{{ $layanan->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Layanan</label>
                                    <textarea class="form-control" name="description" id="description" rows="4">{{ $layanan->description }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="content" class="form-label fw-bold ">Konten Layanan </label>
                                <div class="content">
                                    {!! $layanan->content !!}
                                </div>
                            </div>

                    </fieldset>

                    <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                        <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit
                            Data</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

    <script script>
        var givenDate = '{{ $layanan->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
