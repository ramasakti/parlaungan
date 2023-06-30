<div id="sharer" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>

        <p>
            Salin Data Keterlambatan Siswa Hari Ini
            <a href="#" uk-icon="copy" onclick="copyContent('terlambat')"></a>
            <div id="terlambat" style="display: none">
                @foreach ($dataTerlambat as $terlambat)
                    <p>{{ $terlambat->nama_siswa }}</p>
                @endforeach
            </div>
        </p>
        <p>
            Salin Data Ketidakhadiran Siswa Hari Ini
            <a href="#" uk-icon="copy" onclick="copyContent('kTidakHadiran')"></a>
            <div id="kTidakHadiran" style="display: none">
                @foreach ($dataKetidakhadiran as $kTidakHadiran)
                    <p>{{ $kTidakHadiran->nama_siswa }}</p>
                @endforeach
            </div>
        </p>
    </div>
</div>
<script>
    const copyContent = (content) => {
        const textToCopy = document.getElementById(content).innerText
        navigator.clipboard.writeText(textToCopy)
        console.log(textToCopy)
    }
</script>