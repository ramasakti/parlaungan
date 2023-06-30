<div class="uk-margin">
    <h5>
        Data Siswa Tidak Hadir {{ $hariIni }}
        <a href="#sharer" class="uk-icon-link" uk-icon="social" uk-toggle></a>@include('absen.share') 
    </h5>
</div>
<table class="uk-table uk-table-hover uk-table-small">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Status</th>
            <th scope="col">Kontak</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataKetidakhadiran as $siswa)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>{{ $siswa->tingkat }} {{ $siswa->jurusan }}</td>
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
                    <a href="#modal-center" uk-icon="whatsapp" uk-toggle="target: #kontak-{{ $siswa->id_siswa }}">
                    </a>
                    @include('absen.kontak')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>