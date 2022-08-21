<div id="delete-libur-{{ $libur->id_libur }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete User</h5>
        <p>Yakin delete libur dengan keterangan <b>{{ $libur->keterangan }}</b> ?</p>
        <form action="/libur/delete" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="id_libur" value="{{ $libur->id_libur }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>