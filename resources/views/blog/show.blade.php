<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data[0]->judul }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/css/uikit.min.css" />
    <!-- Primary Meta Tags -->
    <meta name="title" content="{{ $data[0]->judul }}">
    <meta name="description" content="SMA Islam Parlaungan">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://smaispa.sch.id/blog/view/{{ $data[0]->slug }}">
    <meta property="og:title" content="{{ $data[0]->judul }}">
    <meta property="og:description" content="SMA Islam Parlaungan">
    <meta property="og:image" content="https://smaispa.sch.id/storage/blog/blog/{{ $data[0]->foto }}">
    <meta property="og:image:height" content="364">
    <meta property="og:image:width" content="648">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://smaispa.sch.id/blog/view/{{ $data[0]->slug }}">
    <meta property="twitter:title" content="{{ $data[0]->judul }}">
    <meta property="twitter:description" content="SMA Islam Parlaungan">
    <meta property="twitter:image" content="https://smaispa.sch.id/storage/blog/blog/{{ $data[0]->foto }}">
</head>
<body>
    <div class="uk-container uk-container-xsmall">
        <article>
			<header class="uk-margin-medium-bottom">
				<h1 class="uk-article-title" id="title">Judul Artikel</h1>
				<p id="author" class="uk-margin-remove-bottom">Penulis: Penulis</p>
				<p id="uploaded" class="uk-margin-remove-top">Tanggal: 1 Mei 2023</p>
			</header>

			<div class="uk-margin-medium-bottom">
				<img id="banner" src="http://127.0.0.1:8000/storage/blog/20230429164815.png" alt="Gambar artikel" class="uk-align-center">
			</div>

			<section class="uk-margin-medium-bottom">
                <div id="artikel"></div>
			</section>

			<footer>
				<p>Tag artikel: <a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 3</a></p>
			</footer>
		</article>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit-icons.min.js"></script>
    <script>
        const api = window.location.pathname.replace('view', 'api');
        const url = window.location.origin
        const artikel = document.getElementById('artikel')
        const title = document.getElementById('title')
        const author = document.getElementById('author')
        const uploaded = document.getElementById('uploaded')
        const banner = document.getElementById('banner')
        
        fetch(url + api)
            .then(response => response.json())
            .then(data => {
                artikel.innerHTML = data[0].isi
                title.innerHTML = data[0].judul
                author.innerHTML = 'Penulis: ' + data[0].uploader
                uploaded.innerHTML = 'Tanggal: ' + data[0].uploaded
                banner.setAttribute('src', url + '/storage/blog/' + data[0].foto)
            })
            .catch(error => console.error(error));
    </script>
</body>
</html>