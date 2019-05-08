<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">NAMA</th>
            <th scope="col">OPSI</th>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $tag->full_id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
