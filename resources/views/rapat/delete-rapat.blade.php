<div id="delete-rapat-{{ $rapat->id_rapat }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete Rapat</h5>
        <p>Yakin delete rapat <b>{{ $rapat->judul }}</b> ?</p>
        <form action="/rapat/delete" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="id_rapat" value="{{ $rapat->id_rapat }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>