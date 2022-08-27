<div class="uk-margin">
    <h5>
        Data Siswa Tidak Hadir {{ $hariIni }} 
        <a href="https://wa.me/?text=Data Siswa Tidak Hadir {{ $hariIni }} %0A @foreach($dataKetidakhadiran as $kTidakHadiran) *{{ $kTidakHadiran->nama_siswa }}* kelas *{{ $kTidakHadiran->tingkat }} {{ $kTidakHadiran->jurusan }}* keterangan: *{{ $kTidakHadiran->keterangan }}* %0A @endforeach" class="uk-icon-link" uk-icon="social"></a>
    </h5>
</div>
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Status</th>
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
            </tr>
        @endforeach
    </tbody>
</table>