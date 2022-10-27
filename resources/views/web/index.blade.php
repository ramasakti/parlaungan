<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <ul uk-tab>
        <li><a href="#">Home Page</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Galeri</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        <li>
            @include('web.home.index')
        </li>
        <li>
            @include('web.blog.index')
        </li>
        <li>
            @include('web.galeri.index')
        </li>
    </ul>
</x-admintemplate>