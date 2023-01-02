<div id="add-pembayaran" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Pembayaran</h5>
        <form method="POST" action="/pembayaran/store">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nama_pembayaran" placeholder="Nama pembayaran" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" id="nominal" type="number" name="nominal" placeholder="Nominal" required>
            </div>
            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                @foreach ($dataKelas as $kelas)
                    <label>
                        <input name="kelas[]" class="uk-checkbox" type="checkbox" value="{{ $kelas->id_kelas }}">
                        {{ $kelas->tingkat }} {{ $kelas->jurusan }}
                    </label>
                @endforeach
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Tambah</button>
        </form>
    </div>
</div>