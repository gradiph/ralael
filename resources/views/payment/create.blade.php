@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Konfirmasi Pembayaran</div>

                <div class="card-body">
                    @if (session('alert_type'))
                        <div class="alert {{ session('alert_type') }}" role="alert">
                            {{ session('alert_title') }} <br>
                            {!! session('alert_message') !!}
                        </div>
                    @endif

                    <form action="{{ route('payments.store') }}" method="post" id="form-payment" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="input-transaction_id">Pilih Transaksi</label>
                            <select name="transaction_id" id="input-transaction_id" class="form-control">
                                @foreach ($transactions as $transaction)
                                    <option value="{{ $transaction->id }}">{{ $transaction->full_id }} ({{ $transaction->created_at->format('Y-m-d') }}) &mdash; qty: {{ $transaction->qty_total }} &mdash; harga: {{ $transaction->price_total }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input-value">Jumlah Pembayaran</label>
                            <input type="text" name="value" id="input-value" class="form-control" required value="{{ old('value') }}">
                        </div>

                        <div class="form-group">
                            <label for="input-file">Foto Bukti Pembayaran</label>
                            <input type="file" name="file" id="input-file" class="form-control-file" required>
                        </div>

                        <button type="submit" id="btn-submit" class="btn btn-primary">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection
