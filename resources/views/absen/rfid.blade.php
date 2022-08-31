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
    <style>
        .input {
            border: 0px;
            color: white;
        }
    </style>

    <div class="uk-position-center">
        <center>
            <article class="uk-article uk-margin-top">
                <h1 class="uk-article-title">Sistem Absensi</h1>
            </article>
            <h2 class="uk-margin-small">
                <div id="txt"></div>
            </h2>
            <p class="uk-margin-small uk-text-default">Aplikasi ini dibuat dan dikembangkan oleh &copy; Staff IT Development And Infrastructure - SMA Islam Parlaungan</p>
            <form action="/absen/engine" method="POST">
                @csrf
                <input type="text" class="input" name="userabsen" style="outline: 0ch" autofocus autocomplete="off">
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
        </script>
</body>
</html>