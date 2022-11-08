<div id="delete-pembayaran-{{ $pembayaran->id_pembayaran }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete Pembayaran</h5>
        <p>Yakin delete pembayaran dengan nama <b>{{ $pembayaran->nama_pembayaran }}</b> ?</p>
        <form action="/pembayaran/delete" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="id_pembayaran" value="{{ $pembayaran->id_pembayaran }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>