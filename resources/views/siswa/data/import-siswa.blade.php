<div id="import-siswa" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Import Siswa</h5>
        <form id="formUpload" action="/siswa/import" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formFileSm" class="form-label">Small file input example</label>
                <input class="form-control form-control-sm" id="formFileSm" name="siswa" type="file">
                <button id="buttonUpload" class="uk-button uk-button-primary uk-button-small uk-margin uk-margin-remove-bottom" type="submit" onclick="uploading()">UPLOAD</button>
            </div>
        </form>
    </div>
</div>
<script>
    const formUpload = document.getElementById('formUpload')
    const buttonUpload = document.getElementById('buttonUpload')
    const uploading = () => {
        buttonUpload.setAttribute('disabled', '')
        buttonUpload.innerHTML = `<div uk-spinner="ratio: 0.5"></div>`
        formUpload.submit()
    }
</script>