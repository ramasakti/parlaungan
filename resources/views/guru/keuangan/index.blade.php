<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <form method="GET">
        <div class="uk-margin">
            <input type="date" name="dari" value="{{ request('dari') }}">
            <input type="date" name="sampai" value="{{ request('sampai') }}">
            <p class="uk-margin">
                <button class="uk-button uk-button-primary uk-button-small" type="submit">SHOW</button>
            </p>
        </div>
    </form>

    <table class="table table-borderless" id="data-table">
        <thead>
            <tr>
                <th>Guru</th>
                <th>Jml Jam (/Week)</th>
                <th>Tertunaikan</th>
                <th>Transport</th>
                <th>S</th>
                <th>I</th>
                <th>A</th>
                <th>Total</th>
            </tr>
        </thead>
        @foreach ($dataJadwal as $showJadwal)
        <tbody>
            <tr>
                <td>{{ $showJadwal->nama_guru }}</td>
                <td>{{ ceil($showJadwal->jumlah_jam) }}</td>
                <td>
                    @if (count($dataTertunaikan) > 0)
                        {{ $dataTertunaikan[0]->tertunaikan }} Jam
                    @else
                        0 Jam
                    @endif
                </td>
                <td>{{ count($dataTransport) * $dataNominal[1]->harga; }}</td>
                <td>
                    @php
                        $dataSakit = DB::table('jadwal')
                                        ->crossJoin('ketidakhadiran')
                                        ->select('jadwal.guru_id', DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(jadwal.sampai, jadwal.mulai)))/40/60 as sakit'))
                                        ->where('ketidakhadiran.tanggal', '>=', request('dari'))
                                        ->where('ketidakhadiran.tanggal', '<=', request('sampai'))
                                        ->where('ketidakhadiran.keterangan', '=', 'S')
                                        ->where('jadwal.id_jadwal', '=', DB::raw('ketidakhadiran.jadwal_id'))
                                        ->where('jadwal.guru_id', '=', $showJadwal->id_guru)
                                        ->groupBy('jadwal.guru_id')
                                        ->get();

                        if (count($dataSakit) > 0){
                            echo ceil($dataSakit[0]->sakit);
                            echo " Jam";
                        }else{
                            echo 0;
                            echo " Jam";
                        }
                    @endphp 
                </td>
                <td>
                    @php
                        $dataIzin = DB::table('jadwal')
                                        ->crossJoin('ketidakhadiran')
                                        ->select('jadwal.guru_id', DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(jadwal.sampai, jadwal.mulai)))/40/60 as izin'))
                                        ->where('ketidakhadiran.tanggal', '>=', request('dari'))
                                        ->where('ketidakhadiran.tanggal', '<=', request('sampai'))
                                        ->where('ketidakhadiran.keterangan', '=', 'I')
                                        ->where('jadwal.id_jadwal', '=', DB::raw('ketidakhadiran.jadwal_id'))
                                        ->where('jadwal.guru_id', '=', $showJadwal->id_guru)
                                        ->groupBy('jadwal.guru_id')
                                        ->get();

                        if (count($dataIzin) > 0){
                            echo ceil($dataIzin[0]->izin);
                            echo " Jam";
                        }else{
                            echo 0;
                            echo " Jam";
                        }
                    @endphp 
                </td>
                <td>
                    @php
                        $dataAlfa = DB::table('jadwal')
                                        ->crossJoin('ketidakhadiran')
                                        ->select('jadwal.guru_id', DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(jadwal.sampai, jadwal.mulai)))/40/60 as alfa'))
                                        ->where('ketidakhadiran.tanggal', '>=', request('dari'))
                                        ->where('ketidakhadiran.tanggal', '<=', request('sampai'))
                                        ->where('ketidakhadiran.keterangan', '=', 'A')
                                        ->where('jadwal.id_jadwal', '=', DB::raw('ketidakhadiran.jadwal_id'))
                                        ->where('jadwal.guru_id', '=', $showJadwal->id_guru)
                                        ->groupBy('jadwal.guru_id')
                                        ->get();

                        if (count($dataAlfa) > 0){
                            echo ceil($dataAlfa[0]->alfa);
                            echo " Jam";
                        }else{
                            echo 0;
                            echo " Jam";
                        }
                    @endphp 
                </td>
                <td>{{ $total }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</x-admintemplate>