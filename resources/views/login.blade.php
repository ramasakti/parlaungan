@extends('layout.footer')
@extends('layout.navbar')
@extends('layout.header')
@section('konten')
<div class="konten ms-2 me-2">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
            @if (session()->has('gagal'))
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>{{ session('gagal') }}</p>
                </div>
            @endif
            <form action="/login" method="POST" id="formLogin">
                @csrf
                <div class="mb-3 align-self-center">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                </div>
                <div class="mb-3 align-self-center">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button id="loginButton" type="submit" onclick="login()" onsubmit="login()" class="uk-button uk-button-primary uk-width-1-1">Login</button>
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
@endsection