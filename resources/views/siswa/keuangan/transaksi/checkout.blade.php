<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
<h5 class="uk-margin">Detail Pembayaran</h5>
    <form action="/pembayaran/payment" method="post">
    @csrf
    <div class="uk-child-width-1-5@s" uk-grid>
        @foreach ($detailPembayaran as $detilPembayaran)
            <div>
                <div id="card-{{ $detilPembayaran->id_pembayaran }}" class="uk-card uk-card-default uk-card-small uk-card-body uk-margin-small">
                    <h6 class="uk-margin-small">
                        <a id="closer" uk-icon="icon: close" onclick="closeCard()" class="uk-position-top-right"></a>
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
                    @else
                        <p>Terbayar: {{ 0 }}</p>
                    @endif
                    <input class="uk-input uk-margin" type="hidden" name="id_siswa" value="{{ $id_siswa }}">
                    <input class="uk-input uk-margin" type="hidden" name="id_pembayaran[]" value="{{ $detilPembayaran->id_pembayaran }}">
                    <input class="uk-input uk-margin" type="number" name="nominal[]">
                </div>
            </div>
        @endforeach
    </div>
    <button class="uk-margin uk-button uk-button-primary" type="submit">Payment</button>
    </form>
    <script>
        const close = document.getElementById('closer')
        function closeCard() {
            close.parentElement.parentElement.remove()
        }
    </script>
</x-admintemplate>