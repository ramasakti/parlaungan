<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <form method="GET">
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-2@s">
                <p>Dari</p>
                <input class="uk-input" type="date" name="dari" value="{{ request('dari') }}">
            </div>
            <div class="uk-width-1-2@s">
                <p>Sampai</p>
                <input class="uk-input" type="date" name="sampai" value="{{ request('sampai') }}">
            </div>
        </div>
        <button class="uk-button uk-margin uk-button-primary uk-button-small uk-width-1-1" type="submit">TAMPILKAN</button>
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
                                        ->select(DB::raw('COUNT(jurnal.id_jurnal) as tertunaikan'), DB::raw('SUM(jurnal.transport) as transport'))
                                        ->join('jadwal', 'jadwal.id_jadwal', '=', 'jurnal.jadwal_id')
                                        ->where('jadwal.guru_id', $guru->id_guru)
                                        ->where('jurnal.inval', FALSE)
                                        ->where('jurnal.tanggal', '>=', request('dari'))
                                        ->where('jurnal.tanggal', '<=', request('sampai'))
                                        ->groupBy('jadwal.guru_id')
                                        ->first();
            
                $jadwal = DB::table('jadwal')
                                ->select(DB::raw("COUNT(jadwal.id_jadwal) as jumlah_jam"))
                                ->where('guru_id', $guru->id_guru)
                                ->groupBy('guru_id')
                                ->first();

                $menginval = DB::table('inval')
                                ->select(DB::raw("COUNT(jurnal.id_jurnal) AS menginval"))
                                ->join('jadwal', 'jadwal.id_jadwal', '=', 'inval.jadwal_id')
                                ->join('jurnal', 'jurnal.jadwal_id', '=', 'jadwal.id_jadwal')
                                ->where('jurnal.inval', TRUE)
                                ->where('penginval', $guru->id_guru)
                                ->groupBy('penginval')
                                ->first();
                
            @endphp
            <tbody>
                <tr>
                    <td>{{ $guru->nama_guru }}</td>
                    <td>
                        @if ($jadwal)
                            {{ ceil($jadwal->jumlah_jam) }}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if ($dataTertunaikan)
                            {{ $dataTertunaikan->tertunaikan; }}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if ($dataTertunaikan)
                            {{ $dataTertunaikan->transport; }}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        S/I/A
                    </td>
                    <td>
                        @if ($menginval)
                            {{ $menginval->menginval; }}
                        @else
                            0
                        @endif
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
</x-admintemplate>