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
                            <a href={{ route('dashboard.administrator.user.create') }}>
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
                                        <th>Nama user</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($user as $item)
                                        <tr>
                                            <td>{{ $index++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td><span
                                                    class="bg-success text-white p-2 rounded-3 px-3">{{ $item->role }}</span>
                                            </td>
                                            <td class="d-flex flex-column flex-lg-row align-items-center  gap-2">
                                                <a
                                                    href={{ route('dashboard.administrator.user.show', ['user' => $item->id]) }}><button
                                                        type="button" class="btn btn-sm btn-primary"
                                                        title="Read data user : {{ $item->name }}"><i
                                                            class="fas fa-clipboard-list"></i></button></a>
                                                <a
                                                    href={{ route('dashboard.administrator.user.edit', ['user' => $item->id]) }}><button
                                                        class="btn btn-sm btn-success"
                                                        title="Edit data user : {{ $item->name }}"><i
                                                            class="fas fa-edit"></i></button></a>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="WarningAlert('delete', '/dashboard/administrator/user/{{ $item->id }}', 'Delete User?', `Apakah anda yakin ingin menghapus user '{{ $item->name }}' ?`)"
                                                    title="Remove data user : {{ $item->name }}"><i
                                                        class="fas fa-trash-alt"></i></button>
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
