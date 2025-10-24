@extends('dashboard.layouts.main')
@section('content')
<nav aria-label="breadcrumb mt-0 mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href={{ route('dashboard.' . Auth::user()->role . '.index') }}>Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
    </ol>
</nav>
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-center justify-content-md-between">
            <div class="d-flex justify-content-end gap-2 align-items-center">
                <div class="button-create  ">
                    <a href={{ route('dashboard.staf_administrasi.jadwal_belajar.create') }}>
                        <button type="button" class="btn btn-sm btn-primary d-flex align-item-center justify-content-between gap-1" title="Tambah data jadwal belajar">
                            <i class="bi bi-plus-circle-fill"></i>Tambah Jadwal Belajar
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
                            <th>Title</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Akhir</th>
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
                            <td class="d-flex flex-column flex-lg-row align-items-center  gap-2">
                                <a href={{ route('dashboard.staf_administrasi.jadwal_belajar.show', ['jadwal_belajar' => $item->id]) }}><button type="button" class="btn btn-sm btn-primary" title="Read data jadwal belajar : {{ $item->title }}"><i class="bi bi-book-fill"></i></button></a>
                                <a href={{ route('dashboard.staf_administrasi.jadwal_belajar.edit', ['jadwal_belajar' => $item->id]) }}><button class="btn btn-sm btn-success" title="Edit data jadwal belajar : {{ $item->title }}"><i class="bi bi-pencil-square"></i></button></a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="WarningAlert('delete', '/dashboard/staf_administrasi/jadwal_belajar/{{ $item->id }}', 'Delete Jadwal Belajar?', `Apakah anda yakin ingin menghapus jadwal belajar '{{ $item->title }}' ?`)" title="Remove data jadwal belajar : {{ $item->title }}"><i class="bi bi-trash3"></i></button>
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