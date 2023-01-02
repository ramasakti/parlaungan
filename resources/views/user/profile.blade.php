<x-admintemplate title="{{ $title }}" navactive="{{ $navactive }}">
    <ul class="uk-flex-center" uk-tab>
        <li class="{{ (session()->has('profil')) ? 'uk-active' : '' }}"><a href="#">Profil</a></li>
        @if (session('status') === 'Siswa')
            <li class="{{ (session()->has('biodata')) ? 'uk-active' : '' }}"><a href="#">Detail Data</a></li>
        @endif
    </ul>

    <ul class="uk-switcher uk-margin uk-margin-remove-top">
        <li>
            @include('user.profile.profil')
        </li>
        <li>
            @if (session('status') === 'Siswa')
                @include('user.profile.biodata')
            @endif
        </li>
    </ul>
</x-admintemplate>