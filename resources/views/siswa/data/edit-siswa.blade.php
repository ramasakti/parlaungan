<div id="edit-siswa-{{ $siswa->id_siswa }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Siswa</h5>
        <form method="POST" action="/siswa/update">
            @csrf
            <input type="hidden" name="id_lama" value="{{ $siswa->id_siswa }}">
            <div class="uk-margin">
                <input class="uk-input" type="text" name="id_siswa" value="{{ $siswa->id_siswa }}" readonly>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="rfid" value="{{ $siswa->rfid }}">
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
            <div class="uk-margin">
                <textarea class="uk-textarea" rows="5" placeholder="Alamat" name="alamat">{{ $siswa->alamat }}</textarea>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="telp" placeholder="Telp / WA" value="{{ $siswa->telp }}" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ $siswa->tempat_lahir }}" required>
            </div>
            <div class="uk-margin">
                <input name="tanggal_lahir" placeholder="Tanggal Lahir" class="textbox-n uk-input" type="text" onfocus="(this.type='date')" id="date" value="{{ $siswa->tanggal_lahir }}">
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>