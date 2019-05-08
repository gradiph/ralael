@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kelola Kategori</div>

                <div class="card-body">
                    @if (session('alert_type'))
                        <div class="alert {{ session('alert_type') }}" role="alert">
                            {{ session('alert_title') }} <br>
                            {!! session('alert_message') !!}
                        </div>
                    @endif

                    <div id="data"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function () {
        $.get("{{ route('admin.master.categories.list') }}", function (response) {
            $("#data").html(response);
        });
    });
</script>
@endsection
