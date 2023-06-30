<div class="uk-margin">
    <h5>
        Data Siswa Terlambat {{ $hariIni }} 
        <a href="#sharer" class="uk-icon-link" uk-icon="social" uk-toggle></a>@include('absen.share')
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