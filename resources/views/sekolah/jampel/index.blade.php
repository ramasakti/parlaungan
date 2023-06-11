<a class="uk-margin" href="#modal-center" uk-toggle="target: #add-jampel" uk-icon="icon: plus"></a>
@include('sekolah.jampel.add-jampel')
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Hari</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Mulai</th>
            <th scope="col">Selesai</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataJam as $jampel)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $jampel->hari }}</td>
                <td>{{ $jampel->keterangan }}</td>
                <td>{{ $jampel->mulai }}</td>
                <td>{{ $jampel->selesai }}</td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-jampel-{{ $jampel->id_jampel }}">
                    </a> &nbsp;
                    @include('sekolah.jampel.edit-jampel')
                    <a href="#modal-center" uk-icon="trash" uk-toggle="target: #delete-jampel-{{ $jampel->id_jampel }}">
                    </a>
                    @include('sekolah.jampel.delete-jampel')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>