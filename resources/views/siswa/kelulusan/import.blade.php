<div id="import" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-margin">
            <form action="/kelulusan/import" method="POST" enctype="multipart/form-data">
                @csrf
                <P>Upload file xlsx</P>
                <input class="uk-input" type="file" name="kelulusan" id="kelulusan">
                <button class="uk-button uk-button-primary uk-button-small uk-margin">Upload</button>
            </form>
        </div>
    </div>
</div>