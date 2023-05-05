<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengumuman Kelulusan SMA Islam Parlaungan</title>
    <!-- Primary Meta Tags -->
    <meta name="title" content="Pengumuman Kelulusan SMA Islam Parlaungan">
    <meta name="description" content="SMA Islam Parlaungan">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://smaispa.sch.id/kelulusan">
    <meta property="og:title" content="Pengumuman Kelulusan SMA Islam Parlaungan">
    <meta property="og:site_name" content="smaispa">
    <meta property="article:publisher" content="https://www.instagram.com/officialsmaispa/"/>
    <meta property="og:description" content="SMA Islam Parlaungan">
    <meta property="og:image" content="https://smaispa.sch.id/steller/imgs/lambang.png">
    <meta property="og:image:height" content="364">
    <meta property="og:image:width" content="648">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://smaispa.sch.id/kelulusan">
    <meta property="twitter:title" content="Pengumuman Kelulusan SMA Islam Parlaungan">
    <meta property="twitter:description" content="SMA Islam Parlaungan">
    <meta property="twitter:image" content="https://smaispa.sch.id/steller/imgs/lambang.png">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/css/uikit.min.css" />
</head>
<body>
    <div class="uk-section">
        <div class="uk-container uk-container-xsmall">
            <h1>Periksa Kelulusan</h1>
            <form class="uk-form-stacked" id="formKelulusan" method="POST" action="/kelulusan">
                @csrf
                <div class="uk-margin">
                <label class="uk-form-label" for="nisn">Nomor Induk Siswa Nasional</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="nisn" name="nisn" placeholder="Masukkan NISN" required autofocus>
                </div>
                </div>
                <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="buttonCek">Periksa</button>
            </form>
            <div class="uk-margin-top" id="result">
                @if (session()->has('lulus'))    
                    <div uk-alert class="uk-alert-success">
                        <a class="uk-alert-close" uk-close></a>
                        <h3>Selamat! {{ session('lulus') }}</h3>
                        <p>Anda dinyatakan lulus! Semoga harimu menyenangkan.</p>
                    </div>
                @endif
                @if (session()->has('gagal'))    
                    <div uk-alert class="uk-alert-danger">
                        <a class="uk-alert-close" uk-close></a>
                        <h3>Selamat! {{ session('gagal') }}</h3>
                        <p>Anda dinyatakan lulus! Semoga harimu menyenangkan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        const formKelulusan = document.getElementById('formKelulusan')
        const buttonCek = document.getElementById('buttonCek')
        formKelulusan.addEventListener('submit', () => buttonCek.innerHTML = `<div uk-spinner="ratio: 0.5"></div>`)
    </script>
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit-icons.min.js"></script>
</body>
</html>