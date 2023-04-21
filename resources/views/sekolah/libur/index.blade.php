<a class="uk-margin" href="#modal-center" uk-toggle="target: #add-libur" uk-icon="icon: plus"></a>
@include('sekolah.libur.add-libur')
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Mulai</th>
            <th scope="col">Sampai</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataLibur as $libur)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $libur->keterangan }}</td>
                <td>{{ $libur->mulai }}</td>
                <td>{{ $libur->sampai }}</td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-libur-{{ $libur->id_libur }}">
                    </a> &nbsp;
                    @include('sekolah.libur.edit-libur')
                    <a href="#modal-center" uk-icon="trash" uk-toggle="target: #delete-libur-{{ $libur->id_libur }}">
                    </a>
                    @include('sekolah.libur.delete-libur')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>