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
                            <div class="table-responsive">
                                <table id="basic_datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Judul</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($trashedBerita as $item)
                                            <tr>
                                                <td>{{ $index++ }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>
                                                    <button type="button"
                                                        onclick="WarningAlert('put', '/dashboard/administrator/berita/restore/{{ $item->slug }}', 'Restore Data ?', 'Anda yakin ingin melakukan restore data berita ini?')"
                                                        class="btn btn-sm  rounded-4 btn-danger">Restore</button>

                                                    <button type="button"
                                                        onclick="WarningAlert('delete', '/dashboard/administrator/berita/permanent-delete/{{ $item->slug }}', 'Delete Permanent News?', `Apakah anda yakin ingin delete permanent berita '{{ $item->title }}' ?`)"
                                                        class="btn btn-sm  rounded-4 btn-danger remove-permanent-news">Delete
                                                        Permanent</button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
