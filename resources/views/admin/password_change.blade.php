@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ubah Password</div>

                <div class="card-body">
                    @if (session('alert_type'))
                        <div class="alert {{ session('alert_type') }}" role="alert">
                            <strong>{{ session('alert_title') }}</strong> <br>
                            {!! session('alert_message') !!}
                        </div>
                    @endif

                    <form action="{{ route('admin.password.change') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="input-old-password">Password Lama</label>
                            <input type="password" name="old_password" id="input-old-password" class="form-control" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="input-new-password">Password Baru</label>
                            <input type="password" name="new_password" id="input-new-password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="input-new-password-confirmation">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="input-new-password-confirmation" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
