<a class="mx-2" href="#modal-center" uk-toggle="target: #add-jadwal" uk-icon="icon: plus"></a>
@include('jadwal.add-jadwal')
@foreach ($kelasSelected as $kelas)
    <h5>Jadwal Pelajaran {{ $kelas->tingkat }} {{ $kelas->jurusan }} hari Senin</h5>
@endforeach
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Guru</th>
            <th scope="col">Mapel</th>
            <th scope="col">Waktu</th>
            <th scope="col">Status</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataSenin as $jadwal)
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $jadwal->id_jadwal }}</td>
                <td>{{ $jadwal->nama_guru }}</td>
                <td>{{ $jadwal->mapel }}</td>
                <td>{{ $jadwal->mulai }} - {{ $jadwal->sampai }}</td>
                <td>
                    
                </td>
                <td>
                    @if (session('status') === 'Admin' || session('status') === 'Kurikulum')
                        <a href="#modal-center" uk-toggle="target: #delete-jadwal-{{ $jadwal->id_jadwal }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                        @include('jadwal.delete-jadwal')
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>