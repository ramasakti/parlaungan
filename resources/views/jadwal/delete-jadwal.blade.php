<div id="delete-jadwal-{{ $jadwal->id_jadwal }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete Jadwal</h5>
        <p>Yakin delete jadwal <b></b> ?</p>
        <form action="/jadwal/delete" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="id_jadwal" value="{{ $jadwal->id_jadwal }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>