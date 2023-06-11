<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    @if (session()->has('add-libur'))
        <div uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('add-libur') }}</p>
        </div>
    @endif
    @if (session()->has('update-libur'))
        <div uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('update-libur') }}</p>
        </div>
    @endif
    @if (session()->has('delete-libur'))
        <div uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('delete-libur') }}</p>
        </div>
    @endif
    @if (session()->has('update-hari'))
        <div uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('update-hari') }}</p>
        </div>
    @endif
    @if (session()->has('gagal'))
        <div uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('gagal') }}</p>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @error('mulai')
        <div class="uk-alert-danger" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>Jam pelajaran bentrok!</p>
        </div>
    @enderror
    <ul uk-tab>
        <li><a href="#">Jam Pelajaran</a></li>
        <li><a href="#">Harian & Piket</a></li>
        <li><a href="#">Libur</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        <li>
            @include('sekolah.jampel.index')
        </li>
        <li>
            @include('sekolah.harian.index')
        </li>
        <li>
            @include('sekolah.libur.index')
        </li>
    </ul>
</x-admintemplate>