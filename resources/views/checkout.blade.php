@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Konfirmasi Pembelian</div>

                <div class="card-body">
                    @if (session('alert_type'))
                        <div class="alert {{ session('alert_type') }}" role="alert">
                            {{ session('alert_title') }} <br>
                            {!! session('alert_message') !!}
                        </div>
                    @endif

                    <div class="table-responsive">
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
                                    @php($price_total += $value->price_total)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $value->item->name }}</td>
                                        <td>{{ $value->qty }}</td>
                                        <td>{{ $value->price_total }}</td>
                                        <td>{{ $value->note }}</td>
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
                    </div>

                    <h3>Penerima</h3>
                    <form action="{{ route('checkout') }}" method="post" id="form-checkout">
                        @csrf

                        <div class="form-group">
                            <label for="input-recipient_id">Pilih Penerima</label>
                            <select name="recipient_id" id="input-recipient_id" class="form-control">
                                <option value="">Penerima baru</option>
                                @foreach ($recipients as $recipient)
                                    <option value="{{ $recipient->id }}">{{ $recipient->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input-name">Nama Penerima</label>
                            <input type="text" name="name" id="input-name" class="form-control" required value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="input-phone">No. HP Penerima</label>
                            <input type="text" name="phone" id="input-phone" class="form-control" required value="{{ old('phone') }}">
                        </div>

                        <div class="form-group">
                            <label for="input-address">Alamat Penerima</label>
                            <textarea name="address" id="input-address" class="form-control" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="input-province">Provinsi</label>
                            <select name="province" id="input-province" class="form-control" required>
                                <option value="">Pilih provinsi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input-city">Kota/Kabupaten</label>
                            <select name="city" id="input-city" class="form-control" disabled required>
                                <option value="">Pilih kota/kabupaten</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input-subdistrict">Kecamatan &mdash; Kelurahan &mdash; Kode pos</label>
                            <select name="subdistrict" id="input-subdistrict" class="form-control" disabled required>
                                <option value="">Pilih kecamatan, kelurahan, dan kode pos</option>
                            </select>
                        </div>

                        <input type="hidden" name="urban" id="input-urban">
                        <input type="hidden" name="post_code" id="input-post_code">

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
    $.get("https://kodepos-2d475.firebaseio.com/list_propinsi.json?print=pretty", function (response) {
        var arr_reverse = swap(response);

        Object.values(response).sort().forEach(function (item) {
            $("#input-province").append("<option value=\"" + item + "\" data-code=\"" + arr_reverse[item] + "\">" + item + "</option>")
        });
    });

    $(document).ready(function () {
        $("#input-recipient_id").change(function () {
            if ($(this).find(":selected").val() != "") {
                $("#input-name").add("#input-phone").add("#input-address").add("#input-province").add("#input-city").add("#input-subdistrict").add("#input-urban").add("#input-post_code").prop("required", false).prop("disabled", true);
            }
            else {
                $("#input-name").add("#input-phone").add("#input-address").add("#input-province").add("#input-city").add("#input-subdistrict").add("#input-urban").add("#input-post_code").prop("required", true).prop("disabled", false).val("");
            }
        });

        $("#input-province").change(function () {
            $.get("https://kodepos-2d475.firebaseio.com/list_kotakab/" + $(this).find(":selected").data("code") + ".json?print=pretty", function (response) {
                var arr_reverse = swap(response);

                $("#input-city").prop("disabled", false);

                Object.values(response).sort().forEach(function (item) {
                    $("#input-city").append("<option value=\"" + item + "\" data-code=\"" + arr_reverse[item] + "\">" + item + "</option>")
                });
            });
        });

        $("#input-city").change(function () {
            $.get("https://kodepos-2d475.firebaseio.com/kota_kab/" + $(this).find(":selected").data("code") + ".json?print=pretty", function (response) {
                $("#input-subdistrict").prop("disabled", false);

                response.forEach(function (item) {
                    $("#input-subdistrict").append("<option value=\"" + item.kecamatan + "\" data-urban=\"" + item.kelurahan + "\" data-post_code=\"" + item.kodepos + "\">" + item.kecamatan + " &mdash; " + item.kelurahan + " &mdash; " + item.kodepos + "</option>")
                });
            });
        });

        $("#input-subdistrict").change(function () {
            $("#input-urban").val($(this).find(":selected").data("urban"));
            $("#input-post_code").val($(this).find(":selected").data("post_code"));
        });
    });

    //tukar key dan value
    function swap (json){
        var ret = {};
        for (var key in json) {
            ret[json[key]] = key;
        }
        return ret;
    }
</script>
@endsection
