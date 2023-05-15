@if (session()->has('piket') or session('status') === 'Admin')
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
@endif

@foreach ($kelasSelected as $kelas)    
    <div class="uk-margin">
        <h5>Absen Siswa Kelas {{ $kelas->tingkat }} {{ $kelas->jurusan }}</h5>
    </div>
@endforeach
<table class="uk-table uk-table-hover uk-table-small">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Status</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataAbsen as $siswa)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>
                    <div class="uk-inline">
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
                        <div class="uk-card uk-card-body uk-card-default uk-padding-small" uk-drop="pos: left-center">
                            @php
                                $data = DB::table('rekap_siswa')->where('siswa_id', $siswa->id_siswa)->get();

                                $duplikat = DB::table('rekap_siswa')
                                                ->select('keterangan')
                                                ->groupBy('keterangan')
                                                ->havingRaw('COUNT(*) > 1')
                                                ->whereDate('tanggal', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 1 DAY)'))
                                                ->get();
                                dd($duplikat);
                            @endphp
                        </div>
                    </div>
                </td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-absen-{{ $siswa->id_siswa }}">
                    </a> &nbsp;
                    @include('absen.edit-absen')
                    <a href="#modal-center" uk-icon="whatsapp" uk-toggle="target: #kontak-{{ $siswa->id_siswa }}">
                    </a>
                    @include('absen.kontak')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>