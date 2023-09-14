<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    @php
        $absenGuru = DB::table('absen_guru')->select('id_guru')->get();
        $guru = DB::table('guru')
            ->whereNotIn('id_guru', $absenGuru)
            ->get();
        
        foreach ($guru as $guru) {
            DB::table('absen_guru')
                ->insert([
                    'id_guru' => $guru->id_guru,
                    'waktu_absen' => NULL,
                    'keterangan' => ''
            ]);
        }
    @endphp
    @if (session()->has('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <table class="table table-borderless" id="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Handler</th>
            </tr>
        </thead>
        @foreach ($dataAbsenGuru as $showGuru)
        <tbody>
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $showGuru->id_guru }}</td>
                <td>{{ $showGuru->nama_guru }}</td>
                <td>
                    @if ($showGuru->waktu_absen != null)
                        Hadir: {{ $showGuru->waktu_absen }}
                    @else
                        {{ $showGuru->keterangan }}
                    @endif
                </td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #absen-guru-{{ $showGuru->id_guru }}">
                    </a>
                    @include('guru.absen.absen-guru')
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</x-admintemplate>