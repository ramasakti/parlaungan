<div class="uk-margin">
    <h5>Rekap Absen Siswa</h5>
    <p><a href="" uk-icon="future" class="uk-margin"></a></p>
</div>
<table class="uk-table uk-table-hover uk-table-small">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">S</th>
            <th scope="col">I</th>
            <th scope="col">A</th>
            <th scope="col">T</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataAbsen as $siswa)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>
                    {{ substr_count($siswa->rekap, 'S') }}
                </td>
                <td>
                    {{ substr_count($siswa->rekap, 'I') }}
                </td>
                <td>
                    {{ substr_count($siswa->rekap, 'A') }}
                </td>
                <td>
                    {{ $siswa->jumlah_terlambat }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>