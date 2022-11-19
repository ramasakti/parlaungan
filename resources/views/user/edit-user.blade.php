<div id="edit-user-{{ $user[0]->username }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit User</h5>
        <form method="POST" action="/user/update" enctype="multipart/form-data">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="username" placeholder="Username" value="{{ $user[0]->username }}" readonly>
            </div>
            <div class="js-upload uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">Upload file excel dengan ekstensi .xlsx</span>
                <div uk-form-custom>
                    <input type="file">
                    <span class="uk-link">select one</span>
                </div>
            </div>
            @if ($user[0]->status === 'Siswa' or $user[0]->status === 'Walmur')
                <div class="uk-margin">
                    <select class="uk-select" name="status" required>
                        <option value="Siswa" {{ ($user[0]->status === 'Siswa') ? 'selected' : '' }}>Siswa</option>
                        <option value="Guru" {{ ($user[0]->status === 'Guru') ? 'selected' : '' }}>Guru</option>
                        <option value="Bendahara" {{ ($user[0]->status === 'Bendahara') ? 'selected' : '' }}>Bendahara</option>
                        <option value="Kesiswaan" {{ ($user[0]->status === 'Kesiswaan') ? 'selected' : '' }}>Kesiswaan</option>
                        <option value="Kurikulum" {{ ($user[0]->status === 'Kurikulum') ? 'selected' : '' }}>Kurikulum</option>
                        <option value="Kepala Sekolah" {{ ($user[0]->status === 'Kepala Sekolah') ? 'selected' : '' }}>Kepala Sekolah</option>
                        <option value="Admin" {{ ($user[0]->status === 'Admin') ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            @endif
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