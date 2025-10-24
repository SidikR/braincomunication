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
                        <div
                            class="card-header d-flex flex-column flex-md-row justify-content-center align-items-center gap-2 justify-content-lg-between">
                            <div class="button-create">
                                <a href={{ route('dashboard.administrator.berita.create') }}>
                                    <button type="button" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-fill"></i> Tulis Berita
                                    </button>
                                </a>
                            </div>
                            <div class="d-flex justify-content-end gap-2 align-items-center">
                                <a href="{{ route('dashboard.administrator.berita.trash') }}"
                                    class="align-items-center"><button class="btn btn-sm btn-danger"><i
                                            class="bi bi-trash3-fill"></i> Kotak Sampah</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic_datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Judul</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($berita as $item)
                                        <tr>
                                            <td>{{ $index++ }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td class="">
                                                <div
                                                    class="d-flex flex-column flex-grow-0 justify-content-center justify-content-lg-start  align-items-center  flex-lg-row  gap-2">
                                                    <a
                                                        href={{ route('dashboard.administrator.berita.show', [$item->slug]) }}><button
                                                            type="button" class="btn btn-sm btn-primary"
                                                            title="Read News : {{ $item->title }}"><i
                                                                class="fas fa-clipboard-list"></i></button></a>

                                                    <a
                                                        href={{ route('dashboard.administrator.berita.edit', [$item->slug]) }}><button
                                                            class="btn btn-sm btn-success"
                                                            title="Edit News : {{ $item->title }}"><i
                                                                class="fas fa-edit"></i></button></a>

                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="WarningAlert('delete', '/dashboard/administrator/berita/{{ $item->slug }}', 'Delete News?', `Apakah anda yakin ingin delete (move to trash) berita '{{ $item->title }}' ?`)"
                                                        title="Remove News : {{ $item->title }}"><i
                                                            class="fas fa-trash-alt"></i></button>

                                                    @if ($item->published)
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="WarningAlert('put', '/dashboard/administrator/berita/unpublish/{{ $item->slug }}', 'Un-Publish News?', `Apakah anda yakin ingin un-publish berita '{{ $item->title }}' ?`)">
                                                            <i class="bi bi-ban"></i> UnPublish
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            onclick="WarningAlert('put', '/dashboard/administrator/berita/publish/{{ $item->slug }}', 'Publish News?', `Apakah anda yakin ingin publish berita '{{ $item->title }}' ?`)">
                                                            <i class="bi bi-rocket-takeoff"></i> Publish
                                                        </button>
                                                    @endif
                                                </div>

                                            </td>
                                            <td>
                                                {!! $item->published
                                                    ? '<span class="badge bg-success rounded-5 "><i class="bi bi-check-all"></i> Published</span>'
                                                    : '<span class="badge bg-danger rounded-5"><i class="bi bi-ban"></i> Not Published</span>' !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-container mt-3">
                                {{ $berita->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection