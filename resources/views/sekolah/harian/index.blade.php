<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">Hari</th>
            <th scope="col">Masuk</th>
            <th scope="col">Piket</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataHari as $hari)    
            <tr>
                <td>{{ $hari->nama_hari }}</td>
                <td>{{ $hari->masuk }}</td>
                <td>{{ $hari->nama_guru }}</td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-hari-{{ $hari->id_hari }}">
                    </a> &nbsp;
                    @include('sekolah.harian.edit-hari')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>