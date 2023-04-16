<div id="detail-trx-{{ $transaksi->kwitansi }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        @php
            $trx = DB::table('transaksi')->select('pembayaran_id')->where('kwitansi', $transaksi->kwitansi)->get()->toArray();

            $newArr = array_map(function($item) {
                return $item['pembayaran_id'];
            }, $trx);

            dd($newArr);

        @endphp

        <table class="uk-table uk-table-divider">
            <thead>
                <tr>
                    <th>Table Heading</th>
                    <th>Table Heading</th>
                    <th>Table Heading</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Table Data</td>
                    <td>Table Data</td>
                    <td>Table Data</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>