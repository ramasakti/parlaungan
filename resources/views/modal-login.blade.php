<div id="modal-login" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h3 class="uk-text-center">Login</h3>
        @if (session()->has('gagal'))
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{{ session('gagal') }}</p>
            </div>
        @endif
        <div class="uk-margin">
            <form action="/login" method="post" id="formLogin">
                @csrf
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input type="text" class="uk-input uk-margin-small" name="username" placeholder="Username">
                </div>
                <div class="uk-inline uk-width-1-1">
                    <a class="uk-form-icon uk-form-icon-flip" href="#" uk-icon="icon: eye-slash" id="iconEye" onclick="showHide()"></a>
                    <input type="password" id="password" class="uk-input uk-margin-small" name="password" placeholder="Password">
                </div>
                <button id="loginButton" type="submit" onclick="login()" onsubmit="login()" class="uk-button uk-margin-small uk-button-primary uk-width-1-1">Login</button>
            </form>
        </div>
    </div>
</div>
<script>
    const formLogin = document.getElementById('formLogin')
    const buttonLogin = document.getElementById('loginButton')
    const login = () => {
        buttonLogin.setAttribute('disabled', '')
        buttonLogin.innerHTML = `<div uk-spinner="ratio: 0.5"></div>`
        formLogin.submit()
    }

    const showHide = () => {
        const password = document.getElementById('password')
        const iconEye = document.getElementById('iconEye')
        if (password.getAttribute('type') == 'password') {
            iconEye.setAttribute('uk-icon', 'icon: eye')
            password.setAttribute('type', 'text')
        }else{
            iconEye.setAttribute('uk-icon', 'icon: eye-slash')
            password.setAttribute('type', 'password')
        }
    }
</script>