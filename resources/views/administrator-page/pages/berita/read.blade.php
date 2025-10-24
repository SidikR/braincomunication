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
                        <h4 class="card-title">Tabel {{ $data['page_name'] ?? '' }}</h4>
                        <div class="button d-flex gap-2">
                            <div class="button-publish">
                                @if ($berita->published)
                                    <button type="button" class="btn btn-sm rounded-4 btn-danger"
                                        onclick="WarningAlert('put', '/dashboard/administrator/berita/unpublish/{{ $berita->slug }}', 'Un-Publish News?', `Apakah anda yakin ingin un-publish berita '{{ $berita->title }}' ?`)">
                                        <i class="bi bi-ban"></i> UnPublish News!
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-4 btn-success"
                                        onclick="WarningAlert('put', '/dashboard/administrator/berita/publish/{{ $berita->slug }}', 'Publish News?', `Apakah anda yakin ingin publish berita '{{ $berita->title }}' ?`)">
                                        <i class="bi bi-rocket-takeoff"></i> Publish Now!
                                    </button>
                                @endif
                            </div>
                            <div class="d-flex justify-content-end gap-2 align-items-center">

                                <a href="{{ route('dashboard.administrator.berita.edit', [$berita->slug]) }}"
                                    class="align-items-center"><button class="btn btn-sm rounded-4 btn-success"><i
                                            class="fas fa-pencil-alt"></i> Edit
                                    </button></a>

                                <button type="button" class="btn btn-sm rounded-4 btn-danger"
                                    onclick="WarningAlertRedirect('delete', '/dashboard/administrator/berita/{{ $berita->slug }}', 'Delete News?', `Apakah anda yakin ingin delete (move to trash) berita '{{ $berita->title }}' ?` , '/dashboard/administrator/berita')"
                                    title="Remove News : {{ $berita->title }}"><i class="fas fa-trash-alt"></i>
                                    Delete</button>

                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 bg-white">
                                <article class="article py-0 px-2 mb-3 pb-3">

                                    <h1 class="title text-center">{{ $berita->title }}</h1>

                                    <div class="post-img m-0">
                                        <div class="mt-3" style="width: 100%; height: 80%; border-radius: 5px;">
                                            <img src="{{ asset($berita->image) }}" id="croppedImageForm"
                                                alt="{{ asset($berita->alt_image) }}"
                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                                        </div>
                                        <small class="m-0 p-0 mt-1">{{ $berita->description_thumbnail }}</small>
                                    </div>

                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <i class="fas fa-user-alt pe-3 my-3"></i>
                                                <span>{{ $berita->writer->name }}</span>
                                            </li>
                                        </ul>
                                    </div><!-- End meta top -->

                                    <div class="content">
                                        {!! $berita->content !!}
                                    </div><!-- End post content -->

                                    <div class="meta-bottom gap-2">
                                        <i class="fas fa-folder-open"></i> {{ $berita->kategori->name }}

                                        <i class="fas fa-tags"></i>
                                        @foreach (explode(',', $berita->tag) as $tag)
                                            <a href="#">{{ $tag }}, </a>
                                        @endforeach
                                    </div><!-- End meta bottom -->

                                </article><!-- End post article -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
