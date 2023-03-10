<div class="container">
    @csrf
    <form class="uk-form-horizontal uk-margin-small mt-3" method="POST" action="/profile/updateAkun">
        @csrf
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Username</label>
            <div class="uk-form-controls">
                <input class="uk-input" name="username" type="text" value="{{ session('username') }}" readonly>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Password Lama</label>
            <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                    <a class="uk-form-icon uk-form-icon-flip" href="#" id="passwordLama" onclick="showHide('passwordLama')" uk-icon="icon: eye-slash"></a>
                    <input class="uk-input" name="passwordLama" type="password">
                </div>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Password Baru</label>
            <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                    <a class="uk-form-icon uk-form-icon-flip" href="#" id="passwordBaru" onclick="showHide('passwordBaru')" uk-icon="icon: eye-slash"></a>
                    <input class="uk-input" name="passwordBaru" type="password">
                </div>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Konfirmasi Password Baru</label>
            <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                    <a class="uk-form-icon uk-form-icon-flip" href="#" id="confPasswordBaru" onclick="showHide('confPasswordBaru')" uk-icon="icon: eye-slash"></a>
                    <input class="uk-input" name="confPasswordBaru" type="password">
                </div>
            </div>
        </div>

        <button class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="submit">Simpan</button>
    </form>
</div>
<script>
    const showHide = (id) => {
        const passwordLama = document.getElementById(id)
        const oldPassword = document.getElementsByName(id)[0]
        if (oldPassword.getAttribute('type') == 'password') {
            passwordLama.setAttribute('uk-icon', 'icon: eye')
            oldPassword.setAttribute('type', 'text')
        }else{
            passwordLama.setAttribute('uk-icon', 'icon: eye-slash')
            oldPassword.setAttribute('type', 'password')
        }
    }
</script>