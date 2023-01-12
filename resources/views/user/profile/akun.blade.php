<div class="container">
    <form class="uk-form-horizontal uk-margin-small mt-3" method="POST" action="/profile/updatePassword">
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Username</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="form-horizontal-text" type="text" value="{{ session('username') }}" readonly disabled>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Password Lama</label>
            <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                    <a class="uk-form-icon uk-form-icon-flip" href="#" id="passwordLama" onclick="showhidePassLama()" uk-icon="icon: lock"></a>
                    <input class="uk-input" name="passwordLama" id="form-horizontal-text" type="password">
                </div>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Password Baru</label>
            <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                    <a class="uk-form-icon uk-form-icon-flip" href="#" id="passwordBaru" uk-icon="icon: lock"></a>
                    <input class="uk-input" name="passwordBaru" id="form-horizontal-text" type="password">
                </div>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Konfirmasi Password Baru</label>
            <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                    <a class="uk-form-icon uk-form-icon-flip" href="#" uk-icon="icon: lock"></a>
                    <input class="uk-input" name="passwordConfirm" id="form-horizontal-text" type="password">
                </div>
            </div>
        </div>

        <button class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="submit">Simpan</button>
    </form>
</div>