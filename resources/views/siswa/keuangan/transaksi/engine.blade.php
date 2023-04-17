<script src="/js/html5-qrcode.min.js" type="text/javascript"></script>
    <center>
        <br>
            <div class="uk-postion-center" style="width: 500px" id="reader"></div>
            <form action="/siswa/keuangan" method="get" id="formPembayar">
                <input type="hidden" name="siswa_id" id="calonPembayar">
            </form>
        <br>
    </center>

    @if (session()->has('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <h5 class="uk-margin">Detail Pembayaran {{ $dataSiswa->nama_siswa }}</h5>
    <form action="/pembayaran/transaksi?siswa_id={{ request('siswa_id') }}" method="post">
        @csrf
        <input type="hidden" name="id_siswa" value="{{ request('siswa_id') }}" required>
        <div class="uk-child-width-1-5@s" uk-grid>
            @foreach ($detailPembayaran as $pembayaran)   
                <div>
                    <div class="uk-card uk-card-default uk-card-small uk-card-body uk-margin-small">
                            @php
                                $terbayar = DB::table('transaksi')
                                                ->select(
                                                    '*',
                                                    DB::raw('SUM(terbayar) as pembayaran_terbayar')
                                                )
                                                ->where('siswa_id', request('siswa_id'))
                                                ->where('pembayaran_id', $pembayaran->id_pembayaran)
                                                ->groupBy('pembayaran_id')
                                                ->get();
                            @endphp
                            <h6 class="uk-margin-small">
                                {{ $pembayaran->nama_pembayaran }} 
                                <input class="uk-checkbox uk-position-top-right uk-margin" type="checkbox" name="pembayaran[]" value="{{ $pembayaran->id_pembayaran }}">
                            </h6>
                            <p>Nominal: {{ number_format($pembayaran->nominal,0,'','.') }}</p>
                            @if (count($terbayar) > 0)
                                <p>Terbayar: {{ number_format($terbayar[0]->pembayaran_terbayar,0,'','.') }}</p>
                                @if ($terbayar[0]->pembayaran_terbayar == $pembayaran->nominal)
                                    <span name="status" class="uk-label uk-label-success">Lunas</span>
                                @else
                                    <span name="status" class="uk-label uk-label-warning">Belum Lunas</span>
                                @endif
                            @else
                                <p>Terbayar: {{ 0 }}</p>
                                <span name="status" class="uk-label uk-label-warning">Belum Lunas</span>
                            @endif
                    </div>
                </div>
            @endforeach
        </div>
        <button class="uk-margin uk-button uk-button-primary" id="checkout" type="submit">Checkout</button> 
    </form>

    <table class="table table-borderless mt-2">
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
                    <td>Rp. {{ number_format($transaksi->total_transaksi,0,'','.') }}</td>
                    <td>
                        <a href="#detail-trx-{{ $transaksi->kwitansi }}" uk-toggle="target: #detail-trx-{{ $transaksi->kwitansi }}" uk-icon="info"></a>
                        @include('siswa.keuangan.transaksi.detail-transaksi')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<script>
    const pembayaran = document.getElementsByName('pembayaran[]')
    const status = document.getElementsByName('status')
    function disabling() {
        for (let index = 0; index < status.length; index++) {
            if (status[index].innerText == 'LUNAS') {
                pembayaran[index].setAttribute('disabled', '')
            }
        }
    }
    setInterval(() => {
        disabling()
    }, 1000);

    const checkout = document.getElementById('checkout')
    const hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('=')[1];
    if (hashes == undefined) {
        checkout.remove()
    }

    const calonPembayar = document.getElementById('calonPembayar')
    const formPembayar = document.getElementById('formPembayar')
    function onScanSuccess(decodedText) {
        //Handle on success condition with the decoded text or result.
        calonPembayar.setAttribute('value', decodedText)
        formPembayar.submit()
        formPembayar.remove()
    }
    
    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 120, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>