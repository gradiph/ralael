<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">URUTAN</th>
            <th scope="col">NAMA</th>
            <th scope="col">STATUS</th>
            <th scope="col">OPSI</th>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $status->full_id }}</td>
                    <td>{{ $status->order }}</td>
                    <td>{{ $status->name }}</td>
                    <td>{{ $status->trashed() ? 'non aktif' : 'aktif' }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
