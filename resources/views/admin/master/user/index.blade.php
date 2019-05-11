@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kelola User</div>

                <div class="card-body">
                    @if (session('alert'))
                        @alert($alert_config)
                            {{ $alert }}
                        @endcomponent
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
        $.get("{{ route('admin.master.users.list') }}", function (response) {
            $("#data").html(response);
        });
    });
</script>
@endsection
