<x-admintemplate title='Sekolah' active='Sekolah'>
    <ul uk-tab>
        <li><a href="#">Harian & Piket</a></li>
        <li><a href="#">Libur</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        <li>
            @include('sekolah.harian.index')
        </li>
        <li>
            @include('sekolah.libur.index')
        </li>
    </ul>
</x-admintemplate>