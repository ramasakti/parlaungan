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
<body onload="startTime()">
    <script src="/js/html5-qrcode.min.js" type="text/javascript"></script>  
    <style>
        .input {
            border: 0px;
            color: white;
        }
    </style>
    <div class="uk-position-center">
        <center>
            <div class="uk-postion-center" style="width: 500px" id="reader"></div>

            <article class="uk-article uk-margin-top">
                <h1 class="uk-article-title">Sistem Absensi</h1>
            </article>

            <h2 class="uk-margin-small">
                <div id="txt"></div>
            </h2>

            <p class="uk-margin-small uk-text-default">Aplikasi ini dibuat dan dikembangkan oleh &copy; Staf Data, Informasi, Pengembangan dan Infrastruktur Teknologi - SMA Islam Parlaungan</p>
            <form action="/absen/engine" method="POST" id="formabsen">
                @csrf
                <input type="text" class="input" name="userabsen" style="outline: 0ch" id="userabsen" autofocus autocomplete="off" required>
                <input id="submitButton" class="button" type="submit" hidden>
            </form>
            
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

    <script>
        function startTime() {
          const today = new Date();
          let h = today.getHours();
          let m = today.getMinutes();
          let s = today.getSeconds();
          m = checkTime(m);
          s = checkTime(s);
          document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
          setTimeout(startTime, 1000);
        }
        
        function checkTime(i) {
          if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
          return i;
        }
        
        function onScanSuccess(decodedText) {
            //Handle on success condition with the decoded text or result.
            const inputan = document.getElementById('userabsen')
            inputan.setAttribute('value', decodedText)
            const form = document.getElementsByTagName('form')[0]
            form.submit()
            form.remove()
        }

        let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 120, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
        </script>
</body>
</html>