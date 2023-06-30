<div id="sharer" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>

        @php
            $groupedTerlambat = collect($dataTerlambat)->groupBy('kelas_id');
            $groupedKTidakHadiran = collect($dataKetidakhadiran)->groupBy('kelas_id');
        @endphp

        <p>
            Salin Data Keterlambatan Siswa Hari Ini
            <a href="#" uk-icon="copy" onclick="copyContent('terlambat', 0)"></a>
            <div id="terlambat" style="display: none">
                Data Keterlambatan Hari {{ $hariIni }}
@foreach ($dataTerlambat as $terlambat)
<p>• {{ $terlambat->nama_siswa }} *({{ $terlambat->waktu_absen }})*</p>
@endforeach
            </div>

            @foreach ($dataKelas as $kelas)
                <li>
                    Keterlambatan {{ $kelas->tingkat .' '. $kelas->jurusan }}
                    <a href="#" uk-icon="copy" onclick="copyContent('terlambat-{{ $kelas->id_kelas }}')"></a>
                </li>
                @if ($groupedTerlambat->has($kelas->id_kelas))
                    <div id="terlambat-{{ $kelas->id_kelas }}" style="display: none">
                        Data Keterlambatan Kelas {{ $kelas->tingkat .' '. $kelas->jurusan }} Hari {{ $hariIni }}
@foreach ($groupedTerlambat[$kelas->id_kelas] as $item)
<p>• {{ $item->nama_siswa }} *({{ $terlambat->waktu_absen }})*</p>
@endforeach
                    </div>
                @else
                    <div id="terlambat-{{ $kelas->id_kelas }}" style="display: none">
                        Data Keterlambatan Kelas {{ $kelas->tingkat .' '. $kelas->jurusan }} Hari {{ $hariIni }} *NIHIL*
                    </div>
                @endif
            @endforeach
        </p>

        <p>
            Salin Data Ketidakhadiran Siswa Hari Ini
            <a href="#" uk-icon="copy" onclick="copyContent('kTidakHadiran')"></a>
            <div id="kTidakHadiran" style="display: none">
                Data Ketidakhadiran Hari {{ $hariIni }}
@foreach ($dataKetidakhadiran as $kTidakHadiran)
<p>• {{ $kTidakHadiran->nama_siswa }} *({{ $kTidakHadiran->keterangan }})*</p>
@endforeach
            </div>

            @foreach ($dataKelas as $kelas)
                <li>
                    Ketidakhadiran {{ $kelas->tingkat .' '. $kelas->jurusan }}
                    <a href="#" uk-icon="copy" onclick="copyContent('kTidakHadiran-{{ $kelas->id_kelas }}')"></a>
                </li>
                @if ($groupedKTidakHadiran->has($kelas->id_kelas))
                    <div id="kTidakHadiran-{{ $kelas->id_kelas }}" style="display: none">
                        Data Ketidakhadiran Kelas {{ $kelas->tingkat .' '. $kelas->jurusan }} Hari {{ $hariIni }}
@foreach ($groupedKTidakHadiran[$kelas->id_kelas] as $item)
<p>• {{ $item->nama_siswa }} *({{ $kTidakHadiran->keterangan }})*</p>
@endforeach
                    </div>
                @else
                    <div id="kTidakHadiran-{{ $kelas->id_kelas }}" style="display: none">
                        Data Ketidakhadiran Kelas {{ $kelas->tingkat .' '. $kelas->jurusan }} Hari {{ $hariIni }} *NIHIL*
                    </div>
                @endif
            @endforeach
        </p>

    </div>
</div>
<script>
    const copyContent = (content) => {
        const textToCopy = document.getElementById(content)
        const copying = textToCopy.textContent.trim()
        navigator.clipboard.writeText(copying)
    }
</script>