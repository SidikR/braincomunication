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
                <li class="nav-testimoni">
                    <a href="{{ route('dashboard.administrator.berita.index') }}">List Berita</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-testimoni">
                    <a href="#">{{ $data['page_name'] ?? '' }}</a>
                </li>
            </ul>
        </div>

        {{-- Konten --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">{{ $data['page_name'] ?? '' }}</h4>
                       <span><i class="far fa-clock"></i> Updated : <span id="result"></span></span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action={{ route('dashboard.administrator.berita.update', [$berita->slug]) }}
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <fieldset>
                                    <div
                                        class="px-xl-5 mb-4 col-12 d-flex flex-column flex-lg-row gap-xl-5 m-0 justify-content-center align-items-center ">
                                        <div class="image-container text-center">
                                            <div class="mb-3 w-100">
                                                <label for="image1" class="required mb-2">Thumbnail Berita </label>
                                                <div id="imagePreviewBox">
                                                    <figure class="image-preview">
                                                        <img src="{{ asset($berita->image) }}"
                                                            alt="{{ $berita->alt_image }}" id="image1-display">
                                                        <input type="hidden" name="image" id="image1"
                                                            value="{{ $berita->image }}">
                                                    </figure>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-primary mt-2 upload-button"
                                                id="button-image" data-input-id="image1">
                                                <i class="bi bi-cloud-arrow-up-fill"></i> Upload Photo
                                            </button>

                                        </div>

                                        <div class="col-xl-8 mb-2 mt-2">
                                            <label for="description_thumbnail" class="form-label">Deskripsi Foto
                                                Thumbnail</label>
                                            <textarea class="form-control" name="description_thumbnail" id="description_thumbnail" rows="5">{{ $berita->description_thumbnail }}</textarea>
                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <label for="alt_image" class="form-label">Alt Image</label>
                                        <input type="text" class="form-control @error('alt_image') is-invalid @enderror"
                                            name="alt_image" id="alt_image" aria-describedby="helpId"
                                            placeholder="masukkan alt_image berita ..." value="{{ $berita->alt_image }}"
                                            required />
                                        @error('alt_image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label required">Judul Berita</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" id="title" aria-describedby="helpId"
                                            placeholder="masukkan title berita ..." value="{{ $berita->title }}"
                                            required />
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label required">Deskripsi Berita </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                            rows="5" required>{{ $berita->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label required">Konten Berita </label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" id="summernote" name="content" rows="30"
                                            required>{{ $berita->content }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label required">Kategori</label>
                                        <select
                                            class="form-select form-select-sm @error('category_id') is-invalid @enderror"
                                            name="category_id" id="category_id" required>
                                            @foreach ($category as $item)
                                                <option value={{ $item->id }}
                                                    {{ $berita->category_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="writer_id" class="form-label required">Penulis (Author)</label>
                                        <select class="form-select form-select-sm @error('writer_id') is-invalid @enderror"
                                            name="writer_id" id="writer_id" required>
                                            @foreach ($redaktur as $item)
                                                <option value={{ $item->id }}
                                                    {{ $berita->writer_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('writer_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="editor_id" class="form-label required">Editor</label>
                                        <select class="form-select form-select-sm @error('editor_id') is-invalid @enderror"
                                            name="editor_id" id="editor_id" required>
                                            @foreach ($redaktur as $item)
                                                <option value={{ $item->id }}
                                                    {{ $berita->editor_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('editor_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="reporter_id" class="form-label required">Reporter</label>
                                        <select
                                            class="form-select form-select-sm @error('reporter_id') is-invalid @enderror"
                                            name="reporter_id" id="reporter_id" required>
                                            @foreach ($redaktur as $item)
                                                <option value={{ $item->id }}
                                                    {{ $berita->reporter_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('reporter_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tag" class="form-label required">Tag</label>
                                        <textarea class="form-control" name="tag" id="tag" rows="3" required>{{ $berita->tag }}</textarea>
                                    </div>

                                    <script>
                                        var tagSuggestions = @json(getTags());
                                        $('textarea[name="tag"]').amsifySuggestags({
                                            suggestions: tagSuggestions
                                        });
                                    </script>

                                </fieldset>

                                <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                                    <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                            class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                                    <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy"></i> Simpan
                                        Data</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script script>
        var givenDate = '{{ $berita->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
