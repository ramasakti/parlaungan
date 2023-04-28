<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    @if (session()->has('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session()->has('fail'))
        <div class="uk-alert-danger" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('fail') }}</p>
        </div>
    @endif
    <ul uk-tab>
        <li><a href="#">Pembayaran</a></li>
        <li class="{{ (request('tanggal')) ? 'uk-active' : ''}}"><a href="#">Data Transaksi</a></li>
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