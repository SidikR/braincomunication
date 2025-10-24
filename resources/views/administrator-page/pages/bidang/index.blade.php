@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ route('dashboard.administrator.index') }}>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-center justify-content-md-between">
                <div class="button-create">
                    <a href={{ route('dashboard.administrator.bidang.create') }}>
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle-fill"></i> Tambah Bidang
                        </button>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama Bidang</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($bidang as $item)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <div
                                            class="d-flex flex-column flex-grow-0 justify-content-center justify-content-lg-start  align-items-center  flex-lg-row  gap-2">
                                            <a href={{ route('dashboard.administrator.bidang.show', [$item->slug]) }}><button
                                                    type="button" class="btn btn-sm btn-primary"
                                                    title="Read News : {{ $item->name }}"><i
                                                        class="bi bi-book-fill"></i></button></a>

                                            <a href={{ route('dashboard.administrator.bidang.edit', [$item->slug]) }}><button
                                                    class="btn btn-sm btn-success"
                                                    title="Edit News : {{ $item->name }}"><i
                                                        class="bi bi-pencil-square"></i></button></a>

                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="WarningAlert('delete', '/dashboard/administrator/bidang/{{ $item->slug }}', 'Delete Bidang?', `Apakah anda yakin ingin menghapus bidang '{{ $item->name }}' ?`)"
                                                title="Remove News : {{ $item->name }}"><i
                                                    class="bi bi-trash3"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
