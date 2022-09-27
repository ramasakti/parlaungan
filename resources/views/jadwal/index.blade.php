@extends('layout.closer')
@extends('layout.navdash')
@extends('layout.headerlouie')
@section('konten')
@include('jadwal.hari.kelas')
    <ul uk-tab>
        <li class="uk-active"><a href="#">Senin</a></li>
        <li class="uk-active"><a href="#">Selasa</a></li>
        <li class="uk-active"><a href="#">Rabu</a></li>
        <li class="uk-active"><a href="#">Kamis</a></li>
        <li class="uk-active"><a href="#">Jumat</a></li>
        <li class="uk-active"><a href="#">Sabtu</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">  
        <li class="uk-active">
            @include('jadwal.hari.Senin')
        </li> 
        <li class="uk-active">
            @include('jadwal.hari.Selasa')
        </li>
        <li class="uk-active">
            @include('jadwal.hari.Rabu')
        </li>
        <li class="uk-active">
            @include('jadwal.hari.Kamis')
        </li>
        <li class="uk-active">
            @include('jadwal.hari.Jumat')
        </li>
        <li class="uk-active">
            @include('jadwal.hari.Sabtu')
        </li>
    </ul>
@endsection
