<div id="detail-trx-{{ $transaksi->kwitansi }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        @php
            $trx = DB::table('transaksi')->select('pembayaran_id', 'terbayar')->where('kwitansi', $transaksi->kwitansi)->get()->toArray();
            
            $newArr = array_map(function($item) {
                return $item->pembayaran_id;
            }, $trx);

            $newArr = array_values($newArr);

            $pmbyrn = DB::table('pembayaran')->whereIn('id_pembayaran', $newArr)->get();
        @endphp

        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h6>{{ $transaksi->kwitansi }} <a href="#" onclick="editable()" uk-icon="icon: file-edit"></a></h6>

        <table id="kwitansi" class="uk-table">
            <thead>
                <tr>
                    <th>Pembayaran</th>
                    <th>Nominal</th>
                    <th>Dibayar</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($pmbyrn); $i++) 
                    <tr>
                        <td>{{ $pmbyrn[$i]->nama_pembayaran }}</td>
                        <td>Rp. {{ number_format(intval($pmbyrn[$i]->nominal),0,'','.') }}</td>
                        <td id="terbayar-{{ $i }}">Rp. {{ number_format($trx[$i]->terbayar,0,'','.') }}</td>
                    </tr>
                @endfor
                    <tr>
                        @php
                            $total = array_reduce($trx, function($acc, $item) {
                                return $acc + $item->terbayar;
                            }, 0);
                        @endphp
                        <th colspan="2" class="uk-text-center">Total</td>
                        <td>Rp. {{ number_format($total,0,'','.') }}</td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    const editable = () => {
        document.getElementById()
    }
</script>