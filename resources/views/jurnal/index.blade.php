<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <form method="get">
        Tanggal
        <input class="uk-input uk-margin" type="date" name="tanggal" onchange="this.form.submit()" value="{{ request('tanggal') }}">
    </form>
    <table class="table table-borderless" id="data-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>Kelas</th>
                <th>Guru</th>
                <th>Mapel</th>
                <th>Jam</th>
                <th scope="col">Handler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataJurnal as $jurnal)    
                <tr>
                    <td>{{ $ai++ }}</td>
                    <td>{{ $jurnal->tingkat ." ". $jurnal->jurusan }}</td>
                    <td>{{ $jurnal->nama_guru }}</td>
                    <td>{{ $jurnal->mapel }}</td>
                    <td>{{ $jurnal->mulai ." (". $jurnal->lama }} jam)</td>
                    <td>
                        <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-jurnal-{{ $jurnal->id_jurnal }}">
                        </a> &nbsp;
                        @include('jurnal.edit-jurnal')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admintemplate>