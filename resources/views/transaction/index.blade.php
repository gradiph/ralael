@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transaksi</div>

                <div class="card-body">
                    @if (session('alert_type'))
                        <div class="alert {{ session('alert_type') }}" role="alert">
                            {{ session('alert_title') }} <br>
                            {!! session('alert_message') !!}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="table-transaction" class="table table-bordered table-striped table-hover">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Total Qty</th>
                                <th scope="col">Total Harga</th>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{ route('transactions.show', ['transaction' => $transaction->id]) }}">{{ $transaction->full_id }}</a></td>
                                        <td>{{ $transaction->created_at->format('D, d M Y') }}</td>
                                        <td>{{ $transaction->qty_total }}</td>
                                        <td>{{ $transaction->price_total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
