<div id="add-rapat" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Rapat</h5>
        <form method="POST" action="/rapat/store" class="uk-margin">
            @csrf
            <input type="text" class="uk-input" name="judul" id="judul" placeholder="Judul Rapat" >
            <input type="hidden" class="uk-input" name="slug" id="slug">
            <input type="hidden" class="uk-input" name="penyelenggara" value="{{ session('status') }}">
            <div class="uk-margin-small-top">
                <p>Tanggal</p>
                <input type="date" name="tanggal" class="uk-input">
            </div>
            <div class="uk-margin-small-top">
                <p>Mulai</p>
                <input type="time" name="mulai" class="uk-input">
            </div>
            <div class="uk-margin-small-top">
                <p>Sampai</p>
                <input type="time" name="sampai" class="uk-input">
            </div>
            <div class="uk-margin-small-top">
                <p>Kategori Peserta Rapat</p>
                <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" name="kategori[]" value="Siswa"> Siswa</label>
                <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" name="kategori[]" value="Guru"> Guru</label>
                <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" name="kategori[]" value="Walmur"> Wali Murid</label>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small uk-margin">Simpan</button>
        </form>
    </div>
</div>