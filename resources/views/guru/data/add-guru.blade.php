<div id="add-guru" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Guru</h5>
        <form method="POST" action="/guru/store">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="id_guru" placeholder="ID / Username" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nama_guru" placeholder="Nama" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="password" placeholder="Password" required>
            </div>
            <div class="uk-margin">
                <textarea class="uk-textarea" name="alamat"  cols="30" rows="4"></textarea>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="telp" placeholder="Telp / WA" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="tempat_lahir" placeholder="Tempat Lahir" required>
            </div>
            <div class="uk-margin">
                <input name="tanggal_lahir" placeholder="Tanggal Lahir" class="textbox-n uk-input" type="date" onfocus="(this.type='date')" id="date">
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Tambah</button>
        </form>
    </div>
</div>