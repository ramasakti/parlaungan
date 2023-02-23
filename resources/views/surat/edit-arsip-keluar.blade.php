<div id="edit-arsip-keluar-{{ $keluar->id_arsip }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Arsip Surat</h5>
        <form method="POST" action="/arsip/update">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="date" name="tanggal" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nomor" value="{{ $keluar->nomor }}" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="perihal" value="{{ $keluar->perihal }}" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="url" value="{{ $keluar->url }}" required>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>
