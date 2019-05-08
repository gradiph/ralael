@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transaksi ID #{{ $transaction->full_id }}</div>

                <div class="card-body">
                    @if (session('alert_type'))
                        <div class="alert {{ session('alert_type') }}" role="alert">
                            {{ session('alert_title') }} <br>
                            {!! session('alert_message') !!}
                        </div>
                    @endif

                    <h3>Status</h3>
                    <ul>
                        @foreach ($transaction->statuses as $status)
                            <li>{{ $status->pivot->creation_time->format('Y-m-d') }} : {{ $status->name }} ({{ $status->pivot->description }})</li>
                        @endforeach
                        <li>{{ $transaction->created_at->format('Y-m-d') }} : Transaksi dibuat.</li>
                    </ul>

                    <hr>

                    <h3>Rincian Barang</h3>
                    <div class="table-responsive">
                        <table id="table-items" class="table table-bordered table-striped table-hover">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Catatan</th>
                            </thead>
                            <tbody>
                                @foreach ($transaction->items as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->pivot->qty }}</td>
                                        <td>{{ $item->pivot->qty * $item->pivot->price }}</td>
                                        <td>{{ $item->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <td colspan="2"></td>
                                <td><strong>{{ $transaction->qty_total }}</strong></td>
                                <td><strong>{{ $transaction->price_total }}</strong></td>
                                <td></td>
                            </tfoot>
                        </table>
                    </div>

                    <hr>

                    <h3>Pembayaran</h3>
                    <div id="payment">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Status</th>
                                </thead>
                                <tbody>
                                    @foreach($transaction->payments as $payment)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $payment->created_at->format('d-m-Y H:i') }}</td>
                                            <td>{{ $payment->value }}</td>
                                            <td><a data-toggle="modal" data-target="#modal" data-src="{{ asset('images/' . $payment->address) }}" data-alt="{{ $payment->address }}">{{ $payment->full_id . '-' . $loop->iteration }}</a></td>
                                            <td>{{ filled($payment->verified_at) ? $payment->verified_at->format('d-m-Y H:i') : 'Menunggu verifikasi' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="2"></td>
                                    <td><strong>{{ $transaction->payment_total }}</strong></td>
                                    <td colspan="2"></td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
