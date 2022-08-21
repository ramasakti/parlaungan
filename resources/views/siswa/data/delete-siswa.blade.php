<div id="delete-siswa-{{ $siswa->id_siswa }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete Siswa</h5>
        <p>Yakin delete siswa dengan nama <b>{{ $siswa->nama_siswa }}</b> ?</p>
        <form action="/siswa/delete" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>