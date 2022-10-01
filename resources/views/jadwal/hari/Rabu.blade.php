<a class="mx-2" href="#modal-center" uk-toggle="target: #add-jadwal" uk-icon="icon: plus"></a>
@include('jadwal.add-jadwal')
@foreach ($kelasSelected as $kelas)
    <h5>Jadwal Pelajaran {{ $kelas->tingkat }} {{ $kelas->jurusan }} hari Rabu</h5>
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
            @include('jadwal.handler')
        </tr>
    </thead>
    <tbody>
        @foreach ($dataRabu as $jadwal)
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $jadwal->id_jadwal }}</td>
                <td>{{ $jadwal->nama_guru }}</td>
                <td>{{ $jadwal->mapel }}</td>
                <td>{{ $jadwal->mulai }} - {{ $jadwal->sampai }}</td>
                <td>
                    @if ($jadwal->status != '')
                        <span class="uk-label uk-label-success">Hadir</span>
                    @endif
                </td>
                @include('jadwal.action-handler ')
            </tr>
        @endforeach
    </tbody>
</table>