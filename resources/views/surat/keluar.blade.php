<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nomor</th>
            <th scope="col">Perihal</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataKeluar as $keluar)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $keluar->nomor }}</td>
                <td>{{ $keluar->perihal }}</td>
                <td>{{ $keluar->tanggal }}</td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-arsip-keluar-{{ $keluar->id_arsip }}">
                    </a> &nbsp;
                    @include('surat.edit-arsip-keluar')
                    <a href="#modal-center" uk-icon="trash" uk-toggle="target: #delete-arsip-keluar-{{ $keluar->id_arsip }}">
                    </a> &nbsp;
                    @include('surat.delete-arsip-keluar')
                    <a target="_blank" href="/storage/arsip/{{ $keluar->url }}" uk-icon="link">
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>