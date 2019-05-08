<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">TGL BELI</th>
            <th scope="col">NAMA PEMBELI</th>
            <th scope="col">STATUS</th>
            <th scope="col">OPSI</th>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $transaction->full_id }}</td>
                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $transaction->recipient_name }}</td>
                    <td>{{ $transaction->status_name }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
