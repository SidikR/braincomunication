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
                <li class="nav-fasilitas">
                    <a href="{{route('dashboard.administrator.pesan.index')}}">List Pesan</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-fasilitas">
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
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic_datatables" class="display table table-striped table-hover">
                                <fieldset disabled>

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            value="{{ $pesan->nama }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            value="{{ $pesan->subject }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="hp" class="form-label">Hp</label>
                                        <input type="text" class="form-control" aria-describedby="helpId"
                                            value="{{ $pesan->hp }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="pesan" class="form-label">Isi Pesan</label>
                                        <textarea class="form-control" rows="3">{{ $pesan->pesan }}</textarea>
                                    </div>

                                </fieldset>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
