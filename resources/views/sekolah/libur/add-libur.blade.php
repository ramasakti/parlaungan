<div id="add-libur" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Libur</h5>
        <form method="POST" action="/libur/store">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="keterangan" placeholder="Keterangan" required>
            </div>
            <div class="uk-margin">
                <input name="mulai" placeholder="Mulai" class="textbox-n uk-input" type="text" onfocus="(this.type='date')" id="date" required>
            </div>
            <div class="uk-margin">
                <input name="sampai" placeholder="Sampai" class="textbox-n uk-input" type="text" onfocus="(this.type='date')" id="date" required>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Tambah</button>
        </form>
    </div>
</div>