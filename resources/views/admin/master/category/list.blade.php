<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">NAMA</th>
            <th scope="col">STATUS</th>
            <th scope="col">OPSI</th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $category->full_id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->trashed() ? 'non aktif' : 'aktif' }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
