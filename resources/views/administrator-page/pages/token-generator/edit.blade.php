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
                <form action={{ route('dashboard.administrator.token-generator.update', [$token->ulid]) }} method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <fieldset>
                        <div class="mb-3 ">
                            <label for="token" class="form-label required"> Token</label>
                            <div class="input-token d-flex gap-2 ">
                                <input type="text" class="form-control @error('token') is-invalid @enderror"
                                    token="token" id="token" name="token" aria-describedby="helpId"
                                    placeholder="Tuliskan Generate Token" value="{{ $token->token }}" />
                                @error('token')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <button type="button" role="button" class="btn btn-primary btn-sm"
                                    id="generateTokenButton">Generate Token</button>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="aplikasi" class="form-label">Nama Aplikasi</label>
                            <textarea class="form-control @error('aplikasi') is-invalid @enderror" name="aplikasi" id="aplikasi" rows="3">{{ $token->aplikasi }}</textarea>
                            @error('aplikasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </fieldset>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                        <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy"></i> Simpan Data</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
