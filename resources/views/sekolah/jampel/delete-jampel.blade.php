<div id="delete-jampel-{{ $jampel->id_jampel }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete User</h5>
        <p>Yakin delete jampel dengan keterangan <b>{{ $jampel->keterangan }}</b> ?</p>
        <form action="/jampel/delete" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="id_jampel" value="{{ $jampel->id_jampel }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>