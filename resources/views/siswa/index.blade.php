<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    @if (session()->has('imported'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('imported') }}</p>
        </div>
    @endif
    @if (session()->has('siswa'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('siswa') }}</p>
        </div>
    @endif
    @if (session()->has('kelas'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('kelas') }}</p>
        </div>
    @endif

    <ul uk-tab>
        <li><a href="#">Kelas</a></li>
        <li class="uk-active"><a href="#">Data Siswa</a></li>
    </ul>

    <ul class="uk-switcher uk-margin uk-margin-remove-top">
        <li>
            @include('siswa.kelas.index')
        </li>
        <li class="uk-active">
            @include('siswa.data.index')
        </li>
    </ul>
</x-admintemplate>