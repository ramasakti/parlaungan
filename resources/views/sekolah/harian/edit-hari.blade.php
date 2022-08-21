<div id="edit-hari-{{ $hari->id_hari }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Hari</h5>
        <form method="POST" action="/hari/update">
            @csrf
            <input type="hidden" name="id_hari" value="{{ $hari->id_hari }}">
            <div class="uk-margin">
                <input class="uk-input" type="text" value="{{ $hari->nama_hari }}" readonly>
            </div>
            <div class="uk-margin">
                <input name="masuk" placeholder="Masuk" class="textbox-n uk-input" type="text" onfocus="(this.type='time')" id="time" value="{{ $hari->masuk }}">
            </div>
            <div class="uk-margin">
                <input name="jampel" placeholder="Jampel" class="textbox-n uk-input" type="text" onfocus="(this.type='time')" id="time" value="{{ $hari->jampel }}">
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="piket" required>
                    <option value=""></option>
                    @foreach ($dataGuru as $guru)
                        <option  {{ ($guru->id_guru === $hari->piket) ? 'selected' : '' }} value="{{ $guru->id_guru }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>