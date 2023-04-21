<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <a href="#modal-center" class="mb-2" uk-toggle="target: #add-guru" uk-icon="icon: plus"></a>
    @include('guru.data.add-guru')
    @if (session()->has('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <table class="table table-borderless" id="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Handler</th>
            </tr>
        </thead>
        @foreach ($dataGuru as $showGuru)
        <tbody>
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $showGuru->id_guru }}</td>
                <td>{{ $showGuru->nama_guru }}</td>
                <td>{{ $showGuru->status }}</td>
                <td>
                    <a href="#modal-center" uk-icon="trash" uk-toggle="target: #delete-guru-{{ $showGuru->id_guru }}">
                    </a>
                    @include('guru.data.delete-guru')
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</x-admintemplate>