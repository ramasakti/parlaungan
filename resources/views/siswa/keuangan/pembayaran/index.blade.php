<a class="mx-2 my-2" href="#modal-center" uk-toggle="target: #add-pembayaran" uk-icon="icon: plus"></a>
@include('siswa.keuangan.pembayaran.add-pembayaran')
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Pembayaran</th>
            <th scope="col">Nominal</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allPembayaran as $pembayaran)
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $pembayaran->nama_pembayaran }}</td>
                <td>Rp. {{ number_format($pembayaran->nominal,0,'','.') }}</td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-pembayaran-{{ $pembayaran->id_pembayaran }}">
                    </a> &nbsp;
                    @include('siswa.keuangan.pembayaran.edit-pembayaran')
                    <a href="#modal-center" uk-icon="trash" uk-toggle="target: #delete-pembayaran-{{ $pembayaran->id_pembayaran }}">
                    </a>
                    @include('siswa.keuangan.pembayaran.delete-pembayaran')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>