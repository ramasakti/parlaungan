@extends('layout.closer')
@extends('layout.navdash')
@extends('layout.headerlouie')
@section('konten')
    <ul uk-tab>
        @foreach ($dataHari as $hari)
            <li class="uk-active"><a href="/jadwal?hari={{ $hari->nama_hari }}">{{ $hari->nama_hari }}</a></li>
        @endforeach
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
