<div id="add-kelas" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Kelas</h5>
        <form method="POST" action="/kelas/store">
            @csrf
            <div class="uk-margin">
                <select name="tingkat" class="uk-select">
                    <option value="VII">VII</option>
                    <option value="VIII">VIII</option>
                    <option value="IX">IX</option>
                    <option value="XII">XII</option>
                    <option value="XI">XI</option>
                    <option value="X">X</option>
                </select>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="jurusan" placeholder="Jurusan" required>
            </div>
            <div class="uk-margin">
                <select name="walas" class="uk-select" name="piket" required>
                    <option value="">Pilih Walas</option>
                    @foreach ($dataGuru as $guru)
                        <option value="{{ $guru->id_guru }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Tambah</button>
        </form>
    </div>
</div>