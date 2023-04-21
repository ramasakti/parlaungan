<a class="mx-2 my-2" href="#modal-center" uk-toggle="target: #add-kelas" uk-icon="icon: plus"></a>
@include('siswa.kelas.add-kelas')
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Tingkat</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Walas</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataKelas as $kelas)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $kelas->id_kelas }}</td>
                <td>{{ $kelas->tingkat }}</td>
                <td>{{ $kelas->jurusan }}</td>
                <td>{{ $kelas->nama_guru }}</td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-kelas-{{ $kelas->id_kelas }}">
                    </a> &nbsp;
                    @include('siswa.kelas.edit-kelas')
                    <a href="#modal-center" uk-icon="trash" uk-toggle="target: #delete-kelas-{{ $kelas->id_kelas }}">
                    </a>
                    @include('siswa.kelas.delete-kelas')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>