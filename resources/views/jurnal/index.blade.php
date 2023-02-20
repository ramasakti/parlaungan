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
                        <a href="#modal-center" uk-toggle="target: #edit-jurnal-{{ $jurnal->id_jurnal }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a> &nbsp;
                        @include('jurnal.edit-jurnal')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admintemplate>