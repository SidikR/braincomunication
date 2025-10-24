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
                    <a href="{{route('dashboard.administrator.berita.index')}}">List Berita</a>
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
                        <h4 class="card-title">Tabel {{ $data['page_name'] ?? '' }}</h4>
                    </div>
                    <div class="card-body">
                        <form id="form" action={{ route('dashboard.administrator.berita.store') }} method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <fieldset>
                                <div
                                    class="px-xl-5 mb-4 col-12 d-flex flex-column flex-lg-row gap-xl-5 m-0 justify-content-center align-items-center ">
                                    <div class="image-container text-center">
                                        <div class="mb-3 w-100">
                                            <label for="image1" class="required mb-2">Thumbnail Berita </label>
                                            <div id="imagePreviewBox">
                                                <figure class="image-preview w-100">
                                                    <img src="{{ old('image') ? asset(old('image')) : asset('assets-admin/images/images.png') }}"
                                                        id="image1-display">
                                                    <input type="hidden" name="image" id="image1"
                                                        value="{{ old('image') }}">
                                                </figure>
                                            </div>
                                            @error('image')
                                                <div class="text-danger ">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <button type="button" class="btn btn-primary mt-2 upload-button"
                                            id="button-image" data-input-id="image1">
                                            <i class="bi bi-cloud-arrow-up-fill"></i> Upload Photo
                                        </button>

                                    </div>

                                    <div class="col-xl-8 mb-2 mt-2">
                                        <label for="description_thumbnail" class="form-label">Deskripsi Foto
                                            Thumbnail</label>
                                        <textarea class="form-control" name="description_thumbnail" id="description_thumbnail" rows="5">{{ old('description_thumbnail') }}</textarea>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="alt_image" class="form-label">Alt Image</label>
                                    <input type="text" class="form-control @error('alt_image') is-invalid @enderror"
                                        name="alt_image" id="alt_image" aria-describedby="helpId"
                                        placeholder="masukkan alt image berita ..." value="{{ old('alt_image') }}" />
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label required">Judul Berita</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" id="title" aria-describedby="helpId"
                                        placeholder="masukkan title berita ..." value="{{ old('title') }}" required />
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label required">Deskripsi Berita </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                        rows="5">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label required">Konten Berita</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="30"
                                        required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="form-label required">Kategori</label>
                                    <select class="form-select form-select-sm @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id" required>
                                        <option value="" {{ old('category_id') == '' ? 'selected' : '' }}>Pilih
                                            Kategori berita...
                                        </option>
                                        @foreach ($category as $item)
                                            <option value={{ $item->id }}
                                                {{ old('category_id') == $item->id ? 'selected' : '' }}>
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
                                        <option selected>Pilih penulis berita...</option>
                                        @foreach ($redaktur as $item)
                                            <option value={{ $item->id }}
                                                {{ old('writer_id') == $item->id ? 'selected' : '' }}>
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
                                        name="editor_id" id="editord" required>
                                        <option selected>Pilih editor berita...</option>
                                        @foreach ($redaktur as $item)
                                            <option value={{ $item->id }}
                                                {{ old('editor_id') == $item->id ? 'selected' : '' }}>
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
                                    <select class="form-select form-select-sm @error('reporter_id') is-invalid @enderror"
                                        name="reporter_id" id="reporter_id" required>
                                        <option selected>Pilih reporter berita...</option>
                                        @foreach ($redaktur as $item)
                                            <option value={{ $item->id }}
                                                {{ old('reporter_id') == $item->id ? 'selected' : '' }}>
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
                                    <textarea class="form-control" name="tag" id="tag" rows="3" placeholde="Tulis tag">{{ old('tag') }}</textarea>
                                    @error('tag')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </fieldset>

                            <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                                <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                        class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                                <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy"></i> Simpan
                                    Data</button>
                            </div>

                            <script>
                                var tagSuggestions = @json(getTagsNoPagging());
                                $('textarea[name="tag"]').amsifySuggestags({
                                    suggestions: tagSuggestions
                                });
                            </script>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
    </script>
@endsection
