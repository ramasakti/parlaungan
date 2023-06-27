<ul class="uk-iconnav uk-margin">
    <li>
        <a href="/blog/create" class="mx-2" uk-icon="icon: plus"></a>
    </li>
</ul>
@if (session()->has('success'))
    <div class="uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>{{ session('success') }}</p>
    </div>
@endif
@if (session()->has('fail'))
    <div class="uk-alert-danger" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>{{ session('fail') }}</p>
    </div>
@endif
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Uploaded</th>
            <th scope="col">Author</th>
            <th scope="col">Publikasi</th>
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
                    @if ($blog->publish)
                        Sudah
                    @else
                        Belum
                    @endif
                </td>
                <td>
                &nbsp;
                <a href="/blog/view/{{ $blog->slug }}" target="_blank" uk-icon="link"></a>
                @if (session('status') == 'Admin' or session('status') == 'Kurikulum' or session('status') == 'Kesiswaan' or session('status') == 'Bendahara')    
                    <a href="/blog/edit/{{ $blog->slug }}" target="_blank" uk-icon="file-edit">&nbsp;
                    <a href="#delete-blog-{{ $blog->slug }}" uk-toggle uk-icon="trash"></a>
                    <div id="delete-blog-{{ $blog->slug }}" uk-modal>
                        <div class="uk-modal-dialog uk-modal-body">
                            <h4>Delete Blog?</h4>
                            <p></p>
                            <p class="uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                <a class="uk-button uk-button-primary" href="/blog/delete/{{ $blog->slug }}">Ya</a>
                            </p>
                        </div>
                    </div>
                @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>