<div id="edit-siswa-{{ $siswa->id_siswa }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Siswa</h5>
        <form method="POST" action="/siswa/update">
            @csrf
            <input type="hidden" name="id_lama" value="{{ $siswa->id_siswa }}">
            <div class="uk-margin">
                <input class="uk-input" type="text" name="id_siswa" value="{{ $siswa->id_siswa }}">
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}">
            </div>
            <div class="uk-margin">
                <select name="kelas_id" id="" class="uk-select">
                    @foreach ($dataKelas as $kelas)
                        <option {{ ($kelas->id_kelas === $siswa->kelas_id) ? 'selected' : '' }} value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }} {{ $kelas->jurusan }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>