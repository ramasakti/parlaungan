<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    @if (session()->has('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <ul uk-tab>
        <li class="{{ (session()->has('absen')) ? 'uk-active' : '' }}"><a href="#">Absen</a></li>
        <li><a href="#">Keterlambatan</a></li>
        <li><a href="#">Ketidakhadiran</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        <li class="{{ (session()->has('absen')) ? 'uk-active' : '' }}">
            @include('absen.absen')
        </li>
        <li class="{{ (session()->has('keterlambatan')) ? 'uk-active' : '' }}">
            @include('absen.keterlambatan')
        </li>
        <li class="{{ (session()->has('ketidakhadiran')) ? 'uk-active' : '' }}">
            @include('absen.ketidakhadiran')
        </li>
    </ul>
</x-admintemplate>
    