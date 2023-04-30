<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kartu Pelajar Digital</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/css/uikit.min.css" />
</head>
<style>
    .image-wrapper {
      position: relative;
      width: 200px;
      height: 200px;
      overflow: hidden;
      border-radius: 50%;
      margin: 0 auto;
    }
    .image-wrapper img {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      min-width: 100%;
      min-height: 100%;
    }

    html, body {
        background-image: url('/img/bgkp-2.svg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
</style>
<body>
    <div class="uk-container uk-container-xsmall">
        <div class="uk-text-center">
            <h4 class="uk-margin-remove">Kartu Pelajar Digital</h4>
            <h4 class="uk-margin-remove">SMA ISLAM PARLAUNGAN</h4>
            <img class="image-wrapper uk-border-circle uk-margin-top uk-margin-bottom-remove" src="/storage/profil/{{ $data->foto }}">
            <h2 class="uk-margin-small">{{ $data->nama_siswa }}</h2>
        </div>
        <div class="uk-margin">
            <p class="uk-margin-remove uk-text-emphasis">
                <span uk-icon="icon: hashtag"></span>&nbsp; {{ $data->id_siswa }}
            </p>
            <p class="uk-margin-remove uk-text-emphasis">
                <span uk-icon="icon: calendar"></span>&nbsp; {{ $data->tempat_lahir . ', ' . $data->tanggal_lahir }}
            </p>
            <p class="uk-margin-remove uk-text-emphasis">
                <span uk-icon="icon: location"></span>&nbsp; {{ $data->alamat }}
            </p>
            <p class="uk-margin-remove uk-text-emphasis">
                <span uk-icon="icon: whatsapp"></span>&nbsp; {{ $data->telp }}
            </p>
            <div class="uk-margin uk-text-center uk-position-bottom-center">
                <p>Dibuat dan Dikembangkan Oleh</p>
                <p>Staf Data, Informasi, Pengembangan, dan Infrastruktur Teknologi - SMA Islam Parlaungan</p>
            </div>
        </div>
    </div>
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit-icons.min.js"></script>
</body>
</html>