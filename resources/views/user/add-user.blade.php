<div id="add-user" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add User</h5>
        <form method="POST" action="/user/store">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="username" placeholder="Username" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nama" placeholder="Nama" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="password" placeholder="Password" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="telp" placeholder="Telp/WA" required>
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="status" required>
                    <option value="Guru">Guru</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Kesiswaan">Kesiswaan</option>
                    <option value="Kurikulum">Kurikulum</option>
                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                </select>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Tambah</button>
        </form>
    </div>
</div>