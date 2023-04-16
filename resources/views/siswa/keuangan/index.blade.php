<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <ul uk-tab>
        <li><a href="#">Pembayaran</a></li>
        <li><a href="#">Data Transaksi</a></li>
        <li class="{{ (request('siswa_id')) ? 'uk-active' : ''}}"><a href="#">Scan</a></li>
    </ul>

    <ul class="uk-switcher uk-margin uk-margin-remove-top">
        <li>
            @include('siswa.keuangan.pembayaran.index')
        </li>
        <li>
            @include('siswa.keuangan.transaksi.data')
        </li>
        <li>
            @include('siswa.keuangan.transaksi.engine')
        </li>
    </ul>
</x-admintemplate>