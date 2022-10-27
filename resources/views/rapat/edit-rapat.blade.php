<div id="edit-rapat-{{ $rapat->id_rapat }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Rapat</h5>
        <form method="POST" action="/rapat/store" class="uk-margin">
            @csrf
            <input type="hidden" name="id_rapat" value="{{ $rapat->id_rapat }}">
            <input type="text" class="uk-input" name="judul" id="judul" placeholder="Judul Rapat" value="{{ $rapat->judul }}">
            <input type="hidden" class="uk-input" name="slug" id="slug">
            <input type="hidden" class="uk-input" name="penyelenggara" value="{{ session('status') }}">
            <div class="uk-margin-small-top">
                <p>Tanggal</p>
                <input type="date" name="tanggal" class="uk-input" value="{{ $rapat->tanggal }}">
            </div>
            <div class="uk-margin-small-top">
                <p>Mulai</p>
                <input type="time" name="mulai" class="uk-input" value="{{ $rapat->mulai }}">
            </div>
            <div class="uk-margin-small-top">
                <p>Sampai</p>
                <input type="time" name="sampai" class="uk-input" value="{{ $rapat->sampai }}">
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small uk-margin">Simpan</button>
        </form>
    </div>
</div>