<div id="edit-absen-{{ $siswa->id_siswa }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Absen Siswa</h5>
        <form method="POST" action="/absen/update">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="id_siswa" value="{{ $siswa->id_siswa }}" readonly>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}" readonly>
            </div>
            <div class="uk-margin">
                <select name="keterangan" id="" class="uk-select">
                    <option value=""></option>
                    <option {{ ($siswa->keterangan === 'S') ? 'selected' : '' }} value="S">Sakit</option>
                    <option {{ ($siswa->keterangan === 'I') ? 'selected' : '' }} value="I">Izin</option>
                    <option {{ ($siswa->keterangan === 'A') ? 'selected' : '' }} value="A">Alfa</option>
                    <option value="Hadir">Hadir</option>
                </select>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>