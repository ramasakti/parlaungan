<div id="edit-libur-{{ $libur->id_libur }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Libur</h5>
        <form method="POST" action="/libur/update">
            @csrf
            <input type="hidden" name="id_libur" value="{{ $libur->id_libur }}">
            <div class="uk-margin">
                <input class="uk-input" type="text" name="keterangan" placeholder="Keterangan" value="{{ $libur->keterangan }}">
            </div>
            <div class="uk-margin">
                <input name="mulai" placeholder="Mulai" class="textbox-n uk-input" type="text" onfocus="(this.type='date')" id="date" value="{{ $libur->mulai }}">
            </div>
            <div class="uk-margin">
                <input name="sampai" placeholder="Sampai" class="textbox-n uk-input" type="text" onfocus="(this.type='date')" id="date" value="{{ $libur->sampai }}">
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>