<div id="delete-guru-{{ $showGuru->id_guru }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete Guru</h5>
        <p>Yakin delete guru dengan nama <b>{{ $showGuru->nama_guru }}</b> ?</p>
        <form action="/guru/delete" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="id_guru" value="{{ $showGuru->id_guru }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>