<table class="uk-table uk-table-hover uk-table-divider">
    <thead>
        <a href="/web/home/store" uk-icon="icon: plus"></a>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Judul</th>
            <th>Teks</th>
            <th>Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($homePage as $homepage)
            <tr>
                <td>{{ $ai++ }}</td>
                <td>
                    
                </td>
                <td>{{ $homepage->judul }}</td>
                <td>{{ $homepage->teks }}</td>
                <td>
                    <a href="/web/home/store" uk-icon="icon: settings"></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>