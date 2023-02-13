<x-admintemplate title="{{ $title }}" navactive="{{ $navactive }}">
    <form action="" method="get">
        <div class="uk-margin uk-margin-remove-bottom">
            <select name="id_kelas" class="uk-select" required>
                <option value="">Pilih Kelas</option>
                @foreach ($dataKelas as $kelas)
                    &nbsp; <option {{ ($kelas->id_kelas === request('id_kelas')) ? 'selected' : '' }} value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }} {{ $kelas->jurusan }}</option>
                @endforeach
            </select>
            <div class="uk-grid-small uk-margin-small-top" uk-grid>
                <div class="uk-width-1-2@s">
                    <p>Dari</p>
                    <input class="uk-input" type="date" name="mulai" id="mulai" value="{{ request('mulai') }}" required>
                </div>
                <div class="uk-width-1-2@s">
                    <p>Sampai</p>
                    <input class="uk-input" type="date" name="sampai" id="sampai" value="{{ request('sampai') }}" required>
                </div>
            </div>
            <button type="submit" class="uk-button uk-margin uk-width-1-1 uk-button-primary uk-button-small">TAMPILKAN</button>
        </div>
    </form>
        <p><a href="#modal-center" uk-toggle="target: #reset-absen" uk-icon="future" class="uk-margin uk-margin-remove-bottom"></a></p>
        @include('absen.reset')
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
            @foreach ($dataSiswa as $siswa)
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
                        @if (count($alfa) > 0)
                            {{ $alfa[0]->alfa }}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if (count($izin) > 0)
                            {{ $izin[0]->izin }}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if (count($terlambat ) > 0)
                            {{ $terlambat [0]->terlambat  }}
                        @else
                            0
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admintemplate>