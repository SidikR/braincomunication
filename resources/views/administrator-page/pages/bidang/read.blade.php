@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.administrator.bidang.index') }}">Daftar Bidang</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] . ' : ' . $bidang->name }}
            </li>
        </ol>
    </nav>
    <section class="section bg-white">
        <div class="blog-details-page bg-white">
            <section id="blog-details" class="blog-details">
                <div class="card">
                    <div
                        class="card-header d-flex flex-column-reverse flex-lg-row justify-content-center justify-content-lg-between">
                        <div class="name">
                            <h5 class="card-title">
                                {{ $data['page_name'] }}
                            </h5>
                            <span><i class="bi bi-clock-history"></i> Updated : <span id="result"></span></span>
                        </div>
                        <div class="d-flex justify-content-end gap-2 align-items-center">

                            <a href="{{ route('dashboard.administrator.bidang.edit', [$bidang->slug]) }}"
                                class="align-items-center"><button class="btn btn-sm btn-success"><i
                                        class="bi bi-pencil-square"></i> Edit
                                </button></a>

                        </div>
                    </div>
                </div>

                <div class="card-body my-3 bg-body mx-3 p-2 rounded-3 bg-transparent ">
                    <div class="row">
                        <div class="col-lg-12 bg-white">
                            <fieldset disabled>
                                <div
                                    class="px-xl-5 mb-4 col-12 d-flex gap-xl-5 m-0 justify-content-center align-items-center ">
                                    <div class="image-container text-center">
                                        <div class="mb-3 w-100">
                                            <label for="image1" class="required mb-2">Image Bidang </label>
                                            <div id="imagePreviewBox">
                                                <figure class="image-preview w-100">
                                                    <img src="{{ asset($bidang->image) }}" id="image1-display"
                                                        alt="{{ $bidang->alt_image }}">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="alt_image" class="form-label">Alt Image </label>
                                    <input type="text" class="form-control" aria-describedby="helpId" id="alt_image"
                                        value="{{ $bidang->alt_image }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="judul_galeri" class="form-label">Nama Bidang </label>
                                    <input type="text" class="form-control" aria-describedby="helpId"
                                        value="{{ $bidang->name }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Deskripsi Bidang</label>
                                    <textarea class="form-control" rows="3">{{ $bidang->description }}</textarea>
                                </div>

                                <h3 class="p-5 text-center">Konten Bidang</h3>

                                <div class="content">
                                    {!! $bidang->content !!}
                                </div>

                            </fieldset>
                        </div>
                    </div>
                </div>
            </section><!-- End Blog-details Section -->
        </div>
    </section><!-- End Blog-details Section -->
    {{-- Handle human updated at format --}}
    <script script>
        var givenDate = '{{ $bidang->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
