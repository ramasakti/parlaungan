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
                    <td>{{ $transaksi->total_transaksi }}</td>
                    <td>
                        <a href="#detail-trx-{{ $transaksi->kwitansi }}" uk-toggle="target: #detail-trx-{{ $transaksi->kwitansi }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </a> &nbsp;
                        @include('siswa.keuangan.transaksi.detail-transaksi')
                        <a href="#detail-trx-{{ $transaksi->kwitansi }}" uk-toggle="target: #print-transaksi-{{ $transaksi->id_transaksi }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                            </svg>
                        </a> &nbsp;
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