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
                <th>S/I/A</th>
                <th>Menginval</th>
                <th>Total</th>
            </tr>
        </thead>
        @foreach ($dataGuru as $guru)
            @php
                $dataTertunaikan = DB::table('jurnal')
                                        ->select(DB::raw('SUM(jurnal.lama) as tertunaikan'), DB::raw('SUM(jurnal.transport) as transport'))
                                        ->join('jadwal', 'jadwal.id_jadwal', '=', 'jurnal.jadwal_id')
                                        ->where('jadwal.guru_id', $guru->id_guru)
                                        ->where('jurnal.inval', FALSE)
                                        ->where('jurnal.tanggal', '>=', request('dari'))
                                        ->where('jurnal.tanggal', '<=', request('sampai'))
                                        ->groupBy('jadwal.guru_id')
                                        ->get();
            
                $jadwal = DB::table('jadwal')
                                ->select(DB::raw("SUM(TIME_TO_SEC(TIMEDIFF(jadwal.sampai, jadwal.mulai)))/$jampel/60 as jumlah_jam"))
                                ->where('guru_id', $guru->id_guru)
                                ->groupBy('guru_id')
                                ->get();

                $menginval = DB::table('inval')
                                ->select(DB::raw("SUM(jurnal.lama) AS menginval"))
                                ->join('jadwal', 'jadwal.id_jadwal', '=', 'inval.jadwal_id')
                                ->join('jurnal', 'jurnal.jadwal_id', '=', 'jadwal.id_jadwal')
                                ->where('jurnal.inval', TRUE)
                                ->where('penginval', $guru->id_guru)
                                ->groupBy('penginval')
                                ->get();
                
                $sia = DB::table('inval')
            @endphp
            <tbody>
                <tr>
                    <td>{{ $guru->nama_guru }}</td>
                    <td>
                        @if (count($jadwal) > 0)
                            {{ ceil($jadwal[0]->jumlah_jam) }}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if (count($dataTertunaikan) > 0)
                            {{ $dataTertunaikan[0]->tertunaikan; }}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if (count($dataTertunaikan) > 0)
                            {{ $dataTertunaikan[0]->transport; }}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        S/I/A
                    </td>
                    <td>
                        @if (count($menginval) > 0)
                            {{ $menginval[0]->menginval; }}
                        @else
                            0
                        @endif
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
</x-admintemplate>