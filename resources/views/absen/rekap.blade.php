<div class="uk-margin">
    <h5>Rekap Absen Siswa</h5>
    <p><a href="#modal-center" uk-toggle="target: #reset-absen" uk-icon="future" class="uk-margin uk-margin-remove-bottom"></a></p>
    @include('absen.reset')

    <form action="" method="get">
        <input type="date" name="mulai" id="mulai">
        <input type="date" name="sampai" id="sampai">
        <button type="submit" class="uk-button uk-button-primary uk-button-small">Show</button>
    </form>
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
        @php
            $sakit = DB::table('siswa')
                        ->select(DB::raw('COUNT(rekap_siswa.keterangan) AS sakit'))
                        ->join('rekap_siswa', 'rekap_siswa.siswa_id', '=', 'siswa.id_siswa')
                        ->where('rekap_siswa.keterangan', 'S')
                        ->where('siswa.id_siswa', $siswa->id_siswa)
                        ->where('rekap_siswa.tanggal', '>=', request('mulai'))
                        ->where('rekap_siswa.tanggal', '<=', request('sampai'))
                        ->groupBy('rekap_siswa.siswa_id')
                        ->get();
            
            $alfa = DB::table('siswa')
                        ->select(DB::raw('COUNT(rekap_siswa.keterangan) AS alfa'))
                        ->join('rekap_siswa', 'rekap_siswa.siswa_id', '=', 'siswa.id_siswa')
                        ->where('rekap_siswa.keterangan', 'A')
                        ->where('siswa.id_siswa', $siswa->id_siswa)
                        ->where('rekap_siswa.tanggal', '>=', request('mulai'))
                        ->where('rekap_siswa.tanggal', '<=', request('sampai'))
                        ->groupBy('rekap_siswa.siswa_id')
                        ->get();

            $izin = DB::table('siswa')
                        ->select(DB::raw('COUNT(rekap_siswa.keterangan) AS izin'))
                        ->join('rekap_siswa', 'rekap_siswa.siswa_id', '=', 'siswa.id_siswa')
                        ->where('rekap_siswa.keterangan', 'I')
                        ->where('siswa.id_siswa', $siswa->id_siswa)
                        ->where('rekap_siswa.tanggal', '>=', request('mulai'))
                        ->where('rekap_siswa.tanggal', '<=', request('sampai'))
                        ->groupBy('rekap_siswa.siswa_id')
                        ->get();

            $terlambat = DB::table('siswa')
                        ->select(DB::raw('COUNT(rekap_siswa.keterangan) AS terlambat'))
                        ->join('rekap_siswa', 'rekap_siswa.siswa_id', '=', 'siswa.id_siswa')
                        ->where('rekap_siswa.keterangan', 'T')
                        ->where('siswa.id_siswa', $siswa->id_siswa)
                        ->where('rekap_siswa.tanggal', '>=', request('mulai'))
                        ->where('rekap_siswa.tanggal', '<=', request('sampai'))
                        ->groupBy('rekap_siswa.siswa_id')
                        ->get();
        @endphp
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>
                    @if (count($sakit) > 0)
                        {{ $sakit[0]->sakit }}
                    @else
                        0
                    @endif
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