<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">NAMA</th>
            <th scope="col">EMAIL</th>
            <th scope="col">TERAKHIR LOGIN</th>
            <th scope="col">STATUS</th>
            <th scope="col">OPSI</th>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $admin->full_id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->updated_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $admin->trashed() ? 'non aktif' : 'aktif' }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
