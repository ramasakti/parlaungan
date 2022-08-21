@extends('layout.closer')
@extends('layout.navdash')
@extends('layout.headerlouie')
@section('konten')
    <ul uk-tab>
        <li class="{{ (session()->has('kelas')) ? 'uk-active' : '' }}"><a href="#">Kelas</a></li>
        <li class="{{ (session()->has('siswa')) ? 'uk-active' : '' }}"><a href="#">Data Siswa</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        <li class="{{ (session()->has('kelas')) ? 'uk-active' : '' }}">
            @include('siswa.kelas.index')
        </li>
        <li class="{{ (session()->has('siswa')) ? 'uk-active' : '' }}">
            @include('siswa.data.index')
        </li>
    </ul>
@endsection
