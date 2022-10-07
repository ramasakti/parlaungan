<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    @if (session()->has('imported'))
        <div uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('imported') }}</p>
        </div>
    @endif
    <ul uk-tab>
        <li class="{{ (session()->has('kelas')) ? 'uk-active' : '' }}"><a href="#">Kelas</a></li>
        <li class="{{ (session()->has('siswa')) ? 'uk-active' : '' }}"><a href="#">Data Siswa</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        <li class="{{ (session()->has('kelas')) ? 'uk-active' : '' }}">
            @include('siswa.kelas.index')
        </li>
        <li class="{{ (session()->has('siswa')) ? 'uk-active' : '' }}">
            @include('siswa.data.index')
        </li>
    </ul>
</x-admintemplate>