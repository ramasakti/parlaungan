<div id="add-siswa" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Siswa</h5>
        <form method="POST" action="/siswa/store">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="id_siswa" placeholder="ID Siswa" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="rfid" placeholder="RFID">
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nama_siswa" placeholder="Nama Siswa" required>
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="kelas_id" required>
                    <option value="">Pilih Kelas</option>
                    @foreach ($dataKelas as $kelas)
                        <option value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }} {{ $kelas->jurusan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="uk-margin">
                <textarea class="uk-textarea" rows="5" placeholder="Alamat" name="alamat"></textarea>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="telp" placeholder="Telp / WA" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="tempat_lahir" placeholder="Tempat Lahir" required>
            </div>
            <div class="uk-margin">
                <input name="tanggal_lahir" placeholder="Tanggal Lahir" class="textbox-n uk-input" type="text" onfocus="(this.type='date')" id="date">
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Tambah</button>
        </form>
    </div>
</div>