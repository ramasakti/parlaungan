<div id="add-jadwal" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Jadwal</h5>
        <form method="POST" action="/jadwal/store">
            @csrf
            <div class="uk-margin">
                <select name="jampel" id="jampel" class="uk-select jampel">
                    <option value="" disabled selected hidden>Pilih Jam Pelajaran</option>
                    @foreach ($dataJampel as $jampel)
                        <option value="{{ $jampel->id_jampel }}">{{ $jampel->hari . ': ' . $jampel->keterangan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="uk-margin">
                <select name="kelas_id" class="uk-select">
                    <option value="" disabled selected hidden>Pilih Kelas</option>
                    @foreach ($dataKelas as $kelas)
                        <option value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }} {{ $kelas->jurusan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="mapel" placeholder="Mapel" required>
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="guru_id" required>
                    <option value="" disabled selected hidden>Pilih Guru</option>
                    @foreach ($dataGuru as $guru)
                        <option value="{{ $guru->id_guru }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="uk-button uk-button-primary uk-button-small">Tambah</button>
        </form>
    </div>
</div>
<script>  
    $(".jampel").select2();
</script>