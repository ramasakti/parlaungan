<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Absen Rapat</title>
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
                <h1 class="uk-article-title">Sistem Absensi Rapat</h1>
            </article>
            @if (session('success'))
                <div class="uk-alert-success" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('fail'))
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>{{ session('fail') }}</p>
                </div>
            @endif

            @if (session('bePresent'))
                <div class="uk-alert-warning" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>{{ session('bePresent') }}</p>
                </div>
            @endif

            <h2 class="uk-margin-small">
                <div id="txt"></div>
            </h2>
            <p class="uk-margin-small uk-text-default">Aplikasi ini dibuat dan dikembangkan oleh &copy; Staff IT Development and Infrastructure - SMA Islam Parlaungan</p>
            
            <form method="post">
                @csrf
                <input type="text" name="userabsen" id="userabsen" required autofocus>
            </form>

            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPeserta as $user)
                        <tr>
                            <td>{{ $ai++ }}</td>
                            <td>{{ $user->username }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </center>
    </div>
    
    <audio id="success">
        <source src="/audio/success.mp3" type="audio/mpeg">
    </audio>

    <script>
        const form = document.getElementsByTagName('form')[0]
        form.setAttribute('action', window.location.pathname)

        function onScanSuccess(decodedText) {
            //Handle on success condition with the decoded text or result.
            const audio = document.getElementById('success')
            audio.play()
            const inputan = document.getElementById('userabsen')
            inputan.setAttribute('value', decodedText)
            const form = document.getElementsByTagName('form')[0]
            form.submit()
            form.remove()
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 120, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
    
</body>
</html>