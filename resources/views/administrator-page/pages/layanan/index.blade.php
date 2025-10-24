@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-center justify-content-md-between">
                <div class="d-flex justify-content-end gap-2 align-items-center">
                    <div class="button-create  ">
                        <a href={{ route('dashboard.administrator.layanan.create') }}>
                            <button type="button"
                                class="btn btn-sm btn-primary d-flex align-item-center justify-content-between gap-1"
                                title="Tambah data layanan">
                                <i class="bi bi-plus-circle-fill"></i>Tambah Layanan
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama Layanan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($layanan as $item)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="d-flex flex-column flex-lg-row align-items-center  gap-2">
                                        <a
                                            href={{ route('dashboard.administrator.layanan.show', ['layanan' => $item->slug]) }}><button
                                                type="button" class="btn btn-sm btn-primary"
                                                title="Read data layanan : {{ $item->name }}"><i
                                                    class="bi bi-book-fill"></i></button></a>
                                        <a
                                            href={{ route('dashboard.administrator.layanan.edit', ['layanan' => $item->slug]) }}><button
                                                class="btn btn-sm btn-success"
                                                title="Edit data layanan : {{ $item->name }}"><i
                                                    class="bi bi-pencil-square"></i></button></a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="WarningAlert('delete', '/dashboard/administrator/layanan/{{ $item->slug }}', 'Delete Kategori Berita?', `Apakah anda yakin ingin menghapus layanan '{{ $item->name }}' ?`)"
                                            title="Remove data layanan : {{ $item->name }}"><i
                                                class="bi bi-trash3"></i></button>
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
