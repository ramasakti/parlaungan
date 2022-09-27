<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Absen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/css/uikit.min.css" />
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/js/uikit-icons.min.js"></script>
</head>
<body>
    {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
    <script src="/js/html5-qrcode.min.js" type="text/javascript"></script>

    <center>
        <div class="uk-postion-center" style="width: 500px" id="reader"></div>
    </center>

    <div class="container">
        <center>
            <article class="uk-article uk-margin-top">
                <h1 class="uk-article-title">Sistem Absensi</h1>
            </article>
            <h2 class="uk-margin-small">
                <div id="txt"></div>
            </h2>
            <p class="uk-margin-small uk-text-default">Aplikasi ini dibuat dan dikembangkan oleh &copy; Staff IT Development and Infrastructure - SMA Islam Parlaungan</p>
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
            
            @if (session()->has('filled'))
                <div class="uk-alert-warning" uk-alert>
                    <p>{{ session('filled') }}</p>
                </div>
            @elseif (session()->has('unschedule'))
                <div class="uk-alert-danger" uk-alert>
                    <p>{{ session('unschedule') }}</p>
                </div>
            @elseif (session()->has('inserted'))
                <div class="uk-alert-success" uk-alert>
                    <p>{{ session('inserted') }}</p>
                </div>
            @endif
        </center>
    </div>
            
    <audio id="success">
        <source src="/audio/success.mp3" type="audio/mpeg">
    </audio>
    <script>
        function onScanSuccess(decodedText) {
            //Handle on success condition with the decoded text or result.
            const audio = document.getElementById('success')
            audio.play()
            window.location.href = '/absen/engine/' + `${decodedText}`;
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 120, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
    
</body>
</html>