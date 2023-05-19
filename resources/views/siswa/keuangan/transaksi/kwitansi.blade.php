<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data[0]->kwitansi }}</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/css/uikit.min.css" />
</head>
<body>
    @php
        $trx = DB::table('transaksi')->select('pembayaran_id', 'terbayar')->where('kwitansi', $data[0]->kwitansi)->get()->toArray();
        $newArr = array_map(function($item) {
            return $item->pembayaran_id;
        }, $trx);

        $newArr = array_values($newArr);

        $pmbyrn = DB::table('pembayaran')->whereIn('id_pembayaran', $newArr)->get();
    @endphp
    <div class="uk-container uk-container-xsmall">
        @if (session('status') == 'Bendahara' or session('status') == 'Admin')
            <form action="/kwitansi/print" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $data[0]->kwitansi }}">
                <button class="uk-margin-small-top">
                    <span uk-icon="icon: print"></span>
                </button>
            </form>
        @endif
        @if (session()->has('success'))
            <div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <h5 class="uk-text-center uk-margin-small-top">Kwitansi Pembayaran SMA Islam Parlaungan</h5>
        <p class="uk-margin-remove">Nomor Kwitansi: {{ $data[0]->kwitansi }}</p>
        <p class="uk-margin-remove">Nama Siswa: {{ $data[0]->nama_siswa }}</p>
        <p class="uk-margin-remove">Tanggal Transaksi: {{ $data[0]->waktu_transaksi }}</p>
        <p class="uk-margin-remove">Bendahara: Vinna Alviyatin, S.Sos</p>
        <table id="kwitansi" class="uk-table uk-table-divider uk-text-small">
            <thead>
                <tr>
                    <th class="uk-padding-remove">Pembayaran</th>
                    <th class="uk-padding-remove">Nominal</th>
                    <th class="uk-padding-remove">Dibayar</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($pmbyrn); $i++) 
                    <tr>
                        <td class="uk-padding-remove">{{ $pmbyrn[$i]->nama_pembayaran }}</td>
                        <td class="uk-padding-remove">Rp. {{ number_format(intval($pmbyrn[$i]->nominal),0,'','.') }}</td>
                        <td class="uk-padding-remove">Rp. {{ number_format($trx[$i]->terbayar,0,'','.') }}</td>
                    </tr>
                @endfor
                    <tr>
                        @php
                            $total = array_reduce($trx, function($acc, $item) {
                                return $acc + $item->terbayar;
                            }, 0);
                        @endphp
                        <th colspan="2" class="uk-text-center uk-padding-remove">Total</td>
                        <td class="uk-padding-remove">Rp. {{ number_format($total,0,'','.') }}</td>
                    </tr>
            </tbody>
        </table>
        <p class="uk-text-center">{{ QrCode::size(170)->generate('https://smaispa.sch.id/transaksi/kwitansi?id='.$data[0]->kwitansi) }}</p>
        <p class="uk-text-center">Dibuat dan Dikembangkan Oleh Staf Data, Informasi, Pengembangan dan Infrastruktur Teknologi</p>
        <p class="uk-text-center">SMA Islam Parlaungan</p>
    </div>
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit-icons.min.js"></script>
</body>
</html>