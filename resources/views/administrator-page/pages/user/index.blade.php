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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Tabel {{ $data['page_name'] ?? '' }}</h4>
                        <a href="{{ route('dashboard.administrator.user.create') }}">
                            <button type="button" class="btn btn-primary btn-sm rounded-4">
                                <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic_datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $index = 1; @endphp
                                    @foreach ($user as $item)
                                        <tr>
                                            <td>{{ $index++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-primary rounded-pill px-3 py-2">{{ $item->role }}</span>
                                            </td>
                                            <td>
                                                @if ($item->status_akun)
                                                    <span class="badge rounded-pill bg-success px-3 py-2"
                                                        style="cursor:pointer"
                                                        onclick="WarningAlert('put', '/dashboard/administrator/user/status_akun/{{ $item->id }}', 'Nonaktifkan Akun?', `Apakah anda yakin ingin menonaktifkan akun '{{ $item->name }}' ?`)"
                                                        data-bs-toggle="tooltip" title="Klik untuk nonaktifkan">Aktif</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger px-3 py-2"
                                                        style="cursor:pointer"
                                                        onclick="WarningAlert('put', '/dashboard/administrator/user/status_akun/{{ $item->id }}', 'Aktifkan Akun?', `Apakah anda yakin ingin mengaktifkan akun '{{ $item->name }}' ?`)"
                                                        data-bs-toggle="tooltip" title="Klik untuk aktifkan">Tidak
                                                        Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <a
                                                        href="{{ route('dashboard.administrator.user.show', ['user' => $item->id]) }}">
                                                        <button type="button" class="btn btn-sm rounded-3 btn-info"
                                                            title="Detail user: {{ $item->name }}">
                                                            <i class="fas fa-clipboard-list"></i>
                                                        </button>
                                                    </a>
                                                    <a
                                                        href="{{ route('dashboard.administrator.user.edit', ['user' => $item->id]) }}">
                                                        <button type="button" class="btn btn-sm rounded-3 btn-success"
                                                            title="Edit user: {{ $item->name }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    @if ($item->role !== 'administrator')
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger p-2 py-1 fs-6 rounded-3"
                                                            onclick="WarningAlert('delete', '/dashboard/administrator/user/{{ $item->id }}', 'Delete User?', `Apakah anda yakin ingin menghapus user '{{ $item->name }}' ?`)"
                                                            title="Remove data user : {{ $item->name }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Delete Data"><i class="fas fa-trash-alt"
                                                                aria-hidden="true"></i></button>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-sm btn-secondary p-2 py-1 fs-6 rounded-3"
                                                            disabled data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Administrator tidak dapat dihapus"><i
                                                                class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                                    @endif
                                                </div>
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
