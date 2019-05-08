<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">NAMA</th>
            <th scope="col">EMAIl</th>
            <th scope="col">TERAKHIR LOGIN</th>
            <th scope="col">STATUS</th>
            <th scope="col">OPSI</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->full_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->updated_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $user->trashed() ? 'non aktif' : 'aktif' }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
