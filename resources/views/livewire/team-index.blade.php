<div>



    <hr>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Divisi</th>
                <th scope="col">Tugas</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0; ?>
            @foreach ($team as $row)
            <?php $no++; ?>
            <tr>
                <th scope="row">{{ $no }}</th>
                <th scope="row">{{ $row->profil_user->nama }}</th>
                <td>{{ $row->jabatan }}</td>
                <td>{{ $row->divisi }}</td>
                <td>{{ $row->tugas }}</td>
                <td>
                    <button class="btn btn-sm btn-info text-white">Edit</button>
                    <button class="btn btn-sm btn-danger text-white">Delete</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
