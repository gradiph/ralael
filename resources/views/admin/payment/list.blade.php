<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">TGL DIBUAT</th>
            <th scope="col">TRANSAKSI</th>
            <th scope="col">USER</th>
            <th scope="col">JUMLAH</th>
            <th scope="col">FOTO</th>
            <th scope="col">OPSI</th>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $payment->full_id }}</td>
                    <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $payment->transaction->full_id }}</td>
                    <td>{{ $payment->transaction->user->name }}</td>
                    <td>{{ $payment->value }}</td>
                    <td>{{ $payment->address }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
