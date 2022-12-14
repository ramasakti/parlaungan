@extends('layout.footer')
@extends('layout.navbar')
@extends('layout.header')
@section('konten')
<main>
  <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>

    <ul class="uk-slider-items uk-grid">
        <li class="uk-width-4-5">
            <div class="uk-panel">
                <img src="/img/banner-satu.jpg" width="1800" height="1200" alt="">
                <div class="uk-position-center uk-text-center">
                    <h2 uk-slider-parallax="x: 100,-100">Heading</h2>
                    <p uk-slider-parallax="x: 200,-200">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
        </li>
        <li class="uk-width-4-5">
            <div class="uk-panel">
                <img src="https://t-2.tstatic.net/medan/foto/bank/images/Contoh-gambar.jpg" width="1800" height="1200" alt="">
                <div class="uk-position-center uk-text-center">
                    <h2 uk-slider-parallax="x: 100,-100">Heading</h2>
                    <p uk-slider-parallax="x: 200,-200">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
        </li>
        <li class="uk-width-4-5">
            <div class="uk-panel">
                <img src="/img/banner-dua.jpg" width="1800" height="1200" alt="">
                <div class="uk-position-center uk-text-center">
                    <h2 uk-slider-parallax="x: 100,-100">Heading</h2>
                    <p uk-slider-parallax="x: 200,-200">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
        </li>
        <li class="uk-width-4-5">
            <div class="uk-panel">
                <img src="https://t-2.tstatic.net/medan/foto/bank/images/Contoh-gambar.jpg" width="1800" height="1200" alt="">
                <div class="uk-position-center uk-text-center">
                    <h2 uk-slider-parallax="x: 100,-100">Heading</h2>
                    <p uk-slider-parallax="x: 200,-200">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
        </li>
        <li class="uk-width-4-5">
            <div class="uk-panel">
                <img src="https://t-2.tstatic.net/medan/foto/bank/images/Contoh-gambar.jpg" width="1800" height="1200" alt="">
                <div class="uk-position-center uk-text-center">
                    <h2 uk-slider-parallax="x: 100,-100">Heading</h2>
                    <p uk-slider-parallax="x: 200,-200">Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
        </li>
    </ul>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

  </div>
</main>
@endsection