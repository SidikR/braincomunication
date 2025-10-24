@extends('pages.tentang-kami.template')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <div class="container-fluid">
            <ol>
                <li><a href={{ route('homepage') }}>Home</a></li>
                <li class="current">About</li>
            </ol>
        </div>
    </nav>
@endsection

@section('main')
    <div class="container mt-3 d-flex gap-3">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs d-flex flex-column tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#profil_kami">Profil Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#sejarah">Sejarah</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#struktur_organisasi">Struktur Organisasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#unit_usaha">Unit Usaha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#penghargaan">Penghargaan</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content d-flex justify-content-start align-items-start flex-column">
            <div id="profil_kami" class="container tab-pane active"><br>
                {!! $profilKami->konten !!}
            </div>
            <div id="sejarah" class="container tab-pane fade"><br>
                {!! $sejarah->konten !!}
            </div>
            <div id="struktur_organisasi" class="container tab-pane fade"><br>
                {!! $strukturOrganisasi->konten !!}
            </div>
            <div id="unit_usaha" class="container tab-pane fade"><br>
                {!! $unitUsaha->konten !!}
            </div>
            <div id="penghargaan" class="container tab-pane fade"><br>
               {!! $penghargaan->konten !!}
            </div>
        </div>
    </div>
@endsection
