@extends('administrator-page.pages.berita.template')
@section('berita')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ route('dashboard.administrator.index') }}>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-lg-between justify-content-center ">
                <div class="button-create">
                    <a href={{ route('dashboard.administrator.token-generator.create') }}>
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle-fill"></i> Tambah Token
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
                                <th>Aplikasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($tokens as $token)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $token->aplikasi }}</td>
                                    <td>
                                        <a href={{ route('dashboard.administrator.token-generator.show', [$token->ulid]) }}><button
                                                type="button" class="btn btn-sm btn-primary"
                                                title="Read Kategori : {{ $token->aplikasi }}"><i
                                                    class="bi bi-book-fill"></i></button></a>

                                        <a href={{ route('dashboard.administrator.token-generator.edit', [$token->ulid]) }}><button
                                                class="btn btn-sm btn-success"
                                                title="Edit Kategori : {{ $token->aplikasi }}"><i
                                                    class="bi bi-pencil-square"></i></button></a>

                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="WarningAlert('delete', '/dashboard/administrator/token-generator/{{ $token->ulid }}', 'Delete Kategori Berita?', `Apakah anda yakin ingin menghapus token-generator '{{ $token->judul }}' ?`)"
                                            title="Remove News : {{ $token->aplikasi }}"><i
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
