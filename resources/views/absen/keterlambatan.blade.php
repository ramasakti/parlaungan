<div class="uk-margin">
    <h5>
        Data Siswa Terlambat {{ $hariIni }} 
        <a href="https://wa.me/?text=Data Siswa Terlambat {{ $hariIni }} %0A @foreach($dataTerlambat as $terlambat) *{{ $terlambat->nama_siswa }}* kelas *{{ $terlambat->tingkat }} {{ $terlambat->jurusan }}* hadir: *{{ $terlambat->waktu_absen }}* %0A @endforeach" class="uk-icon-link" uk-icon="social"></a>
    </h5>
</div>
<table class="uk-table uk-table-hover uk-table-small">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Hadir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataTerlambat as $siswa)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>{{ $siswa->tingkat }} {{ $siswa->jurusan }}</td>
                <td>{{ $siswa->waktu_absen }}</td>
            </tr>
        @endforeach
    </tbody>
</table>