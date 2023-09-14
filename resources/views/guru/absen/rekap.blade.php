<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <form method="GET">
        <input class="uk-input uk-margin-small" type="date" name="tanggal" value="{{ request('tanggal') }}" onchange="this.form.submit()">
    </form>
    <table class="table table-borderless" id="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Status</th>
            </tr>
        </thead>
        @foreach ($rekapAbsen as $showGuru)
        <tbody>
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $showGuru->id_guru }}</td>
                <td>{{ $showGuru->nama_guru }}</td>
                <td>
                    {{ $showGuru->keterangan }}
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</x-admintemplate>