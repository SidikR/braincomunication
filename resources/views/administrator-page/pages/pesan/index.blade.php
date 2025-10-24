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
                <li class="nav-fasilitas">
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
                        <div class="table-responsive">
                            <table id="basic_datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Pesan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($pesan as $item)
                                        <tr>
                                            <td>{{ $index++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->pesan }}</td>
                                            <td class="d-flex flex-column flex-lg-row align-items-center h-100 gap-2">
                                                <a
                                                    href={{ route('dashboard.administrator.pesan.show', ['pesan' => $item->id]) }}><button
                                                        type="button"
                                                        class="btn btn-sm btn-primary p-2 py-1 fs-6 rounded-3"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Read data pesan : {{ $item->nama }}"><i
                                                            class="fas fa-clipboard-list" aria-hidden="true"></i>
                                                    </button></a>
                                                <button type="button" class="btn btn-sm btn-danger p-2 py-1 fs-6 rounded-3"
                                                    onclick="WarningAlert('delete', '/dashboard/administrator/pesan/{{ $item->id }}', 'Delete User?', `Apakah anda yakin ingin menghapus user '{{ $item->nama }}' ?`)"
                                                    title="Remove data pesan : {{ $item->nama }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Data"><i
                                                        class="fas fa-trash-alt" aria-hidden="true"></i></button>
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
@endsection
