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
                <li class="nav-role_user">
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
                            <a href={{ route('dashboard.administrator.role_user.create') }}>
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
                                        <th>Nama Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($role_user as $item)
                                        <tr>
                                            <td>{{ $index++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td class="d-flex flex-column flex-lg-row align-items-center h-100 gap-2">
                                                <a
                                                    href={{ route('dashboard.administrator.role_user.show', ['role_user' => $item->id]) }}><button
                                                        type="button"
                                                        class="btn btn-sm btn-primary p-2 py-1 fs-6 rounded-3"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Read data role_user : {{ $item->nama }}"><i
                                                            class="fas fa-clipboard-list" aria-hidden="true"></i>
                                                    </button></a>
                                                <a
                                                    href={{ route('dashboard.administrator.role_user.edit', ['role_user' => $item->id]) }}><button
                                                        class="btn btn-sm btn-success p-2 py-1 fs-6 rounded-3"
                                                        title="Edit data role_user : {{ $item->nama }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Edit Data"><i class="fas fa-edit"
                                                            aria-hidden="true"></i></button></a>

                                                <button type="button" class="btn btn-sm btn-danger p-2 py-1 fs-6 rounded-3"
                                                    onclick="WarningAlert('delete', '/dashboard/administrator/role_user/{{ $item->id }}', 'Delete User?', `Apakah anda yakin ingin menghapus user '{{ $item->nama }}' ?`)"
                                                    title="Remove data role_user : {{ $item->nama }}"
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
