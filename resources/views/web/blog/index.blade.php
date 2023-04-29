<ul class="uk-iconnav uk-margin">
    <li>
        <a href="/blog/create" class="mx-2" uk-icon="icon: plus"></a>
    </li>
</ul>
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Uploaded</th>
            <th scope="col">Author</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataBlog as $blog)
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $blog->judul }}</td>
                <td>{{ $blog->uploaded }}</td>
                <td>{{ $blog->uploader }}</td>
                <td>
                    <a href="/blog/edit/{{ $blog->slug }}" target="_blank" uk-icon="file-edit">
                    </a> &nbsp;
                    <a href="/blog/view/{{ $blog->slug }}" target="_blank" uk-icon="link"></a>
                    <a href="/blog/delete/{{ $blog->slug }}" uk-icon="trash"></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>