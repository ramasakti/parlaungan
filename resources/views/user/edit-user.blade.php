<div id="edit-user-{{ $user->username }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit User</h5>
        <form method="POST" action="/user/update">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="username" placeholder="Username" value="{{ $user->username }}" readonly>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="telp" placeholder="Telp/WA" value="{{ $user->telp }}" readonly>
            </div>
            <div class="js-upload uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">Upload file excel dengan ekstensi .xlsx</span>
                <div uk-form-custom>
                    <input type="file">
                    <span class="uk-link">select one</span>
                </div>
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="status" required>
                    <option value="Guru" {{ ($user->status === 'Guru') ? 'selected' : '' }}>Guru</option>
                    <option value="Bendahara" {{ ($user->status === 'Bendahara') ? 'selected' : '' }}>Bendahara</option>
                    <option value="Kesiswaan" {{ ($user->status === 'Kesiswaan') ? 'selected' : '' }}>Kesiswaan</option>
                    <option value="Kurikulum" {{ ($user->status === 'Kurikulum') ? 'selected' : '' }}>Kurikulum</option>
                    <option value="Kepala Sekolah" {{ ($user->status === 'Kepala Sekolah') ? 'selected' : '' }}>Kepala Sekolah</option>
                </select>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>
<script>

    var bar = document.getElementById('js-progressbar');

    UIkit.upload('.js-upload', {

        url: '',
        multiple: true,

        beforeSend: function () {
            console.log('beforeSend', arguments);
        },
        beforeAll: function () {
            console.log('beforeAll', arguments);
        },
        load: function () {
            console.log('load', arguments);
        },
        error: function () {
            console.log('error', arguments);
        },
        complete: function () {
            console.log('complete', arguments);
        },

        loadStart: function (e) {
            console.log('loadStart', arguments);

            bar.removeAttribute('hidden');
            bar.max = e.total;
            bar.value = e.loaded;
        },

        progress: function (e) {
            console.log('progress', arguments);

            bar.max = e.total;
            bar.value = e.loaded;
        },

        loadEnd: function (e) {
            console.log('loadEnd', arguments);

            bar.max = e.total;
            bar.value = e.loaded;
        },

        completeAll: function () {
            console.log('completeAll', arguments);

            setTimeout(function () {
                bar.setAttribute('hidden', 'hidden');
            }, 1000);

            alert('Upload Completed');
        }

    });
</script>