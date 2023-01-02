<div id="import-user" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Import User</h5>
        <p>Yakin import user?</p>
        <form id="fImportUser" action="/user/import" method="POST">
            @csrf
            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                <label><input class="uk-checkbox" type="checkbox" name="data[]" value="guru"> Guru</label>
                <label><input class="uk-checkbox" type="checkbox" name="data[]" value="siswa"> Siswa</label>
                <label><input class="uk-checkbox" type="checkbox" name="data[]" value="walmur"> Walmur</label>
            </div>
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button id="bImportUser" type="submit" class="uk-button uk-button-primary" onclick="importingUser()">Ya</button>
        </form>
    </div>
</div>
<script>
    const fImportUser = document.getElementById('fImportUser')
    const bImportUser = document.getElementById('bImportUser')
    const importingUser = () => {
        bImportUser.setAttribute('disabled', '')
        bImportUser.innerHTML = `<div uk-spinner="ratio: 0.5"></div>`
        fImportUser.submit()
    }
</script>