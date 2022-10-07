<div id="import-jadwal" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Import Jadwal</h5>
        <form action="/jadwal/import" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formFileSm" class="form-label">Small file input example</label>
                <input class="form-control form-control-sm" id="formFileSm" name="jadwal" type="file">
                <button class="uk-button uk-button-primary uk-button-small uk-margin uk-margin-remove-bottom" type="submit">UPLOAD</button>
            </div>
        </form>
    </div>
</div>