<div id="delete-arsip-keluar-{{ $keluar->id_arsip }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete Arsip</h5>
        <p>Yakin delete arsip keluar dengan nomor <b>{{ $keluar->nomor }}</b> perihal <b>{{ $keluar->perihal }}</b> ?</p>
        <form action="/arsip/delete" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="id_arsip" value="{{ $keluar->id_arsip }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>