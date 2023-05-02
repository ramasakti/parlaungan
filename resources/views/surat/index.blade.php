<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    @if (session()->has('add-arsip'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('add-arsip') }}</p>
        </div>
    @endif
    @if (session()->has('update-arsip'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('update-arsip') }}</p>
        </div>
    @endif
    @if (session()->has('delete-arsip'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('delete-arsip') }}</p>
        </div>
    @endif
    @if (session()->has('gagal'))
        <div class="uk-alert-danger" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('gagal') }}</p>
        </div>
    @endif

    <ul uk-tab>
        <li><a href="#">Keluar</a></li>
        <li><a href="#">Masuk</a></li>
    </ul>

    <a class="uk-margin uk-margin-remove-bottom" href="#modal-center" uk-toggle="target: #add-arsip" uk-icon="icon: plus"></a>
    @include('surat.add-arsip')
    &nbsp;

    <ul class="uk-switcher uk-margin">
        <li>
            @include('surat.keluar')
        </li>
        <li>
            @include('surat.masuk')
        </li>
    </ul>
</x-admintemplate>