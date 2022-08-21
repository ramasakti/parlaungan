<div id="delete-kelas-{{ $kelas->id_kelas }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete Kelas</h5>
        <p>Yakin delete Kelas <b>{{ $kelas->tingkat }} {{ $kelas->jurusan }}</b> ?</p>
        <form action="/kelas/delete" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>