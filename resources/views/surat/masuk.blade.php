<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Lembaga / Perusahaan</th>
            <th scope="col">Perihal</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataMasuk as $masuk)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $masuk->nomor }}</td>
                <td>{{ $masuk->perihal }}</td>
                <td>{{ $masuk->tanggal }}</td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-arsip-masuk-{{ $masuk->id_arsip }}">
                    </a> &nbsp;
                    @include('surat.edit-arsip-masuk')
                    <a href="#modal-center" uk-icon="trash" uk-toggle="target: #delete-arsip-masuk-{{ $masuk->id_arsip }}">
                    </a> &nbsp;
                    @include('surat.delete-arsip-masuk')
                    <a target="_blank" href="{{ $masuk->url }}" uk-icon="link">
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>