<div id="edit-{{ $item->nisn }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Kelulusan</h5>
        <form method="POST" action="/kelulusan/update">
            @csrf
            <input type="hidden" name="nisn" value="{{ $item->nisn }}">
            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                <label><input class="uk-radio" type="radio" name="lulus[]" value="1" @checked($item->lulus == true)> Lulus</label>
                <label><input class="uk-radio" type="radio" name="lulus[]" value="0" @checked($item->lulus == false)> Tidak Lulus</label>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>