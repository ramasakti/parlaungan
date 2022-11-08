<script src="/js/html5-qrcode.min.js" type="text/javascript"></script>
    <center>
        <br>
        <div class="uk-postion-center" style="width: 500px" id="reader"></div>
        <br>
    </center>

    <h5 class="uk-margin">Detail Pembayaran</h5>
    <div class="uk-child-width-1-5@s" uk-grid>
        @foreach ($detailPembayaran as $detilPembayaran)    
            <div>
                <div class="uk-card uk-card-default uk-card-small uk-card-body uk-margin-small">
                    <h6 class="uk-margin-small">
                        {{ $detilPembayaran->nama_pembayaran }}
                    </h6>
                    @php
                        $terbayar = DB::table('transaksi')
                                        ->select(
                                            '*',
                                            DB::raw('SUM(terbayar) as pembayaran_terbayar')
                                        )
                                        ->where('siswa_id', request('siswa_id'))
                                        ->where('pembayaran_id', $detilPembayaran->id_pembayaran)
                                        ->groupBy('pembayaran_id')
                                        ->get();
                    @endphp
                    <p>Nominal: {{ number_format($detilPembayaran->nominal,0,'','.') }}</p>
                    @if (count($terbayar) > 0)
                        <p>Terbayar: {{ number_format($terbayar[0]->pembayaran_terbayar,0,'','.') }}</p>
                        @if ($terbayar[0]->pembayaran_terbayar == $detilPembayaran->nominal)
                            <span class="uk-label uk-label-success">Lunas</span>
                        @else
                            <span class="uk-label uk-label-warning">Belum Lunas</span>
                        @endif
                    @else
                        <p>Terbayar: {{ 0 }}</p>
                        <span class="uk-label uk-label-warning">Belum Lunas</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <h5 class="uk-margin">Riwayat Transaksi</h5>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kwitansi</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Total</th>
                <th scope="col">Handler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailTransaksi as $transaksi)
                <tr>
                    <td>{{ $ai++ }}</td>
                    <td>{{ $transaksi->kwitansi }}</td>
                    <td>{{ $transaksi->waktu_transaksi }}</td>
                    <td>{{ $transaksi->total_transaksi }}</td>
                    <td>
                        <a href="#modal-center" uk-toggle="target: #edit-transaksi-{{ $transaksi->id_transaksi }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </a> &nbsp;
                        @include('siswa.keuangan.transaksi.detail-transaksi')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
<script>
    function addTransaksi() {

    }

    function onScanSuccess(decodedText) {
        //Handle on success condition with the decoded text or result.
        const audio = document.getElementById('success')
        audio.play()
        window.location.href = '/siswa/keuangan?siswa_id=' + `${decodedText}`;
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 120, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>