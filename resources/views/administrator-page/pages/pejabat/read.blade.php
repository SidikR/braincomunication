@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.administrator.pejabat.index') }}">Pejabat</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] . ' : ' . $pejabat->judul_gallery }}
            </li>
        </ol>
    </nav>
    <section class="section bg-white">
        <div class="blog-details-page bg-white">
            <section id="blog-details" class="blog-details">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="name">
                            <h5 class="card-title">
                                {{ $data['page_name'] }}
                            </h5>
                            <span><i class="bi bi-clock-history"></i> Updated : <span id="result"></span></span>
                        </div>
                        <div class="d-flex justify-content-end gap-2 align-items-center">

                            <a href="{{ route('dashboard.administrator.pejabat.edit', [$pejabat->ulid]) }}"
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
                                            <label for="image1" class="required mb-2">Image Pejabat </label>
                                            <div id="imagePreviewBox">
                                                <figure class="image-preview">
                                                    <img src="{{ asset($pejabat->image) }}" id="image1-display"
                                                        alt="{{ $pejabat->alt_image }}">
                                                    <input type="hidden" name="image" id="image1"
                                                        value="{{ $pejabat->image }}">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="alt_image" class="form-label">Alt Image</label>
                                    <input type="text" class="form-control" aria-describedby="helpId"
                                        value="{{ $pejabat->alt_image }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Pejabat</label>
                                    <input type="text" class="form-control" aria-describedby="helpId"
                                        value="{{ $pejabat->name }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control" aria-describedby="helpId"
                                        value="{{ $pejabat->nip }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="position" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" aria-describedby="helpId"
                                        value="{{ $pejabat->position }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="detail_pejabat" class="form-label">Keterangan Pejabat</label>
                                    <textarea class="form-control" rows="3">{{ $pejabat->detail }}</textarea>
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
        var givenDate = '{{ $pejabat->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
