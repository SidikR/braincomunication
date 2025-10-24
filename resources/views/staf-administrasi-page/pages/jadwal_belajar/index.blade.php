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
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Tabel {{ $data['page_name'] ?? '' }}</h4>
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <a href={{ route('dashboard.staf_administrasi.jadwal_belajar.create') }}>
                                <button type="button" class="btn btn-primary btn-sm rounded-4"><i class="fa fa-plus"
                                        aria-hidden="true"></i> Tambah Data</button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic_datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Title</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Akhir</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($jadwal_belajar as $item)
                                        <tr>
                                            <td>{{ $index++ }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->start_time }}</td>
                                            <td>{{ $item->end_time }}</td>
                                            <td>
                                                @if ($item->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif ($item->status === 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif ($item->status === 'unactive' || $item->status === 'inactive')
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @else
                                                    <span
                                                        class="badge bg-light text-dark">{{ ucfirst($item->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="d-flex flex-column flex-lg-row align-items-center  gap-2">
                                                <a
                                                    href={{ route('dashboard.staf_administrasi.jadwal_belajar.show', ['jadwal_belajar' => $item->id]) }}><button
                                                        type="button"
                                                        class="btn btn-sm btn-primary p-2 py-1 fs-6 rounded-3"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Read data jadwal belajar : {{ $item->name }}"><i
                                                            class="fas fa-clipboard-list" aria-hidden="true"></i>
                                                    </button></a>
                                                <a
                                                    href={{ route('dashboard.staf_administrasi.jadwal_belajar.edit', ['jadwal_belajar' => $item->id]) }}><button
                                                        class="btn btn-sm btn-success p-2 py-1 fs-6 rounded-3"
                                                        title="Edit data jadwal belajar : {{ $item->name }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Edit Data"><i class="fas fa-edit"
                                                            aria-hidden="true"></i></button></a>

                                                <button type="button" class="btn btn-sm btn-danger p-2 py-1 fs-6 rounded-3"
                                                    onclick="WarningAlert('delete', '/dashboard/staf_administrasi/jadwal_belajar/{{ $item->id }}', 'Delete User?', `Apakah anda yakin ingin menghapus user '{{ $item->name }}' ?`)"
                                                    title="Remove data jadwal belajar : {{ $item->name }}"
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
