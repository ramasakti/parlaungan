<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <ul uk-tab>
        @if (session('status') != 'Siswa')
            <li><a href="#">Home Page</a></li>
            <li><a href="#">Galeri</a></li>
        @endif
        <li><a href="#">Blog</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        @if (session('status') != 'Siswa')   
            <li>
                @include('web.home.index')
            </li>
            <li>
                @include('web.galeri.index')
            </li>
        @endif
        <li>
            @include('web.blog.index')
        </li>
    </ul>
</x-admintemplate>