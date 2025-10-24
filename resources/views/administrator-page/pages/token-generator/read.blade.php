@extends('administrator-page.pages.berita.template')
@section('berita')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ route('dashboard.administrator.index') }}>Dashboard</a></li>
            <li class="breadcrumb-item"><a href={{ route('dashboard.administrator.token-generator.index') }}>Daftar Token</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ $data['page_name'] }}
                </h5>
            </div>
            <div class="card-body">
                <form action={{ route('dashboard.administrator.token-generator.edit', [$token->ulid]) }} method="GET"
                    enctype="multipart/form-data">

                    <fieldset disabled>
                        <div class="mb-3">
                            <label for="token" class="form-label">Token</label>
                            <textarea class="form-control" name="" id="" rows="3">{{ $token->token }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="aplikasi" class="form-label">Nama Aplikasi</label>
                            <textarea class="form-control" name="aplikasi" id="aplikasi" rows="3">{{ $token->aplikasi }}</textarea>
                        </div>
                    </fieldset>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit
                            Data</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
