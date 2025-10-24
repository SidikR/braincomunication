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
                    <div class="card-body text-black p-0 p-xl-2">
                        <p class="text-center p-3">Silakan pilih image dan isi teks untuk ditampilkan pada hero</p>
                        <div class="bg-body p-xl-3 rounded-2 mt-3" style="width: 100%">
                            <div class="row p-xl-2">
                                <div class="col-12 col-md-6 col-xl-10 d-flex flex-column flex-xl-row gap-2 mb-2 mb-xl-0"
                                    style="overflow-x: auto;">
                                    @foreach ($hero_carousel as $item)
                                        <div class="image-preview" onclick="showCarouselDetail('{{ $item->id }}')"
                                            style="height: 150px; width: 300px flex: 0 0 auto; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
                                            <img src="{{ asset($item->image) }}" alt="{{ asset($item->alt_image) }}"
                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; cursor: pointer">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12 col-md-6 col-xl-2 add-image-carousel text-center bg-primary text-white rounded-4 align-items-center d-flex flex-column justify-content-center"
                                    id="button_add_hero_carousel" style="height: 150px" role="button">
                                    <i class="fas fa-plus fs-1"></i>
                                    <p>
                                        Add Hero Carrousel
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- add hero carousel --}}
                        <div class="add-image p-0 p-xl-3 rounded-2 mt-3" id="add_hero_carousel" style="display: none">
                            <div class="mt-4 py-1">
                                <h5 class="text-center mb-4">Tambah Data Hero Carousel</h5>
                                <form action={{ route('dashboard.administrator.hero.store') }} method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row d-flex align-items-center">
                                        <div class="col-12 col-md-6 col-xl-5">
                                            <div class="image text-center">
                                                <div class="mb-3">
                                                    <label for="image1" class="required mb-2">Image Hero
                                                    </label>
                                                    <div id="imagePreviewBox">
                                                        <figure class="image-preview">
                                                            <img src="{{ asset('assets-admin/images/images.png') }}"
                                                                id="image1-display">
                                                            <input type="hidden" name="image" id="image1"
                                                                value="{{ old('image') }}">
                                                        </figure>
                                                        @error('image')
                                                            <div class="text-danger ">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-primary mt-2 upload-button"
                                                    id="button-image" data-input-id="image1">
                                                    <i class="bi bi-cloud-arrow-up-fill"></i> Upload Photo
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-xl-7">
                                            <div class="mb-3 mt-2">
                                                <label for="alt_image" class="form-label">Image Alt</label>
                                                <input type="text"
                                                    class="form-control @error('alt_image') is-invalid @enderror"
                                                    name="alt_image" id="alt_image" aria-describedby="helpId"
                                                    placeholder="ini image alt di hero" value="{{ old('alt_image') }}" />
                                                @error('alt_image')
                                                    <div class="text-danger ">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="heading" class="form-label">Heading</label>
                                                <input type="text"
                                                    class="form-control @error('heading') is-invalid @enderror"
                                                    name="heading" id="heading" aria-describedby="helpId"
                                                    placeholder="ini heading di hero" value="{{ old('heading') }}" />
                                                @error('heading')
                                                    <div class="text-danger ">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="paragraph" class="form-label">Paragraph</label>
                                                <input type="text"
                                                    class="form-control @error('paragraph') is-invalid @enderror"
                                                    name="paragraph" id="paragraph" aria-describedby="helpId"
                                                    placeholder="ini paragraph" value="{{ old('paragraph') }}" />
                                                @error('paragraph')
                                                    <div class="text-danger ">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex justify-content-center justify-content-xl-end  align-items-center w-100">
                                        <button type="submit" class="btn btn-success" style="width: fit-content">Tambah
                                            Hero</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- hero update & delete --}}
                        <div class="update-hero bg-body p-xl-3 p-0 rounded-2 mt-3" id="update_hero_carousel"
                            style="display: none">
                            <div class="mt-4 py-1">
                                <h5 class="text-center mb-4">Update Data Hero Carousel</h5>
                                <form id="form_update_carousel" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row d-flex align-items-center ">
                                        <div class="col-12 col-md-6 col-xl-5">
                                            <div class="d-flex flex-column justify-content-center align-items-center ">
                                                <div id="imagePreviewBox">
                                                    <div class="image-preview"
                                                        style="border-radius: 5px; box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.5);">

                                                        <img id="croppedImageFormUpdate"
                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">

                                                        <input type="hidden" name="image" id="image_update">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-7 mt-2">
                                            <div class="mb-3">
                                                <label for="alt_image" class="form-label">Image
                                                    Alt</label>
                                                <input type="text" class="form-control" name="alt_image"
                                                    id="alt_image_update" aria-describedby="helpId"
                                                    placeholder="ini alt image di hero" />
                                                @error('alt_image')
                                                    <div class="text-danger ">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="heading" class="form-label">Heading</label>
                                                <input type="text" class="form-control" name="heading"
                                                    id="heading_update" aria-describedby="helpId"
                                                    placeholder="ini heading di hero" />
                                                @error('heading')
                                                    <div class="text-danger ">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="paragraph" class="form-label">Paragraph</label>
                                                <input type="text" class="form-control" name="paragraph"
                                                    id="paragraph_update" aria-describedby="helpId"
                                                    placeholder="ini paragraph" />
                                                @error('paragraph')
                                                    <div class="text-danger ">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex flex-column flex-xl-row gap-2 justify-content-end  align-items-center w-100">
                                        <button type="submit" class="btn btn-success btn-sm"
                                            style="width: fit-content">Update Data</button>

                                        <button type="button" class="btn btn-sm btn-danger" id="form_delete_carousel"><i
                                                class="bi bi-trash3"></i>
                                            Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let addHeroCarousel = document.getElementById('add_hero_carousel');
        let buttonAddCarousel = document.getElementById('button_add_hero_carousel');
        let updateHeroCarousel = document.getElementById('update_hero_carousel');
        buttonAddCarousel.addEventListener('click', function() {
            addHeroCarousel.style.display = 'block';
            updateHeroCarousel.style.display = 'none';
        });

        function showCarouselDetail(id) {
            addHeroCarousel.style.display = 'none';
            updateHeroCarousel.style.display = 'block';

            fetchDataHero(id)
                .then(data => {
                    console.log(data);
                    const id = data.id;
                    const heading = data.heading;
                    const image = data.image;
                    const imageAlt = data.alt_image;
                    const paragraph = data.paragraph;
                    const route = `/dashboard/administrator/hero/${id}`;

                    // Populate form fields with data
                    document.getElementById('alt_image_update').value = imageAlt;
                    document.getElementById('heading_update').value = heading;
                    document.getElementById('paragraph_update').value = paragraph;
                    document.getElementById('image_update').value = image;

                    // Set form action route
                    document.getElementById('form_update_carousel').action = route;

                    // Set image source
                    document.getElementById('croppedImageFormUpdate').src = `{{ asset('${image}') }}`;

                    // Add event listener for delete action
                    document.getElementById('form_delete_carousel').addEventListener('click', function() {
                        WarningAlert('delete', route, 'Delete Hero?',
                            `Apakah anda yakin ingin menghapus data hero '${heading}' ?`);
                    });


                })
                .catch(error => {
                    console.error('Error saat mengambil data foto:', error);
                });
        }

        async function fetchDataHero(id) {
            try {
                const response = await axios.get(`/api/hero/${id}`);
                return response.data.data;
            } catch (error) {
                console.error('Gagal mengambil data hero :', error);
                return [];
            }
        }
    </script>
@endsection
