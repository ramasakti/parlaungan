<div id="edit-kelas-{{ $kelas->id_kelas }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Kelas</h5>
        <form method="POST" action="/kelas/update">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
            <div class="uk-margin">
                <select class="uk-select" name="tingkat" id="">
                    <option {{ ($kelas->tingkat === 'XII') ? 'selected' : '' }} value="XII">XII</option>
                    <option {{ ($kelas->tingkat === 'XI') ? 'selected' : '' }} value="XI">XI</option>
                    <option {{ ($kelas->tingkat === 'X') ? 'selected' : '' }} value="X">X</option>
                </select>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="jurusan" id="" value="{{ $kelas->jurusan }}" placeholder="Jurusan">
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="walas" id="">
                    <option value=""></option>
                    @foreach ($dataGuru as $guru)
                        <option {{ ($kelas->walas === $guru->id_guru) ? 'selected' : '' }} value="{{ $guru->id_guru }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>