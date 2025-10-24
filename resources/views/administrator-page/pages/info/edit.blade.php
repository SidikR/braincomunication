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
                <li class="nav-item">
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
                        <span><i class="fas fa-clock text-primary"></i> Updated : <span id="result"></span></span>
                    </div>
                    <div class="card-body">
                        <form action={{ route('dashboard.administrator.info.update', [$info->id]) }} method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <fieldset>

                                <div class="mb-3">
                                    <label for="title" class="form-label required">Title</label>
                                    <input type="text" class="form-control @error('title') 'is-invalid' @enderror"
                                        name="title" id="title" aria-describedby="helpId"
                                        placeholder="Masukkan nama opd... " value="{{ $info->title }}" />
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') 'is-invalid' @enderror"
                                        name="email" id="email" aria-describedby="helpId"
                                        placeholder="Masukkan email... " value="{{ $info->email }}" />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hp" class="form-label">HP</label>
                                    <input type="text" class="form-control @error('hp') 'is-invalid' @enderror"
                                        name="hp" id="hp" aria-describedby="helpId"
                                        placeholder="Masukkan hp... " value="{{ $info->hp }}" />
                                    @error('hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label required">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                                        placeholder="Masukan alamat..." rows="3">{{ $info->alamat }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" class="form-control @error('instagram') 'is-invalid' @enderror"
                                        name="instagram" id="instagram" aria-describedby="helpId"
                                        placeholder="Masukkan link instagram... " value="{{ $info->instagram }}" />
                                    @error('instagram')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" class="form-control @error('facebook') 'is-invalid' @enderror"
                                        name="facebook" id="facebook" aria-describedby="helpId"
                                        placeholder="Masukkan link facebook... " value="{{ $info->facebook }}" />
                                    @error('facebook')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="youtube" class="form-label">Youtube</label>
                                    <input type="text" class="form-control @error('youtube') 'is-invalid' @enderror"
                                        name="youtube" id="youtube" aria-describedby="helpId"
                                        placeholder="Masukkan link youtube... " value="{{ $info->youtube }}" />
                                    @error('youtube')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tiktok" class="form-label">Tiktok</label>
                                    <input type="text" class="form-control @error('tiktok') 'is-invalid' @enderror"
                                        name="tiktok" id="tiktok" aria-describedby="helpId"
                                        placeholder="Masukkan link tiktok... " value="{{ $info->tiktok }}" />
                                    @error('tiktok')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <input type="text" class="form-control @error('twitter') 'is-invalid' @enderror"
                                        name="twitter" id="twitter" aria-describedby="helpId"
                                        placeholder="Masukkan link twitter... " value="{{ $info->twitter }}" />
                                    @error('twitter')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="maps" class="form-label required">Maps</label>
                                    <textarea class="form-control @error('maps') is-invalid @enderror" name="maps" id="maps"
                                        placeholder="Masukan iframe maps info..." rows="3">{{ $info->maps }}</textarea>
                                    @error('maps')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </fieldset>

                            <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                                <button type="button" class="btn btn-danger rounded-3" onclick="goBack()"><i
                                        class="fas fa-undo"></i> Kembali</button>
                                <button type="submit" class="btn btn-success rounded-3"><i class="fas fa-paper-plane"
                                        aria-hidden="true"></i> Simpan Perubahan
                                    Data</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script script>
        var givenDate = '{{ $info->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
