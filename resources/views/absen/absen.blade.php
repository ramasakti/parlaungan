<form action="/absen" method="get">
    <div class="uk-margin">
        <select name="id_kelas" class="uk-select" id="" onchange="this.form.submit()">
            <option value="">Pilih Kelas</option>
            @foreach ($dataKelas as $kelas)
                &nbsp; <option {{ ($kelas->id_kelas === request('id_kelas')) ? 'selected' : '' }} value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }} {{ $kelas->jurusan }}</option>
            @endforeach
        </select>
    </div>
</form>

@foreach ($kelasSelected as $kelas)    
    <div class="uk-margin">
        <h5>Absen Siswa Kelas {{ $kelas->tingkat }} {{ $kelas->jurusan }}</h5>
    </div>
@endforeach
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Status</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataAbsen as $siswa)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $siswa->id_siswa }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>
                    @if ($siswa->waktu_absen === NULL)
                        @if ($siswa->keterangan === 'A')
                            <span class="uk-label uk-label-danger">Alfa</span>
                        @elseif ($siswa->keterangan === 'S')
                            <span class="uk-label uk-label-default">Sakit</span>
                        @elseif ($siswa->keterangan === 'I')
                            <span class="uk-label uk-label-default">Izin</span>
                        @endif
                    @elseif ($siswa->waktu_absen > $jamMasuk[0]->masuk)
                        <span class="uk-label uk-label-warning">Terlambat</span>
                    @else
                        <span class="uk-label uk-label-success">Hadir</span>
                    @endif
                </td>
                <td>
                    <a href="#modal-center" uk-toggle="target: #edit-absen-{{ $siswa->id_siswa }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a> &nbsp;
                    @include('absen.edit-absen')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>