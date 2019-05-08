@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Keranjang Belanja</div>

                <div class="card-body">
                    @if (session('alert_type'))
                        <div class="alert {{ session('alert_type') }}" role="alert">
                            {{ session('alert_title') }} <br>
                            {!! session('alert_message') !!}
                        </div>
                    @endif

                    <div class="table-responsive">
                        @if(filled($carts))
                            <table id="table-cart" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Catatan</th>
                                </thead>
                                <tbody>
                                    @php($qty_total = 0)
                                    @php($price_total = 0)
                                    @foreach ($carts as $key => $value)
                                        @php($qty_total += $value->qty)
                                        @php($price_total += Auth::check() ? $value->price_total : $value['qty'] * $value['item']->price)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ Auth::check() ? $value->item->name : $value['item']->name }}</td>
                                            <td>{{ Auth::check() ? $value->qty : $value['qty'] }}</td>
                                            <td>{{ Auth::check() ? $value->price_total : $value['qty'] * $value['item']->price }}</td>
                                            <td>{{ Auth::check() ? $value->note : $value['note'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="2"></td>
                                    <td><strong>{{ $qty_total }}</strong></td>
                                    <td><strong>{{ $price_total }}</strong></td>
                                    <td></td>
                                </tfoot>
                            </table>

                            <a href="{{ route('checkout') }}" class="btn btn-primary">Tombol</a>
                        @else
                            <h3>Keranjang belanja Anda kosong.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
