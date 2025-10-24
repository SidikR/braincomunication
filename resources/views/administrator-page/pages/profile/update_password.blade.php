@extends('dashboard.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/administrator/user">Daftar user</a></li>
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
            <div class="card-body p-3">
                <form action={{ route('dashboard.administrator.profile.update_password_value', ['id' => $user->id]) }}
                    method="post">
                    @csrf
                    @method('PUT')

                    <fieldset>
                        <div class="mb-3">
                            <label for="password" class="form-label required">New Password</label>
                            <input type="text" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter New Password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </fieldset>

                    <div class="d-flex flex-column flex-lg-row justify-content-end gap-2">
                        <button type="button" class="btn btn-danger" onclick="goBack()"><i
                                class="bi bi-arrow-counterclockwise"></i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

    <script script>
        var givenDate = '{{ $user->updated_at }}';
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
