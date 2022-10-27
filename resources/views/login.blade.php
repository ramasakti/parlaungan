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
            <form action="/login" method="POST">
                @csrf									 
                <div class="mb-3 align-self-center">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                </div>
                <div class="mb-3 align-self-center">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <button type="submit" class="uk-button uk-button-primary uk-width-1-1">Login</button>
            </form>
        </div>
    </div>	
</div>
@endsection