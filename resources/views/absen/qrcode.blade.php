<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Absen</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/css/uikit.min.css" />
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/js/uikit-icons.min.js"></script>
</head>
<body>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <center>
        <div class="uk-postion-center" style="width: 500px" id="reader"></div>
    </center>

    <div class="uk-position-bottom">
        <center>
            <article class="uk-article uk-margin-top">
                <h1 class="uk-article-title">Sistem Absensi</h1>
            </article>
            <h2 class="uk-margin-small">
                <div id="txt"></div>
            </h2>
            <p class="uk-margin-small uk-text-default"> Aplikasi ini dibuat dan dikembangkan oleh &copy; SMA Islam Parlaungan</p>
            @if (session()->has('unregistered'))
                <div class="uk-alert-danger" uk-alert>
                    <p>{{ session('unregistered') }}</p>
                </div>
            @elseif (session()->has('bePresent'))
                <div class="uk-alert-warning" uk-alert>
                    <p>{{ session('bePresent') }} sudah absen!</p>
                </div>
            @elseif (session()->has('success'))
                <div class="uk-alert-success" uk-alert>
                    <p>{{ session('success') }} berhasil absen!</p>
                </div>
            @endif
        </center>
    </div>
    <script>
        function onScanSuccess(decodedText) {
            //Handle on success condition with the decoded text or result.
            window.location.href = '/absen/engine/' + `${decodedText}`;
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
    
</body>
</html>