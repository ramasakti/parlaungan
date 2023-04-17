<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kwitansi</th>
            <th scope="col">Tgl Transaksi</th>
            <th scope="col">Siswa</th>
            <th scope="col">Total</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allTransaksi as $transaksi)
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $transaksi->kwitansi }}</td>
                <td>{{ $transaksi->waktu_transaksi }}</td>
                <td>{{ $transaksi->nama_siswa }}</td>
                <td>Rp. {{ number_format($transaksi->terbayar,0,'','.') }}</td>
                <td>
                    <a href="#detail-trx-{{ $transaksi->kwitansi }}" uk-toggle="target: #detail-trx-{{ $transaksi->kwitansi }}" uk-icon="info"></a>
                    @include('siswa.keuangan.transaksi.detail-transaksi')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>