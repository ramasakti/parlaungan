<div id="add-jampel" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Jampel</h5>
        <form method="POST" action="/jampel/store">
            @csrf
            <div class="uk-margin">
                <select class="uk-select" name="hari" id="hari">
                    @foreach ($dataHari as $hari)
                        <option value="{{ $hari->nama_hari }}">{{ $hari->nama_hari }}</option>
                    @endforeach
                </select>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="keterangan" placeholder="Keterangan" required>
            </div>
            <div class="uk-margin">
                <input name="mulai" placeholder="Mulai" class="textbox-n uk-input" type="text" onfocus="(this.type='time')" id="time" required>
            </div>
            <div class="uk-margin">
                <input name="selesai" placeholder="Selesai" class="textbox-n uk-input" type="text" onfocus="(this.type='time')" id="time" required>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Tambah</button>
        </form>
    </div>
</div>