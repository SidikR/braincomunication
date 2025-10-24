@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ route('dashboard.administrator.index') }}>Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.administrator.pejabat.index') }}">Daftar Pejabat</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ $data['page_name'] }}
                </h5>
                <span><i class="bi bi-clock-history"></i> Updated : <span id="result"></span></span>
            </div>
            <div class="card-body">
                <form action={{ route('dashboard.administrator.pejabat-content.update', [$content->id]) }} method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <fieldset>
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten Pejabat <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="30">{!! $content->content !!}</textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                    {!! $message !!}
                                </div>
                            @enderror
                        </div>

                    </fieldset>

                    <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                        <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                        <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy"></i> Simpan Data</button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    {{-- Handle human updated at format --}}
    <script script>
        var givenDate = '{{ $content->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
