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
                <input type="text" class="uk-input uk-margin-small" name="username" placeholder="Username">
                <input type="password" class="uk-input uk-margin-small" name="password" placeholder="Password">
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
</script>