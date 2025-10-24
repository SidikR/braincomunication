@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ route('dashboard.administrator.index') }}>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">

        {{-- List Pejabat --}}
        <div class="card">
            <div class="card-header d-flex justify-content-center justify-content-md-between">
                <div class="button-create">
                    <a href={{ route('dashboard.administrator.pejabat.create') }}>
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle-fill"></i> Tambah Pejabat
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
                                <th>Nama Lengkap</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($pejabat as $item)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td>
                                        <div
                                            class="d-flex flex-column flex-grow-0 justify-content-center justify-content-lg-start  align-items-center  flex-lg-row  gap-2">
                                            <a href={{ route('dashboard.administrator.pejabat.show', [$item->ulid]) }}><button
                                                    type="button" class="btn btn-sm btn-primary"
                                                    title="Read News : {{ $item->name }}"><i
                                                        class="bi bi-book-fill"></i></button></a>

                                            <a href={{ route('dashboard.administrator.pejabat.edit', [$item->ulid]) }}><button
                                                    class="btn btn-sm btn-success"
                                                    title="Edit News : {{ $item->name }}"><i
                                                        class="bi bi-pencil-square"></i></button></a>

                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="WarningAlert('delete', '/dashboard/administrator/pejabat/{{ $item->ulid }}', 'Delete Pejabat?', `Apakah anda yakin ingin menghapus pejabat '{{ $item->name }}' ?`)"
                                                title="Remove Data Pejabat : {{ $item->name }}"><i
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

        {{-- Pejabat Page Content --}}
        <div class="card">
            <div class="card-header d-flex justify-content-center justify-content-md-between">
                <div class="button-create">
                    <a href={{ route('dashboard.administrator.pejabat-content.edit', [$konten_pejabat[0]->id]) }}>
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil-fill"></i> Edit Konten Pejabat
                        </button>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="content">
                    {!! $konten_pejabat[0]->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
